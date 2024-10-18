<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id=Crypt::decrypt($id);
        $blog = Blog::with('users','comments')->findorFail($id);
        return view('admin.blog.show', compact('blog'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function readblog($id){
        $id=Crypt::decrypt($id);
        $publish=('published');
        $data['blog'] = Blog::with('users','comments')->where('id', $id)->where('status', $publish)->firstOrFail();
        return view('users.blog.read',$data);
    }

    public function comment(Request $request){
        // dd($request->all());
        $request->validate([
            'comment'=>'required',
            'blog_id'=>'required',
        ],[
            'comment.required'=>'Please enter your comment',
        ]);
        $blog_id=$request->blog_id;
        $blog=Blog::findorFail($blog_id);
        if($blog){
            $comment=new Comments();
            $comment->comment=Crypt::encrypt($request->comment);
            $comment->blog_id=$blog_id;
            $comment->user_id=(auth()->user()->id);
            $comment->save();
            return redirect()->back()->with('success','Comment added successfully');
        }
        else{
            return redirect()->back()->with('error','Blog not found');
        }


    }
}
