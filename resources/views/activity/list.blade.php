@extends('layouts.register') 
@section('content')

<div>
  <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col" name="eventDate">Data</th>
        <th scope="col" name="eventDate">Tema</th>
        <th scope="col" name="eventDate">Ementa</th>
        <th scope="col" name="eventDate">Palestrantes</th>
        <th scope="col" name="eventDate">Público-Alvo</th>
        <th scope="col" name="eventDate">Período</th>
        <th scope="col" name="eventDate">Número de Vagas</th>
        <th scope="col" name="eventDate">Local</th>
        <th scope="col" name="eventDate"><center>-</center></th>
        <th scope="col" name="eventDate"><center>-</center></th>
    </tr>
</thead>
<tbody >
  @foreach($activities as $activity)
  <tr>
    <th scope="row" name="period">{{ date('d', strtotime($activity->beginning_date)) }}</th>
    <td>{{$activity->name}}</td>
    <td style="height: 150px; overflow-y: auto; overflow-x: hidden; display: block;">{{$activity->description}}</td>
    <td>{{$activity->description_speaker}}</td>
    <td>{{$activity->bond->name}}</td>
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
    <td>{{$activity->maximum_capacity}}</td>
    <td>{{$activity->location->name}} - {{$activity->location->full_adress}} 
      {{$activity->location->adress_number}}</td>
      <td>
         <form method="GET" action="{{ route('activity_manage') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            <input type="hidden" name="activity_id" value="<?php echo($activity->id)?>">
            <button type="submit" class="btn btn" style="width: 150px;">Editar</button>
        </form>
    </td>
    <td>
        <form method="POST" action="{{ route('delete_activity') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            <input type="hidden" name="activity_id" value="<?php echo($activity->id)?>">
            <button type="submit" class="btn btn-danger" style="width: 150px;">Excluir</button>
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
</div>

@if(session()->has('sucess'))
<script type="text/javascript">alert("{{session()->get('sucess')}}");</script>
@elseif(session()->has('error'))
<script type="text/javascript">alert("{{session()->get('error')}}");</script>
@endif

@endsection