<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assinatura;

class HomeController extends Controller
{
    public function index()
    {	
    	$assinaturas = Assinatura::where('cupom',null)
    							  ->where('ativo',true)
    							  ->paginate(4);
    							  
        return view('site.home',compact('assinaturas'));
    }

   
}
