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
              <li class="nav-item"><a class="nav-link" href="#prazos" data-toggle="tab">Adicionar testemunha ao Processo</a></li>
            </ul>
         
          </div><!-- /.card-header -->
              <!-- /.tab-pane -->
              <div class="tab-pane" id="prazos">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                  <div>
                    <div class="timeline-item">
                      <form method="POST" action="{{route('salvartestemunhaprocesso',['id'=>$processo->id])}}">
                          
                          @csrf     
                          <div class="form-group row">
                            @foreach($testemunhas as $testemunha)
                              <div class="col-sm-3">
                                <label for="">{{strtoupper($testemunha->nome)}} <br> CPF: {{$testemunha->cpf}}</label>
                                  <input type="checkbox" class="form-control" id="inputName" name="testemunha_id[]" value="{{$testemunha->id}}">
                              </div>
                              @endforeach
                          </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="submit" class="form-control btn btn-info btn-block" value="Adicione testemunha(s) a este processo">
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
                {{$testemunhas->links()}}
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
