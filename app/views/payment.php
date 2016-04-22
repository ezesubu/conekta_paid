<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Semana de Prueba Meridia</title>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/utils/foundation/css/foundation.css">
        <link rel="stylesheet" type="text/css" href="/build/css/main.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.0/js/conekta.js"></script>
    </head>
    <body>
        <header>
            <figure>
                <img src="/img/logo.png" />
            </figure>
        </header>

        <section id="conekta-form">
            <br/>

               <div class="row">
                   <?php
                        if($message == 'paid')
                        {
                            echo '<h1 class="text-center">Pago Exitoso!</h1> <br/>';
                        }
                        else
                        {
                            echo '<h1 class="text-center" style="color:darkred;">Error</h1><br/>'.
                                 '<h4 class="subheader text-center">'.$message.'</h4> <br/>';
                        }
                    ?>
               </div>

            <br/>
            <div class="row">
                <div class="small-6 small-centered text-center columns">
                    <a href="#" class="button">Intentar de Nuevo</a>
                </div>
            </div>

        </section>

        <script src="/utils/foundation/js/vendor/modernizr.js"></script>
        <script src="/utils/foundation/js/foundation.min.js"></script>

    </body>
</html>
