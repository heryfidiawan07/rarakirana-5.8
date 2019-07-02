<?php

namespace App\Http\Controllers;

use Purifier;
use App\Product;
use App\Offline;
use Illuminate\Http\Request;

class OfflineController extends Controller
{
    public function __construct(){
        return $this->middleware('admin', ['except' => 'store']);
    }

    public function index(){
        $offlines = Offline::paginate(20);
        return view('admin.offlines.index', compact('offlines'));
    }
    
    public function store(Request $request, $slug){
        $data = request()->validate([
            'phone' => 'required|max:12',
            'email' => 'required|max:50',
            'address' => 'required|max:500',
            'description' => 'required|max:5000',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);
        $product = Product::whereSlug($slug)->first();
        if ($product) {
            Offline::create([
                'product_id' => $product->id,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'description' => Purifier::clean($request->description),
            ]);
            return back()->with('status', 'Pesan terkirim.');
        }else{
            return view('errors.404');
        }
    }
    
    public function delete($id){
        $offline = Offline::find($id);
        if ($offline) {
            $offline->delete();
        }
        return back();
    }
    
}
