 <!DOCTYPE html>
 <html>
 <head>
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
  <div style="text-align: center;">

    <p style="font-size: 28px;">Certificamos que {{ $subscription[0]->user->name }} <br> participou da 30º Semana da Educação Paulo Freire com o tema <br><b>"{{ $subscription[0]->activity->name }}"</b> </p>
    <p style="font-size: 23px;"> Carga Horária de 4 horas.</p>
    <p style="font-size: 23px;"> Santos, {{ date('d/m/Y H:i:s') }}.</p>

  </div>
<div class="row"> 
  <center>
    <br><br>
    <img src="images/footer.png" style="text-align: center; margin-left: 80px; width: 300px;">
    <img src="images/ass.png" style="text-align: right; margin-left: 55px; width: 200px;">
  </center>
</div>
</body>
</html>