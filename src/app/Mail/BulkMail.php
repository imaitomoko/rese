<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;

    public function __construct($messageContent)
    {
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('一斉送信メッセージ')
                    ->view('admin.bulkmail');
    }

    /**
     * Create a new message instance.
     *
     * @return void
     */
    

    /**
     * Build the message.
     *
     * @return $this
     */
    
}
