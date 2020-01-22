<!DOCTYPE html>

<html>
<style>
    body {
        font-family: Helvetica, sans-serif;
        color:#494949;
    }

    ul {
        list-style: none;
    }

    div{
        background-color: #F8F8F8;
        width: 85%;
        border-radius:20px;
        padding: 1rem 2rem;
    }
</style>
<body>
<div>
    <h2>{{ $site ?? 'WGregorutti' }}</h2>
    <h3>Solicitud de Presupuesto</h3>
    <p>Enviado desde la web </p>
    <br>
    <h3>Datos del contacto</h3>
    <ul>
        <li><strong>Nombre:</strong>{{$datos['nombre']}}</li>
        <li><strong>Empresa:</strong>{{$datos['empresa']}}</li>
        <li><strong>Email:</strong> {{$datos['email']}}</li>
        <li><strong>Teléfono:</strong> {{$datos['telefono']}}</li>
        <br>
        <br>
        <h4>{{$datos['nombre']}}   le escribe:</h4>
        <p>
            {{$datos['mensaje']}}
        </p>
    </ul>
</div>
</body>
</html>
