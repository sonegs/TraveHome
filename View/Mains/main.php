<!--
    <figure class="snip1033">
    <figure class="snip1033"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample22.jpg" alt="sample22" />
  <figcaption>
    <div class="left">
      <h3 class="yellow">Trave</h3>
    </div>
    <div class="right">
      <h3 class="white">Home</h3>
    </div>
  </figcaption>
  <div class="center"><i class="ion-ios-loop-strong"></i></div>
  <a href="#"></a>
</figure>

-->
<section class="principalColorful">
    <div class="fila-title">
        <div class="col-12">
            <div class="title-main">Travehome</div>
        </div>
    </div>
    
    <div class="fila-entry"> 
        <div class="col-12">
            <div class="info-main">Encontrar alojamiento nunca fue tan fácil</div>
        </div>
        <div class="fila-buttons">
        <?php
        
    if(isset($_SESSION['owner'])) { ?>

        <div class="col-12">
            <button class="users-button" id="log-out" onclick="location.href='index.php?ow=07'">Cerrar sesión</button>    
        </div>

        <?php
    
    } elseif(isset($_SESSION['traveller'])){  ?>
        
        <div class="col-12">
            <button class="users-button" id="log-out" onclick="location.href='index.php?tr=06'">Cerrar sesión</button>    
        </div>

        <?php
        
    } else { ?>
    
        <div class="position-button">
            <button class="users-buttons" id="sign-up" onclick="location.href='index.php?nu=03'">Sign up</button>    
        </div>
        <div class="position-button">
            <button class="users-buttons" id="log-in" onclick="location.href='index.php?nu=02'">Log in</button>
        </div>
        </div>
        <?php
        }
        ?>
    </div>
    </section>