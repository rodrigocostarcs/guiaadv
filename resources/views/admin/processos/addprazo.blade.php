@extends('adminlte::page')

@section('title','Criar novo processo')

@section('content_header')
    <h1>Processo 10126</h1> 
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
      <!-- /.col -->
      <div class="col-md-12">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link" href="#prazos" data-toggle="tab">Prazos</a></li>
            </ul>
         
          </div><!-- /.card-header -->
              <!-- /.tab-pane -->
              <div class="tab-pane" id="prazos">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                  <div>
                    <div class="timeline-item">
                      <form method="POST" action="{{route('addprazostore',['id'=>$processo->id])}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <label for="">Data início do Prazo</label>
                                <input type="date" class="form-control" name="data_prazo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <label for="">Observações</label>
                                <input type="text" class="form-control" name="descricao" placeholder="Recurso..">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" class="form-control btn btn-info btn-block" value="lançar novo prazo">
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
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dist/js/demo.js')}}"></script>

@endsection

