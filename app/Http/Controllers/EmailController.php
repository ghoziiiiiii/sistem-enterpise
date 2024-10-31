<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

    public function send(){
        $user = User::latest()->first();
        Mail::to('adi@email.com')
        ->send(new TestMail('Test Email', 'Content', 'Ini adalah isi kontennya'));

    return 'OK';
    }
    
}