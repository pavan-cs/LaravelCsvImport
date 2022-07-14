<?php

namespace App\Http\Controllers;

use Excel;
use Storage;
use Notification;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NotifyRahulAndAksharaOfCompletedImport;

class UserController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function import(Request $request)
    {

        // get file 
        $file = $request->file('users');
        $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        // validate
        $validator = Validator::make($request->all(), [
            'users'   => ['required','mimes:csv,txt'],
        ]);

        if ($validator->fails()) {
            // validation failed redirect back to form
            return back()->withInput()->withErrors($validator);
        } else {
            
            $path = Storage::disk('local')->putFileAs("users", $request->file('users'), $name );

            $import = new UsersImport();
            $import->import($path);
           
            // send mail
            Notification::route('mail', ['rahul@protracked.in','akshara@protracked.in'])->notify( new NotifyRahulAndAksharaOfCompletedImport($import->failures()) );
          
        }  

        return back();
    }
}
