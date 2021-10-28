<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $order_details;
    public $cartIdsList;
    public $productsList;
    public $attributesList;
    public $currencySymbol;
    public $currencyCode;
    public $lang;
    
    public function __construct($order_details, $cartIdsList, $productsList, $attributesList, $currencySymbol, $currencyCode, $lang)
    {
        $this->order_details  = $order_details;
        $this->cartIdsList    = $cartIdsList;
        $this->productsList   = $productsList;
        $this->attributesList = $attributesList;
        $this->currencySymbol = $currencySymbol;
        $this->currencyCode   = $currencyCode;
        $this->lang           = $lang;
    }
    
    public function build()
    {
        return $this->subject('Mail from Camixyre')->view('templates.emails.order-submitted');
    }
}
