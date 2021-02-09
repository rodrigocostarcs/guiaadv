<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Assinaturauser;
use App\Models\Assinatura;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function index()
    {   
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation',
        ]);

        $validator = $this->validator($data);

        if($validator->fails()){
            return redirect()
                    ->route('register')
                    ->withErrors($validator)
                    ->withInput();

        }

        $assinatura = Assinatura::where('identificador','FREE')->first();

        //definindo os 10 dias premium

        if(!$assinatura){

          return redirect()->route('register')->with('noautorizado','No momento não é possível criar uma nova conta desculpe :(. Erro #9387');               
        }

        $premium_begin = date('Y-m-d');
        $premium_end = date('Y-m-d', strtotime("+10 days",strtotime($premium_begin))); 

        $user = $this->create($data);
        $user->save();

        
        
        if(!$user){
          
          return redirect()->route('register')->with('noautorizado','No momento não é possível criar uma nova conta desculpe :(. Erro #9130');             
        }

        $assinatura_user = new Assinaturauser;

        $assinatura_user->assinatura_id = intval($assinatura->id);
        $assinatura_user->inicio_assinatura =  $premium_begin;
        $assinatura_user->fim_assinatura = $premium_end;
        $assinatura_user->ativo = true;
        $assinatura_user->descricao = 'Assinatura teste de 10 dias para novos clientes';
        $assinatura_user->status = 'periodo-teste';
        $assinatura_user->user_id = $user->id;
        $assinatura_user->save();

        if(!$assinatura_user){

          return redirect()->route('register')->with('noautorizado','No momento não é possível criar uma nova conta desculpe :(. Erro #9260');                
        }
        

        Auth::login($user);
        return redirect()->route('admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
