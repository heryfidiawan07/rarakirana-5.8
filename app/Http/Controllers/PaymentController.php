<?php

namespace App\Http\Controllers;

use File;
use Auth;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }
    
    public function payment(Request $request, $token){
        $this->validate($request, [
            'pengirim' => 'required|min:3',
            'image_resi' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        if ($order) {
            if (Auth::user()->id === $order->user_id) {
                if ($request->file('image_resi')->isValid()) {
                    $imgName = $order->no_order.'.'.$request->file('image_resi')->getClientOriginalExtension();
                    $request->file('image_resi')->move(public_path('payment'), $imgName);
                }else {
                    $imgName = 'no-image.png';
                }
                Payment::create([
                    'no_invoice' => 'INV/IRA/'.date("His").'/'.date("YmdHis"),
                    'order_id' => $order->id,
                    'pengirim' => $request->pengirim,
                    'image_resi' => $imgName,
                    'status' => 0,
                ]);
                // orderStatus() ==> [ 0 => 'Baru Saja Order', 1 => 'Proses Packing', 2 => 'Delivery', 3 => 'Arrived / Barang Telah Sampai Tujuan']
                // ===========================================
                // payStatus()==> [0 => 'Baru Saja Transfer', 1 => 'Approved', 2 => 'Payment Rejected']
                // Kirim email ke admin bahwa barusaja ada yg melakukan pembayaran
                return back();
            }else {
                return view('errors.404');
            }
        }else {
            return view('errors.404');
        }
    }
    
    public function paymentEdit(Request $request, $token){
        $this->validate($request, [
            'pengirim' => 'required|min:3',
            'image_resi' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        if ($order) {
            if (Auth::user()->id === $order->user_id) {
                if (!empty($request->file('image_resi'))) {
                    $img   = public_path("payment/".$order->payment->image_resi);
                    if (file_exists($img)) {
                        File::delete($img);
                    }
                    $imgName = $order->no_order.'.'.$request->file('image_resi')->getClientOriginalExtension();
                    $request->file('image_resi')->move(public_path('payment'), $imgName);
                }else {
                    $imgName = $order->payment->image_resi;
                }
                $order->payment()->update([
                    'pengirim' => $request->pengirim,
                    'image_resi' => $imgName,
                    'status' => 0,
                ]);
                // orderStatus() ==> [ 0 => 'Baru Saja Order', 1 => 'Proses Packing', 2 => 'Delivery', 3 => 'Arrived / Barang Telah Sampai Tujuan']
                // ===========================================
                // payStatus()==> [0 => 'Baru Saja Transfer', 1 => 'Approved', 2 => 'Payment Rejected']
                // Kirim email ke admin bahwa barusaja ada edit pembayaran di lakukan
                return back();
            }else {
                return view('errors.404');
            }
        }else {
            return view('errors.404');
        }
    }
    
}
