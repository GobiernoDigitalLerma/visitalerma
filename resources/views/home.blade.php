@extends('Sistema.admin')
@section('contenido')
<!DOCTYPE HTML>
<html>
    <head>
        <title>Bienvenidos</title>
        <link rel="stylesheet" href="assets/Bienvenidos/css/main.css" />
    </head>
    <body class="is-preload">
        <!-- Wrapper -->
            <div id="wrapper">

                <!-- Header -->
                    <header id="header">
                        <div >
                            <img src="images/logo.png"  width="100px" length="100px">
                        </div>
                        <div class="content">
                            <div class="inner">
                                <h1>BIENVENIDO</h1>
                                <h3><a id="LINK" href="https://visita.lerma.gob.mx">VISITA LERMA<br />
                               </h3>
                            </div>
                        </div>
                        
                    </header> 
            </div>

        <!-- BG -->
            <div id="bg"></div>

        <!-- Scripts -->
            <script src="assets/Bienvenidos/js/jquery.min.js"></script>
            <script src="assets/Bienvenidos/js/browser.min.js"></script>
            <script src="assets/Bienvenidos/js/breakpoints.min.js"></script>
            <script src="assets/Bienvenidos/js/util.js"></script>
            <script src="assets/Bienvenidos/js/main.js"></script>

    </body>
</html>
@endsection