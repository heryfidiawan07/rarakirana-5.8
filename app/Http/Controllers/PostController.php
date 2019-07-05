<?php

namespace App\Http\Controllers;

use File;
use Auth;
use Image;
use Purifier;
use App\Tag;
use App\Menu;
use App\Post;
use App\Tagable;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class PostController extends Controller
{
	public function __construct(){
		return $this->middleware('admin', ['except' => 'show']);
	}

    public function menus(){
        $menus = Menu::orderBy('name')->get();                        
        return $menus;
    }
    
	public function index(){
        // $menus = $this->menus();
        // $tags  = Tag::all();
		// $posts = Post::OrderBy('sticky','DESC')->latest()->paginate(10);
		// return view('admin.posts.index', compact('posts','menus','tags'));
        return view('admin.posts.index');
	}

    public function getPosts()
    {   
        $posts = Post::with('user')->with('menu')->OrderBy('sticky','DESC')->latest()->get();

        return Datatables::of($posts)
        ->addColumn('img', function ($post) { 
            if ($post->img == null){ $url= asset('posts/thumb/no-image.png'); }
            if ($post->img != null){ $url= asset('posts/thumb/'.$post->img); }
            return '<img src="'.$url.'" border="0" width="50" class="img-rounded" align="center" />';
        })
        ->rawColumns(['img', 'confirmed'])
        ->setRowClass(function ($post) {
            return $post->status % 2 == 0 ? 'alert-danger' : 'alert-success';
        })
        ->editColumn('created_at', function ($post) {
            return date('d-F-Y', strtotime($post->created_at));
        })
        ->addColumn('edit', function ($post) {
            return '<a href="/admin/post/'.$post->id.'/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
        })
        ->addColumn('delete', function ($post) {
            return '<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target=".delete-post-'.$post->id.'"><i class="fas fa-trash"></i></a><div class="modal fade delete-post-'.$post->id.'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5>Delete Post '.$post->title.' ?</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><a class="btn btn-danger btn-sm" href="/admin/post/'.$post->id.'/delete">Delete !</a><button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button></div></div></div></div>';
        })
        ->rawColumns(['edit', 'confirmed'])
        ->rawColumns(['delete', 'confirmed'])
        ->editColumn('status', function ($post) {
            if ($post->status == 0) return 'Draft';
            if ($post->status == 1) return 'Publish';
        })
        ->editColumn('comment', function ($post) {
            if ($post->status == 0) return 'Tidak';
            if ($post->status == 1) return 'Ya';
        })
        ->make(true);
    }
	
	public function create(){
		$menus = $this->menus();
        $tags  = Tag::all();
        if ($menus->count()) {
            return view('admin.posts.create', compact('menus','tags'));
        }
        return back()->with('status', 'Please setup menu !');
	}
	
    public function store(Request $request){
        $data = request()->validate([
            'title' => 'required|unique:posts|max:255',
            'menu_id' => 'required',
            'description' => 'required',
            'comment' => 'required',
            'status' => 'required',
            'sticky' => 'required',
            'img' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $cekSlug = Post::whereSlug(str_slug($request->title))->first();
        if ($cekSlug) {
            $slug = str_slug($request->title).date('His');
        }else{
            $slug = str_slug($request->title);
        }
        $img  = $request->file('img');
        if (!empty($img)) {
            $extends = $img->getClientOriginalextension();
            $imgName = $slug.'.'.$extends;
            $path    = $img->getRealPath();
        }else {
            $imgName = null;
        }
        $post = Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'menu_id' => $request->menu_id,
            'img' => $imgName,
            'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                    'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
            'comment' => $request->comment,
            'status' => $request->status,
            'sticky' => $request->sticky,
            'user_id' => Auth::user()->id,
        ]);
        if (!empty($img)) {
            $img     = Image::make($path)->resize(null, 630, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            $thumb    = Image::make($path)->resize(null, 300, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            $thumb->save(public_path("posts/thumb/". $imgName));
            $img->save(public_path("posts/img/". $imgName));
        }
        $tags = $request->tags;
        if ($tags) {
            for ($i=0; $i < count($tags); $i++) { 
                $tagable = new Tagable;
                $tagable->tag_id       = $tags[$i];
                $tagable->tagable_id   = $post->id;
                $tagable->tagable_type = 'App\Post';
                $tagable->save();
            }
        }
        return redirect('/admin/posts');
    }

    public function edit($id){
        $post = Post::whereId($id)->first();
        $menus = $this->menus();
        $tags  = Tag::all();
        if ($menus->count()) {
            return view('admin.posts.edit', compact('post','menus','tags'));
        }
        return back()->with('status', 'Please setup menu !');
    }
    
    public function update(Request $request, $id){
        $data = request()->validate([
            'title' => 'required|max:255',
            'menu_id' => 'required',
            'description' => 'required',
            'comment' => 'required',
            'status' => 'required',
            'sticky' => 'required',
            'img' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $post    = Post::find($id);
        $cekSlug = Post::whereSlug(str_slug($request->title))->first();
        if (!$cekSlug) {
            $slug = str_slug($request->title);//dd('tidak ada');
        }else{
            if ($cekSlug->id == $post->id) {
                $slug = str_slug($request->title);//dd('dirinya sendiri');
            }else {
                $slug = str_slug($request->title).date('His');//dd('ada di post lain');
            }
        }
        $img  = $request->file('img');
        if (!empty($img)) {
            $oldImg   = public_path("posts/img/".$post->img);
            $oldThumb = public_path("posts/thumb/".$post->img);
            if (file_exists($oldImg)) {
                File::delete($oldImg);
                File::delete($oldThumb);
            }
            $extends = $img->getClientOriginalextension();
            $imgName = $slug.'.'.$extends;
            $path    = $img->getRealPath();
        }else {
            $imgName = $post->img;
        }
        $post->update([
            'title' => $request->title,
            'slug' => $slug,
            'menu_id' => $request->menu_id,
            'img' => $imgName,
            'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 
                    'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
            'comment' => $request->comment,
            'status' => $request->status,
            'sticky' => $request->sticky,
            'user_id' => Auth::user()->id,
        ]);
        if (!empty($img)) {
            $img     = Image::make($path)->resize(null, 630, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            $thumb    = Image::make($path)->resize(null, 300, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            $thumb->save(public_path("posts/thumb/". $imgName));
            $img->save(public_path("posts/img/". $imgName));
        }
        $post->with(['tags'])->find($post->id)->tags()->sync($request->tags);
        return redirect('/admin/posts');
    }
    
    public function quickEdit(Request $request, $id){
        $post = Post::find($id);
        if ($post) {
            $post->update([
                'menu_id' => $request->menu_id,
                'comment' => $request->comment,
                'status'  => $request->status,
                'sticky'  => $request->sticky,
                'user_id' => Auth::user()->id,
            ]);
            $tags = $request->tags;
            if ($tags) {
                for ($i=0; $i < count($tags); $i++) { 
                    $tagable = new Tagable;
                    $tagable->tag_id       = $tags[$i];
                    $tagable->tagable_id   = $post->id;
                    $tagable->tagable_type = 'App\Post';
                    $tagable->save();
                }
            }
            return back();
        }else{
            return back();
        }
    }
    
    public function delete($id){
        $post = Post::find($id);
        $img   = public_path("posts/img/".$post->img);
        $thumb = public_path("posts/thumb/".$post->img);
        if (file_exists($img)) {
            File::delete($img);
            File::delete($thumb);
        }
        $post->tags()->detach($post->tags);
        $post->delete();
        return redirect('/admin/posts');
    }
    
    public function show($slug){
        $post = Post::whereSlug($slug)->first();
        if ($post->status==1) {
            return view('posts.show', compact('post'));
        }
        return redirect('/');
    }
    
}
