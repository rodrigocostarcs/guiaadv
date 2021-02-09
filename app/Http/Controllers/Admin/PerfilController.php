<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use App\Models\Assinatura;

class PerfilController extends Controller
{	
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$usuario = User::find(intval(Auth::id()));

    	if($usuario){
    	return view('admin.perfil.index',[

    		'user' => $usuario

    		]);
    	}

    	return redirect()->route('admin');
    }

    public function alterarDados(Request $request)
    {   
        $loggedId = intval(Auth::id());
        
    	$user = User::find($loggedId);

    	if($user){

    	    $data = $request->only([
    	        'name',
    	        'email',
    	        'password',
    	        'password_confirmation'
    	    ]);

    	    $validator = Validator::make([
    	        'name' => $data['name'],
    	        'email' => $data['email']
    	    ],
    	    [
    	        'name' => ['required','string','max:100'],
    	        'email' => ['required','string','email','max:100']
    	    ]);

    	    $user->name = $data['name'];

    	    if($user->email != $data['email']){

    	        $hasEmail = User::where('email',$data['email'])->get();

    	        if(count($hasEmail) === 0){
    	            $user->email = $data['email'];
    	        }else{
    	           
    	            $validator->errors()
    	                    ->add('email','E-mail já cadastrado');
    	           
    	        }
    	    }

    	    if(!empty($data['password'])){
    	        
    	        if(strlen($data['password']) >= 4){
    	            if($data['password'] === $data['password_confirmation']){
    	                $user->password = Hash::make($data['password']);
    	            }else{
    	                $validator->errors()
    	                    ->add('password','Campo de senha não são iguais');
    	            }
    	        }else{

    	            $validator->errors()
    	                    ->add('password','Campo de senha precisa ter pelo menos 4 caractéres');
    	        }
    	        
    	        
    	    }
    	    //1. alteração do nome
    	    //2. alteração do e-mail
    	    //2.1 Verifica se já não existe email
    	    // altera a senha
    	    // verifica se a confirmação está ok e altera a senha

    	    if(count( $validator->errors() ) > 0){

    	        return redirect()->route('perfil',[
    	            'user'=>$loggedId
    	        ])->withErrors($validator);
    	    }

    	    $user->save();

    	    return redirect()->route('perfil')->with('success','Informações alteradas com sucesso');

    	}

    	return redirect()->route('perfil')->with('noautorizado','Não foi possível acessar essa página no momento');
    }

    public function perfilAssinatura()
    {
        $usuario = User::find(intval(Auth::id()));

        if($usuario){

        $assinaturas = Assinatura::where('cupom',null)
                                   ->where('ativo',true)
                                   ->paginate(4);

        return view('admin.perfil.assinatura',[

            'user' => $usuario,
            'assinaturas' => $assinaturas

            ]);
        }

        return redirect()->route('admin');
    }
}
