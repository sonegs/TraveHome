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

        <div class="col-6">
            <div class="position-buttonuser">
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?ow=02'">Ver viviendas</button>
            </div>
            <div class="position-buttonuser">      
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?ow=04'">Configuración</button>
            </div>
        </div>
        <div class="col-6">
            <div class="position-buttonuser">    
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?ow=03'">Ver reservas</button>    
            </div>
            <div class="position-buttonuser">      
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?ow=07'">Salir</button>    
            </div>
        </div>

        <?php
    
    } elseif(isset($_SESSION['traveller'])){  ?>
        
        <div class="col-6">
            <div class="position-buttonuser">
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?tr=01'">Buscar ciudad</button>    
            </div>
            <div class="position-buttonuser">    
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?tr=03'">Configuración</button>    
            </div>
        </div>
        <div class="col-6">
            <div class="position-buttonuser">    
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?tr=02'">Ver reservas</button>
            </div>
            <div class="position-buttonuser">    
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?tr=05'">Salir</button>    
            </div>
        </div>

        <?php
        
    }
        ?>
    </div>
    </section>