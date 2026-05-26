<div class="campo">
    <label for="nombre">Name</label>
    <input 
        type="text"
        id="nombre"
        placeholder="Service Name"
        name="nombre"
        value="<?php echo $servicio->nombre; ?>"
    />
</div>

<div class="campo">
    <label for="precio">Price</label>
    <input 
        type="number"
        id="precio"
        placeholder="Service Price"
        name="precio"
        value="<?php echo $servicio->precio; ?>"
    />
</div>