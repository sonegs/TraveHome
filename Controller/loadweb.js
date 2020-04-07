$(document).ready(main);

var contador = 1;

var validarFecha;

function main() {
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

};

$(document).ready(function() {

    $("#traveller-option").click(function() {
        $("#traveller-icon").animate({ marginTop: 0 }, 50).animate({ marginTop: -15 }, 200).animate({ marginTop: 0 }, 200).animate({ marginTop: -15 }, 200).animate({ marginTop: 0 }, 200);
    });

    $("#owner-option").click(function() {
        $("#owner-icon").animate({ marginTop: 0 }, 50).animate({ marginTop: -15 }, 200).animate({ marginTop: 0 }, 200).animate({ marginTop: -15 }, 200).animate({ marginTop: 0 }, 200);
    });

    //.toggle( "bounce", { times: 3 }, "slow" );
    /*
        $("#traveller-option").click(function() {
            $("#traveller-icon").toggle("bounce", { times: 3 }, "slow");
        });

        $("#owner-option").click(function() {
            $("#owner-icon").toggle("bounce", { times: 3 }, "slow");
        });*/
    $("#checkdates").click(function() {

        var checkin = document.getElementById('start').value;
        var checkout = document.getElementById('end').value;

        var f = new Date();
        today = (f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate());
        var fechaActual = new Date(today);
        var fechaCheckin = new Date(checkin);
        var fechaCheckout = new Date(checkout);
        console.log(fechaActual); //es un tipo de dato Objeto, con la fecha de la variable today
        console.log(fechaCheckin); //es un tipo de dato Objeto, con la fecha de la variable checkin

        if (fechaCheckin <= fechaActual | fechaCheckout < fechaCheckin) {

            window.stop();
            alert("Introduzca una fecha posterior para su reserva");

        } else {

            console.log(false);

        }
    });

});