<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('index');
});


Route::post('/test-email', function () {
    // try {
        Mail::raw('Hello from MS Graph!', function ($message) {
            $message->to(env('MAIL_TEST_RECIPIENT'))
                    ->subject('Test Email via Microsoft Graph');
        });

        return 'Test email sent to '.env('MAIL_TEST_RECIPIENT');
    // } catch (\Throwable $e) {
    //     return response($e->getMessage(), 500);
    // }
});