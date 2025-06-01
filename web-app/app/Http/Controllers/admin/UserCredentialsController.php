<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserCredential;
use Illuminate\Http\Request;

class UserCredentialsController extends Controller
{
    public function index()
    {
        $userCredentials = UserCredential::all();
        return view('admin.user_credentials', compact('userCredentials'));
    }
}