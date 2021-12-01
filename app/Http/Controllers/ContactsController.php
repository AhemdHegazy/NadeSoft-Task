<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\File;
use Mail;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    public function contactForm()
    {
        return view('index');
    }
    public function storeData(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                    'fname' => 'required',
                    'lname' => 'required',
                    'email' => 'required|email|unique:contacts',
                    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                    'project' => 'required',
                    'classification' => 'required',
                    'issue' => 'required',
                    'description' => 'required',
                    'priority' => 'required',
                    'screan' => 'required',
            ]);
            if ($validator->passes()) {
                //  Store data in database
                $contact = Contact::create($request->all());
/*
                //  Send mail to admin
                \Mail::send('mail', array(
                    'fname' => $request->get('fname'),
                    'lname' => $request->get('lname'),
                    'email' => $request->get('email'),
                    'phone' => $request->get('phone'),
                    'project' => $request->get('project'),
                    'classification' => $request->get('classification'),
                    'issue' => $request->get('issue'),
                    'description' => $request->get('description'),
                    'priority' => $request->get('priority'),
                ), function($message) use ($request){
                    $message->from($request->email);
                    $message->to('ibtihal@nadsoft.net', 'Admin')->subject($request->get('subject'));
                });*/
                $user_id = $contact->id; // this give us the last inserted record id
                return response()->json([
                    'status'=>"success",
                    'message' => 'Thank you, your details have been successfully registered.',
                    'user_id'=>$user_id
                ]);
            }else{
                $first = null;
                foreach($validator->failed() as $key=>$val){
                   $first = $key;
                   break;
                }
                return response()->json(['errors' => $validator->errors(),'first' =>$first]);
            }

        }
        catch (\Exception $e) {
            return response()->json(['status'=>'exception', 'msg'=>$e->getMessage()]);
        }

    }
    // We are submitting are image along with userid and with the help of user id we are updateing our record
    public function storeFiles(Request $request)
    {
        $userid = $request->userid;
        if($request->file('file')){
            foreach ($request->file as $img) {

                $imageName = strtotime(now()).rand(11111,99999).'.'.$img->getClientOriginalExtension();
                $original_name = $img->getClientOriginalName();
                if(!is_dir(public_path() . '/contacts/')){
                    mkdir(public_path() . '/contacts/', 0777, true);
                }

                $img->move(public_path() . '/contacts/', $imageName);
                File::create([
                    'file'  => '/contacts/'.$imageName,
                    'name'   =>$original_name,
                    'contact_id'    =>$userid
                ]);
            }
            return response()->json([
                'status'    =>"success",
                'userid'    =>$userid
            ]);
        }else{
            return response()->json([
                'status'    =>"warning",
                'message'   => 'no file selected'
            ]);
        }
    }
}
