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
		4 =>	'CONFIGURACIÓN',
		5 =>	'CONTACTO',
		6 =>	'CERRAR SESION'
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

	echo $_SESSION['traveller']['Name'].$_SESSION['traveller']['Email'].'<br>';
		for($i = 0; $i < count($menuTraveller); $i++) { 

			?>
	
				<button onclick = "location.assign('index.php?tr= <?php echo $i ?>');"  class='menu'>
			
				<?php echo "$menuTraveller[$i]"; ?>
			
				</button>
				
		<?php }
endif;	

if(isset($_SESSION['owner'])):

	echo $_SESSION['owner']['Name'].' '.$_SESSION['owner']['Email'].'<br>';
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
        <div class="encabezado">
		<h1 class="title">TraveHome</h1>
		<img class="logo" src="View/src/logo.png" alt="" width="72" height="72">
		</div>
</header>