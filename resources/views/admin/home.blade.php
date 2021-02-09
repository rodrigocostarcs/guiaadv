@extends('adminlte::page')

@section('plugins.Chartjs',true)

@section('title','Painel')


@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1>Dashboard</h1>
        </div>
        
    </div>
    
@endsection

@section('content')
       


     @if($prazosAlert > 0 || $compromissoAlert > 0)

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        
        <script type="text/javascript">
            Swal.fire({
              position: 'top-end',
              icon: 'warning',
              title: 'Você tem {{$prazosAlert}} prazo vencendo amanhã e {{$compromissoAlert}} compromisso vencendo amanhã',
              showConfirmButton: true,
             
            })
        </script>

     @endif

  

    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>R$ @php echo number_format($saldo,2,",","."); @endphp</h3>
                    <p>Caixa</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-check-alt"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>R$ @php echo number_format($totalContasPagar,2,",","."); @endphp</h3>
                    <p>Contas a pagar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-sad-cry"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>R$ @php echo number_format($totalContasReceber,2,",","."); @endphp</h3>
                    <p>Contas a receber</p>
                </div>
                <div class="icon">
                    <i class="fas fa-smile-wink"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>ADV PURPLE</h3>
                    <p>Minha Assinatura - Acesso até 26/01/2021</p>
                </div>
                <div class="icon">
                    <i class="fas fa-rocket"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Prazos</h3>
                </div>
                
                <div class="card-body">
                    <!-- TO DO List -->
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">
                          <i class="ion ion-clipboard mr-1"></i>
                           Próximos a vencer de 
                           @php
                           echo date('d/m/Y', strtotime("-20 days"))." até ".date('d/m/Y', strtotime("+20 days"));
                           @endphp
                        </h3>

                        <div class="card-tools">
                          {{$prazos->links()}}
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <ul class="todo-list" data-widget="todo-list">
                          @forelse($prazos as $prazo)
                          <li>
                            <!-- drag handle -->
                            <span class="handle">
                              <i class="fas fa-ellipsis-v"></i>
                              <i class="fas fa-ellipsis-v"></i>
                            </span>
                            
                            <!-- todo text -->
                            <span class="text"><a href="{{route('processos.show',['processo'=>$prazo->processo_id])}}" target="_blank">{{$prazo->descricao}}</a></span>
                            <!-- Emphasis label -->
                            @if($prazo->status == 'finalizado')
                            <small class="badge badge-success"><i class="far fa-clock"></i>{{\Carbon\Carbon::parse($prazo->data_prazo)->format('d/m/Y')}} - Finalizado</small>
                            @else
                            <small class="badge badge-danger"><i class="far fa-clock"></i>{{\Carbon\Carbon::parse($prazo->data_prazo)->format('d/m/Y')}} - Em aberto</small>
                            @endif

                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                              <i  class="fas fa-edit " title="clique no nome ao lado para ir ao processo"></i>
                              <i class="fas fa-trash-o"></i>
                            </div>
                          </li>
                          @empty
                          Nenhum prazo vencendo no momento
                          @endforelse
                        </ul>
                      </div>
                      <!-- /.card-body -->
                      
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- fim prazos relatório -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Compromissos</h3>
                </div>
                
                <div class="card-body">
                    <!-- TO DO List -->
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">
                          <i class="ion ion-clipboard mr-1"></i>
                           Próximos a vencer de 
                           @php
                           echo date('d/m/Y', strtotime("-20 days"))." até ".date('d/m/Y', strtotime("+20 days"));
                           @endphp
                        </h3>

                        <div class="card-tools">
                          {{$compromissos->links()}}
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <ul class="todo-list" data-widget="todo-list">
                          @forelse($compromissos as $compromisso)
                          <li>
                            <!-- drag handle -->
                            <span class="handle">
                              <i class="fas fa-ellipsis-v"></i>
                              <i class="fas fa-ellipsis-v"></i>
                            </span>
                            
                            <!-- todo text -->
                            <span class="text"><a href="{{route('processos.show',['processo'=>$compromisso->processo_id])}}" target="_blank">{{$compromisso->descricao}}</a></span>
                            <!-- Emphasis label -->
                            @if($compromisso->status == 'F')
                            <small class="badge badge-success"><i class="far fa-clock"></i>{{\Carbon\Carbon::parse($compromisso->data_compromisso)->format('d/m/Y')}} às {{$compromisso->horario_inicio}} até {{$compromisso->horario_fim}} - Finalizado </small>
                            @elseif($compromisso->status == 'A')
                            <small class="badge badge-info"><i class="far fa-clock"></i>{{\Carbon\Carbon::parse($compromisso->data_compromisso)->format('d/m/Y')}} às {{$compromisso->horario_inicio}} até {{$compromisso->horario_fim}} - Aguardando</small>
                            @else
                            <small class="badge badge-warning"><i class="far fa-clock"></i>{{\Carbon\Carbon::parse($compromisso->data_compromisso)->format('d/m/Y')}} às {{$compromisso->horario_inicio}} até {{$compromisso->horario_fim}} - Reagendado</small>
                            @endif

                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                              <i  class="fas fa-edit" title="clique no nome ao lado para ir ao processo"></i>
                              <i class="fas fa-trash-o"></i>
                            </div>
                          </li>
                          @empty
                          Nenhum compromisso agendado até o momento
                          @endforelse
                        </ul>
                      </div>
                      <!-- /.card-body -->
                      
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- fim compromissos relatório-->
    </div>

    <div class="row">
        
        <div class="col-md-6">
            
       

          <!-- PIE CHART -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">
                  Relatório de todos processos (Aberto,em recurso, indeferido, arquivado e deferido) 
                                          @if(isset($dia))
                                          - Você está filtrando os últimos {{$dia}}
                                          @endif
              </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="pagePie" style="height:230px; min-height:230px"></canvas>

              <form action="{{route('admin')}}" class="form-horizontal" method="GET">
                @csrf
                <div class="form-group">
                <label for="">Buscar com data de  encerramento nos últimos..</label>
                <select name="ultimosdiasprocesso" class="form-control" >
                    <option value="1">Último 1 mês</option>
                    <option value="2">Últimos 2 meses</option>
                    <option value="3">Últimos 3 meses</option>
                    <option value="4">Últimos 4 meses</option>
                    <option value="5">Últimos 5 meses</option>
                    <option value="6">Últimos 6 meses</option>
                    <option value="7">Últimos 7 meses</option>
                    <option value="8">Últimos 8 meses</option>
                    <option value="9">Últimos 9 meses</option>
                    <option value="10">Últimos 10 meses</option>
                    <option value="11">Últimos 11 meses</option>
                    <option value="12">Últimos 12 meses</option>
                </select>
                </div><br/><br/>

                <div class="form-group">
                <input type="submit" value="Filtrar" class="btn btn-success btn-block ">
                </div>
              </form>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        
        <div class="col-md-6">
            <!-- BAR CHART -->
        <div class="card card-success">
            <div class="card-header">
            <h3 class="card-title">Contas a pagar x Contas a receber</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
             </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
            </div>
            <div class="card-body">
            <div class="chart">
            <canvas id="barChart" style="height:230px; min-height:230px"></canvas>

            <form action="{{route('admin')}}" class="form-horizontal" method="GET">
              @csrf
              <div class="form-group">
              <label for="">Buscar com data do lançamento nos últimos..</label>
              <select name="ultimasdiasfinanceiro" class="form-control" >
                  <option value="1">Último  1 mês</option>
                  <option value="2">Últimos 2 meses</option>
                  <option value="3">Últimos 3 meses</option>
                  <option value="4">Últimos 4 meses</option>
                  <option value="5">Últimos 5 meses</option>
                  <option value="6">Últimos 6 meses</option>
                  <option value="7">Últimos 7 meses</option>
                  <option value="8">Últimos 8 meses</option>
                  <option value="9">Últimos 9 meses</option>
                  <option value="10">Últimos 10 meses</option>
                  <option value="11">Últimos 11 meses</option>
                  <option value="12">Últimos 12 meses</option>
              </select>
              </div><br/><br/>

              <div class="form-group">
              <input type="submit" value="Filtrar" class="btn btn-success btn-block ">
              </div>
            </form>

            </div>
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
    <!-- ChartJS -->
    <script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/dist/js/demo.js')}}"></script>

    <script>

        window.onload = function(){

            let vs = document.getElementById('pagePie').getContext('2d');

            window.pagePie = new Chart(vs,{
                type:'pie',
                data:{
                    datasets:[{
                        data:{{$pageValues2}},
                        backgroundColor:['rgb(191, 157, 109)', 'rgb(191, 109, 109)', 'rgb(67, 69, 82)','rgb(109, 138, 191)','rgb(143, 191, 109)']
                        
                    }],
                    labels:{!! $pageLabels2 !!}
                },
                options:{
                    responsive:true,
                    legend:{
                        display:false
                    }
                }
            });

            let ctx = document.getElementById('barChart').getContext('2d');
            
            window.barChart = new Chart(ctx,{
                type:'bar',
                data:{
                    datasets:[{
                        data:{{$pageValues}},
                        backgroundColor:['rgb(255, 99, 132)', 'rgb(255, 199, 132)', 'rgb(55, 99, 132)']
                        
                    }],
                    labels:{!! $pageLabels !!}
                },
                options:{
                    responsive:true,
                    legend:{
                        display:false
                    }
                }
            });
            
        }

    </script>

@endsection
