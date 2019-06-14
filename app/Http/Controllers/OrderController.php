<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Purifier;
use RajaOngkir;
use App\Cart;
use App\Order;
use App\Address;
use App\Account;
use App\Product;
use App\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }
    
    public function checkout(Request $request){
        $data = request()->validate([
            'address_id' => 'required',
            'note' => 'required|min:3|max:100',
            'kurir' => 'required',
            'services' => 'required',
        ]);
        $oldCart  = Session::get('cart');
        $cart     = new Cart($oldCart);
        $address  = Address::whereId($request->address_id)->first();
        $addAdmin = Address::where('origin',1)->first();
        $cost = RajaOngkir::Cost([
                'origin'        => $addAdmin->kab_id, // id kota asal
                'destination'   => $address->kab_id, // id kota tujuan
                'weight'        => $cart->totalWeight, // berat satuan gram
                'courier'       => $request->kurir, // kode kurir pengantar ( jne / tiki / pos )
            ])->get();
        if ($request->services > count($cost[0]['costs'])) {
            return back();
        }
        //dd($cost);
        $order = Order::create([
            'no_order' => 'IRA-'.date("YmdHis"),
            'address_id' => $request->address_id,
            'total_price' => $cart->totalPrice+$cost[0]['costs'][$request->services]['cost'][0]['value'],
            //Total price error jika beda kurir, karena beda struktur json
            'note' => $request->note,
            'kurir' => $request->kurir,
            'services' => $cost[0]['costs'][$request->services]['service'],
            'ongkir' => $cost[0]['costs'][$request->services]['cost'][0]['value'],
            'user_id' => Auth::user()->id,
            'status' => 0,// 0 = Menunggu Pembayaran, 1 = Dibayar, 2 = Cancel
            'slug_token' => str_random(150),
            'private_token' => str_random(150),
        ]);
        foreach ($cart->items as $products) {
            $orderDetails = new OrderDetail;
            $orderDetails->order_id   = $order->id;
            $orderDetails->product_id = $products['item']['id'];
            $orderDetails->qty        = $products['qty'];
            $orderDetails->save();
        }
        Session::forget('cart');
        return redirect("/order/checkout/details/{$order->slug_token}");
    }

    public function orderDetails($token){
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        if ($order) {
            if (Auth::user()->id === $order->user_id) {
                $details         = $order->details;
                $accounts        = Account::all();
                $status          = new Order;
                $userOrderStatus = $status->userOrderStatus();
                $userPayStatus   = $status->userPayStatus();
                return view('orders.order-details', compact('order','accounts','userOrderStatus','userPayStatus','details'));
            }else {
                return view('errors.404');
            }
        }else {
            return view('errors.404');
        }
    }

    public function cancelOrder($token){
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        if ($order) {
            if (Auth::user()->id === $order->user_id) {
                $userSlug = Auth::user()->slug;
                $order->delete();
                return redirect("/user/{$user->slug}");
            }else {
                return view('errors.404');
            }
        }else {
            return view('errors.404');
        }
    }
    
    
}
