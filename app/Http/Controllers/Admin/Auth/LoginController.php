<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Assinaturauser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/painel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {   
        

        $data = $request->only([
            'email',
            'password'
        ]);

        $validator = $this->validator($data);
        
        //$remember = $request->input('remember',false);

        if($validator->fails()){
            return redirect()->route('login')
                   ->withErrors($validator)
                   ->withInput();
        }

        if(Auth::attempt($data,/*$remember*/)){

            //$premiumUser = auth()->user()->premium;
            
            $assinaturaUser = Assinaturauser::where('user_id',intval(auth()->user()->id))
                                                    ->where('ativo',true)
                                                    ->first();

            $dataAtual = date('Y-m-d');
            
            if(!$assinaturaUser){


            return redirect()->route('perfil.assinatura')
                   ->with('noautorizado','Acesso Premium não localizado, por favor escolha um novo plano e renove para ter acesso a todos módulos.')
                   ->withInput();
            }

            if($assinaturaUser->fim_assinatura < $dataAtual ){

             $assinaturaUser->ativo = false;
             $assinaturaUser->save();

            return redirect()->route('perfil.assinatura')
                   ->with('noautorizado','Acesso Premium vencido, por favor escolha um novo plano e renove para ter acesso a todos módulos.')
                   ->withInput();
            }

            
            return redirect()->route('admin');

        }else{
            $validator->errors()->add('password','E-mail e/ou senha errados');
            return redirect()->route('login')
                   ->withErrors($validator)
                   ->withInput();
        }
    }

    public function logout()
    {   
        
        Auth::logout();
        return redirect()->route('login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data,[
            'email' => ['required','string','email','max:100'],
            'password' => ['required','string','min:4']
        ]);
    }
}
