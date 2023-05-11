<div class="contenedor crear">
<?php  include_once __DIR__ .'/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tú Cuenta</p>
        <?php  include_once __DIR__ .'/../templates/alertas.php'; ?>
        <form class="formulario" method="POST" action="/crear">
        <div class="campo">
                  
                   <input type="text" id="nombre" placeholder="Tú nombre" name="nombre" value="<?php echo $usuario->nombre;?>"/>
            </div>
            <div class="campo">
                   
                   <input type="email" id="email" placeholder="Tú Email" name="email" value="<?php echo $usuario->email;?>"/>
            </div>
            <div class="campo">
                 
                   <input type="password" id="password" placeholder="Tú Contraseña" name="password">
            </div>
            <div class="campo">
                 
                   <input type="password" id="password2" placeholder="Repite Tú Contraseña" name="password2">
            </div>
            <input type="submit" class="boton" value="Guardar"  id="mensaje-modal2">
        </form>
        <div  class="modal-container">
		<div class="modals modal-close">
                <h2>Alerta!</h2>
  		     <div class="modal-textos">
            	     </div>
                   <div class="modal-textos2">
            	     </div>
	     	</div>
	 </div>
        <div class="acciones">
          <a href="/">Iniciar Sesión</a>
          <a href="/olvide">¿Olvidaste tú Password?</a>
        </div>
    </div>
</div>

<?php
      $script ;
?>