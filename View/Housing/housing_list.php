<section>

<?php

include "Model/queries/queries_housing.php";

if(isset($_SESSION['traveller'])){ ?>

	<form method="POST" action="">

  		Buscar: <input type="text" name="looking" autofocus>
  		<input type="submit" name="submit" value="Buscar" class="input_form">
	
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
