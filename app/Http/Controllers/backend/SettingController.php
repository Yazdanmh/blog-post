<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        return view("backend.setting.index")
            ->with('setting', Setting::first());
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'logo' => 'required',
            'email' => 'email',
            'facebook' => 'url',
            'twitter' => 'url'
        ]);
        $setting = Setting::findOrFail($id);
        $setting->logo = $request->logo;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->address = $request->address;
        $setting->save();

        $setting = Setting::find(1);
        $setting->image()->create(['image' => $request->logo]);
        Session::flash('success', 'Setting updated successfully');
        return redirect()->back();
    }
}
