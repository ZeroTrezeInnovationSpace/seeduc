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
        <th scope="col" name="eventDate">Tema</th>
        <th scope="col" name="eventDate">Ementa</th>
        <th scope="col" name="eventDate">Mini Currículo</th>
        <th scope="col" name="eventDate">Público-Alvo</th>
        <th scope="col" name="eventDate">Período</th>
        <th scope="col" name="eventDate">Número de Vagas</th>
        <th scope="col" name="eventDate">Local</th>
        <th scope="col" name="eventDate">#</th>
      </tr>
    </thead>
    <tbody>
      @foreach($activities as $activity)
      <tr>
        <th scope="row" name="period">{{ date('d', strtotime($activity->beginning_date)) }}</th>
        <td>{{$activity->name}}</td>
        <td>{{$activity->description}}</td>
        <td>-</td>
        <td>{{$activity->bond->name}}</td>
        @if($activity->period == 'manhã')
        <td>9h às 11h</td>
        @elseif($activity->period == 'tarde')
        <td>14h às 16h</td>
        @elseif($activity->period == 'noite')
        <td>{{$activity->period}}</td>
        @endif
        <td>{{$activity->maximum_capacity}}</td>
        <td>{{$activity->location->name}} - {{$activity->location->full_adress}} 
          {{$activity->location->adress_number}}</td>
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
  <div class="pagination justify-content-center">
    {!! $activities->links() !!}
  </div>
  <br>
  <button type="button" onclick="location.href='feed'"; class="btn btn-danger" style="width: 150px;">Voltar Painel</button>
</div>

@if(session()->has('sucess'))
<script type="text/javascript">alert("{{session()->get('sucess')}}");</script>
@elseif(session()->has('error'))
<script type="text/javascript">alert("{{session()->get('error')}}");</script>
@endif

@endsection