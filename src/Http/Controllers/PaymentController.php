<?php

namespace LaravelLatam\Epayco\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLatam\Epayco\Epayco;
use LaravelLatam\Epayco\Http\Middleware\VerifyRedirectUrl;
use LaravelLatam\Epayco\Payment;
use Epayco\PaymentIntent as EpaycoPaymentIntent;

class PaymentController extends Controller
{
    /**
     * Create a new PaymentController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(VerifyRedirectUrl::class);
    }

    /**
     * Display the form to gather additional payment verification for the given payment.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return $id;
        /*
        return view('cashier::payment', [
            'EpaycoKey' => config('cashier.key'),
            'payment' => new Payment(
                EpaycoPaymentIntent::retrieve($id, Epayco::stripeOptions())
            ),
            'redirect' => request('redirect'),
        ]);*/
    }
}
