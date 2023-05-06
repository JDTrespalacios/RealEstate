    <fieldset>
        <legend>General Information</legend>

        <label for="titulo">Title:</label>
        <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Property Title" value="<?php echo s($propiedad->titulo); ?>">

        <label for="precio">Price:</label>
        <input type="number" id="precio" name="propiedad[precio]" placeholder="Property Price" value="<?php echo 
        s($propiedad->precio); ?>">

        <label for="imagen">Image:</label>
        <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

        <?php if($propiedad->imagen){ ?>
            <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
        <?php }?>

        <label for="descripcion">Description:</label>
        <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
    </fieldset>

    <fieldset>
        <legend>Property Information</legend>

        <label for="habitaciones">Bedrooms:</label>
        <input 
            type="number" 
            id="habitaciones" 
            name="propiedad[habitaciones]" 
            placeholder="Ex: 3" 
            min="1" max="9" 
            value="<?php echo s($propiedad->habitaciones); ?>">

        <label for="wc">WCs:</label>
        <input type="number" id="wc" name="propiedad[wc]" placeholder="Ex: 3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

        <label for="estacionamiento">Garage:</label>
        <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ex: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
    </fieldset>

    <fieldset>
        <legend>Seller</legend>

        <label for="vendedor">Seller</label>
        <select name="propiedad[vendedorId]" id="vendedor">
            <option selected value="">-- Select --</option>
            <?php foreach($vendedores as $vendedor) { ?>
                <option 
                    <?php  echo $propiedad->vendedorId === $vendedor->id ? 'selected' : ''; ?> 
                    value=" <?php echo s($vendedor->id); ?> "> <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido) ; ?> 
                </option>
            <?php } ?>
        </select>
    </fieldset>