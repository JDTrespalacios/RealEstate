<fieldset>
        <legend>General Information</legend>

        <label for="nombre">Name:</label>
        <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Seller Name" value="<?php echo s($vendedor->nombre); ?>">

        <label for="apellido">Last Name:</label>
        <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Seller Last Name" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Contact Information</legend>

    <label for="telefono">Phone:</label>
        <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Phone Number" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>