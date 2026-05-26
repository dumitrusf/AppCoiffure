<h1 class="nombre-pagina">Update Service</h1>
<p class="descripcion-pagina">Modify the values of the form</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    <input type="submit" class="boton" value="Update">
</form>