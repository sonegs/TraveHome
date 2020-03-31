var validarFecha;
$(document).ready(function() {


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