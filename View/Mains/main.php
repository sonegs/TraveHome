<section class="principalColorful">
    <div class="fila-title">
        <div class="col-12">
            <div class="title-main">Travehome</div>
        </div>
    </div>
    <div class="fila-title">
        <div class="col-12">
            <div class="info-main">Encontrar alojamiento nunca fue tan fácil</div>
        </div>
    </div>
    <div class="fila-entry"> 
        
        <?php
        
    if(isset($_SESSION['owner'])) { ?>

        <div class="col-12">
            <button class="users-bottons" id="log-out" onclick="location.href='index.php?ow=07'">Cerrar sesión</button>    
        </div>

        <?php
    
    } elseif(isset($_SESSION['traveller'])){  ?>
        
        <div class="col-12">
            <button class="users-bottons" id="log-out" onclick="location.href='index.php?tr=06'">Cerrar sesión</button>    
        </div>

        <?php
        
    } else { ?>
    
        <div class="col-6">
            <button class="users-bottons" id="sign-up" onclick="location.href='index.php?nu=03'">Sign up</button>    
        </div>
        <div class="col-6">
            <button class="users-bottons" id="log-in" onclick="location.href='index.php?nu=02'">Log in</button>
        </div>

        <?php
        }
        ?>
    </div>
    </section>