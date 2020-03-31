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
		1 =>	'¿QUÉ ES TRAVEHOME?',
		2 =>	'CIUDADES',
		3 =>	'INICIAR SESIÓN',
		4 =>	'REGISTRATE',
		5 =>	'CONTACTO'
	);	

?>

<header>

	<?php

if(isset($_SESSION['traveller'])):

	echo "User: ".$_SESSION['traveller']['Name']."<br>".$_SESSION['traveller']['Email'].'<br>';
		for($i = 0; $i < count($menuTraveller); $i++) { 

			?>
	
				<button onclick = "location.assign('index.php?tr= <?php echo $i ?>');"  class='menu'>
			
				<?php echo "$menuTraveller[$i]"; ?>
			
				</button>
				
		<?php }
endif;	

if(isset($_SESSION['owner'])):

	echo "User: ".$_SESSION['owner']['Name']."<br>".$_SESSION['owner']['Email'].'<br>';
		for($i = 0; $i < count($menuOwner); $i++) { 

			?>
	
				<button onclick = "location.assign('index.php?ow= <?php echo $i ?>');"  class='menu'>
			
				<?php echo "$menuOwner[$i]"; ?>
			
				</button>
				
		<?php }
	
endif;

if(!isset($_SESSION['traveller']) && !isset($_SESSION['owner'])):

		for($i = 0; $i < count($menuNoUser); $i++) { 

			?>
	
				<button onclick = "location.assign('index.php?nu= <?php echo $i ?>');"  class='menu'>
			
				<?php echo "$menuNoUser[$i]"; ?>
			
				</button>
				
		<?php }
	
endif;	
		
		?>
			<div class="filaheader">
				<div class="col-4">
					TraveHome
				</div>
				<div class="col-4">
					<img class="logo" src="View/src/logo.png">
				</div>
				<div class="col-4">
					prueba
				</div>
			</div>
		
</header>