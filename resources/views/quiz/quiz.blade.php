@extends('layouts.index') 
@section('content')
<div class="center1">

 <form method="POST" action="{{ route('quiz') }}">

  <legend>Conte-me mais sobre você</legend>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-row">
    bond: &nbsp;<select style="width: 250px; height: 30px;"  name="bond_id" id="types">
      @foreach($bonds as $bond)
      <option value="<?php echo($bond->id) ?>">{{$bond->name}}</option>
      @endforeach
    </select> 
  </div>
  <br><br>
  <p align="left">Você é professor?</p> 
  <div style="text-align: left;">
    <div class="form-check">
      <input class="form-check-input" type="radio" name="test" id="" value="" onclick="funcTeacher()">
      <label class="form-check-label" for="exampleRadios1">
        Sim
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="test" id="" value="" onclick="funcTeacher_not()" >
      <label class="form-check-label" for="exampleRadios2">
        Não
      </label>
    </div>              
  </div>
  <br>
  <p align="left">Você precisa de um intérprete de libras?</p>
  <div style="text-align: left;">
    <select name="need_libras_interpreter" style="width: 250px; height: 30px;">
      <option value="1">Sim</option>
      <option value="0">Não</option>
    </select>              
  </div>
  <br>
  <p align="left">Você gosta ou tem interesse em conhecer tecnologia ? </p>      		
  <div style="text-align: left;">
    <div style="text-align: left;">
      <select name="know_technology" style="width: 250px; height: 30px;">
        <option value="1">Sim</option>
        <option value="0">Não</option>
      </select>              
    </div>
  </div>
  <br>
  <div id="style" style="display: none">

    <textarea placeholder="Explique..." class="form-control"	></textarea>

  </div> 

  <p align="left">Costuma acessar sites e/ou aplicativos via internet?</p> 
  <div style="text-align: left;">
    <div style="text-align: left;">
      <select name="used_to_sites" style="width: 250px; height: 30px;">
        <option value="1">Sim</option>
        <option value="0">Não</option>
      </select>              
    </div>
  </div>
  <br>
  <div id="style3" style="display: none">

    <textarea placeholder="Explique..." class="form-control"	></textarea>

  </div> 

  <p align="left">Gostaria de marcar presença nos eventos da Seduc por meios digitais (QR CODE) e via obter seu certificado pelo sistema? </p> 
  <div style="text-align: left;">
    <div style="text-align: left;">
      <select name="adept_qr_code" style="width: 250px; height: 30px;">
        <option value="1">Sim</option>
        <option value="0">Não</option>
      </select>              
    </div>
  </div>
  <br>
  <div id="style1" style="display: none">

    <textarea placeholder="Explique..." class="form-control"	></textarea>

  </div> 

  <p align="left">Você possui celular Smartphone com acesso a internet?</p> 
  <div style="text-align: left;">
    <div style="text-align: left;">
    <select name="smartphone" style="width: 250px; height: 30px;">
      <option value="1">Sim</option>
      <option value="0">Não</option>
    </select>              
  </div>
  </div>
  <br>
  <div id="style2" style="display: none">

    <textarea placeholder="Explique..." class="form-control"	></textarea>

  </div> 
  <br>
  <div id="professor" style="display: none">
    <p align="left">Em qual(is) segmento(s) você atua na Secretaria de Educação de Santos?</p>
    <div style="text-align: left;">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="segment1" id="" value="">
        <label class="form-check-label" for="exampleRadios1">
          Educação Infantil
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="segment2" id="" value="">
        <label class="form-check-label" for="exampleRadios2">
          Ensino Fundamental I
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="segment3" id="" value="">
        <label class="form-check-label" for="exampleRadios3">
         Ensino Fundamental II
       </label>
     </div>
     <div class="form-check">
      <input class="form-check-input" type="checkbox" name="segment4" id="" value="">
      <label class="form-check-label" for="exampleRadios3">
       Educação de Jovens e Adultos
     </label>
   </div>
 </div>
 <br>
 <p align="left">Você atua, como professor, em outra rede de ensino além de Santos?</p> 
 <div style="text-align: left;">
  <div class="form-check">
    <input class="form-check-input" type="radio" name="teacher" id="" value="Municipal" onclick="professorEsconde()">
    <label class="form-check-label" for="exampleRadios1">
      Pública Municipal
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="teacher" id="" value="Estadual" onclick="professorEsconde()">
    <label class="form-check-label" for="exampleRadios2">
      Pública Estadual
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="teacher" id="" value="Federal" onclick="professorEsconde()">
    <label class="form-check-label" for="exampleRadios3">
      Pública Federal
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="teacher" id="" value="Privada" onclick="professorEsconde()">
    <label class="form-check-label" for="exampleRadios3">
      Privada
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="teacher" id="" value="Não Atuo" onclick="professorDel()">
    <label class="form-check-label" for="exampleRadios3">
      Não atuo
    </label>
  </div>
</div>
<br>
<div style="text-align: left; display: none" id="style5">
  <p align="left">Em qual município?</p> 
  <div class="form-check">
    <input class="form-check-input" type="radio" name="city" id="" value="São Vicente">
    <label class="form-check-label">
      São Vicente 
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="city" id="" value="Cubatão">
    <label class="form-check-label">
      Cubatão
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="city" id="" value="Guarujá">
    <label class="form-check-label">
      Guarujá
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="city" id="" value="Bertioga">
    <label class="form-check-label">
      Bertioga
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="city" id="" value="Praia Grande">
    <label class="form-check-label">
     Praia Grande
   </label>
 </div>
 <div class="form-check">
  <input class="form-check-input" type="radio" name="city" id="" value="Mongaguá">
  <label class="form-check-label">
    Mongaguá
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="city" id="" value="Itanhaém">
  <label class="form-check-label">
    Itanhaém
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="city" id="" value="Peruíbe">
  <label class="form-check-label">
    Peruíbe
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="city" id="" value="Outro">
  <label class="form-check-label">
    Outro <input type="text" name="outro" id="outro" style="border: 0px; outline: 0px; background: transparent; border-bottom: 1px solid black; color: green;">
  </label>
</div>
</div>
</div>
<br>


<br>
<br><br>
<input type="checkbox" name="" required=""> Aceito os termos. </input> <br><input type="submit" name="Excadastrar" class="btn btn-primary" style="height: 50px; width: 250px; margin-top: 12px; background: green;" value="Finalizar">

</form>

</div>
@endsection