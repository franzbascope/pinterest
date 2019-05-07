<?php include_once './header.php'; ?>

<?php
include_once './BD/DAL/Connection.php';
include_once './BD/DTO/Persona.php';
include_once './BD/BLL/PersonaBLL.php';

$objPersona = null;
if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
    $personaBLL = new PersonaBLL();
    $objPersona = $personaBLL->select($id);
}
?>
<div class="container">
    <div class="col-md-6 offset-md-3">
        <h1>
            Insertar Persona
        </h1>
        <form action="index.php" method="POST">
            <input type="hidden" name="task" value="<?php echo ($objPersona == null) ? "insert" : "update"; ?>"/>
            <input type="hidden" name="id"  value="<?php
            if ($objPersona != null) {
                echo $objPersona->getId();
            }
            ?>"/>
            <div class="form-group">
                <label>Nombres:</label>
                <input class="form-control" type="text" name="txtNombres" required="required" value="<?php
                if ($objPersona != null) {
                    echo $objPersona->getNombres();
                }
                ?>"/>
            </div>
            <div class="form-group">
                <label>Apellidos:</label>
                <input class="form-control" type="text" name="txtApellidos"  required="required" value="<?php
                if ($objPersona != null) {
                    echo $objPersona->getApellidos();
                }
                ?>"/>
            </div>
            <div class="form-group">
                <label>Edad:</label>
                <input class="form-control" type="number" name="txtEdad"  required="required" value="<?php
                if ($objPersona != null) {
                    echo $objPersona->getEdad();
                }
                ?>"/>
            </div>
            <div class="form-group">
                <label>Sexo:</label>
                <select class="form-control" name="lstSexo"  required="required">
                    <option value="">Seleccione el sexo</option>
                    <option value="0" <?php
                    if ($objPersona != null && $objPersona->getSexo() == 0) {
                        echo " selected ";
                    }
                    ?>>Femenino</option>
                    <option value="1" <?php
                    if ($objPersona != null && $objPersona->getSexo() == 1) {
                        echo " selected ";
                    }
                    ?>>Masculino</option>
                </select>
            </div>
            <div class="form-group">
                <label>Fecha de Nacimiento:</label>
                <input class="form-control" class="form-control" required="required" type="date" name="txtFecha" value="<?php
                if ($objPersona != null) {
                    echo $objPersona->getFechaNacimiento();
                }
                ?>"/>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Enviar"/>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>

    </div>
</div>
<?php include_once 'footer.php'; ?>