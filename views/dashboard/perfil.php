
<?php include_once __DIR__ . '/header-dashboard.php'; ?>
<div class="contenedor-s">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <a href="/cambiar-password" class="enlace">Cambiar Password</a>
    <form class="formulario" method="POST" action="/perfil">
        <div class="campo1">
            <input type="text" value="<?php echo $usuario->nombre;?>" placeholder="Tú nombre" name="nombre">
            <input type="email" value="<?php echo $usuario->email;?>" placeholder="Tú Correo" name="email">
        </div>
        <input type="submit" class="mi" value="Guardar Cambios">
    </form>
</div>
<?php include_once __DIR__ . '/footer-dashboard.php'; ?>