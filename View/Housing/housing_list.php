<section>
<h1 class = "title">Mis viviendas</h1>
		<table border=1>
			<tr>
				<th>Nombre de la vivienda</th>
				<th>Direccion</th>
				<th>Código postal</th>
				<th>Ciudad</th>
				<th>País</th>
				<th>Imagen</th>
				<th>Reserve ahora!</th>
				
			</tr>

			<?php
    
                include "Model/consultas/consultas_viviendas.php";
                        
                if(isset($_SESSION['traveller'])){
                             
                    mostrarViviendasTraveller();
                    
                }

                if(isset($_SESSION['owner'])){
                    
                    mostrarViviendasOwner();
            
                }  
                
			?>

</section>