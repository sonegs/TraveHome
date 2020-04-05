<?php

	$menuTraveller = array(
		0 =>	'HOME',
		1 =>	'¿QUÉ ES TRAVEHOME?',
		2 =>	'BUSCAR CIUDAD',
		3 =>	'MIS RESERVAS',
		4 =>	'CONFIGURACIÓN',
		5 =>	'CONTACTO',
		6 =>	'CERRAR SESION'
	);	

	$menuOwner = array(
		0 =>	'HOME',
		1 =>	'¿QUÉ ES TRAVEHOME?',
		2 =>	'AÑADIR VIVIENDA',
		3 =>	'VER TUS VIVIENDAS',
		4 =>	'VER RESERVAS',
		5 =>	'CONFIGURACIÓN',
		6 =>	'CONTACTO',
		7 =>	'CERRAR SESION'
	);	

	$menuNoUser = array(
		0 =>	'HOME',
		1 =>	'CIUDADES',
		2 =>	'INICIAR SESIÓN',
		3 =>	'REGISTRATE'
	);	

?>

<header>

	<div class="menu_bar">
		<a href="#" class="bt-menu"><span class="icon-list2"></span>Menu</a>
	</div>

	<nav>
		<ul>
				
			<?php // ELECCIONES DE ARRAY EN EL HEADER DEPENDIENDO DEL TIPO DE SESION

				if(isset($_SESSION['traveller'])):

					echo "User: ".$_SESSION['traveller']['Name']."<br>".$_SESSION['traveller']['Email'];
						for($i = 0; $i < count($menuTraveller); $i++) { 

						?>
					
						<li><a href="index.php?tr= <?php echo $i ?>"><span class="icon-house"></span><?php echo "$menuTraveller[$i]"; ?></a></li>
								
						<?php }

				endif;	

				if(isset($_SESSION['owner'])):

					echo "User: ".$_SESSION['owner']['Name']."<br>".$_SESSION['owner']['Email'];
						for($i = 0; $i < count($menuOwner); $i++) { 

						?>
					
						<li><a href="index.php?ow= <?php echo $i ?>"><span class="icon-house"></span><?php echo "$menuOwner[$i]"; ?></a></li>
										
						<?php }
					
				endif;

					if(!isset($_SESSION['traveller']) && !isset($_SESSION['owner'])):

						for($i = 0; $i < count($menuNoUser); $i++) { 

						?>

						<li><a href="index.php?nu= <?php echo $i ?>"><span class="icon-house"></span><?php echo "$menuNoUser[$i]"; ?></a></li>
										
						
						<?php }

					endif;	
									
			?>

		</ul>
	</nav>
</header>