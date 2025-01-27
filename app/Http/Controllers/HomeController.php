<?php

namespace App\Http\Controllers;

use App\Models\User;
use Core\Request;
use Core\Validator;

class HomeController extends Controller

{
    public function index()
    {
        return view("app.index");
    }

    public function store(){
        $request = new Request();
        $data = $request->post();
        $validator = new Validator();
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
        $valid = $validator->validate($data, $rules);


        dd($valid);
    }

}