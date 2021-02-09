<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Processo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Compromisso;

class CompromissoController extends Controller
{	
	public function __construct()
	{
		$this->middleware('auth');
	}


    public function addCompromissoExibir($id)
    {
    	

        $usuario = User::find(Auth::id());


        $processo = $usuario->processos()->where('id',$id)->first();

         if($processo){

           return view('admin.processos.addcompromisso',[

            'processo' => $processo

            ]);
        }

        return redirect()->route('processos.index');
    }

    public function addCompromissoCadastrar(Request $request,$id)
    {
    	$usuario = User::find(Auth::id());

        $processo = $usuario->processos()->where('id',$id)->first();

            if($processo){

                $dado = $request->only([

                    'status',
                    'data_compromisso',
                    'horario_inicio',
                    'horario_fim',
                    'descricao'

                ]);



                $validator = Validator::make($dado,[
                    'descricao' => ['required','string','min:3','max:200'],
                    'data_compromisso' => ['required','date'],
                    'horario_inicio'=> ['date_format:H:i','required'],
                    'horario_fim' => ['date_format:H:i','required','after:horario_inicio','required'],
                    'status' => [Rule::in(['F','A'])]
                        
                ]);

                if($validator->fails()){
                    return redirect()->route('addcompromisso',['id'=>$processo->id])
                        ->withErrors($validator)
                        ->withInput();
                }

                $compromisso = new Compromisso;

                $compromisso->descricao = $dado['descricao'];
                $compromisso->data_compromisso = $dado['data_compromisso'];
                $compromisso->horario_inicio = $dado['horario_inicio'];
                $compromisso->horario_fim = $dado['horario_fim'];
                $compromisso->status = $dado['status'];

                $compromisso->user_id = intval(Auth::id());
                $compromisso->processo_id = $processo->id;
                
                $compromisso->save();

                return redirect()->route('processos.show',[

                    'processo' => $processo->id

                ]);

            }

            return redirect()->route('processos.index');
    }

    public function alterarCompromisso($id)
    {
        $usuario = User::find(Auth::id());

        $compromisso = $usuario->compromissos()->where('id',$id)->first();

        if($compromisso){

            return view('admin.processos.alterarcompromisso',[

                'compromisso' => $compromisso

            ]);
        }

        return redirect()->route('processos.index');
    }

    public function salvarCompromissoAlterado(Request $request,$id)
    {
        $usuario = User::find(Auth::id());

        $compromisso = $usuario->compromissos()->where('id',$id)->first();

        //verifico se o compromisso é realmente a que estava sendo alterada e se é do mesmo dono.
        if($compromisso){

            
        $dado = $request->only([

           'status',
           'data_compromisso',
            'horario_inicio',
            'horario_fim',
            'descricao'
        ]);

        

        $validator = Validator::make($dado,[
          'status' => [Rule::in(['F','A','R'])],  
          'data_compromisso' => ['required','date'],
          'horario_inicio'=> ['date_format:H:i','required'],
          'horario_fim' => ['date_format:H:i','required','after:horario_inicio','required'],
          'descricao' => ['required','string','min:3','max:200']             
        ]);

     //verifico se tem algum erro na validação

     if($validator->fails()){
        
         return redirect()->route('alterarcompromisso',['id'=>$compromisso->processo_id])
             ->withErrors($validator)
             ->withInput();
     }

     $compromisso->descricao = $dado['descricao'];
     $compromisso->data_compromisso = $dado['data_compromisso'];
     $compromisso->horario_inicio = $dado['horario_inicio'];
     $compromisso->horario_fim = $dado['horario_fim'];
     $compromisso->status = $dado['status'];

    $compromisso->save();

     return redirect()->route('processos.show',[

    'processo' => $compromisso->processo_id

    ]);        
            
        
  }

        return redirect()->route('processos.index');

    }


    public function deletarCompromisso($id)
    {
        $usuario = User::find(Auth::id());

        $compromisso = $usuario->compromissos()->where('id',$id)->first();

        if($compromisso){

            $compromisso->delete();

            return redirect()->route('processos.index')->with(['warning'=>'compromisso deletado com sucesso']);
         
        }

        return redirect()->route('processos.index')->with(['warning'=>'falha ao deletar']);
        
    }
}
