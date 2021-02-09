<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Processo;

class ProcessoController extends Controller
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
        $processos = Processo::where('user_id',intval(Auth::id()))->paginate($this->totalPage);

        return view('admin.processos.index',compact('processos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.processos.create');
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

            'numero_processo' => ['required','string','min:3','max:200'],
            'area_processo' => ['required','string','min:3','max:200'],
            'tipo_acao'  => ['required','string','min:3','max:200'],
            'valor' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
            'data_encerramento' => ['required','date'],
            'notificacao_email' => [
            Rule::in(['1'])],
            'observacao_processo' => ['nullable','min:3','max:1000']
        ]);
        
        if($validator->fails()){
           return redirect()->route('processos.create')
               ->withErrors($validator)
               ->withInput();
       }

       if(empty($data['notificacao_email'])){

            $data['notificacao_email'] = false;
       }

       $processo = new Processo;
       $processo->numero_processo = $data['numero_processo'];
       $processo->area_processo = $data['area_processo'];
       $processo->tipo_acao = $data['tipo_acao'];
       $processo->valor = $data['valor'];
       $processo->data_encerramento = $data['data_encerramento'];
       $processo->notificacao_email =  $data['notificacao_email'];
       $processo->observacao_processo =  $data['observacao_processo'];
       $processo->user_id = intval(Auth::id());
       $processo->save();

       $loggedId = intval(Auth::id());

       $processo = Processo::find($processo->id);

        if($processo){
            
            if(intval($processo->user_id) === $loggedId){

                return redirect()->route('processos.show',[
                    'processo' => $processo->id
                ]);
            }
            
        }

        return redirect()->route('processos.index');
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

        $processo = Processo::find($id);

        $clientes = $processo->clientes;
        $contrarios = $processo->contrarios;
        $testemunhas = $processo->testemunhas;

        $prazos = $processo->prazos()->paginate($this->totalPage);
        $despesas = $processo->despesas;
        $compromissos = $processo->compromissos()->paginate($this->totalPage);

        if($processo){

            $dataAtual = date('Y-m-d');

            foreach($prazos as $prazo){

                if($prazo->data_prazo <= $dataAtual && $prazo->status != 'finalizado'){

                    $prazo->status = 'finalizado';
                    $prazo->save();
                }
            }
            
            if(intval($processo->user_id) === $loggedId){

                return view('admin.processos.show',compact('processo','clientes','contrarios','testemunhas','prazos','despesas','compromissos'));
            }
            
        }

        return redirect()->route('processos.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
