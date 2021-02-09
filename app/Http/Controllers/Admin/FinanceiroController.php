<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Financeiro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class FinanceiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $totalPage = 3;

    public function __construct()
    {
        $this->middleware('auth');
       
    }

    public function index()
    {   
        //pesquisar como trazer apenas o intervalo de 1 mes de contas lançadas

        

        $data_inicio = mktime(0, 0, 0, date('m') , 1 , date('Y'));
        $data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y'));

       $data_begin = date('Y-m-d h:i:s',$data_inicio);
       $data_end = date('Y-m-d h:i:s',$data_fim);

        $financas = Financeiro::where('user_id',intval(Auth::id()))
                            ->whereBetween('data_op', [$data_begin, $data_end])
                            ->paginate($this->totalPage);

        //ATÉ AQUI
        
        
        $contaPagar = 0;
        $contaReceber = 0;

        foreach($financas as $financa){

            if($financa->tipo == 'P')
                $contaPagar = $contaPagar + $financa->valor;

            else
                $contaReceber = $contaReceber + + $financa->valor;
        }

        $saldo = 0;
        $saldo = $contaReceber - $contaPagar;

        return view('admin.financeiro.index',compact('financas','saldo','data_begin','data_end'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.financeiro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->all();

       $validator = Validator::make($data,[
           'data_op'       => ['required','date'],
           'valor'         => ['required','regex:/^\d+(\.\d{1,2})?$/'],
           'tipo'          => [
            'required',
            Rule::in(['R', 'P'])],
            'descricao'   => ['required','string','min:3','max:200']
           
       ]);

       if($validator->fails()){
           return redirect()->route('financeiros.create')
               ->withErrors($validator)
               ->withInput();
       }

       $financa = new Financeiro;
       $financa->data_op = $data['data_op'];
       $financa->valor = $data['valor'];
       $financa->tipo = $data['tipo'];
       $financa->descricao = $data['descricao'];
       $financa->user_id = intval(Auth::id());
       $financa->save();

       return redirect()->route('financeiros.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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

        $financa = Financeiro::find($id);

        if($financa){
            
            if(intval($financa->user_id) === $loggedId){

                return view('admin.financeiro.edit',[
                'financeiro' => $financa
                ]);
            }
            
        }

        return redirect()->route('financeiros.index');
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
        $financa = Financeiro::find($id);

        if($financa){

            if(intval($financa->user_id) === $loggedId){

        $data = $request->all();

        $validator = Validator::make($data,[
            'data_op'       => ['required','date'],
            'valor'         => ['required','regex:/^\d+(\.\d{1,2})?$/'],
            'tipo'          => [
             'required',
             Rule::in(['R', 'P'])],
             'descricao'   => ['required','string','min:3','max:200']
            
        ]);
 
        if(count( $validator->errors() ) > 0){

            return redirect()->route('financeiros.edit',[
                'financeiro'=>$id
            ])->withErrors($validator);
        }
 
        
        $financa->data_op = $data['data_op'];
        $financa->valor = $data['valor'];
        $financa->tipo = $data['tipo'];
        $financa->descricao = $data['descricao'];
        $financa->save();

            }
        }

        return redirect()->route('financeiros.index');
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
            
        $financa = Financeiro::find($id);

        if($financa){

            if($loggedId === intval($financa->user_id)){
                
            $financa->delete();

            return redirect()->route('financeiros.index')->with(['warning'=>'Movimento financeiro apagado 
             com sucesso']);
                }
            }

        return redirect()->route('financeiros.index')->with(['warning'=>'falha ao deletar']);
    }
}
