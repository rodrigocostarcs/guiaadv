<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contrario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContrarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $totalPage = 10;

    public function __construct()
    {
        $this->middleware('auth');
       
    }

    public function index()
    {
        $contrarios = Contrario::where('user_id',intval(Auth::id()))->paginate($this->totalPage);

        return view('admin.contrarios.index',compact('contrarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contrarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data = $request->only([
            'nome',
            'cpf',
            'rg',
            'nascimento',
            'profissao',
            'estado_civil',
            'pai',
            'mae',
            'titulo_eleitor',
            'zona',
            'secao',
            'pis',
            'ctps',
            'telefone',
            'celular',
            'email',
            'cep',
            'logradouro',
            'n_casa',
            'bairro',
            'complemento',
            'cidade',
            'estado',
            'observacao',
            'razao_social',
            'responsavel',
            'cnpj',
            'inscricao_estadual'
        ]);

        $validator = Validator::make($data,[
            'nome' => ['required','string','max:100'],
            'email' => ['required','string','email','max:200'],
            'celular' => ['required','string','max:25']
            
        ]);

        if($validator->fails()){
            return redirect()->route('contrarios.create')
                ->withErrors($validator)
                ->withInput();
        }

        $contrario = new Contrario;
        $contrario->nome = $data['nome'];
        $contrario->email = $data['email'];
        $contrario->cpf = $data['cpf'];
        $contrario->rg = $data['rg'];
        $contrario->nascimento = $data['nascimento'];
        $contrario->profissao = $data['profissao'];
        $contrario->estado_civil = $data['estado_civil'];
        $contrario->telefone = $data['telefone'];
        $contrario->celular = $data['celular'];
        $contrario->cep = $data['cep'];
        $contrario->logradouro = $data['logradouro'];
        $contrario->n_casa = $data['n_casa'];
        $contrario->bairro = $data['bairro'];
        $contrario->complemento = $data['complemento'];
        $contrario->cidade = $data['cidade'];
        $contrario->estado = $data['estado'];
        $contrario->observacao = $data['observacao'];
        $contrario->razao_social = $data['razao_social'];
        $contrario->responsavel = $data['responsavel'];
        $contrario->cnpj = $data['cnpj'];
        $contrario->inscricao_estadual = $data['inscricao_estadual'];
        $contrario->user_id = intval(Auth::id());
        $contrario->save();

        return redirect()->route('contrarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loggedId = intval(Auth::id());

        $contrario = Contrario::find($id);

        if($contrario){
            
            if(intval($contrario->user_id) === $loggedId){

                return view('admin.contrarios.show',[
                'contrario' => $contrario
                ]);
            }
            
        }

        return redirect()->route('contrarios.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loggedId = intval(Auth::id());

        $contrario = Contrario::find($id);

        if($contrario){
            
            if(intval($contrario->user_id) === $loggedId){

                return view('admin.contrarios.edit',[
                'contrario' => $contrario
                ]);
            }
            
        }

        return redirect()->route('contrarios.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $loggedId = intval(Auth::id());
        $contrario = Contrario::find($id);

        if($contrario){

            if(intval($contrario->user_id) === $loggedId){
                
                  $data = $request->only([
                     'nome',
                     'cpf',
                     'rg',
                     'nascimento',
                     'profissao',
                     'estado_civil',
                     'telefone',
                     'celular',
                     'email',
                     'cep',
                     'logradouro',
                     'n_casa',
                     'bairro',
                     'complemento',
                     'cidade',
                     'estado',
                     'observacao',
                     'razao_social',
                     'responsavel',
                     'cnpj',
                     'inscricao_estadual'
                 ]);

                 $validator = Validator::make($data,[
                     'nome' => ['required','string','max:100'],
                     'email' => ['required','string','email','max:200'],
                     'celular' => ['required','string','max:25']
                     
                 ]);

                 if(count( $validator->errors() ) > 0){

                     return redirect()->route('contrarios.edit',[
                         'contrario'=>$id
                     ])->withErrors($validator);
                 }

                 $contrario->nome = $data['nome'];
                 $contrario->email = $data['email'];
                 $contrario->cpf = $data['cpf'];
                 $contrario->rg = $data['rg'];
                 $contrario->nascimento = $data['nascimento'];
                 $contrario->profissao = $data['profissao'];
                 $contrario->estado_civil = $data['estado_civil'];
                 $contrario->telefone = $data['telefone'];
                 $contrario->celular = $data['celular'];
                 $contrario->cep = $data['cep'];
                 $contrario->logradouro = $data['logradouro'];
                 $contrario->n_casa = $data['n_casa'];
                 $contrario->bairro = $data['bairro'];
                 $contrario->complemento = $data['complemento'];
                 $contrario->cidade = $data['cidade'];
                 $contrario->estado = $data['estado'];
                 $contrario->observacao = $data['observacao'];
                 $contrario->razao_social = $data['razao_social'];
                 $contrario->responsavel = $data['responsavel'];
                 $contrario->cnpj = $data['cnpj'];
                 $contrario->inscricao_estadual = $data['inscricao_estadual'];
              
                 $contrario->save();

            }
        }

        return redirect()->route('contrarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loggedId = intval(Auth::id());
        
        $contrario = Contrario::find($id);

        if($contrario){

            if($loggedId === intval($contrario->user_id)){
            
            $contrario->delete();

            return redirect()->route('contrarios.index')->with(['warning'=>'Parte contrária deletada com sucesso']);
            }
        }

        return redirect()->route('contrarios.index')->with(['warning'=>'falha ao deletar']);
    }
}
