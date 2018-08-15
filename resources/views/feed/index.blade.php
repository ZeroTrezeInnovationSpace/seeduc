@extends('layouts.index') 
@section('content')

<div class="center1">
  <div class="row">
    <form method="GET" action="manage_user" style="float: left;">
      <div class="col-md-6">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit"  class="btn btn-danger">Editar Cadastro</button> 
      </div>
    </form>

    @if($id == 1 || $id == 1513 || $id == 4 || $id == 25 || $id == 2064)
    <form method="GET" action="dashboard" style="float: right;">
      <div class="col-md-6">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit"  class="btn btn-info">Gestão de Eventos</button> 
      </div>
    </form>
    @endif

    <!--<form method="GET" action="subscriptions" style="float: right;">
      <div class="col-md-6">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit"  class="btn btn-info">Vagas Disponíveis</button> 
      </div>
    </form>-->
  </div>
  <h4 class="display-4"><b>Meu Painel</h4></b><br>
  <div>
    <div class="form-row">
     <div class="col-md-6"> <button type="button" onclick="location.href='activities'" id="EventSelection" class="btn btn-success">Selecione Atividades</button> </div>
     <div class="col-md-6"> <button type="button" id="MyEvents" onclick="displayView()" class="btn btn-success">Minhas Atividades</button> </div>
   </div>
   <br>    
   <div id="EventSelectionTable" >
     <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Evento</th>
          <th scope="col">Descrição</th>
          <th scope="col">Data de início</th>
          <th scope="col">Data de término</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($events as $event)
        <tr>
          <th scope="row">{{$event->name}}</th>
          <td>{{$event->descripition}}</td>
          <td>{{ date('d/m/Y', strtotime($event->beginning_date)) }}</td>
          <td>{{ date('d/m/Y', strtotime($event->end_date)) }}</td>
          <td><button onclick="location.href='activities'" type="button" id="Event" class="btn btn-success">Inscrições Abertas</button></td>
        </tr>
        @endforeach
      </tbody>
    </table>   
  </div>
  <br>
  
  <div id="EventViewTable"  style="display: none;">
   <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Data</th>
        <th scope="col">Tema</th>
        <th scope="col">Ementa</th>
        <th scope="col">Período</th>
        <th scope="col">Local</th>
        <th scope="col">Check-in</th>
        <th scope="col">Nos de sua opinião</th>
        <th scope="col">Certificação</th>
        <th scope="col">#</th>
      </tr>
    </thead>
    <tbody> 
      @foreach($userActivities as $userActivity)
      <tr>
        @foreach($userActivity->activities as $activity)
        <th scope="row" name="period">{{ date('d', strtotime($activity->beginning_date)) }}</th>
        <td>{{$activity->name}}</td>
        <td>{{$activity->description}}</td>
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
        <td>19h às 22h</td>
        @endif
        <td>{{$activity->location->name}} - {{$activity->location->full_adress}} 
          {{$activity->location->adress_number}}</td>
          @foreach($activity->subscribers as $subscriber)
          @if($subscriber->check_in == '0' && $subscriber->user_id == $id)
          <td><p style="color: red;"> Não Realizado </p></td>
          <td><button type="button" id="eventFeedback"  class="btn btn-success" disabled>Feedback</button></td>
          <td><button type="button" id="eventCertification" class="btn btn-success" disabled>Download</button></td>
          @elseif($subscriber->check_in == '1' && $subscriber->user_id == $id)
          <td><p style="color: green;"> Verificado </p></td>
          @php 
            $feedback = $usersFeedback->where('activity_id',$activity->id)->first();
          @endphp
            @if(isset($feedback->id))
              <td>
                <button type="submit" name="feedback"  class="btn btn-success" disabled="true">Feedback</button>
              </td>
              <td>
                <form method="GET" action="{{ route('certificate') }}">
                  <button type="submit" name='activity_id' value="{{$activity->id}}" class="btn btn-success">Download</button>
                </form>
              </td>
            @else
              <td>
                <form method="GET" action="{{ route('feedback') }}">
                  <input type="hidden" name="activity_id" value="{{$activity->id}}">
                  <button type="submit" name="feedback"  class="btn btn-success">Feedback</button>
                </form>
              </td>
              <td>
                <button type="button" id="eventCertification" class="btn btn-success" disabled="true">Download</button>
              </td>
            @endif
          @endif
          @endforeach
          @if($subscriber->check_in == '0')
          <td>
            <form method="POST" action="unsubscribe">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
              <input type="hidden" name="subscription_id" value="<?php echo($subscriber->id)?>">
              <input type="hidden" name="user_id" value="<?php echo($id)?>">
              <input type="hidden" name="activity_id" value="<?php echo($activity->id)?>">
              <button type="submit" class="btn btn-danger" style="width: 150px;">Cancelar Inscrição</button>
            </form>
          </td>
          @else
          <td><button disabled type="button" class="btn btn-danger" style="width: 150px;">Cancelar Inscrição</button></td>
          @endif
        </tr>
        @endforeach
        @endforeach 
      </tbody>
    </table> 
    <br>
    <button type="button" onclick="location.href='feed'"; class="btn btn-danger" style="width: 150px;">Voltar Painel</button>

    @if(session()->has('info')) 
    <script type="text/javascript">alert("{{session()->get('info')}}");</script> 
    @endif


  </div>
</div>  
</div>
@endsection