<?php

namespace App\Http\Controllers;

use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Cliente;
use App\Models\Cuota;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PayPalController extends Controller
{
    private $apiContext;


    public function __construct()
    {


        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);
    }

    public function payWithPayPal($id)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $cuota = Cuota::find($id);
        $cliente = Cliente::find($cuota->clientes_id);
        $moneda = $cliente->moneda;
        $conversion = Currency::convert()->from('EUR')->to($moneda)->amount($cuota->importe)->round(2)->get();

        $amount = new Amount();
        $amount->setTotal($conversion);
        $amount->setCurrency($moneda);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Pago de cuota mensual');

        $callbackUrl = url('/paypal/status/' . $id);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }
    public function payPalStatus(Request $request, $id)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect('/paypal/failed')->with(compact('status'));
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /* Execute the payment */
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {
            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
            $cuota = Cuota::find($id)->update(['pagada' => 1, 'fechapago' => date('Y-m-d\TH:i')]);
            return redirect(route('pagoCorrecto'))->with(compact('status'));
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect(route('pagoCorrecto'))->with(compact('status'));
    }

    public function pagoCorrecto()
    {
        return view('cuotas/cuotaPagada');
    }

    public function pagoFallado()
    {
        return view('cuotas/cuotaErrorPago');
    }
}
