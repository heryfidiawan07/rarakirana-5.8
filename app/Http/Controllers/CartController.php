<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use RajaOngkir;
use App\Cart;
use App\Product;
use App\Address;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
        $data = RajaOngkir::Provinsi()->all();
        $data = RajaOngkir::Provinsi()->count();
        $data = RajaOngkir::Provinsi()->find($id);
        $data = RajaOngkir::Provinsi()->search('province', $name = "ja")->get();
        $data = RajaOngkir::Kota()->all();
        $data = RajaOngkir::Kota()->count();
        $data = RajaOngkir::Kota()->find($id);
        $data = RajaOngkir::Kota()->search('city_name', $name = "banyu")->get();
        $data = RajaOngkir::Kota()->byProvinsi($provinsi_id)->get();
        $data = RajaOngkir::Kota()->byProvinsi($provinsi_id)->count();
        $data = RajaOngkir::Kota()->byProvinsi($provinsi_id)->search('city_name', $name)->get();
        $data = RajaOngkir::Cost([
            'origin'        => 501, // id kota asal
            'destination'   => 114, // id kota tujuan
            'weight'        => 1700, // berat satuan gram
            'courier'       => 'jne', // kode kurir pengantar ( jne / tiki / pos )
        ])->get();
    **/

    public function carts(){
        if (!Session::has('cart')) {
            return view('products.carts');
        }
        $oldCart    = Session::get('cart');
        $cart       = new Cart($oldCart);
        $provinsies = RajaOngkir::Provinsi()->all();
        $addresses  = '';
        if (Auth::check()) {
            if ($user = Auth::user()) {
                $addresses = $user->addresses()->where('origin',0)->get();
            }
        }
        return view('products.carts', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalWeight' => $cart->totalWeight, 'provinsies' => $provinsies, 'addresses' => $addresses, 'totalQty' => $cart->totalQty]);
    }

    public function addToCart(Request $request, $slug){
        $product = Product::whereSlug($slug)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        return response($cart->totalQty);//->with('addToCart','Item dimasukan keranjang.');
    }

    public function buy(Request $request, $slug){
        $product = Product::whereSlug($slug)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        return redirect('/product/carts');
    }
    
    public function plusQty(Request $request, $slug){
        $product = Product::whereSlug($slug)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        return response(array('price' => number_format($cart->items[$product->id]['price']), 'totalPrice' => number_format($cart->totalPrice)));
    }

    public function minQty(Request $request, $slug){
        $product = Product::whereSlug($slug)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->min($product, $product->id);
        $request->session()->put('cart', $cart);
        return response(array('price' => number_format($cart->items[$product->id]['price']), 'totalPrice' => number_format($cart->totalPrice)));
    }

    public function removeCartByProduct($slug){
        $product = Product::whereSlug($slug)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        $cart->removeItem($product->id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }
        return back();
    }

    public function removeAllProduct(){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart    = new Cart($oldCart);
        Session::forget('cart');
        return redirect('/product/carts');
    }

    public function cost($addId, $kurir){
        $address = Address::whereId($addId)->first();
        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);
        $cost    = RajaOngkir::Cost([
            'origin'        => 177, // id kota asal
            'destination'   => $address->kab_id, // id kota tujuan
            'weight'        => $cart->totalWeight, // berat satuan gram
            'courier'       => $kurir, // kode kurir pengantar ( jne / tiki / pos )
        ])->get();
        return response($cost[0]);
    }
    
}
