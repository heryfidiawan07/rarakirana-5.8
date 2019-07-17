<?php

namespace App\Http\Controllers;

use PDF;
use File;
use Auth;
use Image;
use Purifier;
use App\User;
use App\Order;
use App\Review;
use App\Account;
use App\Address;
use App\Product;
use App\OrderDetail;
use Illuminate\Http\Request;

class UserController extends Controller
{   

    public function __construct(){
        return $this->middleware('auth', ['except' => 'slug']);
    }
    
    public function slug($slug){
        $user = User::whereSlug($slug)->first();
        if ($user) {
            $threads = $user->threads()->paginate(10);
            return view('users.index', compact('user','threads'));
        }else{
            return redirect('/');
        }
    }
    
    public function orderDetails($slug, $token){
        $user = User::whereSlug($slug)->first();
        if (Auth::user()->id == $user->id) {
            $validate = Order::where('slug_token', $token)->first();
            if ($validate) {
                $order    = Order::where('private_token', $validate->private_token)->first();
                if (Auth::user()->id == $order->user->id) {
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
            }else {
                return view('errors.404');
            }
        }else {
            return view('errors.404');
        }
    }

    public function arrivedOrder(Request $request, $slug, $token){
        $user = User::whereSlug($slug)->first();
        if (Auth::user()->id == $user->id) {
            $validate = Order::where('slug_token', $token)->first();
            $order    = Order::where('private_token', $validate->private_token)->first();
            if (Auth::user()->id == $order->user->id) {
                if (Auth::user()->id === $order->user_id) {
                    $status          = new Order;
                    $userOrderStatus = $status->userOrderStatus();
                    $userPayStatus   = $status->userPayStatus();
                    $products        = Product::all();
                    $details         = OrderDetail::where('order_id',$order->id)->get();

                    $order->update([
                        'status' => 3,
                    ]);
                    $reviews = $request->review;
                    $i = 0;
                    foreach ($details as $detail) {
                        $review = new Review;
                        $review->review = Purifier::clean($reviews[$i]);
                        $review->user_id = Auth::user()->id;
                        $review->order_id = $order->id;
                        $review->product_id = $detail->product_id;
                        $review->save();
                        $i++;
                    }
                    return redirect("/order/{$user->slug}/details/{$order->slug_token}");
                }else {
                    return view('errors.404');
                }
            }else {
                return view('errors.404');
            }
        }else {
            return view('errors.404');
        }
    }
    
    public function uploadImg(Request $request, $slug){
        $data = request()->validate([
            'img' => 'required|mimes:jpeg,jpg,bmp,png',
        ]);
        $user = User::whereSlug($slug)->first();
        $img = $request->file('img');
        if (Auth::user()->id == $user->id) {
            if (!empty($img)) {
                $extends = $img->getClientOriginalExtension();
                $imgName = $user->slug.'-'.date("YmdHis").'.'.$extends;
                $path    = $img->getRealPath();
                
                if ($user->img != 'profile.jpg') {
                    $oldImg   = public_path("users/".$user->img);
                    if (file_exists($oldImg)) {
                        File::delete($oldImg);
                    }
                }
                $user->update([
                    'img' => $imgName,
                ]);
                
                $img     = Image::make($path)->resize(null, 630, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $img->save(public_path("users/". $imgName));
            }
            return back();
        }
        return view('errors.404');
    }

    public function description(Request $request, $slug){
        $request->validate([
            'description' => 'required|max:255',
        ]);
        $user = User::whereSlug($slug)->first();
        if (Auth::user()->id == $user->id){
            if (! $user->description) {
                $user->biodata()->create([
                    'description' => $request->description,
                ]);
            }else {
                $user->biodata()->update([
                    'description' => $request->description,
                ]);
            }
            return back();
        }
        return view('errors.404');
    }
    
    public function updateName(Request $request, $slug){
        $request->validate([
            'name' => 'required|min:3|max:50',
        ]);
        $user = User::whereSlug($slug)->first();
        if (Auth::user()->id == $user->id) {
            $chekSlug = User::where('slug',str_slug($request->name))->first();
            $slug     = str_slug($request->name);
            if ($chekSlug) {
                $slug = str_slug($request->name).date('His');
            }
            $user->update([
                'name' => $request->name,
                'slug' => $slug,
            ]);
            return redirect("/user/{$user->slug}");
        }
        return view('errors.404');
    }
    
    public function streamInvoice($slug, $token){
        $user     = User::whereSlug($slug)->first();
        $validate = Order::where('slug_token', $token)->first();
        $order    = Order::where('private_token', $validate->private_token)->first();
        if (Auth::user()->id == $user->id) {
            if (Auth::user()->id == $order->user->id) {
                $status          = new Order;
                $userOrderStatus = $status->userOrderStatus();
                $userPayStatus   = $status->userPayStatus();
                $addAdmin = Address::where('origin',1)->first();
                $pdf      = PDF::loadView('users.invoice', compact('order','addAdmin', 'userOrderStatus', 'userPayStatus'));
                return $pdf->stream();
            }
            return back();
        }
        return back();
    }

}
