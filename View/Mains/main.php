<section class="principalColorful">
    <div class="fila-title">
        <div class="col-12">
            <div class="title-main" id="subtitulo-principal">Travehome</div>
        </div>
    </div>
    
    <div class="fila-entry"> 
        <div class="col-12">
            <div class="info-main">
                <div class="fadein">Encontrar alojamiento nunca fue tan fácil</div>
            </div>
        </div>

        <?php
        
    if(isset($_SESSION['owner'])) { ?>

        <div class="fila-buttons">
            <div class="position-buttonuser">
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?ow=02'">Ver viviendas</button>
            </div>
            <div class="position-buttonuser">      
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?ow=03'">Ver reservas</button>    
            </div>
        </div>
            <div class="fila-buttons">
                <div class="position-buttonuser">    
                    <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?ow=04'">Configuración</button>
            </div>
            <div class="position-buttonuser">      
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?ow=05'">Salir</button>    
            </div>
        </div>

        <?php
    
    } elseif(isset($_SESSION['traveller'])){  ?>
        
        <div class="fila-buttons">
            <div class="position-buttonuser">
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?tr=01'">Buscar ciudad</button>    
            </div>
            <div class="position-buttonuser">    
                <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?tr=02'">Ver reservas</button>
            </div>
                </div>
            <div class="fila-buttons">
                <div class="position-buttonuser">    
                    <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?tr=03'">Configuración</button>    
                </div>
                <div class="position-buttonuser">    
                    <button class="users-buttons-type" id="log-out" onclick="location.href='index.php?tr=04'">Salir</button>    
                </div>
            </div>

        <?php
        
    
        
    
    } else { ?>
    <div class="fila-buttons">
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