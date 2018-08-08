@extends('layouts.register') 

@section('content')
    &nbsp;<a href="/seeduc"><img src="https://marketplace.canva.com/MAB4qEAhS1M/1/thumbnail_large/canva-directional-arrow-icon-MAB4qEAhS1M.png" style="max-width:100px;
max-height:50px;"></a>
<br> &ensp; <font style="color: green;">Voltar</font>
<center>
        <h2 class="display-4 lead" style="margin: 90px;">Verificação de informações cadastrais para redefinição de senha </h2>
        1 - Informar seu CPF e email utilizados no cadastro <br>
                2 - Realizar tentativa de login novamente no sistema de gerenciamento de eventos do SEEDUC. <br> 
                3 - Você será redirecionado(a) para página de redefinição de senha. Informe sua nova senha. <br>
                4 - Salve a nova senha. Através do botão salvar alterações <br> 
                5 - Realize login novamente com a senha definida. <br>
                <br>
</center>
@if( session()->has('error') )
<br><br>
<div class="centerWarning">
        <div class="alert alert-danger" role="alert">
                <p class="alert-link" style="color: red; text-align: center;">{{session()->get('error')}}</p>
        </div>
</div>
@endif

<div class="center1"> 
        <div id="CPFverification">

                <form method="POST" action="{{ route('verify_remember_password') }}">  
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">    
                        <input placeholder="CPF" style="box-shadow: 1px -1px 69px 0px rgba(27, 126, 27, 0.51);" class="form-control" type="text" name="CPF" onkeydown="javascript: fMasc( this, mCPF );" required> <br>
                        <input placeholder="Email informado no cadastro" style="box-shadow: 1px -1px 69px 0px rgba(27, 126, 27, 0.51);" class="form-control" type="email" name="email" required> <br>    
                        <input type="submit" name="rememberPasswordVerification" class="btn btn-success"  value="Redefinir">
                </form>
        </div>  <br>
</div>
<center>
    <div class="alert alert-danger" role="alert">
            <p class="alert-link" style="color: black; text-align: center;"> Informe o CPF e Email informados no momento de seu cadastro </p>
    </div>
</center>


@if(session()->has('success')) 
    <script type="text/javascript">alert("{{session()->get('success')}}");</script> 
@endif

@endsection