<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Semana de Prueba Meridia</title>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="utils/foundation/css/foundation.css">
        <link rel="stylesheet" type="text/css" href="build/css/main.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.0/js/conekta.js"></script>
        <script type="text/javascript">
            // Conekta Public Key
            Conekta.setPublishableKey('key_LuXCXvfXdAvYLf2nnUUMrWw');
            // ...
        </script>
    </head>
    <body>

        <header>
            <figure>
                <img src="img/logo.png" />
            </figure><h1>Activa tu semana de Prueba</h1>
        </header>

        <section id="conekta-form">
            <h3 style="text-align:center;">Total: $3, 000 MXN</h3>
            <h3 style="text-align:center;">Valoración Integral + 5 días en Meridia <br> Centro de día</h3>
            <div id="errors"></div>
            <form action="/process/payment" method="POST" id="card-form" role="form">
                <fieldset class="row">
                    <legend>Informaci&oacute;n de contacto</legend>

                    <div class="input large-12 columns">
                        <label>Nombre:
                            <input type="text" class="form-control" id="nombre" placeholder="Ej. Oscar Robles Torres" size="20" name="nombre" />
                        </label>
                    </div>

                    <div class="input large-12 columns">
                        <label >Tel&eacute;fono:
                            <input type="number" class="form-control" id="telefono" placeholder="550 000000" size="10" name="telefono" />
                        </label>
                    </div>

                    <div class="input large-12 columns">
                        <label >Correo electr&oacute;cnico:
                            <input type="email" class="form-control" id="email" placeholder="correo@gmail.com" size="100" name="email" />
                        </label>
                    </div>

                </fieldset>
                <br/>
                <fieldset class="row">
                    <legend>Informaci&oacute;n de la Tarjeta</legend>

                    <div class="input large-12 columns">
                        <label >Nombre en la tarjeta:
                            <input type="text" class="form-control" id="nombretarjetahabiente" placeholder="Ej. Oscar Robles Torres" size="20" data-conekta="card[name]" />
                        </label>
                    </div>

                    <div class="input large-12 columns">
                        <label >N&uacute;mero de Tarjeta:
                            <input type="text" class="form-control" id="tarjeta" placeholder="Ej. 87129873" size="20" data-conekta="card[number]" />
                        </label>
                    </div>

                    <div>
                        <div class="input large-3 columns">
                            <label>Vencimiento:
                                <div class="row">
                                    <div class="input large-5 columns">
                                        <input  class="form-control" type="text" size="3"  placeholder="MM" data-conekta="card[exp_month]" />
                                    </div>
                                    <div class="input large-5 columns">
                                        <input  class="form-control" type="text" size="4"  placeholder="YYYY" data-conekta="card[exp_year]" />
                                    </div>
                                    <div class="large-1 columns"></div>

                                </div>
                            </label>
                        </div>
                        <div class="input large-2 columns">
                            <label >CVC:
                                <input class="form-control" type="text" size="4" placeholder="0000" data-conekta="card[cvc]" />
                            </label>
                        </div>
                        <div class="large-6 columns"></div>
                    </div>
                </fieldset>
                <div class="formter">
                    <div id="goback">
                        <a href="/">< Regresar a Meridia.mx</a>
                    </div><div id="spinner"></div><button class="button success" id="pagar-btn" type="submit">Pagar</button>
                </div>
            </form>
        </section>
        <section id="conekta-success"></section>



        <script src="utils/foundation/js/vendor/modernizr.js"></script>
        <script src="utils/foundation/js/foundation.min.js"></script>
        <script type="text/javascript">
            jQuery(function($) {

                $('#card-form input').blur(function () {
                    if( $(this).val().length === 0 ) {
                        $(this).css('border', '1px solid red');
                    }
                    else{
                        $(this).css('border', '1px solid green');
                    }
                });

                var conektaSuccessResponseHandler;
                conektaSuccessResponseHandler = function(token) {
                    var $form;
                    $form = $("#card-form");

                    /* Inserta el token_id en la forma para que se envíe al servidor */
                    $form.append($("<input type=\"hidden\" name=\"conektaTokenId\" />").val(token.id));

                    /* and submit */
                    $form.get(0).submit();
                };
                
                conektaErrorResponseHandler = function(token) {
                    //console.log(token.message_to_purchaser);
                    $("#errors").html("<div data-alert class='alert-box alert radius'>"+token.message_to_purchaser+"<a href='#' onclick='window.location.reload(true);' class='close'>&times;</a> </div>");
                    $('#pagar-btn').prop("disabled", false);
                };
                
                $("#card-form").submit(function(event) {
                    event.preventDefault();
                    var $form;
                    $form = $(this);

                    /* Previene hacer submit más de una vez */
                    $form.find("button").prop("disabled", true);
                    Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
                    /* Previene que la información de la forma sea enviada al servidor */
                    return false;
                });

            });

        </script>
    </body>
</html>
