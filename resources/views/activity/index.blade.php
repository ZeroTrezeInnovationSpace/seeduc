@extends('layouts.index') 
@section('content')

<div class="center1">
  <legend>Eventos Semana da Educação</legend>
  <br>
  <br><br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col" name="eventDate">Data</th>
        <th scope="col" name="eventDate">Evento</th>
        <th scope="col" name="eventDate">Atividade</th>
        <th scope="col" name="eventDate">Descrição</th>
        <th scope="col" name="eventDate">Capacidade</th>
        <th scope="col" name="eventDate">#</th>
      </tr>
    </thead>
    <tbody>
      @foreach($activities as $activity)
      <tr>
        <th scope="row" name="period">{{ date('d/m/Y', strtotime($activity->beginning_date)) }}</th>
        <td>{{$activity->event->name}}</td>
        <td>{{$activity->name}}</td>
        <td>{{$activity->description}}</td>
        <td>{{$activity->maximum_capacity}}</td>
        <td>
         <form method="POST" action="subscribe">
          <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
          <input type="hidden" name="user_id" value="<?php echo($id)?>">
          <input type="hidden" name="activity_id" value="<?php echo($activity->id)?>">
          <button type="submit" class="btn btn-success" style="width: 150px;">Inscrever-se</button>
        </form>
      </td>
    </tr>
    @endforeach        
  </tbody>
</table>
<br>
<button type="button" onclick="location.href='feed'"; class="btn btn-danger" style="width: 150px;">Voltar Painel</button>
</div>

@if(session()->has('sucess'))
<script type="text/javascript">alert("{{session()->get('sucess')}}");</script>
@elseif(session()->has('error'))
<script type="text/javascript">alert("{{session()->get('error')}}");</script>
@endif

@endsection