<section class="mybookings">

<?php

include "Model/queries/queries_housing.php";

if(isset($_SESSION['traveller'])){ ?>
	<div class="searcher-position">
			<form class="looking-city" method="POST" action="">
			<div class="searcher">
				<div class="position-form">
					Destino: <input type="text" name="looking" autofocus class="looking">
				</div>
			</div>
			<div class="button-searcher">
				<div class="position-form">
					<input type="submit" name="submit" value="Buscar" class="users-buttons" id="update-states"><br><br>
				</div>
			</div>
	
			</form>
		
	</div>
	<?php

	if(isset($_POST['submit'])){

		showHousing();
	
	}
}

if(isset($_SESSION['owner'])){ ?>
	<div class="my-housing-list">
	</div>
		<?php
		showHousing();
		?>
		
	

<?php
}

?>

</section>
