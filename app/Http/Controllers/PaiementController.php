<?php

namespace App\Http\Controllers;

use Omnipay\Omnipay;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(
            'AUFdzqMO0hDO3yRMS24tG6uReqyLV8hnNcPFXzM9rehU0tvs5CyKQyk2fx_8tKxDbcaSOqWkEijUGkGi'
        );
        $this->gateway->setSecret(
            'EDLf3cWlUMALNmQhzRSwxD9maCHvKGHeo6Aac03KiWnQDDpYZCnbkAhYB9Y9gNEGIBbfHmI5sz8-exUD'
        );
        $this->gateway->setTestMode(false);
    }

    public function paymentHandle(Request $request)
    {
        try {
            $response = $this->gateway
                ->purchase([
                    'amount' => $request->montant,
                    'currency' => env('PAYPAL_CURRENCY', 'USD'),
                    'returnUrl' => url('success'),
                    'cancelUrl' => url('error'),
                ])
                ->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase([
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ]);

            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr = $response->getData();

                Paiement::create([
                    'payment_id' => $arr['id'],
                    'payer_id' => $arr['payer']['payer_info']['payer_id'],
                    'payer_email' => $arr['payer']['payer_info']['email'],
                    'amount' => $arr['transactions'][0]['amount']['total'],
                    'currency' => env('PAYPAL_CURRENCY', 'USD'),
                    'payment_status' => $arr['state'],
                    'user_id' => Auth::user()->id,
                ]);

                return view('paiement', compact('arr'));
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Paiement refusé !!';
        }
    }

    public function error()
    {
        return 'Paiement annulé';
    }
}
