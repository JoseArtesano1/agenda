<div class="contenedor login">
<?php  include_once __DIR__ .'/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
   
        <p class="descripcion-pagina">Iniciar Sesión</p>
  
        <?php  include_once __DIR__ .'/../templates/alertas.php'; ?> 
    
        <form class="formulario" method="POST" action="/"  novalidate >
           
            <div class="campo">
                  
                   <input type="email" id="email" placeholder= 
                    "Tú Email" name="email">
            </div>
            <div class="campo">
                 
                   <input type="password" id="password" placeholder="Tú Contraseña" name="password">
            </div>
            
            <input type="submit" class="boton" value="Iniciar Sesión" id="mensaje-modal" >
        </form>

     <div  class="modal-container">
		     <div class="modals modal-close">
                <h2>Alerta!</h2>
  			  	<div class="modal-textos">
            	</div>
	     	</div>
	 </div>

        <div class="acciones">
          <a href="/crear" >¿Aún no tienes Cuenta?</a>
          <a href="/olvide" >¿Olvidaste tú Password?</a>
        </div>
    </div>
   
</div>
 
 
<?php  $script ;   ?>
           
     
     

