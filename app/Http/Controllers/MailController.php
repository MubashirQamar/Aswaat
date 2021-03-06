<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //

    public function sendmail(Request $request) {
        // dd($request);
        $data = array(
            'name'=> $request->name,
            'company_name'=> $request->name,
            'country'=> $request->country,
            'city'=> $request->city,
            'phone_number'=> $request->p_number,
            'email'=> $request->email,
            'message'=> $request->message,
        );
        $email=$request->email;
        $name=$request->name;
        Mail::send('mail',[
            'data'=>$data
         ],function ($mail) use($request){
             $mail->from('talabat@aswwat.com','Aswwat');
             $mail->to('talabat@aswwat.com')->subject('Aswwat Inquiry');
         });
         return back()->with(['msg'=>'success']);
        // echo "Basic Email Sent. Check your inbox.";
     }
    //  public function html_email() {
    //     $data = array('name'=>"Virat Gandhi");
    //     Mail::send('mail', $data, function($message) {
    //        $message->to('abc@gmail.com', 'Tutorials Point')->subject
    //           ('Laravel HTML Testing Mail');
    //        $message->from('xyz@gmail.com','Virat Gandhi');
    //     });
    //     echo "HTML Email Sent. Check your inbox.";
    //  }
    //  public function attachment_email() {
    //     $data = array('name'=>"Virat Gandhi");
    //     Mail::send('mail', $data, function($message) {
    //        $message->to('abc@gmail.com', 'Tutorials Point')->subject
    //           ('Laravel Testing Mail with Attachment');
    //        $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
    //        $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
    //        $message->from('xyz@gmail.com','Virat Gandhi');
    //     });
    //     echo "Email Sent with attachment. Check your inbox.";
    //  }

}
