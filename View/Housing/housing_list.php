<section class="principal-info">

<?php

include "Model/queries/queries_housing.php";

if(isset($_SESSION['traveller'])){ ?>

	<form method="POST" action="">

  		Ciudad de destino: <input type="text" name="looking" autofocus class="looking"><br><br>
  		<input type="submit" name="submit" value="Buscar" class="users-bottons"><br><br>
	
	</form>
	<?php

	if(isset($_POST['submit'])){

		showHousing();
	
	}
}

if(isset($_SESSION['owner'])){

		showHousing();

}

?>

</section>
