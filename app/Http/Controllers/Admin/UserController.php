<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Mail\ActiveAccountMail;

class UserController extends Controller {

    /**
     * @function login
     * @params $request
     */
    public function login(Request $request) {
        $data = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8|max:16'
        ]);
        $user = User::where('email', $data['email'])->first();
        if($user) {
            if(Hash::check($data['password'], $user->password)) {
                $this->output('Login success', 200);
            } else {
                $this->output('Email or password is vaild', 200);
            }
        } else {
            $this->output('User is not existend. Please sign up', 200);
        }
    }

    /**
     * @function signUp
     * @params $request
     */
    public function signUp(Request $request) {
        $data = $request->all();
        $this->validate($request, [
            'username' => 'required|unique:users,username,',
            'name' => 'required',
            'email' => 'required|unique:users,email,',
            'password' => 'required|min:8|max:16',
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        $signUp = User::create($data);
        if($signUp) {
            $mail = $this->mailSignUp($data);
            $this->output('Sign up success. Please access to active account.');
        } else {
            $this->output('Sign up user fail', 401);
        }
    }

    /**
     * @function mailSignUp
     * @params $data
     */
    public function mailSignUp($data) {
        Mail::to($data['email'])->send(new ActiveAccountMail($data));
    }
}