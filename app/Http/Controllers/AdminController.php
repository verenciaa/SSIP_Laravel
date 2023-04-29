<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function post_page(){
        return view('admin.post_page');
    }

    public function add_post(Request $request){

        
        $post=new Post;

        $post->title = $request->title;
        $post->description = $request->description;

        $post->post_status = 'active';

        $image=$request->image;//getting the image file
        if($image){//if we didnt post with the image it will skip this part and it still can save the post

        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('postimage',$imagename);//it will create a folder in public called postimage
        //3 above is responsible to keep the image in the public folder
        
        $post->image = $imagename;//responsible to put the imag eto the DB
        }
        

        $post->save();
        return redirect()->back()->with('message','Added succesfully, Horay!');
    }
    

    public function show_post(){

        $post = Post::all();//it will get the data from the post DB and will be stored in $post
        return view('admin.show_post',compact('post'));
    }

    public function delete_post($id){
        $post = Post::find($id);//it will find the specific id

        $post->delete();//it will delete the specific data that we want

        return redirect()->back()->with('message','Post has been Deleted!');
    }

    public function edit_page($id){
        $post = Post::find($id);

        return view('admin.edit_page',compact('post'));
    }

    public function update_post(Request $request,$id){
        $data = Post::find($id);

        $data->title=$request->title;
        $data->description=$request->description;
        $image=$request->image;
        if($image){
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('postimage',$imagename);
        $data->image = $imagename;
        }

        $data->save();
        return redirect()->back()->with('message','Yay! Post has been Updated!');
        
    }
}
