@extends('adminlte::page')

@section('title','Novo Cliente')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                
                <h5> <i class="icon fas fa-ban"></i> Ocorreu um erro</h5>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                 @endforeach 
            </ul> 
        </div>
        @endif
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
              
          </li>
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">Lista de Clientes</li>
          <li class="breadcrumb-item active">Novo Cliente</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row">
<div class="col-md-4">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Dados Pessoa Física</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
       <!-- Formulário -->
        <form action="{{route('clientes.store')}}" method="POST" class="form-horizontal">
            @csrf

        <div class="form-group">
            <label for="inputName">Nome <span style="color:red;"> *</span></label>
            <input type="text" id="inputName" name="nome" value="{{old('nome')}}" class="form-control">
        </div>

        <div class="form-group">
            <label for="inputName">CPF</label>
            <input type="text" name="cpf" value="{{old('cpf')}}" class="form-control @error('cpf') is-invalid @enderror">
        </div>

        <div class="form-group">
            <label for="inputName">Data de Nascimento</label>
            <input type="date" name="nascimento" value="{{old('nascimento')}}" class="form-control @error('nascimento') is-invalid @enderror">
        </div>

        <div class="form-group">
            <label for="inputName">RG</label>
            <input type="text" name="rg" value="{{old('rg')}}" class="form-control @error('rg') is-invalid @enderror">
        </div>

        <div class="form-group">
            <label for="inputName">Profissão</label>
            <input type="text" name="profissao" value="{{old('profissao')}}" class="form-control @error('profissao') is-invalid @enderror">
        </div>

        <div class="form-group">
            <label for="inputName">Pai</label>
            <input type="text" name="pai" value="{{old('pai')}}" class="form-control @error('pai') is-invalid @enderror">
        </div>
       
        <div class="form-group">
            <label for="inputName">Mãe</label>
            <input type="text" name="mae" value="{{old('mae')}}" class="form-control @error('mae') is-invalid @enderror">
        </div>
      
      <div class="form-group">
        <label for="inputStatus">Estado Civil</label>
        <select class="form-control custom-select" name="estado_civil">
          <option selected disabled>estado civil</option>
          <option value="Solteiro">Solteiro</option>
          <option value="Casado">Casado</option>
          <option value="Divorciado">Divorciado</option>
          <option value="Divorciado">Viúvo</option>
        </select>
      </div>

      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<div class="col-md-4">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Dados Pessoa Júridica</h3>
  
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="inputName">Razão Social</label>
          <input type="text" name="razao_social" value="{{old('razao_social')}}" class="form-control @error('razao_social') is-invalid @enderror" placeholder="Razão social caso o cliente seja empresa">
        </div>
        <div class="form-group">
          <label for="inputDescription">Responsável</label>
          <input type="text" name="responsavel" value="{{old('responsavel')}}" class="form-control @error('responsavel') is-invalid @enderror" placeholder="responsável pela empresa">
        </div>
        <div class="form-group">
          <label for="inputStatus">CNPJ</label>
          <input type="text" name="cnpj" value="{{old('cnpj')}}" class="form-control @error('cnpj') is-invalid @enderror" placeholder="CNPJ caso o cliente seja empresa">
        </div>
        <div class="form-group">
          <label for="inputClientCompany">Inscrição Estadual</label>
          <input type="text" name="inscricao_estadual" value="{{old('inscricao_estadual')}}" class="form-control @error('inscricao_estadual') is-invalid @enderror" placeholder="Inscrição Estadual caso o cliente seja empresa">
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

<div class="col-md-4">
  <div class="card card-secondary">
    <div class="card-header">
      <h3 class="card-title">Informações de Contato</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
     
      <div class="form-group">
        <label for="inputEstimatedBudget">Celular</label>
        <input type="text" name="celular" value="{{old('celular')}}" class="form-control @error('telefone') is-invalid @enderror">
      </div>
      <div class="form-group">
        <label for="inputSpentBudget">E-mail <span style="color:red;"> *</span></label>
        <input value="{{old('email')}}" type="email" name="email" class="@error('email') is-invalid @enderror form-control">
      </div>
      <div class="form-group">
        <label for="inputEstimatedDuration">CEP - Informe o CEP para consulta</label>
        <input type="text" name="cep" id="cep" value="{{old('cep')}}" class="form-control @error('cep') is-invalid @enderror"  onblur="pesquisacep(this.value);">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Bairro</label>
        <input type="text" name="bairro" value="{{old('bairro')}}" class="form-control @error('logradouro') is-invalid @enderror" id="bairro" placeholder="informar o endereço">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Logradouro</label>
        <input type="text" name="logradouro" value="{{old('logradouro')}}" class="form-control @error('logradouro') is-invalid @enderror"  id="rua" placeholder="informar o endereço">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Nº</label>
        <input type="text" name="n_casa" value="{{old('n_casa')}}" class="form-control @error('n_casa') is-invalid @enderror">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Cidade</label>
        <input type="text" name="cidade" id="cidade" value="{{old('cidade')}}" class="form-control @error('cidade') is-invalid @enderror">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Estado</label>
        <input type="text" name="estado" id="uf" value="{{old('estado')}}" class="form-control @error('estado') is-invalid @enderror">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">complemento</label>
        <input type="text" name="complemento" value="{{old('complemento')}}" class="form-control @error('complemento') is-invalid @enderror">
      </div>

      <div class="form-group">
        <label for="inputEstimatedDuration">Observação</label>
        <textarea id="inputDescription" class="form-control @error('observacao') is-invalid @enderror" name="observacao" rows="4">{{old('observacao')}}</textarea>
      </div>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
</div>
<div class="row">
<div class="col-12">
  <input type="submit" value="Salvar" class="btn btn-success btn-block float-right">
</div>
</form>
</div>

<!-- Adicionando Javascript -->
    <script type="text/javascript" >
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";


                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>
@endsection

