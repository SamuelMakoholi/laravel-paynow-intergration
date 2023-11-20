<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paynow\Payments\Paynow;


class PaynowController extends Controller
{
    //

    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {

        //validate the input
        $request->validate([
            'email' => 'required',
            'phone_number' => 'required|starts_with:07',
            'amount' => 'required'
        ]);

        //data from the form
        $email = $request->email;
        $phone_number = $request->phone_number;
        $amount = $request->amount;

        $wallet = 'ecocash';

        //paynow
        $paynow = new \Paynow\Payments\Paynow(
            '16264',
            '79c32394-9655-464b-9575-90be83078e13',
            route('dashboard'),
            route('dashboard'),
        );

        $payment = $paynow->createPayment('Testing Fee', $email);

        $payment->add('Fee', $amount);

        $response = $paynow->sendMobile($payment, $phone_number, $wallet);

        dd($response);




    }
}
