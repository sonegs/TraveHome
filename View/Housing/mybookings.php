<section>
<h1 class = "title">Mis viviendas</h1>
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
    
                include "Model/consultas/consultas_reservas.php";
                        
                if(isset($_SESSION['traveller'])){
                             
                    mostrarReservas();
                    
                }
                
			?>

</section>