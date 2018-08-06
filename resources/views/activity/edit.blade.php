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
        <th scope="col" name="eventDate">Mini Currículo</th>
        <th scope="col" name="eventDate">Público-Alvo</th>
        <th scope="col" name="eventDate">Período</th>
        <th scope="col" name="eventDate">Número de Vagas</th>
        <th scope="col" name="eventDate">Local</th>
        <th scope="col" name="eventDate">#</th>
      </tr>
    </thead>
    <tbody >
      @foreach($activities as $activity)
      <tr>
        <th scope="row" name="period">{{ date('d', strtotime($activity->beginning_date)) }}</th>
        <td>{{$activity->name}}</td>
        <td style="height: 150px; overflow-y: auto; overflow-x: hidden; display: block;">{{$activity->description}}</td>
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
            <button type="submit" class="btn btn-success" style="width: 150px;">Editar</button>
          </form>
        </td>
        <td>
            <button type="submit" class="btn btn-success" style="width: 150px;">Excluir</button>
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