<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Advogado;
use App\Models\Contrario;
use App\Models\Financeiro;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Processo;
use App\Models\Prazo;
use App\Models\Compromisso;

class HomeController extends Controller
{
    private $totalPage = 10;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        
        //pesquisa do gráfica de contas a receber ajustar depois
        $filtro = $request->only([
            'ultimosdias'
        ]);
        
        //pesquisa do gráfica de processos
        $filtroProcesso = $request->only([
            'ultimosdiasprocesso'
        ]);

        //validando o gráfico de processos
        $validator = Validator::make($filtroProcesso,[
           'ultimosdiasprocesso' => ['digits_between:1,12']     
       ]);

        //conferido o validate
       if($validator->fails()){
           return redirect()->route('admin')
               ->withErrors($validator)
               ->withInput();
       }

        //preparando para pegar os dados do gráfico de contas a pagar e receber
        $contaspagar = Financeiro::where('user_id',intval(Auth::id()))->where('tipo','P')->get();
        $contasreceber = Financeiro::where('user_id',intval(Auth::id()))->where('tipo','R')->get();
        //preparando para fazer a soma
        $totalContasPagar = 0;
        $totalContasReceber = 0;

        //adicionando o valor em contas a pagar
        foreach($contaspagar as $conta){

            $totalContasPagar = $totalContasPagar + $conta->valor;
        }
        //adicionando o valor em contas a receber
        foreach($contasreceber as $conta){

            $totalContasReceber = $totalContasReceber + $conta->valor;
        }
        
        //somando o saldo
        $saldo = $totalContasReceber - $totalContasPagar;
        
        //preparando o gráfico financeiro
        $pagePie = array(
            "contas a pagar" => $totalContasPagar,
            "contas a receber" => $totalContasReceber,
            "saldo" => $saldo
        );

        //verificando se existe filtro no gráfico de processos

        if(!empty($filtroProcesso)){

        //pego o mês selecionado no filtro
        $mesSelected = intval($filtroProcesso['ultimosdiasprocesso']);
        //diminuo o mês na data atual
        $mes =  date('Y-m-d', strtotime("-$mesSelected month"));
        //pego a data atual para filtrar na query
        $dataAtual = date('Y-m-d');

        //contagem de processos se existir filtro
        $processoDeferido = Processo::where('status_processo','deferido')
                                    ->where('user_id',intval(Auth::id()))
                                    ->whereBetween('data_encerramento',[$mes,$dataAtual])
                                    ->count();
        $processoIndeferido = Processo::where('status_processo','indeferido')
                                    ->where('user_id',intval(Auth::id()))
                                    ->whereBetween('data_encerramento',[$mes,$dataAtual])
                                    ->count();
        $processoRecurso = Processo::where('status_processo','recurso')
                                    ->where('user_id',intval(Auth::id()))
                                    ->whereBetween('data_encerramento',[$mes,$dataAtual])
                                    ->count();
        $processoAberto = Processo::where('status_processo','aberto')
                                    ->where('user_id',intval(Auth::id()))
                                    ->whereBetween('data_encerramento',[$mes,$dataAtual])
                                    ->count();
        $processoArquivado = Processo::where('status_processo','arquivado')
                                    ->where('user_id',intval(Auth::id()))
                                    ->whereBetween('data_encerramento',[$mes,$dataAtual])
                                    ->count();

      }else{

        //se não existir filtros do gráfico de processo eu exibido isso
        $processoDeferido = Processo::where('status_processo','deferido')
                                    ->where('user_id',intval(Auth::id()))
                                    ->count();
        $processoIndeferido = Processo::where('status_processo','indeferido')
                                    ->where('user_id',intval(Auth::id()))
                                    ->count();
        $processoRecurso = Processo::where('status_processo','recurso')
                                    ->where('user_id',intval(Auth::id()))
                                    ->count();
        $processoAberto = Processo::where('status_processo','aberto')
                                    ->where('user_id',intval(Auth::id()))
                                    ->count();
        $processoArquivado = Processo::where('status_processo','arquivado')
                                    ->where('user_id',intval(Auth::id()))
                                    ->count();
      }

        //preparando o gráfico de processo
        $pagePieProcesso = array(

            "processo deferido" => $processoDeferido,
            "processo indeferido" => $processoIndeferido,
            "processo arquivado" => $processoArquivado,
            "processo em recurso" => $processoRecurso,
            "processo aberto"    =>  $processoAberto
        );

        //ajustando o gráfico do financeiro
        $pageLabels = json_encode(array_keys($pagePie));
        $pageValues = json_encode(array_values($pagePie));

        //ajustando o gráfico de processo
        $pageLabels2 = json_encode(array_keys($pagePieProcesso));
        $pageValues2 = json_encode(array_values($pagePieProcesso));
        
        //retorando a view

            return view('admin.home',[
                
                'pageLabels' => $pageLabels,
                'pageValues' => $pageValues,
                'pageLabels2' => $pageLabels2,
                'pageValues2' => $pageValues2,
                'prazos'    => $this->prazoVencendo(),
                'compromissos' => $this->compromissoVencendo(),
                'prazosAlert' => $this->prazosAlert(),
                'compromissoAlert' => $this->compromissoAlert(),
                'totalContasPagar' => $totalContasPagar,
                'totalContasReceber' => $totalContasReceber,
                'saldo'             => $saldo

            ]);
      
    }

    public function prazoVencendo()
    {   


        $diainicio =  date('Y-m-d', strtotime("-20 days"));
        $dataAtual = date('Y-m-d',strtotime("+20 days"));

        //contagem de prazos a vencer
       $prazos = Prazo::where('user_id',intval(Auth::id()))
                        ->whereBetween('data_prazo',[$diainicio,$dataAtual])
                        ->paginate($this->totalPage);
        return $prazos;

    }

    public function compromissoVencendo()
    {

        $diainicio =  date('Y-m-d', strtotime("-20 days"));
        $dataAtual = date('Y-m-d',strtotime("+20 days"));

        //contagem de prazos a vencer
       $compromissos = Compromisso::where('user_id',intval(Auth::id()))
                        ->whereBetween('data_compromisso',[$diainicio,$dataAtual])
                        ->paginate($this->totalPage);
        return $compromissos;

    }

    public function prazosAlert()
    {
        $datafinal =  date('Y-m-d', strtotime("+1 days"));
        $dataAtual = date('Y-m-d');

        //contagem de prazos a vencer
       $prazosAlert = Prazo::where('user_id',intval(Auth::id()))
                        ->where('status','aguardando')
                        ->whereBetween('data_prazo',[$dataAtual,$datafinal])
                        ->count();
        return $prazosAlert;
    }

    public function compromissoAlert()
    {
        $datafinal =  date('Y-m-d', strtotime("+1 days"));
        $dataAtual = date('Y-m-d');

        //contagem de prazos a vencer
       $compromissoAlert = Compromisso::where('user_id',intval(Auth::id()))
                        ->where('status','A')
                        ->whereBetween('data_compromisso',[$dataAtual,$datafinal])
                        ->count();

        return $compromissoAlert;
    }
}
