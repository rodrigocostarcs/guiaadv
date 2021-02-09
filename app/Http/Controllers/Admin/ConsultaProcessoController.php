<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Cliente;
use App\Models\Processo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Processocliente;
use App\Models\Testemunha;
use App\Models\Processotestemunha;
use App\Models\Contrario;
use App\Models\Processocontrario;

class ConsultaProcessoController extends Controller
{
	private $totalPage = 3;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function processoCliente($id)
    {
    	$usuario = User::find(Auth::id());

        $processo = $usuario->processos()->where('id',$id)->first();
        $clientes = $usuario->clientes()->paginate($this->totalPage);


        if($processo){

        	return view('admin.processos.addclienteprocesso',[

        		'processo' => $processo,
        		'clientes' => $clientes

        	]);
        }

        return redirect()->route('processos.index');

    }

    public function salvarProcessoCliente(Request $request,$id)
    {
    	//recupero o usuário logado
        $usuario = User::find(Auth::id());

        //recupero o processo com id vindo do formulário
        $processo = $usuario->processos()->where('id',$id)->first();

        if($processo){

         foreach($request->get('cliente_id') as $item ){
                   
         $cliente = Cliente::where('id',$item)->where('user_id',$usuario->id)->first();

         if(!$cliente){

            return redirect()->route('processos.index')->with(['warning'=>'Erro ao adicionar este cliente entre em contato com o suporte Guia ADV.']);
               exit;
              }


            $processocliente = Processocliente::where('processo_id',$processo->id)
                              ->where('cliente_id',$cliente->id)
                              ->first();

              if($processocliente){

               return redirect()->route('processos.show',['processo'=>$processo->id])->with(['noautorizado'=>'cliente já faz parte deste processo.']);
                //exit;
              }

          }
                
         $processo->clientes()->attach($request->get('cliente_id'));

        return redirect()->route('processos.show',['processo'=>$processo->id])->with(['success'=>'cliente(s) adicionado(s) com sucesso ao processo']);
        }

         return redirect()->route('processos.index')->with(['noautorizado'=>'Não foi possível adicionar o(s) cliente(s)  ao processo']);
    }

    public function deletarProcessoCliente($idCliente,$idProcesso)
    {
        //recupero o usuário logado
        $usuario = User::find(Auth::id());

        $cliente = $usuario->clientes()->where('id',$idCliente)->first();

        if($cliente){

          $clienteProcesso = Processocliente::where('cliente_id',$idCliente)
                             ->where('processo_id',$idProcesso)
                             ->first();
         
          if($clienteProcesso){

            $clienteProcesso->delete();

            return redirect()->route('processos.show',['processo'=>$idProcesso])->with(['success'=>'cliente removido com sucesso do processo']);

          }else{

            return redirect()->route('processos.index')->with(['noautorizado'=>'Não foi possível remover  o cliente  deste processo']);
          }

        }

        return redirect()->route('processos.index')->with(['noautorizado'=>'Não foi possível remover  o cliente  deste processo']);
    }

    public function processoTestemunha($id)
    {
        
        $usuario = User::find(Auth::id());

        $processo = $usuario->processos()->where('id',$id)->first();
        $testemunhas = $usuario->testemunhas()->paginate($this->totalPage);

        if($processo){

         return view('admin.processos.addtestemunhaprocesso',[
          'processo' => $processo,
          'testemunhas' => $testemunhas

          ]);
         }

          return redirect()->route('processos.index')->with(['noautorizado'=>'Não foi possível acessar essa página no momento']);
    }

    public function salvarProcessoTestemunha(Request $request,$id)
    {
          //recupero o usuário logado
            $usuario = User::find(Auth::id());

            //recupero o processo com id vindo do formulário
            $processo = $usuario->processos()->where('id',$id)->first();

            if($processo){

             foreach($request->get('testemunha_id') as $item ){
                       
             $testemunha = Testemunha::where('id',$item)->where('user_id',$usuario->id)->first();

             if(!$testemunha){

                return redirect()->route('processos.index')->with(['warning'=>'Erro ao adicionar testemunha a este processo.']);
                   exit;
                  }


                $processoTestemunha = Processotestemunha::where('processo_id',$processo->id)
                                  ->where('testemunha_id',$testemunha->id)
                                  ->first();

                  if($processoTestemunha){

                   return redirect()->route('processos.show',['processo'=>$processo->id])->with(['noautorizado'=>'Testemunha já faz parte deste processo.']);
                    //exit;
                  }

              }
                    
             $processo->testemunhas()->attach($request->get('testemunha_id'));

            return redirect()->route('processos.show',['processo'=>$processo->id])->with(['success'=>'Testemunha(s) adicionada(s) com sucesso ao processo']);
            }

             return redirect()->route('processos.index')->with(['noautorizado'=>'Não foi possível adicionar a(s) Testemunha(s)  ao processo']);
    }

    public function deletarProcessoTestemunha($idTestemunha,$idProcesso)
    {
        //recupero o usuário logado
        $usuario = User::find(Auth::id());

        $testemunha = $usuario->testemunhas()->where('id',$idTestemunha)->first();

        if($testemunha){

          $testemunhaProcesso = Processotestemunha::where('testemunha_id',$idTestemunha)
                             ->where('processo_id',$idProcesso)
                             ->first();
         
          if($testemunhaProcesso){

            $testemunhaProcesso->delete();

            return redirect()->route('processos.show',['processo'=>$idProcesso])->with(['success'=>'Testemunha removida com sucesso do processo']);

          }else{

            return redirect()->route('processos.index')->with(['noautorizado'=>'Não foi possível remover  a testemunha deste processo']);
          }

        }

        return redirect()->route('processos.index')->with(['noautorizado'=>'Não foi possível remover  a testemunha deste processo']);
    }

    public function processoContrario($id)
    {
        $usuario = User::find(Auth::id());

        $processo = $usuario->processos()->where('id',$id)->first();
        $contrarios = $usuario->contrarios()->paginate($this->totalPage);

        if($processo){

         return view('admin.processos.addcontrarioprocesso',[
          'processo' => $processo,
          'contrarios' => $contrarios

          ]);
         }

          return redirect()->route('processos.index')->with(['noautorizado'=>'Não foi possível acessar essa página no momento']);
    }

    public function salvarProcessoContrario(Request $request,$id)
    {
          //recupero o usuário logado
            $usuario = User::find(Auth::id());

            //recupero o processo com id vindo do formulário
            $processo = $usuario->processos()->where('id',$id)->first();

            if($processo){

             foreach($request->get('contrario_id') as $item ){
                       
             $contrario = Contrario::where('id',$item)->where('user_id',$usuario->id)->first();

             if(!$contrario){

                return redirect()->route('processos.index')->with(['warning'=>'Erro ao adicionar parte contrária a este processo.']);
                   exit;
                  }


                $processoContrario = Processocontrario::where('processo_id',$processo->id)
                                  ->where('contrario_id',$contrario->id)
                                  ->first();

                  if($processoContrario){

                   return redirect()->route('processos.show',['processo'=>$processo->id])->with(['noautorizado'=>'Parte contrária já faz parte deste processo.']);
                    //exit;
                  }

              }
                    
             $processo->contrarios()->attach($request->get('contrario_id'));

            return redirect()->route('processos.show',['processo'=>$processo->id])->with(['success'=>'Parte Contrária  adicionada(s) com sucesso ao processo']);
            }

             return redirect()->route('processos.index')->with(['noautorizado'=>'Não foi possível adicionar a(s) Parte(s) Contrária  ao processo']);
    }

    public function deletarProcessoContrario($idContrario,$idProcesso)
    {
        //recupero o usuário logado
        $usuario = User::find(Auth::id());

        $contrario = $usuario->contrarios()->where('id',$idContrario)->first();

        if($contrario){

          $contrarioProcesso = Processocontrario::where('contrario_id',$idContrario)
                             ->where('processo_id',$idProcesso)
                             ->first();
         
          if($contrarioProcesso){

            $contrarioProcesso->delete();

            return redirect()->route('processos.show',['processo'=>$idProcesso])->with(['success'=>'Parte contrária removida com sucesso do processo']);

          }else{

            return redirect()->route('processos.index')->with(['noautorizado'=>'Não foi possível remover  a Parte contrária deste processo']);
          }

        }

        return redirect()->route('processos.index')->with(['noautorizado'=>'Não foi possível remover  a Parte contrária deste processo']);
    }
}
