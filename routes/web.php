<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('index');
});


Route::post('/test-email', function () {
    try {
        Mail::raw('If you got this, your SMTP is not lying 👀', function ($message) {
            $message->to(env('MAIL_TEST_RECIPIENT'))
                    ->subject('Laravel SMTP Test');
        });

        return 'Email sent. SMTP understood the assignment.';
    } catch (\Throwable $e) {
        return response($e->getMessage(), 500);
    }
});