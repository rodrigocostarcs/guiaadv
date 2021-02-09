@extends('adminlte::register')

@section('title','Cadastrar')

@section('js')
	@if(session('noautorizado'))
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    Swal.fire({
      position: 'top-end',
      icon: 'info',
      title: '{{session('noautorizado')}}',
      showConfirmButton: true
    })
</script>

@endif
@endsection
