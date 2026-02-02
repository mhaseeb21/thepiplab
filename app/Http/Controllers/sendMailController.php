<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendMailController extends Controller
{
    public function index()
    {
        $mailData=[
            'title'=>'The Pip lab',
            'body'=> 'Testing mail'
        ];
        Mail::to('i.amm.haseeb21@gmail.com')->send(new SendMail($mailData));
        echo "Email successful";
    }
}
