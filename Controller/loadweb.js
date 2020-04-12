var contador = 1;
var colores = 1;

var validarFecha;

$(document).ready(function() {

    /* ESTO ES LO QUE MUEVE LA IMAGEN QUE COPIASTE CUANDO PONES ENCIMA EL RATON PONE TRAVEHOME
    $("figure").mouseleave(
        function() {
            $(this).removeClass("hover");
        }
    ); */
    //mueve las imagenes de la mochila y la casa al iniciar sesion/crear usuario
    $("#traveller-option").click(function() {
        $("#traveller-icon").animate({ marginTop: 0 }, 50).animate({ marginTop: -50 }, 200).animate({ marginTop: 0 }, 200).animate({ marginTop: -50 }, 200).animate({ marginTop: 0 }, 200);
    });

    $("#owner-option").click(function() {
        $("#owner-icon").animate({ marginTop: 0 }, 50).animate({ marginTop: -50 }, 200).animate({ marginTop: 0 }, 200).animate({ marginTop: -50 }, 200).animate({ marginTop: 0 }, 200);
    });

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
            $("#end").val(today);

        } else {

            console.log(false);

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

    $('.principal-info').mouseover(function() {
        // $('nav').toggle(); 

        if (colores == 1) {
            $('.zone-blue').animate({
                left: '0'
            }, 400);
            $('.zone-green').animate({
                left: '0'
            }, 600);
            $('.zone-orange').animate({
                left: '0'
            }, 1000);
            $('.zone-orange2').animate({
                left: '0'
            }, 900);
            colores = 0;
        }
    });
});