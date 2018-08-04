@extends('layouts.register') 

@section('content')

<div id ="sombra" style="display: block;">
	<div class="center1">
		<legend>Login</legend>

		<div id="formLogin">
			<form method="POST" action="{{ route('log_in') }}"> 
				<input type="hidden" name="_token" value="{{ csrf_token() }}">    
				<input placeholder="CPF" class="form-control" type="text" name="email" required> <br>
				<input placeholder="Senha" class="form-control" type="password" name="senha" required> <br>
				<input type="submit" name="entrar" class="btn btn-primary"  value="Log in"> &nbsp; <input type="reset" class="btn btn-danger" value="Limpar"><br> <br>  
			</form>
		</div>  
		<a href="#" onclick="myFunction()">Criar uma conta</a>
	</div>
	<br> <br>
</div>

<div id="myDIV" style="display: none;">

	<input type="hidden" name="_token" value="">
	<div class="center1">
		<legend>Cadastro de Usuário</legend> <br>
		<select class="form-control form-control-lg" onclick="selectCadastro()" name="typesCadastro" id="typesCadastro">
			<option value="seduc">Professores, gestores e funcionários - SEDUC</option>
			<option value="escola">Escola Total, Tempo Integral e Subvencionadas</option>
			<option value="externo">Público externo</option>
		</select> <br>

		<div id="formCadastroSeduc" style="display: none;">
			<form method="POST" action="{{ route('register') }}">
				<select class="form-control form-control-lg" onclick="test()" name="types" id="types">
					<option value="estatuario">Estatutário</option>
					<option value="celetista">Celetista</option>
					<option value="municipal">Municipal</option>
					<option value="estavel">Estável</option>			            
				</select> <br>  
				<input type="text" class="form-control" name="SeducCPF"  placeholder="Entre com CPF" required> <br>
				<input type="text" class="form-control" name="Seducnome"  placeholder="Nome Completo" required> <br>
				<input type="text" class="form-control" name="Seducregistro"  placeholder="Numero de Registro" required> <br>
				<input type="email" class="form-control" name="Seducemail" placeholder="E-mail" required> <br> 
				<input type="password" class="form-control" name="Seducsenha" placeholder="Senha" required> <br> 
				<input type="submit" name="Seducadastrar" class="btn btn-primary" value="Cadastrar"> &nbsp; <input type="reset" class="btn btn-danger" value="Limpar "><br> <br>
			</form>
		</div>

		<div id="formCadastroExterno" style="display: none;">
			<form method="POST" action="{{ route('register') }}">
				<input type="text" class="form-control" name="Excpf"  placeholder="Entre com CPF" required> <br>
				<input type="text" class="form-control" name="Exnome"  placeholder="Nome Completo" required> <br>
				<input type="email" class="form-control" name="Exemail" placeholder="E-mail" required> <br> 
				<input type="password" class="form-control" name="Exsenha" placeholder="Senha" required> <br> 
				<input type="number" class="form-control" name="Extelefone" placeholder="Numero de telefone" required> <br> 
				<input type="submit" name="Excadastrar" class="btn btn-primary" value="Cadastrar"> &nbsp; <input type="reset" class="btn btn-danger" value="Limpar "><br> <br>
			</form>
		</div>

		<div id="formCadastroEscola" style="display: none;">
			<form method="POST" action="{{ route('register') }}">
				<input type="text" class="form-control" name="Escpf"  placeholder="Entre com CPF" required> <br>
				<input type="text" class="form-control" name="Esnome"  placeholder="Nome Completo" required> <br>
				<input type="email" class="form-control" name="Esmail" placeholder="E-mail" required> <br> 
				<input type="password" class="form-control" name="Esenha" placeholder="Senha" required> <br> 
				<input type="submit" name="Escadastrar" class="btn btn-primary" value="Cadastrar"> &nbsp; <input type="reset" class="btn btn-danger" value="Limpar "><br> <br>
			</form>
		</div>
		<a href="#sombra" onclick="myFunction()">volte para o login</a>
	</div>

</div>

@if( isset($error) )
<br><br>
<div class="centerWarning">
	<div class="alert alert-danger" role="alert">
		<p class="alert-link" style="color: red; text-align: center;">{{ $error }}</p>
	</div>
</div>
@endif

@endsection