<div class="barra">
    <p>Hello: <?php echo $nombre ?? ''; ?></p>
    <a class="boton" href="/logout">Logout</a>
</div>

<?php if(isset($_SESSION['admin'])) { ?>
    <div class="barra-servicios">
        <a class="boton" href="/admin">View Appointments</a>
        <a class="boton" href="/servicios">See Services</a>
        <a class="boton" href="/servicios/crear">New Service</a>
    </div>
<?php } ?>