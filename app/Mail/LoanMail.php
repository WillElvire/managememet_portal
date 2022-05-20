<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Loan;
class LoanMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $email;
    protected $loan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,Loan $loan )
    {
        //
        $this->email  = $email;
        $this->loan = $loan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.loan');
    }
}
