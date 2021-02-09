@extends('adminlte::page')

@section('title','Alterar assinatura')

@section('content_header')
   
@endsection

@section('content')

        @if(session('success'))
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script type="text/javascript">
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: '{{session('success')}}',
              showConfirmButton: true,
          
            })
        </script>
   
        @endif

        @if(session('noautorizado'))
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script type="text/javascript">
            Swal.fire({
              position: 'top-end',
              icon: 'info',
              title: '{{session('noautorizado')}}',
              showConfirmButton: true,
             
            })
        </script>
   
        @endif

        @if($errors->any())
        @foreach($errors->all() as $error)
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script type="text/javascript">
            Swal.fire({
              position: 'top-end',
              icon: 'info',
              title: '{{$error}}',
              showConfirmButton: true,
            
            })
        </script>
        @endforeach 
        @endif


<div class="row">
  <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Alterar assinatura</h3>
    
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form action="{{route('assinaturas.update',['assinatura'=>encrypt($assinatura->id)])}}" method="POST" class="form-horizontal">
            @METHOD('PUT')
            @csrf
            <div class="form-group">
              <label for="inputName" title="Coloque de 3 a 100 caracteres ">Trocar o nome da assinatura</label>
              <textarea name="tipo" class="form-control bodyfield @error('tipo') is-invalid @enderror" placeholder="Nome visual para assinatura">{!! $assinatura->tipo !!}</textarea>
            </div>

            <div class="form-group">
              <label for="inputName" title="se possuir cupom de desconto o mesmo precisa ter 9 dígitos">Possui cupom de desconto?</label>
              <input type="text" name="cupom" value="{{$assinatura->cupom}}" size="9" class="form-control @error('cupom') is-invalid @enderror" placeholder="GUIAADVXX">
            </div>

            <div class="form-group">
              <label for="inputName" title="até 30 letras">Código identificador do sistema</label>
              <input type="text" name="identificador" value="{{$assinatura->identificador}}" size="30" class="form-control @error('cupom') is-invalid @enderror" required placeholder="GUIAADVXXXX">
            </div>

            <div class="form-group">
              <label title="seguindo o padrão [ 120,00] por exempl" for="inputStatus">Valor que será cobrado pela assinatura</label>
              <input type="text" name="valor" value="@php echo number_format($assinatura->valor,2,",","."); @endphp" class="form-control @error('valor') is-invalid @enderror" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" placeholder="120,00">
            </div>

             <div class="form-group">
              <label for="inputDescription">Cobrança da assinatura a cada quanto tempo?</label>
              <input type="number" name="qtd_mes_cobranca" value="{{$assinatura->qtd_mes_cobranca}}" class="form-control @error('qtd_mes_cobranca') is-invalid @enderror" placeholder="informe a cada quantos meses será cobrado por essa assinatura">
            </div>

            <div class="form-group">
              <label for="inputDescription">Quantidade de cadastros básicos que será disponível para essa assinatura</label>
              <input type="number" name="qtd_cad_basico" value="{{$assinatura->qtd_cad_basico}}" class="form-control @error('qtd_cad_basico') is-invalid @enderror" placeholder="Informe a quantidade">
            </div>
            <div class="form-group">
              <label for="inputStatus">Quantidade de processos que será disponível para essa assinatura</label>
              <input type="text" name="qtd_processos" value="{{$assinatura->qtd_processos}}" class="form-control @error('qtd_processos') is-invalid @enderror" placeholder="Informe a quantidade">
            </div>

            <div class="form-group">
              Módulo de financeiro será disponível?
              <input type="checkbox" name="financeiro" value="1" class="form-control @error('financeiro') is-invalid @enderror" @if($assinatura->financeiro) checked @endif >
              Vai ter envio de e-mail dos prazos?
              <input type="checkbox" name="envio_email_prazos" value="1" class="form-control @error('envio_email_prazos') is-invalid @enderror" @if($assinatura->envio_email_prazos) checked @endif>
              Vai ter envio de Whatsapp dos prazos?
              <input type="checkbox" name="envio_whatsapp_prazos" value="1" class="form-control @error('envio_whatsapp_prazos') is-invalid @enderror" @if($assinatura->envio_whatsapp_prazos) checked @endif>
              Vai ter envio de e-mail dos compromissos?
              <input type="checkbox" name="envio_email_compromissos" value="1" class="form-control @error('envio_email_compromissos') is-invalid @enderror" @if($assinatura->envio_email_compromissos) checked @endif>
              <label>Marque para deixar a assinatura ativa</label>
              <input type="checkbox" name="ativo" value="1" class="form-control @error('ativo') is-invalid @enderror" @if($assinatura->ativo) checked @endif>
            </div>

            <div class="form-group">
              <label for="inputStatus">Descrição da assinatura para o site</label>
              <textarea name="descricao_site" class="form-control bodyfield @error('descricao_site') is-invalid @enderror" placeholder="Informe a quantidade">{!! $assinatura->descricao_site !!}</textarea>
            </div>

            <div class="form-group">
              <label for="inputStatus">Descrição da assinatura o painel</label>
              <textarea name="descricao_painel" class="form-control bodyfield @error('descricao_painel') is-invalid @enderror" placeholder="Informe a quantidade">{!! $assinatura->descricao_painel !!}</textarea>
            </div>

            <div class="form-group">
              <label for="inputStatus">Link para o botão de compra</label>
              <textarea name="link" class="form-control  @error('link') is-invalid @enderror" placeholder="Informe a quantidade">{{$assinatura->link}}</textarea>
            </div>

            <div class="form-group">
              <label for="inputClientCompany">Confirmar senha</label>
              <input type="password" name="password"  class="form-control @error('password') is-invalid @enderror" placeholder="por segurança precisamos confirmar sua senha" required>
            </div>

            <div class="form-group">
              
              <input type="submit" value="atualizar assinatura"  class="form-control btn btn-success">
            </div>


          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
</div>

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dist/js/demo.js')}}"></script>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'textarea.bodyfield',
        height:300,
        menubar:false,
        plugins:['link','table','image','autoresize','lists','template'],
        toolbar:'undo redo | formatselect | bold italic backcolor forecolor underline | alignleft aligncenter alignright alignjustify | table | link image | bullist numlist',
        images_upload_credentials:false,
        convert_urls:false
    })
</script>

@endsection
