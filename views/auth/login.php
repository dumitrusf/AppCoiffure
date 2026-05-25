<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Login to your account</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            placeholder="Tu Email"
            name="email"
        />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            placeholder="Your Password"
            name="password"
        />
    </div>

    <input type="submit" class="boton" value="Login">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Don't have an account? Create one</a>
    <a href="/olvide">Did you forget your password?</a>
</div>