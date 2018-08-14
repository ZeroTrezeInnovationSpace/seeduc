@extends('layouts.register') 

@section('content')
<center>

        <h1 class="display-3 lead" style="margin: 90px;">Bem-Vindo ao SEEDUC</h1>

</center>

<div class="center1"> 
        <div id="CPFverification">
                <form method="POST" action="{{ route('log_in') }}">  
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">    
                        <input placeholder="CPF - Sem pontos ou traços - Ex: 11111111111" style="box-shadow: 1px -1px 69px 0px rgba(27, 126, 27, 0.51);" class="form-control" type="text" name="CPF" onkeydown="javascript: fMasc( this, mCPF );" required> <br>
                        <input placeholder="Senha" style="box-shadow: 1px -1px 69px 0px rgba(27, 126, 27, 0.51);" class="form-control" type="password" name="password" required> <br>    
                        <input type="submit" name="LoginVerification" class="btn btn-success"  value="Começar">
                        <!--<button onclick="alert('O Sistema de Inscrição reabrirá amanhã, dia 07/8, às 8h. Desde já, agradecemos a compreensão de todos e todas.');"; type="button"
                         class="btn btn-success">Começar</button>-->
                </form>
        </div>  <br>
        <!--<button onclick="location.href='register'"; type="button" class="btn btn-secondary">Cadastrar-se</button>-->
        <button onclick="alert('Inscrições encerradas!');" type="button" class="btn btn-secondary">Cadastrar-se</button>
        <button onclick="location.href='remember_password'"; type="button" class="btn btn-secondary">Redefinir Senha</button>
</div>

@if( isset($error) )
<br><br>
<div class="centerWarning">
        <div class="alert alert-danger" role="alert">
                <p class="alert-link" style="color: red; text-align: center;">{{ $error }}</p>
        </div>
</div>
@endif

@if(session()->has('success')) 
    <script type="text/javascript">alert("{{session()->get('success')}}");</script> 
@endif

@endsection