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
                <button class="users-bottons-type" id="log-out" onclick="location.href='index.php?ow=03'">Ver viviendas</button>
            </div>
            <div class="position-buttonuser">      
                <button class="users-bottons-type" id="log-out" onclick="location.href='index.php?ow=05'">Configuración</button>
            </div>
        </div>
        <div class="col-6">
            <div class="position-buttonuser">    
                <button class="users-bottons-type" id="log-out" onclick="location.href='index.php?ow=04'">Ver reservas</button>    
            </div>
            <div class="position-buttonuser">      
                <button class="users-bottons-type" id="log-out" onclick="location.href='index.php?ow=07'">Salir</button>    
            </div>
        </div>

        <?php
    
    } elseif(isset($_SESSION['traveller'])){  ?>
        
        <div class="col-6">
            <div class="position-buttonuser">
                <button class="users-bottons-type" id="log-out" onclick="location.href='index.php?tr=02'">Buscar ciudad</button>    
            </div>
            <div class="position-buttonuser">    
                <button class="users-bottons-type" id="log-out" onclick="location.href='index.php?tr=04'">Configuración</button>    
            </div>
        </div>
        <div class="col-6">
            <div class="position-buttonuser">    
                <button class="users-bottons-type" id="log-out" onclick="location.href='index.php?tr=03'">Ver reservas</button>
            </div>
            <div class="position-buttonuser">    
                <button class="users-bottons-type" id="log-out" onclick="location.href='index.php?tr=06'">Salir</button>    
            </div>
        </div>

        <?php
        
    }
        ?>
    </div>
    </section>