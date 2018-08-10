@extends('layouts.index') 
@section('content')
<div class="center1">
  <h4 class="display-4"><b>Meu Painel</h4></b><br>
  <div id="EventInfoTable">
    <p class="lead"> </p><br>
      <div id="Ingresso" class="col-md-12" style="width: 100%; height: 300px;"></div>
    <p class="lead"> Filtros </p>
    <hr>
    <form method="GET" action="dashboard_activity_users_search">
    <div class="form-row">
          <input type="hidden" name="_token" value='{{ csrf_token() }}'>
          <input class="form-control col-md-6" type="text" id="search_activity_key" name="search_activity_key" placeholder="Pesquise por nome de atividades..." value="{{ $search_activity_key }}"> &ensp;
          <input class="form-control col-md-4" type="text" id="search_user_key" name="search_user_key" placeholder="Pesquise por nome ou cpf de usuário..." title="Type in a name" style="border-radius: 5px 0px 0px 5px;" value="{{$search_user_key}}">
          <button type="submit" class="btn btn-info" style="width: 100px; border-radius: 0px 5px 5px 0px;">Pesquisar</button>
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
        <th scope="col">Mínimo Quorum</th>
        <th scope="col">Capacidade Máxima</th>
        <th scope="col">Total de Inscrições</th>
        <th scope="col">Vagas Disponíveis</th>
      </tr>
    </thead>
    @forelse($subscriptions_relation as $subscription)
       <tr>
        <td scope="row" name="activity_id">{{ $subscription->activity_id }}</td>
        <td scope="row" name="activity_name">{{ $subscription->activity_name }}</td>
        <td scope="row" name="activity_maximum_capacity">{{ $subscription->activity_maximum_capacity }}</td>
        <td scope="row" name="subscriptions_total">{{ strtotime($subscription->subscriptions_total }}</td>
      </tr>
    @empty

    @endforelse
    <tbody>
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
                Tipo: "Vagas disponíveis",
                Número: <?php echo $total->total ?>
            }, {
                Tipo: "Total de Usuários",
                Número: <?php echo $total->ingressos ?>
            }];
            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "Tipo";
                chart.valueField = "Número";
                chart.outlineColor = "#FFFFFF";
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
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;

                // WRITE
                chart.write("Presenca");
            } );
</script>
@endsection