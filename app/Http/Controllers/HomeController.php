<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Models\Post;

class HomeController extends Controller
{
    public function index(){

        if(Auth::id()) //if we want to login it will call the '/home' url (from RouteServiceProvider.php) and it will send to route HomeController index function(in web.php)
        {

            $post= Post::all();

            $usertype=Auth()->user()->usertype;

            if($usertype=='user'){
                return view('home.homepage',compact('post')); //if it login as user it will send to the desired page
            }
            else if($usertype=='admin'){
                return view('admin.adminhome');
            }
            else{
                return redirect()->back();
            }

        } 
    }

    public function homepage(){
        $post = Post::all();

        return view('home.homepage',compact('post'));
    }

    public function post_details($id){

        $post = Post::find($id);

        return view('home.post_details',compact('post'));
    }
}
