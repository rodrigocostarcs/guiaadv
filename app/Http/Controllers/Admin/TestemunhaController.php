<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testemunha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TestemunhaController extends Controller
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
        $testemunhas = Testemunha::where('user_id',intval(Auth::id()))->paginate($this->totalPage);

        return view('admin.testemunhas.index',compact('testemunhas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testemunhas.create');
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
            'observacao'
        ]);

        $validator = Validator::make($data,[
            'nome' => ['required','string','max:100'],
            'email' => ['required','string','email','max:200'],
            'celular' => ['required','string','max:25']
            
        ]);

        if($validator->fails()){
            return redirect()->route('testemunhas.create')
                ->withErrors($validator)
                ->withInput();
        }

        $testemunha = new Testemunha;
        $testemunha->nome = $data['nome'];
        $testemunha->email = $data['email'];
        $testemunha->cpf = $data['cpf'];
        $testemunha->rg = $data['rg'];
        $testemunha->nascimento = $data['nascimento'];
        $testemunha->profissao = $data['profissao'];
        $testemunha->estado_civil = $data['estado_civil'];
        $testemunha->telefone = $data['telefone'];
        $testemunha->celular = $data['celular'];
        $testemunha->cep = $data['cep'];
        $testemunha->logradouro = $data['logradouro'];
        $testemunha->n_casa = $data['n_casa'];
        $testemunha->bairro = $data['bairro'];
        $testemunha->complemento = $data['complemento'];
        $testemunha->cidade = $data['cidade'];
        $testemunha->estado = $data['estado'];
        $testemunha->observacao = $data['observacao'];
        $testemunha->user_id = intval(Auth::id());
        $testemunha->save();

        return redirect()->route('testemunhas.index');
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

        $testemunha = Testemunha::find($id);

        if($testemunha){
            
            if(intval($testemunha->user_id) === $loggedId){

                return view('admin.testemunhas.show',[
                'testemunha' => $testemunha
                ]);
            }
            
        }

        return redirect()->route('testemunhas.index');
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

        $testemunha = Testemunha::find($id);

        if($testemunha){
            
            if(intval($testemunha->user_id) === $loggedId){

                return view('admin.testemunhas.edit',[
                'testemunha' => $testemunha
                ]);
            }
            
        }

        return redirect()->route('testemunhas.index');
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
        $testemunha = Testemunha::find($id);

        if($testemunha){

            if(intval($testemunha->user_id) === $loggedId){
                
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
                     'observacao'
                 ]);

                 $validator = Validator::make($data,[
                     'nome' => ['required','string','max:100'],
                     'email' => ['required','string','email','max:200'],
                     'celular' => ['required','string','max:25']
                     
                 ]);

                 if(count( $validator->errors() ) > 0){

                     return redirect()->route('testemunhas.edit',[
                         'testemunha'=>$id
                     ])->withErrors($validator);
                 }

                 $testemunha->nome = $data['nome'];
                 $testemunha->email = $data['email'];
                 $testemunha->cpf = $data['cpf'];
                 $testemunha->rg = $data['rg'];
                 $testemunha->nascimento = $data['nascimento'];
                 $testemunha->profissao = $data['profissao'];
                 $testemunha->estado_civil = $data['estado_civil'];
                 $testemunha->telefone = $data['telefone'];
                 $testemunha->celular = $data['celular'];
                 $testemunha->cep = $data['cep'];
                 $testemunha->logradouro = $data['logradouro'];
                 $testemunha->n_casa = $data['n_casa'];
                 $testemunha->bairro = $data['bairro'];
                 $testemunha->complemento = $data['complemento'];
                 $testemunha->cidade = $data['cidade'];
                 $testemunha->estado = $data['estado'];
                 $testemunha->observacao = $data['observacao'];

                $testemunha->save();

            }
        }

        return redirect()->route('testemunhas.index');
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
            
        $testemunha = Testemunha::find($id);

        if($testemunha){

            if($loggedId === intval($testemunha->user_id)){
                
            $testemunha->delete();

            return redirect()->route('testemunhas.index')->with(['warning'=>'Testemunha deletada com sucesso']);
                }
            }

        return redirect()->route('testemunhas.index')->with(['warning'=>'falha ao deletar']);
        
    }
}
