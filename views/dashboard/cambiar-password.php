
<?php include_once __DIR__ . '/header-dashboard.php'; ?>
<div class="contenedor-s">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <a href="/perfil" class="enlace">Volver Perfil</a>
    <form class="formulario" method="POST" action="/cambiar-password">
        <div class="campo1">
            <input type="password"  placeholder="Tú Password" name="password_actual" id="password_actual">
            <input type="password"  placeholder="Nuevo Password" name="password_nuevo" id="password_nuevo">
        </div>
        <input type="submit" class="mi" value="Guardar Cambios" id="mensaje-modal2">
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
</div>
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<?php
      $script .='<script src="build/js/mensajes4.js"></script>
      <script src="build/js/limpiar.js"></script>' ;
?>