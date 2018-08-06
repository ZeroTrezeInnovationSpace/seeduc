@extends('layouts.register') 

@section('content')
<center>

        <h1 class="display-3 lead" style="margin: 90px;">Alteração de senha </h1>

</center>

<div class="center1"> 
        <div id="CPFverification">
                <form method="POST" action="{{ route('new_password') }}">  
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">    
                        <input type="hidden" name="id" value="{{ $user->id}}" required><br>
                        <input placeholder="CPF" style="box-shadow: 1px -1px 69px 0px rgba(27, 126, 27, 0.51);" class="form-control" type="text" name="CPF" onkeydown="javascript: fMasc( this, mCPF );" value="{{ $user->CPF}}" required readonly><br>
                        <div class="form-row">
                        <div class="col-md-6"> 
                                <input type="password"  class="form-control " name="password" id="password" placeholder="Senha" required>
                        </div>
                        <div class="col-md-6">    
                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Repetir Senha" onblur="verificate()" required>
                        </div>    
                </div> <br>   
                        <input type="submit" name="LoginVerification" class="btn btn-success"  value="Salvar alterações">
                </form>
        </div>  <br>
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