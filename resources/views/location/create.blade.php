@extends('layouts.register') 

@section('content')

<div class="center1">

	<form method="POST" action="{{ route('location_register') }}">
		
		<legend>Local</legend>

		<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
		<input type="text" name="name" placeholder="Nome do Local" class="form-control" required><br>
		<input type="text" name="full_adress" placeholder="Endereço" class="form-control" required><br>
		
		
		<div class="form-row">

			<div class="form-group col-md-6">
				<input type="number" name="adress_number" placeholder="Nº" class="form-control" required> 
			</div>

			<div class="form-group col-md-6">
				<input type="text" name="adress_complement" placeholder="Complemento" class="form-control">
			</div>

		</div>

		<div class="form-row">

			<div class="form-group col-md-4">
				<input type="text" name="postal_code" placeholder="CEP" class="form-control" onkeydown="javascript: fMasc( this, mCEP );" required>
			</div>

			<div class="form-group col-md-6">
				<input type="text" name="city" placeholder="Cidade" class="form-control" required>
			</div>

			<div  class="form-group col-md-2">	
				<input type="text" name="state" placeholder="UF" class="form-control" required>
			</div>
		</div>
		<input type="text" name="district" placeholder="Bairro" class="form-control" required>
		<br>			
		<input type="text" name="reference_point" placeholder="Ponto de Referência" class="form-control"><br>

		<div class="form-row">

			<div class="form-group col-md-6">
				<label for="func">Dias de Funcionamento</label>
				<input type="text" name="work_days" class="form-control" id="func" placeholder="seg, terça, quarta, quinta...">
			</div>

			<div  class="form-group col-md-3">
				<label for="open">Abertura</label>
				<input type="time" name="open_hours" placeholder="Horário" class="form-control" id="open">
			</div>
			<div  class="form-group col-md-3">	
				<label for="enc">Fechamento</label>
				<input type="time" name="Close_hour" placeholder="Horário" class="form-control" id="enc">
			</div>
		</div>


		<input type="text" name="manager_name" placeholder="Nome do Responsável Técnico" class="form-control"><br>
		<input type="number" name="manager_phone_number" placeholder="telefone do Responsável Técnico" class="form-control"><br>
		<input type="email" name="manager_email" placeholder="email do Responsável Técnico" class="form-control"><br>


		<input type="submit" name="register" class="btn btn-primary" style="height: 50px; width: 250px;" value="Cadastrar">
		&nbsp;
		<input style="height: 50px; width: 250px;" type="reset" class="btn btn-danger" value="Limpar ">


	</form>
	
</div>
@if(session()->has('sucess'))
<script type="text/javascript">alert("{{session()->get('sucess')}}");</script>
@endif


@endsection