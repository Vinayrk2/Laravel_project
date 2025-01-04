<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cartItems;
    public $subTotal;
    public $tax;
    public $total;

    public function __construct($user, $cartItems, $subTotal, $tax, $total)
    {
        $this->user = $user;
        $this->cartItems = $cartItems;
        $this->subTotal = $subTotal;
        $this->tax = $tax;
        $this->total = $total;
    }

    public function build()
    {
        return $this->subject('Order Confirmation')
                    ->view('emails.order-confirmation');
    }
} 