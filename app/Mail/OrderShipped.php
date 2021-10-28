<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order_details;
    public $courier_name;
    public $tracking_number;
    public $lang;

    public function __construct($order_details, $courier_name, $tracking_number, $lang)
    {
        $this->order_details   = $order_details;
        $this->courier_name    = $courier_name;
        $this->tracking_number = $tracking_number;
        $this->lang            = $lang;
    }
    
    public function build()
    {
        return $this->subject('Mail from Camixyre')->view('templates.emails.order-shipped');
    }
}
