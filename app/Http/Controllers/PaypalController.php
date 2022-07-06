<?php

namespace App\Http\Controllers;

use App\Download;
use App\Http\Requests;
use App\Package;
use App\Payment as AppPayment;
use App\PaymentDetail;
use App\Song;
use App\Subscription;
use App\Transaction as AppTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use ZipArchive;

class PaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {

        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function payWithPaypal()
    {
        return view('payment');
    }

    public function postPaymentWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName($request->get('desc'))
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Enter Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::route('payment-msg');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('payment-msg');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('payment-msg');
    }

    public function getPaymentStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::route('payment-msg');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            \Session::put('success', 'Payment success !!');
            $package = session()->get('package');


            foreach ($package as  $key => $details) {


                $pack = Package::find($key);
                $sub = new Subscription();
                $sub->user_id = Auth::user()->id;
                $sub->package_id = $pack->id;
                $sub->total_download = $pack->downloads;
                $sub->use_download = 0;
                $sub->status = 'Active';
                $sub->start_date = date('Y-m-d');
                $sub->end_date = date("Y-m-d", strtotime("+1 month"));
                $sub->save();
                $user = Auth::user();
                $user->subscription_id = $sub->id;
                $user->save();
                $pay = new AppPayment;
                $pay->user_id = Auth::user()->id;
                $pay->type = 0;
                $pay->total = $pack->price;
                $pay->save();
                $pay_detail = new PaymentDetail;
                $pay_detail->payment_id = $pay->id;
                $pay_detail->relation_id = $pack->id;
                $pay_detail->save();
                $transaction = new AppTransaction;
                $transaction->payment_id = $pay->id;
                $transaction->txn_id = $payment_id;
                $transaction->amount = $pack->price;
                $transaction->save();
            }

            return Redirect::route('payment-msg');
        }

        \Session::put('error', 'Payment failed !!');
        return Redirect::route('payment-msg');
    }

    //  song payment start

    public function songPaymentWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName($request->get('desc'))
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($request->get('desc'));

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment-status'))
            ->setCancelUrl(URL::route('payment-status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::route('payment-msg');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('payment-msg');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('payment-msg');
    }


    public function getSongPaymentStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::route('payment-msg');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            $total = $result->transactions[0]->amount->total;
            \Session::put('success', 'Payment success !!');
            $package = session()->get('package');

            $cart = session()->get('cart');
            if (count($cart) == 0) {
                return Redirect::route('payment-msg');
            }
            $zip = new ZipArchive;
            $fileName = 'myNewFile' . time() . '.zip';
            $date = date('Y-m-d');


            $pay = new AppPayment;
            $pay->user_id = Auth::user()->id;
            $pay->type = 1;
            $pay->total = $total;
            $pay->save();

            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {

                foreach ($cart as  $id => $detail) {
                    foreach ($detail as  $key => $details) {
                        $downloads = new Download();
                        $downloads->song_id = $key;
                        $downloads->user_id = Auth::user()->id;
                        $downloads->type = $details['type'];
                        $downloads->save();
                        $pay_detail = new PaymentDetail;
                        $pay_detail->payment_id = $pay->id;
                        $pay_detail->relation_id = $key;
                        $pay_detail->save();
                        $sub = Subscription::where('user_id', Auth::user()->id)->where('end_date',  '>=', $date)->where('status', 'Active')->orderBy('id', 'ASC')->first();
                        if (Auth::user()->subscription_id != -1) {
                            $use = $sub->use_download + 1;
                            if ($sub->total_download > $use) {
                                $sub->use_download +=  1;

                                $sub->save();
                            } else if ($sub->total_download == $use) {
                                $sub->use_download += 1;
                                $sub->status = 'Inactive';

                                $sub->save();
                            }
                        }
                        $song = Song::find($key);
                        if (isset($song->audio)) {
                            $zip->addFile(public_path('assets/images/songs/' . $song->audio), $song->audio);
                        }
                        if (isset($song->image)) {
                            $zip->addFile(public_path('assets/images/songs/' . $song->image), $song->image);
                        }
                        if (isset($song->copyright)) {
                            $zip->addFile(public_path('assets/images/songs/' . $song->copyright), $song->copyright);
                        }
                        if (isset($song->file)) {
                            $zip->addFile(public_path('assets/images/songs/' . $song->file), $song->file);
                        }
                        unset($cart[$id][$key]);
                        session()->put('cart', $cart);
                    }
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                }
                $transaction = new AppTransaction;
                $transaction->payment_id = $pay->id;
                $transaction->txn_id = $payment_id;
                $transaction->amount = $total;
                $transaction->save();


                $zip->close();
            }



            return redirect('/home')->with('download', $fileName);
        }

        \Session::put('error', 'Payment failed !!');
        return Redirect::route('payment-msg');
    }
}
