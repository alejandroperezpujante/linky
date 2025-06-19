<?php

namespace App\Http\Controllers;

use App\LinkStatus;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use App\Jobs\IncrementLinkUsage;

class LinkController
{
    /**
     * Handle the incoming request.
     */
    public function external(Request $request, string $short_code)
    {
        $link = Link::where('short_code', $short_code)->first();
        if (! $link) {
            return view('errors.404');
        }
        if (Gate::denies('follow', $link)) {
            return view('errors.423');
        }
        IncrementLinkUsage::dispatch($link->id);
        return redirect()->away($link->original_url);
    }

    // List links
    public function index()
    {
        $links = Link::latest()->simplePaginate(5);
        return view('links.index', ['links' => $links]);
    }

    // Show create form
    public function create()
    {
        $status_options = LinkStatus::forSelect();
        return view('links.create', [
            'status_options' => $status_options,
        ]);
    }

    // Store new link
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'original_url' => 'required|string|url',
            'status' => ['required', Rule::enum(LinkStatus::class)],
        ]);
        Link::create([
            'name' => $request->name,
            'original_url' => $request->original_url,
            'status' => $request->status,
            'short_code' => Str::random(8),
            'user_id' => auth()->id(),
        ]);
        return to_route('links.index');
    }

    // Show edit form
    public function edit(Request $request, Link $link)
    {
        Gate::authorize('edit', $link);
        $status_options = LinkStatus::forSelect();
        return view('links.edit', [
            'link' => $link,
            'status_options' => $status_options,
        ]);
    }

    // Update link
    public function update(Request $request, Link $link)
    {
        if (! $link) {
            return view('errors.404');
        }
        Gate::authorize('update', $link);
        $request->validate([
            'name' => 'required|string|max:255',
            'original_url' => 'required|string|url',
            'status' => ['required', Rule::enum(LinkStatus::class)],
        ]);
        $link->update($request->all());
        return to_route('links.edit', $link)
            ->with('success', 'Link updated successfully');
    }

    // Delete link
    public function destroy(Request $request, Link $link)
    {
        Gate::authorize('delete', $link);
        $link->delete();
        return back();
    }

    // Toggle link status
    public function toggleStatus(Request $request, Link $link)
    {
        Gate::authorize('toggle', $link);
        $new_status = match ($link->status) {
            LinkStatus::ACTIVE => LinkStatus::INACTIVE,
            LinkStatus::INACTIVE => LinkStatus::ACTIVE,
        };
        $link->update(['status' => $new_status]);
        return back();
    }
}
