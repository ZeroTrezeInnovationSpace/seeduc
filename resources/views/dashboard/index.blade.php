


@extends('layouts.index') 
@section('content')
<div class="center1">
  <h4 class="display-4"><b>Atividades</h4></b><br>
  <div id="EventInfoTable">
    <p class="lead"> </p><br>
    <p class="lead"> Filtros </p>
    <hr>
    <form method="GET" action="dashboard_activity_search">
    <div class="form-row">
          <input class="form-control col-md-10" type="text" id="search_activity_key" name="search_activity_key" placeholder="Pesquise por nome de atividades..." value="{{ $search_activity_key }}"> &ensp;
          <button type="submit" class="btn btn-info" style="width: 160px; border-radius: 0px 5px 5px 0px;">Pesquisar</button>
    </div>
    </form>
    <hr>
  </div>    
  <div id="EventSelectionTable" >
   <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome Atividade</th>
        <th scope="col">Periodo</th>
        <th scope="col">Capacidade Máxima</th>
        <th scope="col">Total de Inscrições</th>
        <th scope="col">Vagas Disponíveis</th>
        <th scope="col">#</th>
      </tr>
    </thead>
    @forelse($activities as $activity)
       <tr>
        <td scope="row" name="activity_id">{{ $activity->id }}</td>
        <td scope="row" name="activity_name">{{ $activity->name }}</td>
        @if($activity->period == 'trilha')
        <td>8h às 14h</td>
        @elseif($activity->period == 'manhã')
        <td>9h às 11h</td>
        @elseif($activity->period == 'VLImanha')
        <td>8h às 12h</td>
        @elseif($activity->period == 'tarde')
        <td>14h às 16h</td>
        @elseif($activity->period == 'VLItarde')
        <td>13h30 às 17h30</td>
        @elseif($activity->period == 'noite')
        <td>{{$activity->period}}</td>
        @endif
        <td scope="row" name="activity_maximum_capacity">{{ $activity->maximum_capacity }}</td>
        <td scope="row" name="subscriptions_total">10</td>
        <td scope="row" name="subscriptions_total">{{ $activity->maximum_capacity - 20 }}</td>
        <td>
          <form action="subscriptions" method="GET">
              <button type="submit" name="activity_id" value='{{ $activity->id }}' class="btn btn-success">
                Lista de Inscritos
              </button>
          </form>
        </td>
      </tr>
    @empty

    @endforelse
    <tbody>
  </table>
  <div class="pagination justify-content-center">
  {!! $activities->links() !!}
  </div>   
</div>

<button type="button" onclick="location.href='feed'"; class="btn btn-danger" style="width: 150px;">Voltar Painel</button>
@if(session()->has('info')) 
<script type="text/javascript">alert("{{session()->get('info')}}");</script> 
@endif
</div>
</div>  
</div>
@endsection