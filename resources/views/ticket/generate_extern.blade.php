<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="/print.css" media="print" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <meta charset="utf-8">
  <title></title>
  <style type="text/css">
</style>
<script type="text/javascript">
</script>
</head>
<body>
  <nav style="text-align: center; margin-top: 0px;">
   <img src="images/header2.png" style="width: 900px;">
 </nav>
 <div style="margin: auto;">
  <p class="col-md-12" style="text-align: center; margin-left: 100px; font-size: 24px;">
    <b>Nome do Evento: {{ $activity->name }}</b><br>
    @if(isset($activity->room->name))
    <b>Sala: {{ $activity->room->name }}</b>
    @endif
  </p>
</div>
<div class="col-md-12">
  <b style="text-align: center; margin-left: 100px; font-size: 24px;"> Local: {{ $activity->location->name }} </b> <br>
  <b style="text-align: center; margin-left: 100px; font-size: 24px;"> Data: {{ $activity->beginning_date }} </b>
</div>  
<br><br>
<div class="row"> 
 <center>
  <p style="font-size: 10px; text-align: justify; margin-left: 10px;">
    Certifico que o (a) visitante: ____________________________________________________________________________________________,<br>
    detentor do CPF: _______________________________________________________________________________________________________, <br> 
    participou da palestra: _________________________________________________________________________________________________,<br>
    no dia __________________ de agosto de 2018, no período da ____________________ (manhã, tarde ou noite).
  </p>
</center>
</div>
<br><br>
<div class="row"> 
  <center>
    <br><br>
    <img src="images/footer.png" style="text-align: center; margin-left: 80px; width: 300px;">
    <img src="images/ass.png" style="text-align: right; margin-left: 55px; width: 200px;">
  </center>
</div>
</body>
</html>