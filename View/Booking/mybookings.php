<section>
<h1 class = "title">Mis reservas</h1>
		<table border=1>
			<tr>
				<th>Código</th>
				<th>Nombre</th>
				<th>Direccion</th>
				<th>Ciudad</th>
                <th>País</th>
                <th>Checkin</th>
                <th>Checkout</th>
                <th>Email de contacto</th>
				<th>Imagen</th>
				<th>Estado</th>
				<th>Modificar reserva</th>
				
			</tr>

			<?php
    
                include "Model/queries/queries_bookings.php";
                        
                    showBooking();
                
			?>

</section>