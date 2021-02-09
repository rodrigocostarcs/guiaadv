@extends('adminlte::page')

@section('title','Criar novo processo')

@section('content_header')
    <h1>Novo Processo</h1> 
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
 
            <p class="text-muted text-center">Dados Gerais do Processo</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                
                <form method="POST" action="{{route('processos.store')}}"  class="form-horizontal">

                @csrf

                <!-- Número do processo -->
                <div class="form-group row">
                    
                    <label for="inputNumero">Número do Processo</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="numero_processo" id="inputNumero" placeholder="Nº Processo">
                    </div>

                </div>

              </li>

              <li class="list-group-item">
                <!-- ÁREA do processo -->
                <div class="form-group row">
                    <label for="inputArea">Área do Processo</label>
                    <div class="col-sm-10">
                        <input type="text" name="area_processo" class="form-control" id="inputArea" placeholder="Administrativo,Comercial...">
                    </div>
                </div>

              </li>

              <li class="list-group-item">
                <!-- ÁREA do processo -->
                <div class="form-group row">
                    <label for="inputAcao">Tipo de Ação</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputAcao" name="tipo_acao" placeholder="Tipo de ação">
                    </div>
                </div>

              </li>

              <li class="list-group-item">
                <!-- ÁREA do processo -->
                <div class="form-group row">
                    <label for="inputValor">Valor da Ação</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputValor" name="valor" placeholder="Valor da Ação">
                    </div>
                </div>

              </li>

              <li class="list-group-item">
                <!-- ÁREA do processo -->
                <div class="form-group row">
                    <label for="inputData">Data de encerramento</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="inputData" name="data_encerramento" placeholder="Data d Encerramento">
                    </div>
                </div>

              </li>

              <li class="list-group-item">
                <!-- ÁREA do processo -->
                <div class="form-group row">
                    <label for="inputObs">Observações</label>
                    <div class="col-sm-10">
                        <textarea name="observacao_processo" id="inputObs" cols="30" rows="10" class="form-control"  placeholder="Observações"></textarea>
                    </div>
                </div>

              </li>

               <li class="list-group-item">
                <!-- ÁREA do processo -->
                <div class="form-group row">
                    <label for="inputNotificacao">Receber Notificação por e-mail dos prazos</label>
                     <div class="col-sm-2">
                      <input type="checkbox" class="form-control" id="inputNotificacao" name="notificacao_email" value="1">
                    </div>
                </div>

              </li>
               
              <li class="list-group-item">
                <!-- ÁREA do processo -->
                <div class="form-group row">
                    <div class="col-sm-12">
                       <input type="submit" class="form-control btn btn-success btn-block" value="iniciar processo">
                    </div>
                </div>

              </li>

            </ul>
          </div>
          <!-- /.card-body -->
          </form>
        </div>
        <!-- /.card -->

      </div>
     
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script type="text/javascript" src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/dist/js/demo.js')}}"></script>

@endsection

