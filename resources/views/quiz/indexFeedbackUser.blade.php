@extends('layouts.index') 
@section('content')

<div class="center1">
  <h4 class="display-4"><b>Avaliação</b></h4>
  <h5>Palestra Tal</h5>
  
  <div id="EventInfoTable">
    <p class="lead"> </p><br>
  </div>    
  <div id="EventSelectionTable" style="overflow-x:auto;">
   <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Nome usuário</th>
        <th scope="col">Como você avalia a divulgação do evento?</th>
        <th scope="col">E o site da inscrição?</th>
        <th scope="col">Na sua opinião, os assuntos abordados foram...</th>
        <th scope="col">Quanto à organização geral do evento,você avalia que foi...</th>
        <th scope="col">Local do evento:</th>
        <th scope="col">Gostaria de deixar algum comentário?</th>
        <th scope="col">Palestra/Oficina:</th>
        <th scope="col">Dê sua opinião sobre a feira do livro "5ª Onda literária"</th>
        <th scope="col">Se você assinalou Ruim ou Regular, justifique</th>
        <th scope="col">Santos à luz da leitura - Integralidade: o olhar, o pensar, o ser</th>
        <th scope="col">Se você assinalou Ruim ou Regular, justifique</th>
        <th scope="col">Elogie...</th>
        <th scope="col">Critique...</th>
        <th scope="col">Sugira...</th>
      </tr>
    </thead>
    <tbody>
      @foreach($quizzes as $quiz)
    <tr>
     <td>{{$quiz->name}}</td>
     <td>{{$quiz->A1}}</td>
     <td>{{$quiz->B1}}</td>
     <td>{{$quiz->C1}}</td>
     <td>{{$quiz->D1}}</td>
     <td>{{$quiz->A2}}</td>
     <td>{{$quiz->users_comment}}</td>
     <td>{{$quiz->A3}}</td>
     <td>{{$quiz->B3}}</td>
     <td>{{$quiz->justify_B3_answer}}</td>
     <td>{{$quiz->C3}}</td>
     <td>{{$quiz->justify_C3_answer}}</td>
     <td>{{$quiz->users_praise}}</td>
     <td>{{$quiz->users_criticism}}</td>
     <td>{{$quiz->users_suggestions}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
    <div class="pagination justify-content-center">
      
    </div>   
  </div>

  <button type="button" onclick="location.href='dashboard'"; class="btn btn-danger" style="width: 150px;">Voltar Painel</button>
  @if(session()->has('info')) 
  <script type="text/javascript">alert("{{session()->get('info')}}");</script> 
  @endif
</div>
</div>  
</div>
@endsection