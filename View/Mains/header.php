<?php

	$menuTraveller = array(
		0 =>	'HOME',
		1 =>	'BUSCAR CIUDAD',
		2 =>	'MIS RESERVAS',
		3 =>	'EDITAR',
		4 =>	'CONTACTO',
		5 =>	'CERRAR SESION'
	);	

	$menuOwner = array(
		0 =>	'HOME',
		1 =>	'AÑADIR VIVIENDA',
		2 =>	'VER TUS VIVIENDAS',
		3 =>	'VER RESERVAS',
		4 =>	'EDITAR',
		5 =>	'CONTACTO',
		6 =>	'CERRAR SESION'
	);	

	$menuNoUser = array(
		0 =>	'HOME',
		1 =>	'CIUDADES',
		2 =>	'INICIAR SESIÓN',
		3 =>	'REGISTRATE'
	);	

?>

<header>

	<div class="col-4">
		<div class="menu_bar">
			<a href="#" class="bt-menu"><i class="fas fa-bars"></i></a>
		</div>
	</div>
	<div class="col-4">
		<div class="menu_bar"><?php
		if(isset($_SESSION['traveller'])):
			echo "<a href='index.php?tr=200' class='bt-menu'><i class='fas fa-home'></i></a>";
		elseif(isset($_SESSION['owner'])):
			echo "<a href='index.php?ow=200' class='bt-menu'><i class='fas fa-home'></i></a>";
		else:?>
			<a href="index.php" class="bt-menu"><i class="fas fa-home"></i></a> <?php endif; ?>
		</div>
	</div>
	<div class="col-4">
		<div class="user-mail"><?php
		if(isset($_SESSION['traveller'])):
			echo "<p>".$_SESSION['traveller']['Email']."</p>";
		endif;
		if(isset($_SESSION['owner'])):
			echo "<p>".$_SESSION['owner']['Email']."</p>";
		endif;?>
		</div>
	</div>
	<nav>
		<ul>
				
			<?php // ELECCIONES DE ARRAY EN EL HEADER DEPENDIENDO DEL TIPO DE SESION

				if(isset($_SESSION['traveller'])):

					//echo "User: ".$_SESSION['traveller']['Name']."<br>".$_SESSION['traveller']['Email'];
						for($i = 0; $i < count($menuTraveller); $i++) { 

						?>
					
						<li><a href="index.php?tr= <?php echo $i ?>"><span class="icon-house"></span><?php echo "$menuTraveller[$i]"; ?></a></li>
								
						<?php }

				endif;	

				if(isset($_SESSION['owner'])):

					//echo "User: ".$_SESSION['owner']['Name']."<br>".$_SESSION['owner']['Email'];
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
	</div>
</header>