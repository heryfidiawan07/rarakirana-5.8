<?php

namespace App\Http\Controllers;

use File;
use Auth;
use Image;
use Purifier;
use App\Menu;
use App\Etalase;
use App\Product;
use App\Picture;
use App\Address;
use App\OrderDetail;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(){
        return $this->middleware('admin', ['except' => ['show','etalase']]);
    }
    
    public function index(){
        $adminAdd = Address::where('origin',1)->first();
        $etalases = Etalase::all();
        $products = Product::orderBy('sticky','DESC')->paginate(10);
        $i        = 1;
        return view('admin.products.index', compact('adminAdd','etalases','products', 'i'));
    }
    
    public function create(){
        $etalases = Etalase::all();
        if ($etalases->count()) {
            return view('admin.products.create', compact('etalases'));
        }else {
            return back();
        }
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|unique:products|max:255',
            'etalase_id' => 'required',
            'first_price' => 'required',
            'discount' => 'required',
            'weight' => 'required',
            'description' => 'required',
            'type' => 'required',
            'comment' => 'required',
            'status' => 'required',
            'sticky' => 'required',
            'img.*' => 'required|mimes:jpeg,jpg,bmp,png',
        ]);
        $images = $request->file('img');
        $slug = str_slug($request->title);
        $slugDuplicate = Product::whereSlug($slug)->first();
        if ($slugDuplicate) {
            $slug = $slug.'-'.date('His');
        }
        if (empty($images)) {
            return redirect("admin/product/create")->with('warning','Gambar product tidak boleh kosong !');
        }else{
            $product = Product::create([
                'title' => $request->title,
                'slug'  => $slug,
                'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                    'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                'etalase_id' => $request->etalase_id,
                'first_price' => $request->first_price,
                'discount' => $request->discount,
                'price' => $request->first_price - $request->discount,
                'weight' => $request->weight,
                'type'    => $request->type,
                'sticky'    => $request->sticky,
                'status' => $request->status,
                'comment' => $request->comment,
                'user_id' => Auth::user()->id,
            ]);
            foreach ($images as $key => $img) {
                $ex      = $img->getClientOriginalExtension();
                $imgName = $slug.'-'.date("YmdHis").$key.'.'.$ex;
                $path    = $img->getRealPath();
                $img     = Image::make($path)->resize(null, 630, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $thumb    = Image::make($path)->resize(null, 200, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $thumb->save(public_path("products/thumb/". $imgName));
                $img->save(public_path("products/img/". $imgName));

                $picture = new Picture;
                $picture->img        = $imgName;
                $picture->product_id = $product->id;
                $picture->save();
            }
        }
        return redirect('/admin/products');
    }
    
    public function edit(Request $request, $id){
        $product = Product::find($id);
        $etalases = Etalase::all();
        return view('admin.products.edit', compact('product','etalases'));
    }
    
    public function update(Request $request, $id){
        $this->validate($request, [
            'title' => 'required|max:255',
            'etalase_id' => 'required',
            'first_price' => 'required',
            'discount' => 'required',
            'weight' => 'required',
            'description' => 'required',
            'type' => 'required',
            'comment' => 'required',
            'status' => 'required',
            'sticky' => 'required',
            'img.*' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $product = Product::find($id);
        $images = $request->file('img');
        $slug = str_slug($request->title);
        $slugDuplicate = Product::whereSlug($slug)->first();
        if ($slugDuplicate) {
            if ($slugDuplicate->id != $product->id) {
                $slug = $slug.'-'.date('His');
            }
        }
        if (empty($images) && $product->pictures->count()==0) {
            return redirect("admin/product/{$product->id}/edit")->with('warning','Gambar product tidak boleh kosong !');
        }else{
            $product->update([
                'title' => $request->title,
                'slug'  => $slug,
                'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                    'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                'etalase_id' => $request->etalase_id,
                'first_price' => $request->first_price,
                'discount' => $request->discount,
                'price' => $request->first_price - $request->discount,
                'weight' => $request->weight,
                'type'    => $request->type,
                'sticky'    => $request->sticky,
                'status' => $request->status,
                'comment' => $request->comment,
                'user_id' => Auth::user()->id,
            ]);
            if (!empty($images)) {
                foreach ($images as $key => $img) {
                    $ex      = $img->getClientOriginalExtension();
                    $imgName = $slug.'-'.date("YmdHis").$key.'.'.$ex;
                    $path    = $img->getRealPath();
                    $img     = Image::make($path)->resize(null, 630, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                    $thumb    = Image::make($path)->resize(null, 200, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                    $thumb->save(public_path("products/thumb/". $imgName));
                    $img->save(public_path("products/img/". $imgName));

                    $picture = new Picture;
                    $picture->img        = $imgName;
                    $picture->product_id = $product->id;
                    $picture->save();
                }
            }
        }
        return redirect('/admin/products');
    }

    public function quickEdit(Request $request, $id){
        $product = Product::find($id);
        $product->update([
            'status'  => $request->status,
            'etalase_id' => $request->etalase_id,
            'first_price' => $request->first_price,
            'discount'    => $request->discount,
            'sticky'      => $request->sticky,
        ]);
        return redirect('/admin/products');
    }
    
    public function delete($id){
        $product = Product::find($id);
        foreach ($product->pictures as $pict) {
            $img   = public_path("products/img/".$pict->img);
            $thumb = public_path("products/thumb/".$pict->img);
            if (file_exists($img)) {
                File::delete($img);
                File::delete($thumb);
            }
            $pict->delete();
        }
        $product->delete();
        return redirect('/admin/products');
    }
    
    public function show($slug){
        $product = Product::whereSlug($slug)->first();
        $delivery = $product->delivery()->sum('qty');
        if ($product->status==1) {
            $etalases = Etalase::where('menu_id',$product->etalase->menu_id)->where('parent_id',0)->get();
            return view('products.show', compact('product','etalases','delivery'));
        }
        return redirect('/');
    }
    
    public function etalase($slug){
        $etalase = Etalase::whereSlug($slug)->first();
        if ($etalase->status==1) {
            if ($etalase->childs()->count() > 0) {
                $products = Product::where('status',1)->whereHas('etalase', function ($query) use ($etalase) {
                                            $query->where('status', 1)->where('parent_id',$etalase->id);
                                        })->orderBy('sticky','DESC')->paginate(9);
            }else{
                $products = Product::where('status',1)->whereHas('etalase', function ($query) use ($etalase) {
                                            $query->where('status', 1)->where('id',$etalase->id);
                                        })->orderBy('sticky','DESC')->paginate(9);
            }
            $etalases = Etalase::where('menu_id',$etalase->menu->id)->where('parent_id',0)->get();
            return view('products.etalase', compact('products','etalases','etalase'));
        }
        return redirect('/');
    }
    
}
