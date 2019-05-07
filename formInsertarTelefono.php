<?php include_once './header.php'; ?>

<?php
include_once './BD/DAL/Connection.php';
include_once './BD/DTO/Telefono.php';
include_once './BD/BLL/TelefonoBLL.php';
include_once './BD/DTO/Persona.php';
include_once './BD/BLL/PersonaBLL.php';

$objTelefono = null;
if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
    $telefonoBLL = new TelefonoBLL();
    $objTelefono = $telefonoBLL->select($id);
}
?>
<div class="container">
    <div class="col-md-6 offset-md-3">
        <h1>
            Insertar Telefono
        </h1>
        <form action="listaTelefonos.php" method="POST">
            <input type="hidden" name="task" value="<?php echo ($objTelefono == null) ? "insert" : "update"; ?>"/>
            <input type="hidden" name="id"  value="<?php
            if ($objTelefono != null) {
                echo $objTelefono->getId();
            }
            ?>"/>
            <div class="form-group">
                <label>Persona:</label>
                <select class="form-control" name="idPersona">
                    <?php
                    $personaBLL = new PersonaBLL();
                    $listaPersonas = $personaBLL->selectAll();
                    foreach ($listaPersonas as $objPersona) {
                        ?>
                        <option <?php
                        if ($objTelefono != null && $objPersona->getId() == $objTelefono->getIdPersona()) {
                            echo " selected ";
                        }
                        ?> value="<?php echo $objPersona->getId(); ?>"><?php echo $objPersona->getNombres() . " " . $objPersona->getApellidos(); ?></option>

                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Telefono:</label>
                <input class="form-control" type="text" name="txtTelefono"  required="required" value="<?php
                if ($objTelefono != null) {
                    echo $objTelefono->getTelefono();
                }
                ?>"/>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Enviar"/>
                <a href="listaTelefonos.php?idPersona=<?php echo $objTelefono->getIdPersona()?>" class="btn btn-danger">Cancelar</a>
            </div>
        </form>

    </div>
</div>
<?php include_once 'footer.php'; ?>