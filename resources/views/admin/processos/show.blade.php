@extends('adminlte::page')

@section('title','Criar novo processo')

@section('content_header')
    <h1>Processo 10126</h1> 
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#partes" data-toggle="tab">Partes</a></li>
              <li class="nav-item"><a class="nav-link" href="#prazos" data-toggle="tab">Prazos</a></li>
              <li class="nav-item"><a class="nav-link" href="#despesas" data-toggle="tab">Despesas e Honorários</a></li>
              <li class="nav-item"><a class="nav-link" href="#compromissos" data-toggle="tab">Compromissos</a></li>
            </ul>
          </div><!-- /.card-header -->

          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="partes">
                

                <!-- Post Cliente-->
                <div class="post">
                  <div class="user-block">
                    
                    <span class="username">
                      <a href="{{route('addclienteprocesso',['id'=>$processo->id])}}">Clientes</a>
                      <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                    </span>
                    <span class="description">clique no nome a cima e adicione o cliente que vai fazer parte desse processo</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                     <ul>
                      @forelse($clientes as $cliente)
                        <li>
                          <a href="{{route('clientes.show',['cliente'=>encrypt($cliente->id)])}}"  class="btn btn-info">{{$cliente->nome}} faz parte desse processo </a>&nbsp;&nbsp;

                          <form class="d-inline" method="POST" action="{{route('processoclientedeleta',['idCliente'=>$cliente->id,'idProcesso'=>$processo->id])}}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                              @method('DELETE')
                              @csrf
                              <button class="btn btn-danger btn-sm">Remover {{$cliente->nome}} deste processo</button>
                          </form>
                        </li><br/>
                        @empty
                        <li>Nenhum Cliente adicionado a esse processo até o momento</li>
                      @endforelse
                      </ul>
                  </p>
                </div>
                <!-- /.post -->

                
                <!-- Post Cliente-->
                <div class="post">
                    <div class="user-block">
                      
                      <span class="username">
                        <a href="{{route('addtestemunhaeprocesso',['id'=>$processo->id])}}">Testemunhas</a>
                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                      </span>
                      <span class="description">clique no nome a cima e adicione qual quais Testemunhas fazem parte deste processo</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                     <ul>
                        @forelse($testemunhas as $testemunha)
                        <li>
                          <a href="{{route('testemunhas.show',['testemunha'=>$testemunha->id])}}"  class="btn btn-info">{{$testemunha->nome}} faz parte desse processo </a>&nbsp;&nbsp;

                          <form class="d-inline" method="POST" action="{{route('processotestemunhadeleta',['idTestemunha'=>$testemunha->id,'idProcesso'=>$processo->id])}}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                              @method('DELETE')
                              @csrf
                              <button class="btn btn-danger btn-sm">Remover {{$testemunha->nome}} deste processo</button>
                          </form>
                        </li><br/>
                        @empty
                        <li>Nenhuma Testemunha adicionada a esse processo até o momento</li>
                        @endforelse
                      </ul>
                  </p>
                  </div>
                  <!-- /.post -->

                  <!-- Post Cliente-->
                <div class="post">
                    <div class="user-block">
                      
                      <span class="username">
                        <a href="{{route('addcontrarioprocesso',['id'=>$processo->id])}}">Parte Contrária</a>
                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                      </span>
                      <span class="description">clique no nome a cima e adicione qual  a parte contrária do processo</span>
                    </div>
                    <!-- /.user-block -->
                   <p>
                     <ul>
                        @forelse($contrarios as $contrario)
                        <li>
                          <a href="{{route('contrarios.show',['contrario'=>$contrario->id])}}"  class="btn btn-info">{{$contrario->nome}} faz parte desse processo </a>&nbsp;&nbsp;

                          <form class="d-inline" method="POST" action="{{route('processocontrariodeleta',['idContrario'=>$contrario->id,'idProcesso'=>$processo->id])}}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                              @method('DELETE')
                              @csrf
                              <button class="btn btn-danger btn-sm">Remover {{$contrario->nome}} deste processo</button>
                          </form>
                        </li><br/>
                        @empty
                        <li>Não existe parte contrária adicionada a esse processo até o momento</li>
                        @endforelse
                      </ul>
                  </p>
  
                  </div>
                  <!-- /.post -->

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="prazos">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                  <div>
                    <div class="timeline-item">
                        <br/>
                        <a href="{{route('addprazo',['id'=>$processo->id])}}" style="padding-left:30px;">Adicionar um novo prazo</a>
                        <br/>

                        <p>
                          <ul>
                            @forelse($prazos as $prazo)
                            <hr>
                            <li>
                              <strong>Referente:</strong> {{$prazo->descricao}}<br/>
                              
                              <strong>Data do prazo:</strong> {{\Carbon\Carbon::parse($prazo->data_prazo)->format('d/m/Y')}}<br/>
                              
                              <strong>Status:</strong>
                              @if($prazo->status != 'aguardando')
                              <span style="color:green;"> {{$prazo->status}}</span>
                              @else
                              <span style="color:red;"> {{$prazo->status}}</span>
                              @endif
                            </li>

                            @empty
                            Nenhum prazo adicionado a esse processo até o momento
                            @endforelse
                          </ul>
                        </p>

                        {{$prazos->links()}}
                        
                    </div>

                  </div>
                  <!-- END timeline item -->
                  <div>
                    <i class="far fa-clock bg-gray"></i>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->
              <div class="tab-pane" id="despesas">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                  <div>
                    <div class="timeline-item">
                      
                      <br/>
                      <a href="{{route('adddespesa',['id'=>$processo->id])}}" style="padding-left:30px;">Adicionar nova despesa ou honorário</a>
                      <br/>

                      <p>
                        <ul>
                          @forelse($despesas as $despesa)
                          <hr>
                          <li>
                            <strong>Referente:</strong> {{$despesa->descricao}}<br/>
                            
                            <strong>Data da movimentação:</strong> {{\Carbon\Carbon::parse($despesa->data_operacao)->format('d/m/Y')}}<br/>
                            
                            <strong>Essa é uma conta:</strong>
                            @if($despesa->tipo_operacao === 'R')
                            <span style="color:green;">
                            Conta a Receber
                            </span>
                            @else
                            <span style="color:red;">
                            Conta a Pagar
                            </span>
                            @endif<br/>

                            <strong>Status:</strong>
                            @if($despesa->lancar_movimento === 'S')
                            <span style="color:green;">
                            Movimento lançado no financeiro
                            </span>
                            @else
                            <span style="color:red;">
                            Esse movimento não foi lançado automático no financeiro
                            </span>
                            @endif<br/>
                            <a href="{{route('alterardespesa',['id'=>$despesa->id])}}" class="btn btn-warning">Alterar dados</a> |
                            <form class="d-inline" method="POST" action="{{route('despesa.destroy',['id'=>$despesa->id])}}" onsubmit="return confirm('Tem certeza que deseja excluir? Se sim, certifique-se de apagar o lançamento financeiro caso tenha sido feito')">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                          </li>

                          @empty
                          Nenhum movimento de despesa ou honorário adicionado a esse processo até o momento
                          @endforelse
                        </ul>
                      </p>

                    </div>
                  </div>
                  <!-- END timeline item -->
                  <div>
                    <i class="far fa-clock bg-gray"></i>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="compromissos">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                    <div>
                      <div class="timeline-item">
                          <br/>
                        <a href="{{route('addcompromisso',['id'=>$processo->id])}}" style="padding-left:30px;">Adicionar um novo compromisso</a>
                        <br/>

                        <p>
                          <ul>
                            @forelse($compromissos as $compromisso)
                            <hr>
                            <li>
                              <strong>Referente:</strong> {{$compromisso->descricao}}<br/>
                              
                              <strong>Data do compromisso:</strong> {{\Carbon\Carbon::parse($compromisso->data_compromisso)->format('d/m/Y')}}<br/>
                              
                              <strong>Horário do início do compromisso:</strong>
                             
                              <span style="color:green;">
                              {{$compromisso->horario_inicio}}
                              </span><br/>

                              <strong>Horário do fim do compromisso:</strong>
                              <span style="color:red;">
                              {{$compromisso->horario_fim}}
                              </span><br/>

                              <a href="{{route('alterarcompromisso',['id'=>$compromisso->id])}}" class="btn btn-warning">Alterar dados</a> |
                              <form class="d-inline" method="POST" action="{{route('compromisso.destroy',['id'=>$compromisso->id])}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                  @method('DELETE')
                                  @csrf
                                  <button class="btn btn-danger btn-sm">Excluir</button>
                              </form>
                            </li>

                            @empty
                            Nenhum compromisso agendado a esse processo até o momento
                            @endforelse
                          </ul>
                        </p>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                      <i class="far fa-clock bg-gray"></i>
                    </div>
                  </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->

      <div class="col-md-3">
        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">{{$processo->numero_processo}}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
            <strong><i class="far fa-file-alt mr-1"></i>Valor da Ação</strong>
    
            <p class="text-muted">
              <span class="tag tag-danger">R$ {{$processo->valor}}</span>
            </p>

            <strong><i class="far fa-file-alt mr-1"></i>Data de encerramento</strong>

            <p class="text-muted">
              <span class="tag tag-danger">{{\Carbon\Carbon::parse($processo->data_encerramento)->format('d/m/Y')}}</span>
            </p>

            <strong><i class="far fa-file-alt mr-1"></i>Área do Processo e Tipo de ação</strong>

            <p class="text-muted">
              <span class="tag tag-danger">{{$processo->area_processo}} - {{$processo->tipo_acao}}</span>
            </p>

            <strong><i class="far fa-file-alt mr-1"></i>Observações</strong>

            <p class="text-muted">
              <span class="tag tag-danger">{{$processo->observacao_processo}}</span>
            </p>


          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>        
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
<script src="{{asset('assets/dist/js/demo.js')}}"></script>

 @if(session('success'))
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script type="text/javascript">
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: '{{session('success')}}',
              showConfirmButton: false,
              timer: 1500
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
              showConfirmButton: false,
              timer: 1500
            })
        </script>
   
        @endif

@endsection

