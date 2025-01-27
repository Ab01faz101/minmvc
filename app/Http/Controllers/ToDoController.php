<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Core\Request;
use Core\Validator;

class ToDoController extends Controller
{
    public function getAll()
    {
        $todoModel = new Todo();
        $todos = [];
        $todos['status'] = 1;
        $todos['items'] = $todoModel->getAll();
        toJson($todos);
    }

    function store()
    {
        $request = new Request();
        $inputs = $request->post();
        $validator = new Validator();
        $rules = [
            'title' => 'required',
        ];
        $valid = $validator->validate($inputs, $rules);
        if (!$valid){
            $result = ["status" => 0, "message" => "validation error"];
            toJson($result);
        }

        try {
            $todoModel = new Todo();
            $todoModel->create($inputs);
            $result = ["status" => 1, "message" => "toto store successfully"];
            toJson($result);
        } catch (\Exception $exception) {
            $result = ["status" => 0, "message" => $exception->getMessage()];
            toJson($result);
        }
    }

    function changeStatus()
    {
        try {
            $request = new Request();
            $inputs = $request->post();
            $todoModel = new Todo();
            $todo = $todoModel->find($inputs['id']);
            $inputs = [];
            $inputs['status']  = $todo['status'] == 1 ? 0 : 1;
            $todoModel->update($todo['id'] , $inputs);
            $result = ["status" => 1, "message" => "toto status update successfully"];
            toJson($result);
        }catch (\Exception $exception){
            $result = ["status" => 0, "message" => $exception->getMessage()];
            toJson($result);
        }
    }


    function remove()
    {
        try {
            $request = new Request();
            $inputs = $request->post();
            $todoModel = new Todo();
            $todoModel->delete($inputs['id']);
            $result = ["status" => 1, "message" => "toto delete successfully"];
            toJson($result);
        }catch (\Exception $exception){
            $result = ["status" => 0, "message" => $exception->getMessage()];
            toJson($result);
        }
    }


}