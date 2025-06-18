<?php

namespace App\Http\Controllers;

use App\LinkStatus;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LinkManagementController
{
    public function index()
    {
        $links = Link::latest()->simplePaginate(5);

        return view('links.index', ['links' => $links]);
    }

    public function create()
    {
        $status_options = LinkStatus::forSelect();

        return view('links.create', [
            'status_options' => $status_options,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'original_url' => 'required|string|url',
            'status' => ['required', Rule::enum(LinkStatus::class)],
        ]);

        $link = Link::create([
            'name' => $request->name,
            'original_url' => $request->original_url,
            'status' => $request->status,
            'short_code' => Str::random(8),
            'user_id' => auth()->id(),
        ]);

        return to_route('links.index');
    }

    public function edit(Request $request, Link $link)
    {
        if ($link->user_id !== $request->user()->id) {
            abort(403);
        }

        $status_options = LinkStatus::forSelect();
        return view('links.edit', [
            'link' => $link,
            'status_options' => $status_options,
        ]);
    }

    public function update(Request $request, $id)
    {
        $link = Link::findOrFail($id);
        if ($link->user_id !== $request->user()->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'original_url' => 'required|string|url',
            'status' => ['required', Rule::enum(LinkStatus::class)],
        ]);

        $link->update($request->all());

        return to_route('links.edit', $link)
            ->with('success', 'Link updated successfully');
    }

    public function destroy(Request $request, Link $link)
    {
        if ($link->user_id !== $request->user()->id) {
            abort(403);
        }

        $link->delete();

        return back();
    }
}
