@extends('adminlte::page')

@section('title','Relatório do Cliente')

@section('content')
	 <!-- Default box -->
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">Relatório do Cliente {{strtoupper($cliente->nome)}}</h3>

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
               <div class="col-12 col-sm-4">
                 <div class="info-box bg-light">
                   <div class="info-box-content">
                     <span class="info-box-text text-center text-muted">CPF</span>
                     <span class="info-box-number text-center text-muted mb-0">{{$cliente->cpf}}</span>
                   </div>
                 </div>
               </div>
               <div class="col-12 col-sm-4">
                 <div class="info-box bg-light">
                   <div class="info-box-content">
                     <span class="info-box-text text-center text-muted">RG</span>
                     <span class="info-box-number text-center text-muted mb-0">{{$cliente->rg}}</span>
                   </div>
                 </div>
               </div>
               <div class="col-12 col-sm-4">
                 <div class="info-box bg-light">
                   <div class="info-box-content">
                    
                     <span class="info-box-text text-center text-muted">Data de Nascimento</span>
                     <span class="info-box-number text-center text-muted mb-0">{{\Carbon\Carbon::parse($cliente->nascimento)->format('d/m/Y')}}<span>

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
                         <a  href="#">{{strtoupper($cliente->nome)}}</a>
                       </span>
                       <span class="description">consulte todos processo desse cliente clicando no nome dele</span>
                     </div>
                     <!-- /.user-block -->
                     <p>
                       <ul>
                           <li>Profissão: {{$cliente->profissao}}</li>
                           <li>Estado Civil: {{$cliente->estado_civil}}</li>
                           <li>Pai: {{$cliente->pai}}</li>
                           <li>Mãe: {{$cliente->mae}}</li>
                       </ul>
                     </p>
                     <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i>Problema? Altere os dados agora mesmo.</a>
                   </div>

                   <div class="post clearfix">
                     <div class="user-block">
                       <span class="username">
                         <a href="#">Contato</a>
                       </span>
                       <span class="description">Informações de Contato</span>
                     </div>
                     <!-- /.user-block -->
                     <p>
                       <ul>
                          
                           <li>Celular Civil: {{$cliente->celular}}</li>
                           <li>E-mail: {{$cliente->email}}</li>
                       </ul>
                     </p>
                     <p>
                       <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i>Problema? Altere os dados agora mesmo.</a>
                     </p>
                   </div>

                   <div class="post">
                     <div class="user-block">
                       <span class="username">
                         <a href="#">Endereço</a>
                       </span>
                       <span class="description">Informações de Endereço</span>
                     </div>
                     <!-- /.user-block -->
                     <p>
                       <li>CEP: {{$cliente->cep}}</li>
                       <li>Logradouro: {{$cliente->logradouro}}</li>
                       <li>Nº: {{$cliente->n_casa}}</li>
                       <li>Bairro: {{$cliente->bairro}}</li>
                       <li>Complemento: {{$cliente->complemento}}</li>
                       <li>Cidade: {{$cliente->cidade}}</li>
                       <li>Estado: {{$cliente->estado}}</li>
                     </p>

                     <p>
                       <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i>Problema? Altere os dados agora mesmo.</a>
                     </p>
                   </div>
               </div>
             </div>
           </div>
           <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
             
             <div class="text-muted">
               <p class="text-sm">Empresa
                 <b class="d-block">- Razão Social: {{$cliente->razao_social}}</b>
                 <b class="d-block">- Responsável pela empresa: {{$cliente-> responsavel}}</b>
                 <b class="d-block">- CNPJ: {{$cliente-> cnpj}}</b>
                 <b class="d-block">- Inscrição Estadual: {{$cliente->inscricao_estadual}}</b>
               </p>
               <p class="text-sm">Observações
                 <b class="d-block">{{$cliente->observacao}}</b>
               </p>
             </div>

             <h5 class="mt-5 text-muted">Consultas Rápidas</h5>
             <ul class="list-unstyled">

               <li>
                 <i class="far fa-fw fa-folder-open"></i> Consultar processos que o cliente faz parte
               </li>
               @forelse($processos as $processo)
               <hr>
               <li>
                 <a href="{{route('processos.show',['processo'=>$processo->id])}}">
                  Nº Processo: {{$processo->numero_processo}}<br/>
                  Status do processo: {{$processo->status_processo}}<br/>
                  Data de encerramento: {{\Carbon\Carbon::parse($processo->data_encerramento)->format('d/m/Y')}}
                 </a>
               </li>
               @empty
               <li>
                 Até o momento o cliente não faz parte de nenhum processo
               </li>
               @endforelse

               {{$processos->links()}}
               <hr>



               <li>
                 <form class="d-inline" method="POST" action="" id="form">
                    
                     <input type="hidden" name="id" value="{{encrypt($cliente->id)}}">
                     @csrf
                     <button class="btn-link text-danger">Excluir cliente</button>
                 </form>
               </li>
    
             </ul>
           </div>
         </div>
       </div>
       <!-- /.card-body -->
     </div>
     <!-- /.card -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#form').bind('submit',function(e){
       
        e.preventDefault();
         
        var txt = $(this).serialize();
        
        
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: true
        })

        swalWithBootstrapButtons.fire({
          title: 'Deseja excluir realmente este cliente?',
          text: "Lembre-se que é impossível reverter essa ação!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sim deletar',
          cancelButtonText: 'Não deletar',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
            $.ajax({
            type:'POST',
            url:"{!! URL::to('painel/deletar/cliente') !!}",
            data:txt,
            success:function(data){

            swalWithBootstrapButtons.fire(
              'Cliente deletado!',
              'todos dados do cliente foi apagado com sucesso.',
              'success'
            )
                  
             window.location.href = "/painel/clientes";

                },
                error:function(){
                  alert('Não foi possível deletar cliente, se o erro persistir contate o suporte Guia ADV');
                  window.location.href = "/painel/clientes";

                },
             });
            
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'Ufa! ação cancelada com sucesso :)',
              'error'
            )
          }
        })

    });

</script>
@endsection