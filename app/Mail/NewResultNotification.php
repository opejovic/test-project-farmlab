<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewResultNotification extends Mailable
{

    use Queueable, SerializesModels;

    public $labresult;
    public $vet;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($labresult, $vet)
    {
        $this->labresult = $labresult;
        $this->vet = $vet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.result');
    }
}
