<?php

namespace App\Http\Controllers\Estudiante\Subir;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Estudiante\Base;
use Input;
use Response;
 


class Control extends Base
{
    public function getSubir(Request $request)
    {
       return view('estudiante.subir.portafolio');
    }

    public function postSubir() {
        $input = Input::all();
 
        $rules = array(
            'file' => 'mimes:zip|max:3000',
        );
 
        $validation = Validator::make($input, $rules);
 
        if ($validation->fails()) {
            return Response::make($validation->errors()->first(), 400);
        }
 
        $destinationPath = 'uploads'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
 
        if ($upload_success) {
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }   
}

}
