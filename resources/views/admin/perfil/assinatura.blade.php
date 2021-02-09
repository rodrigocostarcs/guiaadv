@extends('adminlte::page')

@section('title','Alterar dados do perfil')

@section('content_header')
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Invoice</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="#">Home</a></li>
           <li class="breadcrumb-item active">Assinatura</li>
         </ol>
       </div>
     </div>
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
                <div class="col-12">
                  <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Aviso:</h5>
                    Fique atento a validade da sua assinatura para que você continue usufruindo dos serviços da plataforma.
                  </div>


                  <!-- Main content -->
                  <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                      <div class="col-12">
                        <h4>
                          <i class="fas fa-globe"></i> GuiaADV.
                          <small class="float-right">Assinatura até: {{\Carbon\Carbon::parse($user->premium)->format('d/m/Y')}}</small>
                        </h4>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                      <div class="col-sm-4 invoice-col">
                        Serviço realizado por 
                        <address>
                          <strong>GuiaADV.</strong><br>
                          Rua Riozinho, Bairro Urupá.<br>
                          Ji-Paraná, RO - 76900274<br>
                          Whatsapp: (69) 993269482<br>
                          Email: suporte@guiaadv.com
                        </address>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 invoice-col">
                         Para
                        <address>
                          <strong>{{$user->name}}</strong><br>
                          795 Folsom Ave, Suite 600<br>
                          San Francisco, CA 94107<br>
                          Telefone: (555) 539-1037<br>
                          Email: {{$user->email}}
                        </address>
                      </div>
                      
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                      <div class="col-12 table-responsive">
                        <table class="table table-striped">
                          <thead>
                          <tr>
                            <th>Quantidade</th>
                            <th>Produto</th>
                            <th>código identificador</th>
                            <th>Descrição</th>
                            <th>Total</th>
                          </tr>
                          </thead>
                          <tbody>

                          <tr>
                            <td>1</td>
                            <td>ADV Blue</td>
                            <td>455-981-221</td>
                            <td>Acesso por 3 meses (até 70 clientes, testemunhas, parte contrária. 50 Processos e financeiro.) </td>
                            <td>R$64,50</td>
                          </tr>
                          
                          </tbody>
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                      <!-- accepted payments column -->
                      <div class="col-6">
                        <p class="lead" style="color:#4c1982;"><strong>ATENÇÃO - Fique atento as Instruções para efetuar a compra da assinatura:</strong></p>
                        
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                         - Ao efetuar a compra utilize o mesmo e-mail que você usa na sua conta aqui na GuiaADV;<br/>
                         - Comprou com e-mail diferente ? Entre em contato conosco por meio de nosso e-mail suporte@guiaadv.com informando o e-mail que você utilizou e o e-mail da sua conta;<br/>
                         - Compra realizada por cartão de crédito tem liberação em até 5 horas, é o prazo que nossa plataforma tem para receber o retorno do Mercado Pago;<br/>
                         - Compra realizada por boleto tem liberação em até 3 dias, é o prazo que nossa plataforma tem para receber o retorno do Mercado Pago;<br/>
                         - Pagou por boleto e precisa de uma liberação urgente? Envie um e-mail para suporte@guiaadv.com com comprovante do pagamento e o e-mail da sua conta, junto com o plano de assinatura que foi pago, vamos analisar e adiantar a liberação para você;<br/>
                         - Comprou e quer cancelar a assinatura? O Prazo de cancelamento é de 7 dias como previsto em lei.
                        </p>
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                          <strong>Art. 49. O consumidor pode desistir do contrato, NO PRAZO DE 7 DIAS a contar de sua assinatura ou do ato de recebimento do produto ou serviço, sempre que a contratação de fornecimento de produtos e serviços ocorrer FORA DO ESTABELECIMENTO COMERCIAL, especialmente por telefone ou a domicílio. Parágrafo único.</strong>
                        </p>
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                          - Precisa de um plano com mais espaço? Entre em contato com nosso suporte por e-mail suporte@guiaadv.com que vamos fazer um plano especial para você <br/>

                        </p>
                      </div>
                      <!-- /.col -->
                      <div class="col-6">
                        <p class="lead">Escolha um de nossos planos de assinatura abaixo. Parcele em até 12x Qualquer plano ou pague no boleto</p>

                        <div class="table-responsive">
                          <table class="table">
                            @forelse($assinaturas as $assinatura)
                            <tr>
                              <th style="width:50%">
                                {!! $assinatura->link !!}
                              </th>
                              <td>R$ @php echo number_format($assinatura->valor,2,",","."); @endphp</td>
                              <td>{!! $assinatura->descricao_painel !!}</td>
                              @empty
                              <p>Não existe nenhuma assinatura ativa até o momento</p>
                            </tr>
                             @endforelse
                          </table>
                          {{$assinaturas->links()}}
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    
                  </div>
                  <!-- /.invoice -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
      </div>
      <!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dist/js/demo.js')}}"></script>

@endsection
