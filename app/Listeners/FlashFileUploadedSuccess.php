<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FlashFileUploadedSuccess
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FileUploaded  $event
     * @return void
     */
    public function handle(FileUploaded $event)
    {
        session()->flash('message', [
            'title' => 'Success!',
            'text'  => 'File successfully uploaded.',
            'type'  => 'success'
        ]);
    }
}
