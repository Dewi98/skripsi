<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function notification(Request $request)
    {
        dd($request);

    }
    public function completed(Request $request)
    {

    }
    public function unfinish(Request $request)
    {

    }
    public function failed(Request $request)
    {

    }

}