<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use PayPal\Api\Item;
use PayPal\Api\Payer;

use App\Start;

class Checkout extends Controller
{
    public function paySuscription() {
        $product = 'Alas Flight Academy Suscription';
        $price = 120.00;
        $shipping = 2.00;

        $total = $price + $shipping;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($product)->setCurrency('US')->setQuantity('1')->price($price);

    }
}
