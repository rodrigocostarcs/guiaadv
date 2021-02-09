<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Processocliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $totalPage = 5;

    public function __construct()
    {
        $this->middleware('auth');
       
    }

    public function index()
    {
        //$clientes = Cliente::where('user_id',intval(Auth::id()))->paginate($this->totalPage);

        $usuario = User::find(Auth::id());
        
        $clientes = $usuario->clientes()->paginate($this->totalPage);


        return view('admin.clientes.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->except('_token');

       $validator = Validator::make($data,[
           'nome' => ['required','string','max:100'],
           'email' => ['required','string','email','max:200'],
           'celular' => ['required','string','max:25']
           
       ]);

       if($validator->fails()){
           return redirect()->route('clientes.create')
               ->withErrors($validator)
               ->withInput();
       }

       $cliente = new Cliente;
       $cliente->nome = $data['nome'];
       $cliente->email = $data['email'];
       $cliente->cpf = $data['cpf'];
       $cliente->rg = $data['rg'];
       $cliente->nascimento = $data['nascimento'];
       $cliente->profissao = $data['profissao'];
       $cliente->pai = $data['pai'];
       $cliente->mae = $data['mae'];
       $cliente->estado_civil = $data['estado_civil'];
       $cliente->celular = $data['celular'];
       $cliente->cep = $data['cep'];
       $cliente->logradouro = $data['logradouro'];
       $cliente->n_casa = $data['n_casa'];
       $cliente->bairro = $data['bairro'];
       $cliente->complemento = $data['complemento'];
       $cliente->cidade = $data['cidade'];
       $cliente->estado = $data['estado'];
       $cliente->observacao = $data['observacao'];
       $cliente->razao_social = $data['razao_social'];
       $cliente->responsavel = $data['responsavel'];
       $cliente->cnpj = $data['cnpj'];
       $cliente->inscricao_estadual = $data['inscricao_estadual'];
       $cliente->user_id = intval(Auth::id());
       $cliente->save();

       return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$loggedId = intval(Auth::id());

        //$cliente = Cliente::find($id);

        $usuario = User::find(Auth::id());

        try {
            $decryptedId = decrypt($id);
        } catch (DecryptException $e) {
            
            return redirect()->route('clientes.index');
            exit;
        }


        $cliente = $usuario->clientes()->where('id',$decryptedId)->first();

        if($cliente){
        
         $processos = $cliente->processos()->paginate($this->totalPage);

         return view('admin.clientes.show',[
                'cliente' => $cliente,
                'processos' => $processos
            ]);
          
            
        }

        return redirect()->route('clientes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $usuario = User::find(Auth::id());

         try {
            $decryptedId = decrypt($id);
        } catch (DecryptException $e) {
            
            return redirect()->route('clientes.index')->with(['noautorizado'=>'Isso não era para ter acontecido, se o erro persistir entre em contato com o suporte Guia ADV']);
            exit;
        }

        $cliente = $usuario->clientes()->where('id',$decryptedId)->first();

        if($cliente){

                return view('admin.clientes.edit',[
                'cliente' => $cliente
                ]);            
        }

        return redirect()->route('clientes.index');
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
        

        $usuario = User::find(Auth::id());

         try {
            $decryptedId = decrypt($id);
        } catch (DecryptException $e) {
            
            return redirect()->route('clientes.index')->with(['noautorizado'=>'Isso não era para ter acontecido, se o erro persistir entre em contato com o suporte Guia ADV']);
            exit;
        }


        $cliente = $usuario->clientes()->where('id',$decryptedId)->first();

        if($cliente){

            
                
                 $data = $request->except('_token');

                 $validator = Validator::make($data,[
                     'nome' => ['required','string','max:100'],
                     'email' => ['required','string','email','max:200'],
                     'celular' => ['required','string','max:25']
                     
                 ]);

                 if(count( $validator->errors() ) > 0){

                     return redirect()->route('clientes.edit',[
                         'cliente'=>$id
                     ])->withErrors($validator);
                 }

                 $cliente->nome = $data['nome'];
                 $cliente->email = $data['email'];
                 $cliente->cpf = $data['cpf'];
                 $cliente->rg = $data['rg'];
                 $cliente->nascimento = $data['nascimento'];
                 $cliente->profissao = $data['profissao'];
                 $cliente->pai = $data['pai'];
                 $cliente->mae = $data['mae'];
                
                 $cliente->estado_civil = $data['estado_civil'];
               
                 $cliente->celular = $data['celular'];
                 $cliente->cep = $data['cep'];
                 $cliente->logradouro = $data['logradouro'];
                 $cliente->n_casa = $data['n_casa'];
                 $cliente->bairro = $data['bairro'];
                 $cliente->complemento = $data['complemento'];
                 $cliente->cidade = $data['cidade'];
                 $cliente->estado = $data['estado'];
                 $cliente->observacao = $data['observacao'];
                 $cliente->razao_social = $data['razao_social'];
                 $cliente->responsavel = $data['responsavel'];
                 $cliente->cnpj = $data['cnpj'];
                 $cliente->inscricao_estadual = $data['inscricao_estadual'];
              
                 $cliente->save();

                 return redirect()->route('clientes.index')->with(['success'=>'dados atualizados com sucesso']);

            }

        return redirect()->route('clientes.index')->with(['noautorizado'=>'Isso não era para ter acontecido, se o erro persistir entre em contato com o suporte Guia ADV']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find(Auth::id());

        try {
            $decryptedId = decrypt($id);
        } catch (DecryptException $e) {
            
            return redirect()->route('clientes.index');
            exit;
        }


        $cliente = $usuario->clientes()->where('id',$decryptedId)->first();

        if($cliente){

            $cliente->delete();

            return redirect()->route('clientes.index')->with(['warning'=>'cliente deletado com sucesso']);
         
        }

        return redirect()->route('clientes.index')->with(['warning'=>'falha ao deletar']);
  
        
    }

    //requisição ajax

    public function deletarCliente(Request $request)
    {
        $usuario = User::find(Auth::id());
        $id = $request->all();
       
        try {
            $decryptedId = decrypt($id['id']);
        } catch (DecryptException $e) {
            
            return redirect()->route('clientes.index');
            exit;
        }

        $cliente = $usuario->clientes()->where('id',$decryptedId)->first();

        if($cliente){

            $cliente->delete();

            return redirect()->route('clientes.index')->with(['warning'=>'cliente deletado com sucesso']);
         
        }

        return redirect()->route('clientes.index')->with(['warning'=>'falha ao deletar']);
    }
}
