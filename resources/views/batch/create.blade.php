@extends('layouts.register') 

@section('content')
<div class="center1">

	<form method="" action="">

		<legend>Lote</legend>

		
		<input type="text" name="name" placeholder="Nome do Lote" class="form-control"><br>	


		<div class="form-row">				

			<div class="form-group col-md-3">
				<label for="func">Incicio</label>
				<input type="number" name="horaInicio" placeholder="Horário" class="form-control">
			</div>

			<div class="form-group col-md-3">
				<label for="func">Encerramento</label>
				<input type="number" name="horaEncerramento" placeholder="Horário" class="form-control">
			</div>

			<div class="form-group col-md-3">
				<label for="func">Início</label>
				<input type="date" placeholder="00/00/0000" class="form-control">
			</div>

			<div class="form-group col-md-3">
				<label for="func">Encerramento</label>
				<input type="date" name="dataEncerramento" placeholder="00/00/0000" class="form-control">
			</div>

		</div>

		<div class="form-row">

			<div class="form-group col-md-3">
				<label for="func">Ingresso</label>
				<input type="number" name="ingressoMaxima" placeholder="Qtd.Mínima" class="form-control">
			</div>

			<div class="form-group col-md-3">
				<label for="func">Ingresso</label>
				<input type="number" name="ingressoMinima" placeholder="Qtd.Máxima" class="form-control">
			</div>

		</div>


		<input type="submit" name="Excadastrar" class="btn btn-primary" style="height: 50px; width: 250px; margin-top: 12px;" value="Cadastrar"> &nbsp; <input style="height: 50px; width: 250px; margin-top: 12px;" type="reset" class="btn btn-danger" value="Limpar ">


	</form>

</div>

@endsection