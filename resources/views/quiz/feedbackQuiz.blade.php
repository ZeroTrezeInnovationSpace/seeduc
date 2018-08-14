@extends('layouts.index') 
@section('content')
<div>
	<br>
	<h4 style="text-align: center;">Sobre o evento:</h4>

	<div class="center1">
		<h5 style="text-align: center;">
			Com vistas ao aprimoramento da próxima Semana da Educação e tendo como parâmetro o atendimento às expectativas da comunidade escolar, solicitamos a gentileza de avaliar os itens abaixo.  Queremos "ouvir" sua opinião
		</h5>
	</div>

	<br>

	<form method="POST" action="{{ route('feedbackquiz') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}"> 

		<h4 style="text-align: center;">O Evento</h4>
		<div class="center1">
			<h6>Como você avalia a divulgação do evento?</h6>
			<select style="width: 40%; height: 30px;" name="A1" id="A1"  required>
				<option ></option>
				<option value="Ruim">Ruim</option>
				<option value="Regular">Regular</option>
				<option value="Bom">Bom</option>
				<option value="Excelente">Excelente</option>
			</select>
			<br><br>

			<h6>E o site da inscrição?</h6>
			<select style="width: 40%; height: 30px;" name="B1" id="B1"  required>
				<option ></option>
				<option value="Ruim">Ruim</option>
				<option value="Regular">Regular</option>
				<option value="Bom">Bom</option>
				<option value="Excelente">Excelente</option>
			</select>
			<br><br>

			<h6>Na sua opinião, os assuntos abordados foram...</h6>
			<select style="width: 40%; height: 30px;" name="C1" id="C1" required >
				<option ></option>
				<option value="Ruim">Ruim</option>
				<option value="Regular">Regular</option>
				<option value="Bom">Bom</option>
				<option value="Excelente">Excelente</option>
			</select>
			<br><br>

			<h6>Quanto à organização geral do evento,você avalia que foi... </h6>
			<select style="width: 40%; height: 30px;" name="D1" id="D1" required>
				<option ></option>
				<option value="Ruim">Ruim</option>
				<option value="Regular">Regular</option>
				<option value="Bom">Bom</option>
				<option value="Excelente">Excelente</option>
			</select>
			<br>
		</div>
		
		<br>

		<h4 style="text-align: center;">Adequações do evento</h4>
		<div class="center1">
			<h6>Local do evento:</h6>
			<select style="width: 40%; height: 30px;" name="A2" id="A2"  required>
				<option ></option>
				<option value="Ruim">Ruim</option>
				<option value="Regular">Regular</option>
				<option value="Bom">Bom</option>
				<option value="Excelente">Excelente</option>
			</select>
			<br><br>

			<h6>Gostaria de deixar algum comentário?</h6>
			<input style=" width: 40%; border: 0px; outline: 0px; background: transparent; border-bottom: 1px solid black; color: green;" type="text" placeholder="Sua Resposta..." name="users_comment" id="users_comment" maxlength="255">
			<br>    
		</div>
		
		<br>

		<h4 style="text-align: center;">Sobre as palestras e demais eventos</h4>
		<div class="center1">
			<h6>Palestra/Oficina:</h6>
			<select style="width: 40%; height: 30px;" onclick="" name="A3" id="A3"  required>
				<option ></option>
				<option value="Ruim">Ruim</option>
				<option value="Regular">Regular</option>
				<option value="Bom">Bom</option>
				<option value="Excelente">Excelente</option>
			</select>
			<br><br>

			<h6>Dê sua opinião sobre a feira do livro "5ª Onda literária"</h6>
			<select style="width: 40%; height: 30px;" name="B3" id="B3"  required>
				<option ></option>
				<option value="Ruim">Ruim</option>
				<option value="Regular">Regular</option>
				<option value="Bom">Bom</option>
				<option value="Excelente">Excelente</option>
			</select>
			<br><br>

			<h6>Se você assinalou Ruim ou Regular, justifique</h6>
			<input style=" width: 40%; border: 0px; outline: 0px; background: transparent; border-bottom: 1px solid black; color: green;" type="text" placeholder="Sua Resposta..." name="justify_B3_answer" id="justify_B3_answer" maxlength="255">
			<br><br>

			<h6>Santos à luz da leitura - Integralidade: o olhar, o pensar, o ser </h6>
			<select style="width: 40%; height: 30px;" name="C3" id="C3"  required>
				<option ></option>
				<option value="Ruim">Ruim</option>
				<option value="Regular">Regular</option>
				<option value="Bom">Bom</option>
				<option value="Excelente">Excelente</option>
			</select>
			<br><br>

			<h6>Se você assinalou Ruim ou Regular, justifique</h6>
			<input style="width: 40%; border: 0px; outline: 0px; background: transparent; border-bottom: 1px solid black; color: green;" type="text" name="justify_C3_answer" placeholder="Sua Resposta..." maxlength="255">
			<br>
		</div>
		
		<br>
		
		<h4 style="text-align: center;">Por fim... Se você quiser</h4>
		<div class="center1">
			<br>
			<h6>Elogie...</h6>
			<input style="width: 40%; border: 0px; outline: 0px; background: transparent; border-bottom: 1px solid black; color: green;" type="text" name="users_praise" id="users_praise" placeholder="Sua Resposta..." maxlength="255">
			<br> <br>
			<h6>Critique...</h6>
			<input style="width: 40%; border: 0px; outline: 0px; background: transparent; border-bottom: 1px solid black; color: green;" type="text" name="users_criticism" id="users_criticism" placeholder="Sua Resposta..." maxlength="255">
			<br> <br>
			<h6>Sugira...</h6>
			<input style="width: 40%; border: 0px; outline: 0px; background: transparent; border-bottom: 1px solid black; color: green;" type="text" name="users_suggestions"  id="users_suggestions" placeholder="Sua Resposta..." maxlength="255">
		</div>
		
		<div class="center1">
			<input  value="{{$activity_id}}" type="hidden" name="activity_id">
			<input class="btn btn-outline-success btn-lg btn-block" value="Finalizar Quiz" type="submit" name="Enviar" id="Enviar">
		</div>
	</form>
</div>
@endsection
