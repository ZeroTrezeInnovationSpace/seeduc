@extends('layouts.register') 

@section('content')

<div class="center1">
  <h4 class="display-4">Cadastro de sala</h4><br>
  <form method="POST" action="{{ route('room_register') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
    <div>
      <label for="RoomDesc" class="lead">Nome:</label>
      <div>
        <input type="text" name="name" class="form-control" id="name" placeholder="ex: Sala 01">
        <br>
        <div>
          <label for="RoomDesc" class="lead">Descrição da sala:</label>
          <div>
            <textarea name="descripition" placeholder="Descrição da sala..." class="form-control" rows="5"></textarea>
          </div><br>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="RoomCapacity" class="lead">Capacidade da sala</label>
              <input type="number" name="capacity" class="form-control" id="capacity" placeholder="N° de pessoas">
            </div>  
            <div class="form-group col-md-6">
              <label for="RoomSeatNumber" class="lead">Número de assentos</label>
              <input type="number" name="avaible_seats" class="form-control" id="avaible_seats" placeholder="N° de assentos">
            </div><br>
          </div>
          <div>
            <label for="EventName" class="lead">Tipo de assentos:</label>
            <div>
              <input type="text" name="seats_type" class="form-control" id="seats_type" placeholder="Tipo de assentos">
            </div>
            <br>
          </div>
          <div class="form-row">
           <div class="input-group col-md-6">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input value="1" name="avaible_video_projector" type="checkbox" aria-label="Checkbox for following text input">
              </div>
            </div>
            <input type="text" class="form-control" type="text" placeholder="Tem projetor" readonly>
          </div> 
          <div class="input-group col-md-6">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input value="1" name="avaible_AC" type="checkbox" aria-label="Checkbox for following text input">
              </div>
            </div>
            <input type="text" class="form-control" type="text" placeholder="Tem ar condicionado" readonly>
          </div>
        </div><br>
        <div class="form-row">
          <div  class="col-md-6">
            <label for="EventTypeRoom" class="lead">Tipo de evento</label>  
            <select class="form-control form-control-lg" name="EventTypeRoom" id="EventType">
              <option value="exemploType1">ExemploTipo1</option>
            </select>
          </div>
          <div  class="col-md-6">
            <label for="EventTypeRoom" class="lead">Local</label>  
            <select class="form-control form-control-lg" name="location_id" id="location_id" required>
              <option default="">Selecione Local</option>
              @foreach($locations as $location)
              <option value="<?php echo($location->id) ?>">{{$location->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-row">
          <input type="submit" name="register" style="margin-top: 30px;" class="btn btn-primary col-md-4" value="Cadastrar"> 
          &nbsp;
          <input type="reset" class="btn btn-primary-danger col-md-4"   style="margin-top: 30px; margin-left: 10px;" value="Limpar"> 
        </div>
      </div>
    </form>
  </div>
  @if(session()->has('sucess'))
  <script type="text/javascript">alert("{{session()->get('sucess')}}");</script>
  @endif
  @endsection