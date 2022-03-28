<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Mail\TestMarkdownMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function bar()
    {
        $user = auth()->user();

        Mail::to($user->email)->send(new TestMarkdownMail($user));
        // return view();
    }
}
