<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Link;

class IncrementLinkUsage implements ShouldQueue
{
    use Queueable;

    protected $linkId;

    /**
     * Create a new job instance.
     */
    public function __construct($linkId)
    {
        $this->linkId = $linkId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $link = Link::find($this->linkId);
        if ($link) {
            $link->incrementUsage();
        }
    }
}
