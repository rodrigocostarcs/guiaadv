<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Cliente;
use App\Models\Contrario;
use App\Models\Financeiro;
use App\Models\Processo;
use App\Models\Testemunha;
use App\Models\Despesa;
use App\Models\Compromisso;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','premium'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

  
    public function financeiros()
    {
        return $this->hasMany(Financeiro::class);
    }

    public function contrarios()
    {
        return $this->hasMany(Contrario::class);
    }

    public function processos()
    {
        return $this->hasMany(Processo::class);
    }

    public function testemunhas()
    {
        return $this->hasMany(Testemunha::class);
    }

   public function despesas()
   {
        return $this->hasMany(Despesa::class,'user_id','id');
   }

   public function compromissos()
   {
        return $this->hasMany(Compromisso::class,'user_id','id');
   }
}
