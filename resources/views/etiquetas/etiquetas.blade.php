<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Etiqqueta</title>
</head>
<body>
<div
    style="height: 300px; width: 300px; border: 1px solid black;">
    <img  style="height: 300px; width: 300px; z-index:-1; position: absolute" src="{{asset('images/CARGACONOCIDAIMG.png')}}">
    <br>
    <br>

    <br>
    <br>
    <br>
  
    <br>
    <p style="text-align: center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$carta->id}}</p>

    <p style="text-align: center; font-size: 20px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$carta->encargado->nombre}}</p>
</div>

</body>
</html>
