@extends('layouts.register') 

@section('content')
<div class="center1">

	<form method="POST" action="{{ route('store') }}">

		<legend>Atração</legend>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">  
		<input type="text" name="name" placeholder="Nome da Atração" class="form-control"><br>
		<input type="text" name="type" placeholder="Tipo da Atração" class="form-control"><br>
		<input type="text" name="linkedin" placeholder="Linkedin" class="form-control"><br>
		<input type="text" name="facebook" placeholder="Facebook" class="form-control"><br>				
		<input type="text" name="twitter" placeholder="Twitter" class="form-control"><br>
		<label>Descrição:</label>
		<textarea name="small_desc" class="form-control" rows="5" placeholder="Sua descrição..."></textarea><br>
		<input type="text" name="website" placeholder="Site" class="form-control"><br>				
		

		<input type="submit" name="register" class="btn btn-primary" style="height: 50px; width: 250px; margin-top: 12px;" value="Cadastrar"> 
		&nbsp; 
		<input style="height: 50px; width: 250px; margin-top: 12px;" type="reset" class="btn btn-danger" value="Limpar ">

	</form>

	@if(session()->has('sucess'))
	<script type="text/javascript">alert("{{session()->get('sucess')}}");</script>
	@endif

</div>

@endsection