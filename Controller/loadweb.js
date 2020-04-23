var contador = 1;

var validarFecha;

$(document).ready(function() {
    var agreement = 1;
    //mueve las imagenes de la mochila y la casa al iniciar sesion/crear usuario
    $("#traveller-option").click(function() {

        $("#traveller-icon").animate({ marginTop: 0 }, 50).animate({ marginTop: -35 }, 200).animate({ marginTop: 0 }, 200).animate({ marginTop: -35 }, 200).animate({ marginTop: 0 }, 200);

    });

    $("#owner-option").click(function() {

        $("#owner-icon").animate({ marginTop: 0 }, 50).animate({ marginTop: -50 }, 200).animate({ marginTop: 0 }, 200).animate({ marginTop: -50 }, 200).animate({ marginTop: 0 }, 200);

    });
    //comprueba que las fechas introducidas en el navegador para hacer la reserva son correctas
    $(".checks").change(function() {

        var checkin = document.getElementById('start').value;
        var checkout = document.getElementById('end').value;

        var f = new Date();
        today = (f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate());

        if (((f.getMonth() + 1) < 10) && (f.getDate() < 10)) {

            today = (f.getFullYear() + "-0" + (f.getMonth() + 1) + "-0" + f.getDate());

        } else {

            if (f.getDate() < 10) {

                today = (f.getFullYear() + "-" + (f.getMonth() + 1) + "-0" + f.getDate());
            }

            if ((f.getMonth() + 1) < 10) {

                today = (f.getFullYear() + "-0" + (f.getMonth() + 1) + "-" + f.getDate());
            }
        }


        var fechaActual = new Date(today);
        var fechaCheckin = new Date(checkin);
        var fechaCheckout = new Date(checkout);
        //console.log(fechaActual); //es un tipo de dato Objeto, con la fecha de la variable today
        //console.log(fechaCheckin); //es un tipo de dato Objeto, con la fecha de la variable checkin

        if (fechaCheckin < fechaActual | fechaCheckout <= fechaCheckin) {

            alert("Introduzca una fecha posterior para su reserva");

            $("#start").val(today);


        } else {



        }
    });
    // aparece el menu de navegación del header
    $('.menu_bar').click(function() {
        // $('nav').toggle(); 

        if (contador == 1) {
            $('nav').animate({
                left: '0'
            });
            contador = 0;
        } else {
            contador = 1;
            $('nav').animate({
                left: '-100%'
            });
        }

    });

    // llama a una función para que cree la cookie y hace desaparecer el menu de navegación del footer
    $('#agreement').click(function() {
        $("#agreement").load("Model/queries/cookies.php", function(ifCookie, statusTxt, xhr) { //al cargar el rombo, que llame al archivo devolverColor de PHP

            if (statusTxt == "success") { //si se ha realizado la comunicación correctamente

                $('footer').animate({
                    bottom: '-100%'
                });
                agreement = 0;
            }

            if (statusTxt == "error") { //si ha ocurrido un error en la comunicación con PHP lo imprime en consola

                console.log("Se ha producido el siguiente error: " + xhr.status + ": " + xhr.statusText); //indica el tipo de error en la comunicacion AJAX

            }

        });

    });

    // cada vez que se busque una ciudad, se cambiarán a expiradas las reservas pasadas de fecha
    $("#update-states").click(function() { //al hacer click en el boton

        //aqui pasamos la variable randomColor a PHP con ajax

        $.ajax({
            type: "POST", //tipo de método
            url: "Model/queries/update_states.php", //url del archivo PHP con el que comunica
            success: function() { // si la comunicación se produce correctamente, imprime un mensaje por consola

                console.log("Fechas actualizadas en la base de datos!");

            },
            error: function() { // si se ha producido un error en la comunicación, imprime un mensaje por consola

                console.log("Ha ocurrido un error inesperado al actualizar los estados");

            }

        });

    });

});
$("main.php").ready(function() { // cuando se carge la pantalla principal sin logear, que haga estos efectos

    $(window).scroll(function() { //cuando se haga scroll en la pagina web

        var windowHeight = $(window).scrollTop();
        var contenido2 = $("#subtitulo-principal").offset();
        var contenido3 = $("#signal-images").offset();

        if (typeof $('#subtitulo-principal').offset() == 'undefined' || typeof $('#signal-images').offset() == 'undefined') {

        } else { // evita que aparezca un error en consola si no nos encontramos en la web principal

            contenido2 = contenido2.top;
            contenido3 = contenido3.top;


            if (windowHeight >= contenido2) {

                $('.zone-green').animate({
                    left: '0'
                }, 1600);
                $('.zone-orange').animate({
                    left: '0'
                }, 1400);
                $('.zone-orange2').animate({
                    left: '0'
                }, 700);
                $('.zone-blue').animate({
                    left: '0'
                }, 2000);
            }

            if (windowHeight >= contenido3) {

                $('#airplanepass').fadeIn(1500);
                $('#planet').fadeIn(2500);
                $('#creditcard').fadeIn(3500);

            }
        }
    });
});