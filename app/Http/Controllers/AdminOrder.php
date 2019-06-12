<?php

namespace App\Http\Controllers;

use PDF;
use File;
use Auth;
use App\User;
use App\Order;
use App\Address;
use Illuminate\Http\Request;

class AdminOrder extends Controller
{
    public function __construct(){
        return $this->middleware('admin');
    }
    
    public function index(){
        $status = new Order;
        $orderStatus = $status->orderStatus();
        $payStatus   = $status->payStatus();
        $orders = Order::all();
        return view('admin.orders.index', compact('orders','orderStatus','payStatus'));
    }
    
    public function accept($token){
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        if ($order) {
            $order->payment()->update([
                'status' => 1,
                'keterangan' => null,
            ]);
            $order->update([
                'status' => 1,
            ]);
            // Kirim Email ke user bahwa pesanan sedang di proses
            return back();
        }else {
            return view('errors.404');
        }
    }
    
    public function resi(Request $request, $token){
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        if ($order) {
            $order->update([
                'resi_kurir' => $request->resi_kurir,
                'status' => 2,
            ]);
            // Kirim email ke user bahwa pasanan dalam pengiriman kurir dan nomor resi
            return back();
        }else {
            return view('errors.404');
        }
    }
    
    public function arrived($token){
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        if ($order) {
            $order->update([
                'status' => 3,
            ]);
            // Kirim email bahwa pesanan telah sampai
            return back();
        }else {
            return view('errors.404');
        }
    }
    
    public function manualUpdate(Request $request, $token){
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        if ($order) {
            $order->payment()->update([
                'status' => $request->order_status,
            ]);
            $order->update([
                'status' => $request->pay_status,
            ]);
            return back();
        }else {
            return view('errors.404');
        }
    }
    
    public function reject(Request $request, $token){
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        if ($order) {
            $order->payment()->update([
                'status' => 2,
                'keterangan' => $request->keterangan,
            ]);
            // kirim email bahwa pembayaran anda di tolak dengan keterangan ....
            return back();
        }else {
            return view('errors.404');
        }
    }
    
    public function delete($token){
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        if ($order) {
            $payment = Payment::where('order_id',$order->id)->first();
            $img   = public_path("payment/".$payment->image_resi);
            if (file_exists($img)) {
                File::delete($img);
            }
            $payment->delete();
            $order->delete();
            return back();
        }else {
            return view('errors.404');
        }
    }

    public function downloadAddress($token){
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        $pdf      = PDF::loadView('admin.orders.download-address', compact('order'));
        return $pdf->download("{$order->no_order}".date('Y-m-d_H-i-s').'.pdf');
    }

    public function streamAddress($token){
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        $addAdmin = Address::where('origin',1)->first();
        $pdf      = PDF::loadView('admin.orders.stream-address', compact('order','addAdmin'));
        return $pdf->stream();
    }

}
