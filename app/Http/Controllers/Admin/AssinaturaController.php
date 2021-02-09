<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assinatura;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Validation\Rule;

class AssinaturaController extends Controller
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
       $assinaturas = Assinatura::paginate($this->totalPage);

       return view('admin.assinaturas.index',compact('assinaturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.assinaturas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find(intval(Auth::id()));

        $data = $request->only([

            'tipo',
            'identificador',
            'cupom',
            'valor',
            'qtd_mes_cobranca',
            'qtd_cad_basico',
            'ativo',
            'qtd_processos',
            'financeiro',
            'envio_email_prazos',
            'envio_whatsapp_prazos',
            'envio_email_compromissos',
            'descricao_site',
            'descricao_painel',
            'link',
            'password'

        ]);

        $data['valor'] = number_format(doubleval($data['valor']), 2, '.', '');
       
        $validator = Validator::make($data,[
           'tipo'                       => ['required','string','min:3','max:100'],
           'identificador'              => ['required','string','min:3','max:30'],
           'cupom'                      => ['nullable','string','max:9'],
           'valor'                      => ['required','regex:/^\d+(\.\d{1,2})?$/'],
           'qtd_mes_cobranca'           => ['required','digits_between:1,100'],
           'qtd_cad_basico'             => ['required','digits_between:1,2000'],
           'qtd_processos'              => ['required','digits_between:1,2000'],
           'financeiro'                 => [Rule::in(['1'])],
            'envio_email_prazos'        => [Rule::in(['1'])],
            'envio_whatsapp_prazos'     => [Rule::in(['1'])],
            'envio_email_compromissos'  => [Rule::in(['1'])],
            'ativo'                     => [Rule::in(['1'])],
            'descricao_site'            => ['required','string'],
            'descricao_painel'          => ['required','string','min:3'],
            'link'                      => ['required','string','min:3'],
            'password'                  => ['required','min:3']
       ]);

        if (!Hash::check($data['password'], $user->password)) {
            
            return redirect()->route('assinaturas.index')->with('noautorizado','Senha digitada não confere com a do usuário logado');
        }



       if($validator->fails()){
           return redirect()->route('assinaturas.create')
                   ->withErrors($validator)
                   ->withInput();
       }


       $assinatura = new Assinatura;
       
       $assinatura->tipo = $data['tipo'];
       $assinatura->identificador = strtoupper($data['identificador']);
       $assinatura->cupom = $data['cupom'];
       $assinatura->valor = doubleval($data['valor']);
       $assinatura->qtd_mes_cobranca = intval($data['qtd_mes_cobranca']);
       $assinatura->qtd_cad_basico = intval($data['qtd_cad_basico']);
       $assinatura->qtd_processos = intval($data['qtd_processos']);
       
       if(isset($data['financeiro']))
        $assinatura->financeiro = $data['financeiro'];
       else
         $assinatura->financeiro = false;

       if(isset($data['ativo']))
        $assinatura->ativo = $data['ativo'];
       else
         $assinatura->ativo = false;

       if(isset($data['envio_email_prazos']))
        $assinatura->envio_email_prazos = $data['envio_email_prazos'];
       else
         $assinatura->envio_email_prazos = false;

      if(isset($data['envio_whatsapp_prazos']))
        $assinatura->envio_whatsapp_prazos = $data['envio_whatsapp_prazos'];
       else
         $assinatura->envio_whatsapp_prazos = false;

      if(isset($data['envio_email_compromissos']))
        $assinatura->envio_email_compromissos = $data['envio_email_compromissos'];
       else
         $assinatura->envio_email_compromissos = false;

       $assinatura->descricao_site = $data['descricao_site'];
       $assinatura->descricao_painel = $data['descricao_painel'];
       $assinatura->link = $data['link'];
       $assinatura->save();

       return redirect()->route('assinaturas.index')->with('success','assinatura criada com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        try {
            $decryptedId = decrypt($id);
        } catch (DecryptException $e) {
            
            return redirect()->route('assinaturas.index');
            exit;
        }


        $assinatura = Assinatura::find($decryptedId);

        if($assinatura){

         return view('admin.assinaturas.show',[
                'assinatura' => $assinatura
            ]);
          
            
        }

        return redirect()->route('assinaturas.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       

         try {
            $decryptedId = decrypt($id);
        } catch (DecryptException $e) {
            
            return redirect()->route('assinaturas.index')->with(['noautorizado'=>'Isso não era para ter acontecido, se o erro persistir entre em contato com o suporte Guia ADV']);
            exit;
        }

        $assinatura = Assinatura::find($decryptedId);

        if($assinatura){

                return view('admin.assinaturas.edit',[
                'assinatura' => $assinatura
                ]);            
        }

        return redirect()->route('assinaturas.index');
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
         try {
            $decryptedId = decrypt($id);
        } catch (DecryptException $e) {
            
            return redirect()->route('assinaturas.index')->with(['noautorizado'=>'Isso não era para ter acontecido, se o erro persistir entre em contato com o suporte Guia ADV']);
            exit;
        }

          $user = User::find(intval(Auth::id()));

          $data = $request->only([

              'tipo',
              'identificador',
              'cupom',
              'valor',
              'qtd_mes_cobranca',
              'qtd_cad_basico',
              'qtd_processos',
              'financeiro',
              'ativo',
              'envio_email_prazos',
              'envio_whatsapp_prazos',
              'envio_email_compromissos',
              'descricao_site',
              'descricao_painel',
              'link',
              'password'

          ]);

          $data['valor'] = number_format(doubleval($data['valor']), 2, '.', '');
         
          $validator = Validator::make($data,[
             'tipo'                       => ['required','string','min:3','max:100'],
             'identificador'              => ['required','string','min:3','max:30'],
             'cupom'                      => ['nullable','string','max:9'],
             'valor'                      => ['required','regex:/^\d+(\.\d{1,2})?$/'],
             'qtd_mes_cobranca'           => ['required','digits_between:1,100'],
             'qtd_cad_basico'             => ['required','digits_between:1,2000'],
             'qtd_processos'              => ['required','digits_between:1,2000'],
             'financeiro'                 => [Rule::in(['1'])],
              'envio_email_prazos'        => [Rule::in(['1'])],
              'envio_whatsapp_prazos'     => [Rule::in(['1'])],
              'ativo'                     => [Rule::in(['1'])],
              'envio_email_compromissos'  => [Rule::in(['1'])],
              'descricao_site'            => ['required','string'],
              'descricao_painel'          => ['required','string','min:3'],
              'link'                      => ['required','string','min:3'],
              'password'                  => ['required','min:3']
         ]);

          if (!Hash::check($data['password'], $user->password)) {
              
              return redirect()->route('assinaturas.index')->with('noautorizado','Senha digitada não confere com a do usuário logado');
          }



         if($validator->fails()){
             return redirect()->route('assinaturas.edit',[
              'assinatura' => $id
             ])->withErrors($validator)
              ->withInput();
         }

         $assinatura = Assinatura::find($decryptedId);

         

         if($assinatura){

             $assinatura->tipo = $data['tipo'];
             $assinatura->identificador = strtoupper($data['identificador']);
             $assinatura->cupom = $data['cupom'];
            
             $assinatura->valor = doubleval($data['valor']);
             $assinatura->qtd_mes_cobranca = intval($data['qtd_mes_cobranca']);
             $assinatura->qtd_cad_basico = intval($data['qtd_cad_basico']);
             $assinatura->qtd_processos = intval($data['qtd_processos']);
             
             if(isset($data['ativo']))
              $assinatura->ativo = $data['ativo'];
             else
               $assinatura->ativo = false;


             if(isset($data['financeiro']))
              $assinatura->financeiro = $data['financeiro'];
             else
               $assinatura->financeiro = false;

             if(isset($data['envio_email_prazos']))
              $assinatura->envio_email_prazos = $data['envio_email_prazos'];
             else
               $assinatura->envio_email_prazos = false;

            if(isset($data['envio_whatsapp_prazos']))
              $assinatura->envio_whatsapp_prazos = $data['envio_whatsapp_prazos'];
             else
               $assinatura->envio_whatsapp_prazos = false;

            if(isset($data['envio_email_compromissos']))
              $assinatura->envio_email_compromissos = $data['envio_email_compromissos'];
             else
               $assinatura->envio_email_compromissos = false;

             $assinatura->descricao_site = $data['descricao_site'];
             $assinatura->descricao_painel = $data['descricao_painel'];
             $assinatura->link = $data['link'];
             $assinatura->save();

             return redirect()->route('assinaturas.index')->with('success','assinatura atualizada com sucesso');
         }

          return redirect()->route('assinaturas.index')->with('noautorizado','Ocorreu um erro ao atualizar essa assinatura');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

      //criar uma verificação pra ver se existe clientes com essa assinatura ativa
      //se existir não deixar apagar

        try {
            $decryptedId = decrypt($id);
        } catch (DecryptException $e) {
            
            return redirect()->route('assinaturas.index');
            exit;
        }

        $usuario = User::find(Auth::id());
        
        $data = $request->only([
          'password'
        ]);

        $validator = Validator::make($data,[
              'password' => ['required','min:3']
         ]);

        if (!Hash::check($data['password'], $usuario->password)) {
              
              return redirect()->route('assinaturas.index')->with('noautorizado','Senha digitada não confere com a do usuário logado');
          }

        $assinatura = Assinatura::find($decryptedId);

        if($assinatura){

            if(!$assinatura->ativo){

             $assinatura->delete();
              return redirect()->route('assinaturas.index')->with(['success'=>'assinatura deletada com sucesso']);
            
            }else{

               return redirect()->route('assinaturas.index')->with(['noautorizado'=>'falha ao deletar']);
            }  
         
        }

        return redirect()->route('assinaturas.index')->with(['noautorizado'=>'falha ao deletar']);
    }
}
