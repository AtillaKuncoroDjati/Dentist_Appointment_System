<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class HomeController extends Controller
{
    public function redirect(){
        if(Auth::id()) {
            if(Auth::user()->usertype=='0') {
                return view('welcome');
            } else {
                return view('admin.contact');
            }
        }
    }

    public function homeView() {
        return view('welcome');
    }

    public function aboutView() {
        return view('templates.about_template');
    }

    public function serviceView() {
        return view('templates.services_template');
    }

    public function doctorsView() {
        return view('templates.doctors_template');
    }
}
