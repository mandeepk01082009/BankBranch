<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class IndexController extends Controller
{
    // Route::get('/apply-loan', function () {
    //     return view('frontend/apply-loan');
    // });
    // Route::get('/apply-loan-otp', function () {
    //     return view('frontend/apply-loan-otp');
    // });
    // Route::get('/track-loan-status', function () {
    //     return view('frontend/track-loan-status');
    // });
    // Route::get('/about-us', function () {
    //     return view('frontend/about-us');
    // });
    // Route::get('/contact-us', function () {
    //     return view('frontend/contact-us');
    // });
    public function index()
    {
        $slider = Slider::where('status',1)->get();
        return view('welcome',compact('slider'));
    }

    public function applyLoan()
    {
        return view('frontend.apply-loan');
    }

    public function applyLoanOtp()
    {
        return view('frontend.apply-loan-otp');
    }

    public function trackLoanStatus()
    {
        return view('frontend.track-loan-status');
    }

    public function aboutUs()
    {
        return view('frontend.about-us');
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }
}
