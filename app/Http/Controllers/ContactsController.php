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
                $contact_id = $contact->id; // this give us the last inserted record id
                return response()->json([
                    'status'=>"success",
                    'message' => 'Thank you, your details have been successfully registered.',
                    'contact_id'=>$contact_id
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
        $contact_id = $request->contact_id;
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
                    'contact_id'    =>$contact_id
                ]);
            }
            set_time_limit(6000);
            $contact = Contact::find($contact_id);
            $files = File::where('contact_id',$contact_id)->get();
            //  Send mail to admin
            \Mail::send('mail', array(

                'fname' => $contact->fname,
                'lname' => $contact->lname,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'project' => $contact->project,
                'classification' => $contact->classification,
                'issue' => $contact->issue,
                'description' => $contact->description,
                'priority' => $contact->priority,

            ), function($message) use ($contact,$files){
                $message->from($contact->email);
                //ibtihal@nadsoft.net
                $message->to('ahmedhegazi214@gmail.com', 'Admin')->subject($contact->issue);
                /*foreach ($files as $file){
                    $message->attach(public_path($file->file));
                }*/
            });
            return response()->json([
                'status'    =>"success",
                'contact_id'    =>$contact_id
            ]);
        }else{
            return response()->json([
                'status'    =>"warning",
                'message'   => 'no file selected'
            ]);
        }
    }
}
