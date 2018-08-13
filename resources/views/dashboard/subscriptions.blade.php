@extends('layouts.index') 
@section('content')

<div class="center1">
  <h4 class="display-4"><b>Lista de Inscrições</h4></b><br>
  <div id="EventInfoTable">
    <p class="lead"> </p><br>
    <div id="Ingresso" class="col-md-12" style="width: 100%; height: 400px;"></div>
    <p class="lead"> Filtros </p>
    <hr>
    <form method="GET" action="dashboard_users_search">
      <div class="form-row">
        <input class="form-control col-md-10" type="hidden" id="activity_id" name="activity_id" value="{{ $activity_id }}"> &ensp;
        <input class="form-control col-md-10" type="text" id="search_user_key" name="search_user_key" placeholder="Pesquise por nome de usuário..." title="Type in a name" style="border-radius: 5px 0px 0px 5px;" value="{{$search_user_key}}">
        <button type="submit" class="btn btn-info" style="width: 160px; border-radius: 0px 5px 5px 0px;">Pesquisar</button>
      </div>
    </form>
    <hr>
  </div> 
  @if(session()->has('success')) 
  <div class="alert alert-success">{{session()->get('success')}}</div> 
  @elseif(session()->has('error'))
  <div class="alert alert-danger">{{session()->get('error')}}</div>
  @endif   
  <div id="EventSelectionTable" >
   <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">CPF</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Telefone</th>
        <th scope="col">DT. Inscrição</th>
        <th scope="col">#</th>
      </tr>
    </thead>
    <tbody>
      @forelse($subscriptions_relation as $subscription)
      <tr>
        
        <td scope="row" name="user_id">{{ $subscription->user_id }}</td>
        <td scope="row" name="user_cpf">{{ $subscription->CPF }}</td>
        <td scope="row" name="user_name">{{ $subscription->username }}</td>
        <td scope="row" name="user_email">{{ $subscription->email }}</td>
        <td scope="row" name="user_phone">{{ $subscription->phone_number }}</td>
        <td scope="row" name="subscription_created_at">{{ date('d/m/y h:m:s', strtotime($subscription->created_at)) }}</td>
        @if($subscription->check_in == 0)
        <form action="./admin_check_in" method="POST">
          @csrf
          <td>
            <input type="hidden" name="user_id" value='{{ $subscription->user_id }}'>
            <input type="hidden" name="activity_id" value='{{ $activity_id }}'>
            <button type="submit" class="btn btn-success">
              Fazer Check In
            </button>
          </td>
        </form>
        @else
        <td>
            <button type="submit" class="btn btn-success" disabled="true">
              Fazer Check In
            </button>
        </td>
        @endif
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

<button type="button" onclick="location.href='dashboard'"; class="btn btn-danger" style="width: 150px;">Voltar Atividades</button>
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
