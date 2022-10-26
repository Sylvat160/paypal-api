<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $file = view('pdf')->render();
        echo "<script>console.log($file)</script>";
        // dd($file);
        return $this->markdown('emails.users.payment')
                    ->subject('Payment Successful')
                    ->attachData($file, 'payment', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
