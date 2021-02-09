<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Processo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Despesa;
use App\Models\Financeiro;


class DespesaController extends Controller
{
        public function __construct()
        {
        	$this->middleware('auth');
        }

    	public function addDespesaExibir($id)
    	{
    		$usuario = User::find(Auth::id());

            $processo = $usuario->processos()->where('id',$id)->first();

            if($processo){

            	return view('admin.processos.adddespesa',[

            		'processo' => $processo

            	]);
            }

            return redirect()->route('processos.index');
    		
    	}

    	public function addDespesaCadastrar(Request $request, $id)
    	{
    		
    		$usuario = User::find(Auth::id());

            $processo = $usuario->processos()->where('id',$id)->first();

            if($processo){


    			$dado = $request->only([

    				'data_operacao',
    				'tipo_operacao',
    				'lancar_movimento',
    				'valor',
    				'descricao'

    			]);

                
                
    			$validator = Validator::make($dado,[
               		'descricao' => ['required','string','min:3','max:200'],
               		'data_operacao' => ['required','date'],
               		'tipo_operacao' => [Rule::in(['R','P'])],
               		'lancar_movimento' => [Rule::in(['S','N'])],
               		'valor'         => ['required','regex:/^\d+(\.\d{1,2})?$/']
            			
           		]);

    			if($validator->fails()){
    			    return redirect()->route('adddespesa',['id'=>$processo->id])
    			        ->withErrors($validator)
    			        ->withInput();
    			}

    			$despesa = new Despesa;

    			$despesa->descricao = $dado['descricao'];
    			$despesa->data_operacao = $dado['data_operacao'];
    			$despesa->tipo_operacao = $dado['tipo_operacao'];
    			$despesa->lancar_movimento = $dado['lancar_movimento'];
    			$despesa->valor = $dado['valor'];

    			if($dado['lancar_movimento'] === 'S'){

    				$despesa->movimento_lancado = true;

    				$financeiro = new Financeiro;

    				$financeiro->user_id = intval(Auth::id());
    				$financeiro->data_op = $dado['data_operacao'];
    				$financeiro->valor = $dado['valor'];
    				$financeiro->tipo = $dado['tipo_operacao'];
    				$financeiro->descricao = 'Esse lançamento foi gerado a partir do processo de número '.$processo->numero_processo;

    				$financeiro->save();
    			}


    			$despesa->user_id = intval(Auth::id());
    			$despesa->processo_id = $processo->id;
    			
    			$despesa->save();

    			return redirect()->route('processos.show',[

    				'processo' => $processo->id

    			]);

    		}

    		return redirect()->route('processos.index');
    	}

        public function alterarDespesa($id)
        {
            $usuario = User::find(Auth::id());

            $despesa = $usuario->despesas()->where('id',$id)->first();

            if($despesa){

                return view('admin.processos.alterardespesa',[

                    'despesa' => $despesa

                ]);
            }

            return redirect()->route('processos.index');
        }

        public function salvarDespesaAlterada(Request $request,$id)
        {
            $usuario = User::find(Auth::id());

            $despesa = $usuario->despesas()->where('id',$id)->first();

            //verifico se a despesa é realmente a que estava sendo alterada e se é do mesmo dono.
            if($despesa){

                //verifico se já foi lançado o movimento no financeiro dessa conta.
                if(!$despesa->movimento_lancado){

                        $dado = $request->only([

                        'data_operacao',
                        'tipo_operacao',
                        'lancar_movimento',
                        'valor',
                        'descricao'
                         ]);

                        $validator = Validator::make($dado,[
                            'descricao' => ['required','string','min:3','max:200'],
                            'data_operacao' => ['required','date'],
                            'tipo_operacao' => [Rule::in(['R','P'])],
                            'lancar_movimento' => [Rule::in(['S','N'])],
                            'valor'         => ['required','regex:/^\d+(\.\d{1,2})?$/']
                                
                        ]);

                    //verifico se tem algum erro na validação

                    if($validator->fails()){
                        return redirect()->route('adddespesa',['id'=>$despesa->processo_id])
                            ->withErrors($validator)
                            ->withInput();
                    }

                $despesa->descricao = $dado['descricao'];
                $despesa->data_operacao = $dado['data_operacao'];
                $despesa->tipo_operacao = $dado['tipo_operacao'];
                $despesa->lancar_movimento = $dado['lancar_movimento'];
                $despesa->valor = $dado['valor'];

                if($dado['lancar_movimento'] === 'S'){

                    $processo = Processo::find($despesa->processo_id);
                    
                    $despesa->movimento_lancado = true;

                    $financeiro = new Financeiro;

                    $financeiro->user_id = intval(Auth::id());
                    $financeiro->data_op = $dado['data_operacao'];
                    $financeiro->valor = $dado['valor'];
                    $financeiro->tipo = $dado['tipo_operacao'];
                    $financeiro->descricao = 'Esse lançamento foi gerado a partir do processo de número '.$processo->numero_processo;

                    $financeiro->save();
                }
                
                $despesa->save();

                return redirect()->route('processos.show',[

                    'processo' => $despesa->processo_id

                ]);

                }else{

                    
                    $dado = $request->only([
                        'descricao'
                    ]);

                    $validator = Validator::make($dado,[
                    'descricao' => ['required','string','min:3','max:200']
                        
                     ]);

                    //verifico se tem algum erro na validação

                    if($validator->fails()){
                        return redirect()->route('adddespesa',['id'=>$despesa->processo_id])
                            ->withErrors($validator)
                            ->withInput();
                    }

                     $despesa->descricao = $dado['descricao'];
                     $despesa->save();

                }
               
            }

            return redirect()->route('processos.index');
        }

        public function deletarDespesa($id)
        {
            $usuario = User::find(Auth::id());

            $despesa = $usuario->despesas()->where('id',$id)->first();

            if($despesa){

                $despesa->delete();

                return redirect()->route('processos.index')->with(['warning'=>'despesa deletada com sucesso']);
             
            }

            return redirect()->route('processos.index')->with(['warning'=>'falha ao deletar']);
  
        }
}
