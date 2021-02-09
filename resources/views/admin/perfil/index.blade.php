@extends('adminlte::page')

@section('title','Alterar dados do perfil')

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
          <h3 class="card-title">Meus dados</h3>
    
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form action="{{route('perfil.editar')}}" method="POST" class="form-horizontal">
            
            @method('PUT')
            @csrf
            <div class="form-group">
              <label for="inputName">Nome</label>
              <input type="text" name="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Nome completo">
            </div>
            <div class="form-group">
              <label for="inputDescription">E-mail</label>
              <input type="email" name="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" placeholder="Informe um e-mail">
            </div>
            <div class="form-group">
              <label for="inputStatus">Senha</label>
              <input type="password" name="password"  class="form-control @error('password') is-invalid @enderror" placeholder="Informe uma nova  senha">
            </div>
            <div class="form-group">
              <label for="inputClientCompany">Confirmar senha</label>
              <input type="password" name="password_confirmation"  class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirme sua senha">
            </div>

            <div class="form-group">
              
              <input type="submit" value="Atualizar dados"  class="form-control btn btn-success">
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



@endsection
