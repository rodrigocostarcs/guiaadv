@extends('adminlte::page')

@section('title','Testemunhas')

@section('content_header')
    <h1>Lista de Testemunhas do sistema</h1>
    
    <div class="card-header">
        <a href="{{route('testemunhas.create')}}" class="btn btn-sm btn-success">Cadastrar nova Testemunha</a>
    @if(session('warning'))
        <br/><br/><br/>
        <div class="alert alert-info">
            
            <h5> <i class="icon fas fa-ban"></i>{{session('warning')}}</h5>
        
        </div>

    @endif
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Celular</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @foreach($testemunhas as $testemunha)
                <tbody>
                    <tr>
                        <td>{{$testemunha->nome}}</td>
                        <td>{{$testemunha->email}}</td>
                        <td>{{$testemunha->celular}}</td>
                        <td>
                        <a href="{{route('testemunhas.edit',['testemunha'=>$testemunha->id])}}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{route('testemunhas.show',['testemunha'=>$testemunha->id])}}" class="btn btn-sm btn-info">Relatório</a>
                        <form class="d-inline" method="POST" action="{{route('testemunhas.destroy',['testemunha'=>$testemunha->id])}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                        </td>
                    </tr>
                </tbody>
                @endforeach
           </table>
        </div>
    </div>
   {{$testemunhas->links()}}
@endsection