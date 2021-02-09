@extends('adminlte::page')

@section('title','Criar novo processo')

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
          <li class="breadcrumb-item active">cliente</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
      <!-- /.col -->
      <div class="col-md-12">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link" href="#prazos" data-toggle="tab">Despesas e Honorários</a></li>
            </ul>
         
          </div id="app"><!-- /.card-header -->
              <!-- /.tab-pane -->

              <div class="tab-pane" >
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                  <div>
                    <div class="timeline-item">
                      <form method="POST" action="{{route('addcompromisso.save',['id'=>$compromisso->id])}}">
                          @method('PUT')
                          @csrf
                        
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <label for="">Status do compromisso</label>
                              <select name="status"  class="form-control" >
                                <option value="F"  @if($compromisso->status === 'F') selected @endif>Finalizado</option>
                                <option value="A" @if($compromisso->status === 'A') selected @endif>Agendado</option>
                                <option value="R" @if($compromisso->status === 'R') selected @endif>Reagendar</option>
                              </select>
                            </div>
                          </div>
          
                          <div class="form-group row">
                              <div class="col-sm-4">
                                  <label>Consulte o calendário abaixo</label>
                                  <input type="date" class="form-control" name="data_compromisso" value="{{$compromisso->data_compromisso}}">
                              </div>
                          </div>
                          
                          <div class="form-group row">
                              <div class="col-sm-10">
                                  <label for="">Horário de início do compromisso</label>
                                  <input type="time" class="form-control"  value="{{\Carbon\Carbon::parse($compromisso->horario_inicio)->format('H:i')}}" name="horario_inicio">
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-10">
                                <label for="">Horário do fim do compromisso</label>
                                <input type="time" class="form-control" value="{{\Carbon\Carbon::parse($compromisso->horario_fim)->format('H:i')}}" name="horario_fim">
                              </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <label for="">Descrição do compromisso</label>
                              <textarea name="descricao"  cols="30" class="form-control" rows="10">{{$compromisso->descricao}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" class="form-control btn btn-info btn-block" value="Alterar compromisso">
                            </div>
                        </div>

                    </div>
                    </form>
                  </div>
                  <!-- END timeline item -->
                  <div>
                    <i class="far fa-clock bg-gray"></i>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
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
<!-- InputMask -->
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dist/js/demo.js')}}"></script>

</script>

@endsection

