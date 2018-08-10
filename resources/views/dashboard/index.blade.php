@extends('layouts.index') 
@section('content')

<div class="center1">
  <h4 class="display-4"><b>Lista de Inscrições</h4></b><br>
  <div id="EventInfoTable">
    <p class="lead"> </p><br>
    <div id="Ingresso" class="col-md-12" style="width: 100%; height: 400px;"></div>
    <p class="lead"> Filtros </p>
    <hr>
    <form method="GET" action="dashboard_activity_users_search">
      <div class="form-row">
        <input type="hidden" name="_token" value='{{ csrf_token() }}'>
        <input class="form-control col-md-6" type="text" id="search_activity_key" name="search_activity_key" placeholder="Pesquise por nome de atividades..." value="{{ $search_activity_key }}"> &ensp;
        <input class="form-control col-md-4" type="text" id="search_user_key" name="search_user_key" placeholder="Pesquise por nome de usuário..." title="Type in a name" style="border-radius: 5px 0px 0px 5px;" value="{{$search_user_key}}">
        <button type="submit" class="btn btn-info" style="width: 100px; border-radius: 0px 5px 5px 0px;">Pesquisar</button>
      </div>
    </form>
    <hr>
  </div>    
  <div id="EventSelectionTable" >
   <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Atividade ID</th>
        <th scope="col">Nome Atividade</th>
        <th scope="col">Período Atividade</th>
        <th scope="col">DT. Atividade</th>
        <th scope="col">CPF Inscrito</th>
        <th scope="col">Nome Inscrito</th>
        <th scope="col">DT. Inscrição</th>
      </tr>
    </thead>
    <tbody>
      @forelse($subscriptions_relation as $subscription)
      <tr>
        <td scope="row" name="id"> {{ $subscription->activity_id }}</td>
        <td scope="row" name="activity_name">{{ $subscription->name }}</td>
        @if($subscription->period == 'trilha')
        <td>8h às 14h</td>
        @elseif($subscription->period == 'manhã')
        <td>9h às 11h</td>
        @elseif($subscription->period == 'VLImanha')
        <td>8h às 12h</td>
        @elseif($subscription->period == 'tarde')
        <td>14h às 16h</td>
        @elseif($subscription->period == 'VLItarde')
        <td>13h30 às 17h30</td>
        @elseif($subscription->period == 'noite')
        <td>{{$subscription->period}}</td>
        @endif
        <td scope="row" name="activity_beginning_date">{{ date('d/m/y', strtotime($subscription->beginning_date)) }}</td>
        <td scope="row" name="user_cpf">{{ $subscription->CPF }}</td>
        <td scope="row" name="user_name">{{ $subscription->username }}</td>
        <td scope="row" name="subscription_created_at">{{ date('d/m/y h:m:s', strtotime($subscription->created_at)) }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="12">Nenhum registro encontrado</td>
      </tr>
      @endforelse
    </tbody>
  </table>
  <div class="pagination justify-content-center">
    {!! $subscriptions_relation->links() !!}
  </div>   
</div>

<button type="button" onclick="location.href='feed'"; class="btn btn-danger" style="width: 150px;">Voltar Painel</button>
@if(session()->has('info')) 
<script type="text/javascript">alert("{{session()->get('info')}}");</script> 
@endif
</div>
</div>  
</div>
<script>
  var chart;
  var legend;
  var chartData = [{
    Tipo: "Inscritos",
    Número: <?php echo $subscriptions_total?>
  }, {
    Tipo: "Capacidade",
    Número: <?php echo $tickets_total?>
  }];
  AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "Tipo";
                chart.valueField = "Número";
                chart.outlineColor = "#FFFFFF";
                chart.colorField = "#000000";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;

                // WRITE
                chart.write("Ingresso");
              });
  AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "Presenca";
                chart.valueField = "Pessoas";
                chart.outlineColor = "#08af27";
                chart.colorField = "#000000";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;

                // WRITE
                chart.write("Presenca");
              } );
            </script>
            @endsection