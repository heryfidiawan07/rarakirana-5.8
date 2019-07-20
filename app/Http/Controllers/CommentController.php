<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Post;
use App\Forum;
use App\Product;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }
    
    public function postCommentStore(Request $request, $slug){
        $this->validate($request, [
            'description' => 'required|min:1'
        ]);
        $post = Post::whereSlug($slug)->first();
        if ($post) {
            Comment::create([
                'user_id' => Auth::user()->id,
                'commentable_id' => $post->id,
                'commentable_type' => 'App\Post',
                'description' => Purifier::clean($request->description),
            ]);
            return back();
        }else{
            return back();
        }
    }

    public function productCommentStore(Request $request, $slug){
        $this->validate($request, [
            'description' => 'required|min:1'
        ]);
        $product = Product::whereSlug($slug)->first();
        if ($product) {
            Comment::create([
                'user_id' => Auth::user()->id,
                'commentable_id' => $product->id,
                'commentable_type' => 'App\Product',
                'description' => Purifier::clean($request->description),
            ]);
            return back();
        }else{
            return back();
        }
    }

    public function threadCommentStore(Request $request, $slug){
        $this->validate($request, [
            'description' => 'required|min:1'
        ]);
        $thread = Forum::whereSlug($slug)->first();
        if ($thread) {
            Comment::create([
                'user_id' => Auth::user()->id,
                'commentable_id' => $thread->id,
                'commentable_type' => 'App\Forum',
                'description' => Purifier::clean($request->description),
            ]);
            return back();
        }else{
            return back();
        }
    }

    // Global update
    public function update(Request $request, $id){
        $this->validate($request, [
            'descriptionEdit' => 'required|min:1'
        ]);
        $comment = Comment::whereId($id)->first();
        if ($comment->user->id == Auth::user()->id) {    
            $comment->update([
                'user_id' => Auth::user()->id,
                'description' => Purifier::clean($request->descriptionEdit),
            ]);
            return back();
        }else{
            return back();
        }
    }
    
    // Global Comment With Parent
    public function parentCommentStore(Request $request, $id){
        $this->validate($request, [
            'descriptionParent' => 'required|min:1'
        ]);
        $comment = Comment::whereId($id)->first();
        if ($comment) {
            Comment::create([
                'user_id' => Auth::user()->id,
                'commentable_id' => $comment->commentable_id,
                'commentable_type' => $comment->commentable_type,
                'description' => Purifier::clean($request->descriptionParent),
                'parent_id' => $comment->id,
            ]);
            return back();
        }else{
            return back();
        }
    }
    
}
