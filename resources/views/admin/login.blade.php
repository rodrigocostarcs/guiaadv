@extends('adminlte::login')

@section('title','Acessar sua conta')

@if(session('warning'))
@section('body')

<div class="card-header">
    
    <div class="alert alert-danger">
        <h5> <i class="icon fas fa-ban"></i>{{session('warning')}}</h5>
    <a href="{{route('login')}}">Voltar a Página inicial</a>
    </div>

    </div>

@endsection

@endif