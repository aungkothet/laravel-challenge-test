<?php

namespace App\Http\Controllers;

use App\Http\Requests\InternetServiceProviderRequest;
use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Request;

class InternetServiceProviderController extends Controller
{
    public function getMptInvoiceAmount(InternetServiceProviderRequest $request)
    {
        $mpt = new Mpt();
        $mpt->setMonth($request->month);
        $amount = $mpt->calculateTotalAmount();
        
        return response()->json([
            'data' => $amount
        ]);
    }
    
    public function getOoredooInvoiceAmount(InternetServiceProviderRequest $request)
    {
        $ooredoo = new Ooredoo();
        $ooredoo->setMonth($request->month);
        $amount = $ooredoo->calculateTotalAmount();
        
        return response()->json([
            'data' => $amount
        ]);
    }
}
