<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\LandingpageInquiryRequest;

class HomeController extends Controller
{
    public function __invoke() {
        return view('static.home');
    }
}
