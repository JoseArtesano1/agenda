<div class="contenedor olvida">
<?php  include_once __DIR__ .'/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recuperar Cuenta</p>

        <?php  include_once __DIR__ .'/../templates/alertas.php'; ?>
        <form class="formulario" method="POST" action="/olvide" novalidate>
      
            <div class="campo">
                 
                   <input type="email" id="email" placeholder="Tú Email" name="email">
            </div>
           
            <input type="submit" class="boton" value="Enviar Instrucciones" id="mensaje-modal3">
        </form>
        <div  class="modal-container">
		     <div class="modals modal-close">
                <h2>Alerta!</h2>
  			  	<div class="modal-textos">
            	</div>
	     	</div>
	    </div>
        <div class="acciones">
          <a href="/">Iniciar Sesión</a>
          <a href="/crear">¿Crear Cuenta?</a>
        </div>
    </div>
</div>
<?php
    
    $script .='<script src="build/js/mensajes3.js"></script>
    <script src="build/js/limpiar.js"></script>';
   
   ?>