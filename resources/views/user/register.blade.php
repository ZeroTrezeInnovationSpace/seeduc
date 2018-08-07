@extends('layouts.register') 

@section('content')
&nbsp;<a href="/seeduc"><img src="https://marketplace.canva.com/MAB4qEAhS1M/1/thumbnail_large/canva-directional-arrow-icon-MAB4qEAhS1M.png" style="max-width:100px;
max-height:50px;"></a>
<br> &ensp; <font style="color: green;">Voltar</font>
<div class="center1">
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="centerWarning">
		<div class="alert alert-danger" role="alert">
			<p class="alert-link" style="color: black; text-align: center;">Se você é profissional de Educação Física ou da Educação Infantil (professores, gestores e educadores de entidades subvencionadas) e quiser visualizar todas as atividades para este público não esqueça de selecionar o perfil correto no seu cadastro [ Educação Física - Professores ] ou [ Educação Infantil - Gestão - Professor - Educadores e Subvencionadas - SEDUC ]</p>
		</div>
	</div>
	<legend>Cadastro de Usuário</legend> <br>
	<form method="POST" action="{{route('register_user')}}" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}"> 		
		<img class="photo" style="width: 120px; height: 120px;"><br><br>
		<input  type="file" name="image" id="imagem" onchange="previewImagem()"><br><br>
		<div class="form-row">
			<select name="bond_id" class="form-control" class="col-md-11" required="">
				<option>Escolha seu segmento</option>
				@foreach($bonds as $bond)
				<option value="<?php echo($bond->id)?>">{{$bond->name}}</option>
				@endforeach
			</select>
		</div>
		<br>
		<div class="form-row">
			<div class="col-md-6">    
				<input type="text" class="form-control" name="name"  placeholder="Nome Completo" required>
			</div>
			<div class="col-md-6">    
				<input type="text" class="form-control" id="cpf" name="CPF"  placeholder="CPF" required>
			</div>      
		</div>
		<br>
		<div class="form-row">
			<div class="col-md-6">    
				<input type="text" id="register_id" class="form-control" name="register_id"  placeholder="Número de registro" required disabled>
			</div>
			<div class="col-md-6">    
				<input type="text" id="second_register_id" class="form-control" name="second_register_id"  placeholder="2° N° de registro (se possuir)" disabled>
			</div>      
		</div>
		<br>
		<div class="form-row">
			<div class="col-md-6">
				<input type="text" id="telefone" class="form-control" name="phone_number" placeholder="Número do celular" required> <br>
			</div>
			<div class="col-md-6">    
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">
							<input value="1" name="avaible_whatsapp" type="checkbox" aria-label="Checkbox for following text input">	
						</div>
					</div>				                 			                         				
					<input type="text" class="form-control" placeholder="Possuo whatsapp" readonly>
				</div>  
			</div>
		</div>    
		<input type="email" class="form-control" name="email" placeholder="E-mail" required> <br>
		<div class="form-row">
			<div class="col-md-6"> 
				<input type="password"  class="form-control " name="password" id="password" placeholder="Senha" required>
			</div>
			<div class="col-md-6">    
				<input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Repetir Senha" onblur="verificate()" required>
			</div>    
		</div> <br>
		<div class="form-row">
			<div class="col-md-3">    
				<input type="text" class="form-control " name="postal_code" id="zipCode" placeholder="Digite o CEP" onblur="pesquisacep(this.value);" required>
			</div>
			<div class="col-md-9">       
				<input type="text" class="form-control" name="full_adress" id="adress" placeholder="Endereço" required>
			</div>
		</div><br>
		<div class="form-row">
			<div class="col-md-6">   
				<input type="number" class="form-control" name="adress_number" id="number" placeholder="número de sua residencia" required>
			</div>    
			<div class="col-md-6">
				<input type="text" class="form-control" name="adress_complement" placeholder="complemento (caso tenha)">
			</div>    
		</div><br>
		<div class="form-row">
			<div class="col-md-5">    
				<input type="text" class="form-control" name="district" id="district" placeholder="entre com seu bairro" required>
			</div> 
			<div class="col-md-5">   
				<input type="text" class="form-control" name="city" id="city" placeholder="entre com seu cidade" required>
			</div>
			<div class="col-md-2">   
				<input type="text" class="form-control" name="state" id="state" placeholder="UF" required>
			</div>
		</div><br> 

		<input type="text" class="form-control" name="twitter" placeholder="entre com seu twitter" > <br>
		<input type="text" class="form-control" name="linkedin" placeholder="entre com seu linkedln" > <br>
		<input type="text" class="form-control" name="facebook" placeholder="entre com seu facebook" > <br>
		<input type="submit" name="register" class="btn btn-primary" value="Cadastrar">  &nbsp; 	<input type="reset" class="btn btn-danger" value="Limpar ">	<br><br>

	</form>	  
</div>



@endsection