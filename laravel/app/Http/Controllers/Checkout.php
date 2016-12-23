<?php

namespace App\Http\Controllers;

use App\AlasPayment;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use League\Flysystem\Exception;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;


use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class Checkout extends Controller
{
    public function paySuscription(Request $request) {

        if(!$request->has('email')) {
            die();
        }

        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $email = $request['email'];

        $user = User::where('email', $email)->first();

        if($user == null) die();

        $SITE_URL = 'http://localhost/AlasFlightAcademy/laravel/public';

        $product = 'Alas Flight Academy Suscription';
        $price = 10.00;
        $shipping = 2.00;

        $total = $price + $shipping;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($product)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping($shipping)
            ->setSubtotal($price);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Pay for Alas Flight Academy Subscription')
            ->setInvoiceNumber(uniqid());

        $serial = bin2hex(openssl_random_pseudo_bytes(20));
        $user_id = $user->id;

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($SITE_URL . '/pay?success=true&student='.$user_id.'&serial='.$serial)
            ->setCancelUrl($SITE_URL . '/pay?success=false');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->getPaypal());
        } catch (PayPalConnectionException $ex) {

            echo $ex->getData(); // Prints the detailed error message
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }

        $approvalUrl = $payment->getApprovalLink();

        $alas_payment = new AlasPayment();
        $alas_payment->user_id = $user_id;
        $alas_payment->serial = $serial;
        $alas_payment->type = 'subscription';

        $alas_payment->save();

        return redirect()->to($approvalUrl);


    }

    private function getPaypal() {
        return new ApiContext(new OAuthTokenCredential(
            'Adihqrx8m_1iktN6donLICKgZCSgv2q9HOe_-oriNPeWLOG4ZIRdd6FKiP2CQ64BeQqRGJF_MZt56655'
            ,
            'EEHHJejiGylsdiwhLw0TjNJnyl1AtSSBplwDjA2Lg8hbKUTdPM5GU_CTfP7JM-F0yG2FUtGa2uKxKPbe'
        ));
    }
}
