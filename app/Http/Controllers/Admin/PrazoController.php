<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Processo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Prazo;

class PrazoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

	public function addPrazoExibir($id)
	{
		$usuario = User::find(Auth::id());

        $processo = $usuario->processos()->where('id',$id)->first();

        if($processo){

        	return view('admin.processos.addprazo',[

        		'processo' => $processo

        	]);
        }

        return redirect()->route('processos.index');
		
	}

	public function addPrazoCadastrar(Request $request, $id)
	{
		
		$usuario = User::find(Auth::id());

        $processo = $usuario->processos()->where('id',$id)->first();

        if($processo){


			$dado = $request->except('_token');

			$validator = Validator::make($dado,[
           		'descricao' => ['required','string','max:100'],
           		'data_prazo' => ['required','date']
       		]);

			if($validator->fails()){
			    return redirect()->route('addprazo',['id'=>$processo->id])
			        ->withErrors($validator)
			        ->withInput();
			}

			$prazo = new Prazo;
			$prazo->descricao = $dado['descricao'];
			$prazo->data_prazo = $dado['data_prazo'];
			$prazo->user_id = intval(Auth::id());
			$prazo->processo_id = $processo->id;
			
			$prazo->save();

			return redirect()->route('processos.show',[

				'processo' => $processo->id

			]);

		}

		return redirect()->route('processos.index');
	}

}
