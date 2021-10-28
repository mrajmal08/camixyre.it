<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $cartIdsList;
    public $cartList;
    public $cartProducts;
    public $currencySymbol;
    public $currencyCode;
    public $lang;

    public function __construct($order, $cartIdsList, $cartList, $cartProducts, $currencySymbol, $currencyCode, $lang)
    {
        $this->order          = $order;
        $this->cartIdsList    = $cartIdsList;
        $this->cartList       = $cartList;
        $this->cartProducts   = $cartProducts;
        $this->currencySymbol = $currencySymbol;
        $this->currencyCode   = $currencyCode;
        $this->lang           = $lang;
    }
    
    public function build()
    {
        return $this->subject('Mail from Camixyre')->view('templates.emails.order-successful');
    }
}
