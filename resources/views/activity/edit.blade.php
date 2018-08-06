@extends('layouts.register') 
@section('content')

<div class="center1">
    <h4 class="display-4">Alterar Atividade</h4><br>
    <div>
        <div>
            <form method="POST" action="{{route('activities_save')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="EventSelection" class="lead">Selecione o evento:</label>  
                <select class="form-control form-control-md" name="event_id" id="EventSelection">
                    @foreach($events as $event)
                    <option value="<?php echo($event->id) ?>">{{$event->name}}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="form-row">
             <div class="col-md-6">
                <label for="EventSelection" class="lead">Selecione o periodo:</label> 
                <select class="form-control form-control-md" name="period" id="EventPeriod"  required>
                    <option value="NULL"></option>
                    <option value="manhã">Manhã</option>
                    <option value="tarde">Tarde</option>
                    <option value="noite">Noite</option>
                </select>
            </div>
            <div  class="col-md-6">
                <label for="EventSelection" class="lead">Selecione o dia:</label>  
                <input type="date" class="form-control form-control-md" name="beginning_date" id="EventDay"  required>
            </div>
        </div>
        <br>    
        <div>
            <label class="lead">Entre com o nome da atividade</label>
            <input type="text" class="form-control" placeholder="nome da atividade" name="name" required>
        </div>
        <div>
            <label class="lead">Entre com a descrição da atividade</label>
            <textarea name="description" placeholder="Descrição da atividade..." class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label for="LocationSelection" class="lead">Selecione o local:</label>  
                <select class="form-control form-control-md" name="location_id" id="EventPeriod" required>
                    <option value=""></option>
                    @foreach($locations as $location)
                    <option value="<?php echo($location->id) ?>">{{$location->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="RoomSelection" class="lead">Selecione a sala:</label>  
                <select class="form-control form-control-md" name="room" id="EventPeriod" required>
                    <option value="NULL"></option>
                    @foreach($rooms as $room)
                    <option value="<?php echo($room->id) ?>">{{$room->full_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label class="lead">Quórum</label>
                <input type="number" class="form-control" placeholder="Quórum" name="minimum_quorum" required>
            </div>
            <div class="col-md-6">
                <label class="lead">Capacidade</label>
                <input type="number" class="form-control" placeholder="Capacidade max." name="maximum_capacity" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <label for="RoomSelection" class="lead">Palestrantes:</label>  
                <select class="form-control form-control-md" name="speaker_id" style="margin-bottom: 10px" id="EventSpeakers">
                    <option value=""></option>
                    @foreach($speakers as $speaker)
                    <option value="<?php echo($speaker->id) ?>">{{$speaker->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2" style="margin-top:39px;">
                <button type="button" class="btn btn-primary" onclick="duplicarCampos();">+</button>&nbsp;
                <button type="button"  class="btn btn-danger" onclick="removerCampos(this);">-</button>
            </div>
            <div class="col-md-6">
                <label for="RoomSelection" class="lead">Publico Alvo:</label>  
                <select  class="form-control form-control-md" name="public_id" id="EventPublic" required>
                    <option value=""></option>
                    @foreach($bonds as $bond)
                    <option value="<?php echo($bond->id) ?>">{{$bond->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row" >
            <div class="col-md-4" id="destino">
            </div>
        </div>    
        <input type="submit" name="register" style="margin-top: 30px;" class="btn btn-success col-md-2" value="Cadastrar">
        <input type="reset"class="btn btn-secondary col-md-2"   style="margin-top: 30px; margin-left: 10px;" value="Limpar">
    </form>
</div>   
</div>
@if(session()->has('sucess'))
<script type="text/javascript">alert("{{session()->get('sucess')}}");</script>
@endif
@endsection