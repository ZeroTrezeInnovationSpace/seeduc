@extends('layouts.index') 
@section('content')

<div class="center1">
  <h4 class="display-4"><b>Meu Painel</h4></b><br>
  <div id="EventInfoTable">
    <p class="lead"> </p><br>
      <div id="Ingresso" class="col-md-12" style="width: 100%; height: 300px;"></div>

    <p class="lead"> Filtros </p>
    <hr>
    <form method="GET" action="search_activity">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-row">
        <div class="col-md-6">
          <label for="PublicSegment" class="lead">Atividade:</label>  
          <input class="form-control col-md-12" type="text" id="search_activity_key" name="search_activity_key" placeholder="Pesquise por Atividades..." title="Pesquise por atividades" value=''>
        </div>
        <div class="col-md-6">
          <label for="PublicSegment" class="lead">Publico:</label>  
          <input class="form-control col-md-12" type="text" id="search_bond_key" name="search_bond_key" placeholder="Pesquise por um tipo de público..." title="Pesquise por um tipo de público"  value=''>
        </div>
      </div>
      <br>
      <center>    
        <button type="submit" class="btn btn-info" style="width: 150px;">Pesquisar</button>
      </center>
    </form>
    <hr>
  </div>    
  <div id="EventSelectionTable" >
   <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Nome Atividade</th>
        <th scope="col">Período Atividade</th>
        <th scope="col">DT. Atividade</th>
        <th scope="col">CPF Inscrito</th>
        <th scope="col">Nome Inscrito</th>
        <th scope="col">DT. Inscrição</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>   
  </div>

<button type="button" onclick="location.href='feed'"; class="btn btn-danger" style="width: 150px;">Voltar Painel</button>
@if(session()->has('info')) 
<script type="text/javascript">alert("{{session()->get('info')}}");</script> 
@endif
</div>
</div>  
</div>
@endsection