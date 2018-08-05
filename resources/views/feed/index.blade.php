@extends('layouts.index') 
@section('content')

<div class="center1">
  <h4 class="display-4">Meu Painel</h4><br>
  <div>
    <div class="form-row">
     <div class="col-md-6"> <button type="button" onclick="location.href='activities'" id="EventSelection" class="btn btn-success">Seleção de eventos</button> </div>
     <div class="col-md-6"> <button type="button" id="MyEvents" onclick="displayView()" class="btn btn-success">Minhas Atividades</button> </div>
   </div>
   <br>    
   <div id="EventSelectionTable" >
     <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Evento</th>
          <th scope="col">Descrição</th>
          <th scope="col">Data de inicio</th>
          <th scope="col">Data de termino</th>
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
        @if($activity->period == 'manhã')
        <td>9h às 11h</td>
        @elseif($activity->period == 'tarde')
        <td>14h às 16h</td>
        @elseif($activity->period == 'noite')
        <td>{{$activity->period}}</td>
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
          <td><button type="button" id="eventFeedback"  class="btn btn-success">Feedback</button></td>
          <td><button type="button" id="eventCertification" class="btn btn-success">Download</button></td>
          @endif
          @endforeach
          @if($subscriber->check_in == '0')
          <td>
            <form method="POST" action="ticket">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="bond_id" value="<?php echo($bond_id)?>">
              <input type="hidden" name="name" value="<?php echo($name)?>">
              <input type="hidden" name="id" value="<?php echo($id)?>">
              <button type="submit" class="btn btn-primary">Gerar Inscrição</button>
            </form>
          </td>
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
          <td><button disabled type="button" class="btn btn-primary">Gerar Inscrição</button></td>
          <td><button disabled type="button" class="btn btn-danger" style="width: 150px;">Cancelar Inscrição</button></td>
          @endif
        </tr>
        @endforeach
        @endforeach 
      </tbody>
    </table>   
    
  </div>
</div>  
</div>
@endsection