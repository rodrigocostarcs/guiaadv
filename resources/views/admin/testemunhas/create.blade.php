@extends('adminlte::page')

@section('title','Nova Testemunha')

@section('content_header')
    <h1>Novo Cliente</h1> 
@endsection

@section('content')

        
        <div class="card">
            @if($errors->any())
            <div class="card-header">
                
            <div class="alert alert-danger">
                <ul>
                    
                    <h5> <i class="icon fas fa-ban"></i> Ocorreu um erro</h5>
                    @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                     @endforeach 
                </ul> 
            </div>
       
            </div>
            @endif
            <div class="card-body">

            <form action="{{route('testemunhas.store')}}" method="POST" class="form-horizontal">
                    @csrf
                   
                    <!-- nome-->
                    
                    <h3>Dados Pessoa Física</h3>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nome Completo <span style="color:red;">*</span></label>
                            <div class="col-sm-10">
                            <input type="text" name="nome" value="{{old('nome')}}" class="form-control @error('nome') is-invalid @enderror" placeholder="nome completo da testemunha">
                            </div>
                    </div>

                     <!-- cpf-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">CPF</label>
                            <div class="col-sm-10">
                            <input type="text" name="cpf" value="{{old('cpf')}}" class="form-control @error('cpf') is-invalid @enderror">
                            </div>
                    </div>

                     <!-- nascimento-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Data de Nascimento</label>
                            <div class="col-sm-10">
                            <input type="date" name="nascimento" value="{{old('nascimento')}}" class="form-control @error('nascimento') is-invalid @enderror">
                            </div>
                    </div>

                     <!--rg-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">RG</label>
                            <div class="col-sm-10">
                            <input type="text" name="rg" value="{{old('rg')}}" class="form-control @error('rg') is-invalid @enderror">
                            </div>
                    </div>


                     <!--profissao-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Profissão</label>
                            <div class="col-sm-10">
                            <input type="text" name="profissao" value="{{old('profissao')}}" class="form-control @error('profissao') is-invalid @enderror">
                            </div>
                    </div>

                     <!--estado_civil-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Estado Civil</label>
                            <div class="col-sm-10">
                            <input type="text" name="estado_civil" value="{{old('estado_civil')}}" class="form-control @error('estado_civil') is-invalid @enderror">
                            </div>
                    </div>

                    <h3>Informações de Contato</h3>
                      <!--celular-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Celular<span style="color:red;">*</span></label>
                            <div class="col-sm-10">
                            <input type="text" name="celular" value="{{old('celular')}}" class="form-control @error('celular') is-invalid @enderror" placeholder="informar celular para contato">
                            </div>
                    </div>
                      <!--telefone-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Telefone</label>
                            <div class="col-sm-10">
                            <input type="text" name="telefone" value="{{old('telefone')}}" class="form-control @error('telefone') is-invalid @enderror">
                            </div>
                    </div>

                    <!-- email-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">E-mail <span style="color:red;"> *</span></label>
                        <div class="col-sm-10">
                            <input value="{{old('email')}}" type="email" name="email" class="@error('email') is-invalid @enderror form-control">
                        </div>
                    </div>
                    <h3>Informações de Endereço</h3>
                     <!--cep-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">CEP</label>
                            <div class="col-sm-10">
                            <input type="text" name="cep" value="{{old('cep')}}" class="form-control @error('cep') is-invalid @enderror">
                            </div>
                    </div>

                     <!--logradouro-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Logradouro</label>
                            <div class="col-sm-10">
                            <input type="text" name="logradouro" value="{{old('logradouro')}}" class="form-control @error('logradouro') is-invalid @enderror" placeholder="informar o endereço">
                            </div>
                    </div>

                     <!--número da casa-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Nº</label>
                            <div class="col-sm-10">
                            <input type="text" name="n_casa" value="{{old('n_casa')}}" class="form-control @error('n_casa') is-invalid @enderror">
                            </div>
                    </div>
                    
                    
                     <!--bairro-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Bairro</label>
                            <div class="col-sm-10">
                            <input type="text" name="bairro" value="{{old('bairro')}}" class="form-control @error('bairro') is-invalid @enderror">
                            </div>
                    </div>
                     <!--complemento-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">complemento</label>
                            <div class="col-sm-10">
                            <input type="text" name="complemento" value="{{old('complemento')}}" class="form-control @error('complemento') is-invalid @enderror">
                            </div>
                    </div>
                     <!--cidade-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Cidade</label>
                            <div class="col-sm-10">
                            <input type="text" name="cidade" value="{{old('cidade')}}" class="form-control @error('cidade') is-invalid @enderror">
                            </div>
                    </div>
                     <!--estado-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Estado</label>
                            <div class="col-sm-10">
                            <input type="text" name="estado" value="{{old('estado')}}" class="form-control @error('estado') is-invalid @enderror">
                            </div>
                    </div>
                    <h3>Observações</h3>
                    <!--obss-->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Observação</label>
                            <div class="col-sm-10">
                            
                            <textarea name="observacao" value="{{old('observacao')}}" class="form-control @error('observacao') is-invalid @enderror">
                                
                            </textarea>
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="submit" value="Cadastrar" class="btn btn-success">
                        </div>
                    </div>
        
               </form>
            </div>
        </div>
@endsection

