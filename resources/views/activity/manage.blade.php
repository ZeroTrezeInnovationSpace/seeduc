@extends('layouts.register') 
@section('content')
<div class="center1">
    <h4 class="display-4">Alterar Atividade</h4><br>
    <div>
        <div>
            <form method="POST" action="{{route('activity_update')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $activity->id }}">
                <label for="EventSelection" class="lead">Selecione o evento:</label>  

                <select class="form-control form-control-md" name="event_id" id="EventSelection">
                    <option value="{{ $activity->event->id }}" selected>{{ $activity->event->name }}</option>
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
                    <option value="{{ $activity->period }}" selected>{{ $activity->period }}</option>
                    <option value="manhã">Manhã</option>
                    <option value="tarde">Tarde</option>
                    <option value="noite">Noite</option>
                </select>
            </div>
            <div  class="col-md-6">
                <label for="EventSelection" class="lead">Selecione o dia:</label>  
                <input type="date" class="form-control form-control-md" name="beginning_date" id="EventDay" value="{{ $activity->beginning_date }}" required>
            </div>
        </div>
        <br>    

        <div>
            <label class="lead">Entre com o nome da atividade</label>
            <input type="text" class="form-control" placeholder="nome da atividade" name="name" value="{{ $activity->name}}" required>
        </div>
        <div>
            <label class="lead">Entre com a descrição da atividade</label>
            <textarea name="description" placeholder="Descrição da atividade..." class="form-control" rows="5"  value="{{$activity->description}}"required>{{$activity->description}}</textarea>
        </div>
        <div>
            <label class="lead">Entre com palestrantes da atividade</label>
            <textarea name="description_speaker" placeholder="Palestrantes" class="form-control" rows="5"  required></textarea>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label for="LocationSelection" class="lead">Selecione o local:</label>  
                <select class="form-control form-control-md" name="location_id" id="EventPeriod" required>
                    <option value="{{ $activity->location->id }}" selected>{{ $activity->location->name }}</option>
                    @foreach($locations as $location)
                    <option value="<?php echo($location->id) ?>">{{$location->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="LocationSelection" class="lead">Selecione a sala:</label>  
                <select class="form-control form-control-md" name="room_id">
                    <option value="" selected></option>
                    @foreach($rooms as $room)
                    <option value="<?php echo($room->id) ?>">{{$room->full_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label class="lead">Quórum</label>
                <input type="number" class="form-control" placeholder="Quórum" name="minimum_quorum" value="{{ $activity->minimum_quorum}}" required>
            </div>
            <div class="col-md-6">
                <label class="lead">Capacidade</label>
                <input type="number" class="form-control" placeholder="Capacidade max." name="maximum_capacity" value="{{ $activity->maximum_capacity}}"required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label for="speakers" class="lead">Palestrantes:</label>  
                <select class="form-control form-control-md" name="speakers[0]" style="margin-bottom: 10px" id="EventSpeakers0">
                    @foreach($speakers as $speaker)                        
                    <option value="<?php echo ($speaker->id) ?>" >{{$speaker->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2" style="margin-top:39px;">
                <button type="button" class="btn btn-primary" onclick="duplicarCampos();">+</button>&nbsp;
                <button type="button"  class="btn btn-danger" onclick="removerCampos(this);">-</button>
            </div>
            <div class="col-md-12" id="destino">
            </div>
            
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label for="bonds" class="lead">Publico Alvo:</label>
                <select class="form-control form-control-md" name="bonds" style="margin-bottom: 10px" id="EventBonds">  
                    @foreach($bonds as $bond)                         
                    <option value="<?php echo($bond->id) ?>">{{$bond->name}}</option>  
                    @endforeach
                </select>
            </div>
            <div class="col-md-2" style="margin-top:39px;">
                <button type="button" class="btn btn-primary" onclick="duplicarCamposPublico();">+</button>&nbsp;
                <button type="button"  class="btn btn-danger" onclick="removerCamposPublico(this);">-</button>
            </div>
            <div class="col-md-12" id="destiny">
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