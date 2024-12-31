<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Colors\Rgb\Channels\Red;

class ContactController extends Controller
{
    public function index(){
        return view('frontend.contact.index')
            ->with('setting',Setting::first());
    }
    public function post(Request $request){
        $request->validate([
            'name'=> 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ]);

        $data =[
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ]; 
        Mail::to('mohammadiy207@gmail.com')->send(new ContactMail($data)); 
        Session::flash('success','Message has been successfully sent!'); 
        return redirect()->back();

    }
}
