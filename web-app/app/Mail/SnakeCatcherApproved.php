<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SnakeCatcher;

class SnakeCatcherApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $catcher;

    public function __construct(SnakeCatcher $catcher)
    {
        $this->catcher = $catcher;
    }

    public function build()
    {
        return $this->subject('Snake Catcher Application Approved')
                    ->view('emails.snake_catcher_approved');
    }
}