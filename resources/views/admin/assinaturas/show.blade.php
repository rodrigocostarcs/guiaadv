@extends('adminlte::page')

@section('title','Relatório da assinatura...')

@section('content')
	 <!-- Default box -->
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">Relatório da assinatura {!! strtoupper($assinatura->tipo) !!}</h3>

         <div class="card-tools">
           <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
             <i class="fas fa-minus"></i></button>
           <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
             <i class="fas fa-times"></i></button>
         </div>
       </div>
       <div class="card-body">
         <div class="row">
           <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
             <div class="row">
               <div class="col-12 col-sm-3">
                 <div class="info-box bg-light">
                   <div class="info-box-content">
                     <span class="info-box-text text-center text-muted">Cobrança a cada</span>
                     <span class="info-box-number text-center text-muted mb-0">{{$assinatura->qtd_mes_cobranca}} mês/meses</span>
                   </div>
                 </div>
               </div>

               
               <div class="col-12 col-sm-3">
                 <div class="info-box bg-light">
                   <div class="info-box-content">
                     <span class="info-box-text text-center text-muted">Valor</span>
                     <span class="info-box-number text-center text-muted mb-0">R$ @php echo number_format($assinatura->valor,2,",","."); @endphp</span>
                   </div>
                 </div>
               </div>

               <div class="col-12 col-sm-3">
                 <div class="info-box bg-light">
                   <div class="info-box-content">
                     <span class="info-box-text text-center text-muted">Quantidade<br/> Cadastro Básico</span>
                     <span class="info-box-number text-center text-muted mb-0">{{$assinatura->qtd_cad_basico}}</span>
                   </div>
                 </div>
               </div>


               <div class="col-12 col-sm-3">
                 <div class="info-box bg-light">
                   <div class="info-box-content">
                    
                     <span class="info-box-text text-center text-muted">Quantidade<br/>  de Processos</span>
                     <span class="info-box-number text-center text-muted mb-0">{{$assinatura->qtd_processos}}<span>

                   </div>
                 </div>
               </div>
             </div>
             <div class="row">
               <div class="col-12">
                 <h4></h4>
                   <div class="post">
                     <div class="user-block">
                       
                       <span class="username">
                         <a  href="{{route('admin')}}">GuiaADV</a>
                       </span>
                       <span class="description">Relatório da assinatura {!! $assinatura->tipo !!}</span>
                     </div>
                     <!-- /.user-block -->
                     <p>
                       <ul>

                          <li>Código Identificador do sistema: {{$assinatura->identificador}}</li>
                           <li>Status da assinatura: @if($assinatura->ativo) Disponível para venda @else Essa assinatura no momento não está disponível para venda @endif</li>
                           <li>Financeiro: @if($assinatura->financeiro) Possui financeiro ativo @else Não possui financeiro @endif</li>
                           <li>Envio de prazos por e-mail: @if($assinatura->envio_email_prazos) Possui envio de prazos por e-mail @else Não possui envio de prazos por e-mail @endif</li>
                           <li>Envio de prazos por Whatsapp: @if($assinatura->envio_whatsapp_prazos) Possui envio de prazos por Whatsapp @else Não possui envio de prazos por Whatsapp @endif</li>
                           <li>Envio de compromissos por E-mail: @if($assinatura->envio_email_compromissos) Possui envio de compromissos por e-mail @else Não possui envio de compromissos por e-mail @endif</li>
                       </ul>
                     </p>
                   </div>

                   <div class="post clearfix">
                     <div class="user-block">
                       <span class="username">
                         <a href="#">Outras Informações</a>
                       </span>
                     </div>
                     <!-- /.user-block -->
                     <p>
                       <ul>
                          
                           <li>CUPOM: {{$assinatura->cupom}}</li>
                           <li>Descrição Painel: {!! $assinatura->descricao_painel !!}</li>
                       </ul>
                     </p>
                     <p>
                       {!! $assinatura->descricao_site !!}
                     </p>
                   </div>

                   <div class="post">
                     <div class="user-block">
                       <span class="username">
                         <a href="#">Link de compra</a>
                       </span>
                     </div>
                     <!-- /.user-block -->
                     <p>
                       {!! $assinatura->link !!}
                     </p>
                   </div>
               </div>
             </div>
           </div>
           <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
        

             <h5 class="mt-5 text-muted">Ao apagar uma assinatura todo registro de clientes cadastrado nessa assinatura será perdido, portanto verfique se antes de apagar uma assinatura existe clientes que fazem parte dessa assinatura.</h5>
             <ul class="list-unstyled">

               <li>
                 <form class="d-inline" method="POST" action="{{route('assinaturas.destroy',['assinatura'=>encrypt($assinatura->id)])}}" id="form">
                     @METHOD('DELETE')
                     @csrf
                     <input type="password" name="password" placeholder="Confirme sua senha para deletar essa assinatura">
                     <button class="btn-link text-danger">Excluir assinatura</button>
                 </form>
               </li>
    
             </ul>
           </div>
         </div>
       </div>
       <!-- /.card-body -->
     </div>
     <!-- /.card -->
@endsection