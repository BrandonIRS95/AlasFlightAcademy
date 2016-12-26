<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admission paid</title>
</head>
<body>
<div class="container" style="
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    box-sizing: border-box;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
">
    <div class="page-header" style="
        padding-bottom: 9px;
        margin: 40px 0 20px;
        border-bottom: 1px solid #eee;
        box-sizing: border-box;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
    ">
        <h1 style="
            font-size: 36px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
            color: black;
            box-sizing: border-box;
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        ">
            Alas Flight Academy <br>
            <small style="
                font-size: 65%;
                font-weight: 400;
                line-height: 1;
                color: #777;
                font-family: inherit;
                -webkit-tap-highlight-color: rgba(0,0,0,0);
            ">
                @yield('subtitle')
            </small>
        </h1>
    </div>
    @yield('content')
    <br>
    <p>Best regards, <a href="">Alas Flight Academy.</a></p>
    <br>
    <p><b>Tel:</b> (917) 321-7654</p> <!-- Cambiar telefono-->
    <p><b>E-mail:</b> flyalas@gmail.com</p> <!-- Cambiar correo-->
    <p><b>Address:</b> #6545 Palm Ville, San Diego, CA.</p> <!-- Cambiar direccion-->
</div>


</body>
</html>