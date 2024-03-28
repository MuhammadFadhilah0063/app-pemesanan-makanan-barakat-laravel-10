<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function callback(Request $request)
    {
        // $serverKey = config('midtrans.server_key');
        // $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // if ($hashed === $request->signature_key) {
        //     if ($request->transaction_status == 'capture') {
        //         if (Str::startsWith($request->order_id, 'OND')) {
        //             // Online order
        //             $payment = Payment::where('online_order_id', $request->order_id)->first();
        //         } else {
        //             // Offline order
        //             $payment = Payment::where('offline_order_id', $request->order_id)->first();
        //         }

        //         $payment->update([
        //             'payment_status' => 'success',
        //         ]);

        //         $cash = Cash::where('id', 1)->first();
        //         $cash->addCash($request->gross_amount);
        //     }
        // }

        $payload      = $request->getContent();
        $notification = json_decode($payload);

        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . config('midtrans.server_key'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $transaction  = $notification->transaction_status;
        $type         = $notification->payment_type;
        $fraud        = $notification->fraud_status;

        // data transaksi payment
        if (Str::startsWith($request->order_id, 'OND')) {
            // Online order
            $data_transaction = Payment::where('online_order_id', $request->order_id)->first();
        } else {
            // Offline order
            $data_transaction = Payment::where('offline_order_id', $request->order_id)->first();
        }

        if ($transaction == 'capture') {

            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {

                if ($fraud == 'challenge') {

                    /**
                     *   update payment to pending
                     */
                    $data_transaction->update([
                        'payment_status' => 'pending'
                    ]);
                } else {

                    /**
                     *   update payment to success
                     */
                    $data_transaction->update([
                        'payment_status' => 'success'
                    ]);

                    $cash = Cash::where('id', 1)->first();
                    $cash->addCash($request->gross_amount);
                }
            }
        } elseif ($transaction == 'settlement') {

            /**
             *   update payment to success
             */
            $data_transaction->update([
                'payment_status' => 'success'
            ]);

            $cash = Cash::where('id', 1)->first();
            $cash->addCash($request->gross_amount);
        } elseif ($transaction == 'pending') {


            /**
             *   update payment to pending
             */
            $data_transaction->update([
                'payment_status' => 'pending'
            ]);
        } elseif ($transaction == 'deny') {


            /**
             *   update payment to failed
             */
            $data_transaction->update([
                'payment_status' => 'failed'
            ]);
        } elseif ($transaction == 'expire') {


            /**
             *   update payment to expired
             */
            $data_transaction->update([
                'payment_status' => 'expired'
            ]);
        } elseif ($transaction == 'cancel') {

            /**
             *   update payment to failed
             */
            $data_transaction->update([
                'payment_status' => 'failed'
            ]);
        }
    }
}
