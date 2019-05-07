<?php include_once './header.php'; ?>
<?php
include_once './BD/DAL/Connection.php';
include_once './BD/DTO/Telefono.php';
include_once './BD/BLL/TelefonoBLL.php';
include_once './BD/DTO/Persona.php';
include_once './BD/BLL/PersonaBLL.php';

$telefonoBLL = new TelefonoBLL();
$task = "list";
if (isset($_REQUEST["task"])) {
    $task = $_REQUEST["task"];
}

switch ($task) {
    case "insert":
        if (isset($_REQUEST["idPersona"]) && isset($_REQUEST["txtTelefono"])) {

            $idPersona = $_REQUEST["idPersona"];
            $telefono = $_REQUEST["txtTelefono"];
            $telefonoBLL->insert($idPersona, $telefono);
        }
        break;
    case "update":
        if (isset($_REQUEST["idPersona"]) && isset($_REQUEST["txtTelefono"]) && isset($_REQUEST["id"])) {

            $idPersona = $_REQUEST["idPersona"];
            $telefono = $_REQUEST["txtTelefono"];
            $id = $_REQUEST["id"];
            $telefonoBLL->update($idPersona, $telefono, $id);
        }
        break;
    case "delete":
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $telefonoBLL->delete($id);
        }
        break;
    case "search":
        if (isset($_REQUEST["q"])) {
            $q = $_REQUEST["q"];
            $listaTelefonos = $telefonoBLL->search($q);
        }
        break;
}
if ($task != 'search') {
    $idPersona = $_REQUEST["idPersona"];
    $listaTelefonos = $telefonoBLL->selectByIdPersona($idPersona);
}
?>

<div class="container">
    <div class="col-md-12">

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Persona</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listaTelefonos as $objTelefono) {
                    ?>
                    <tr>
                        <td><?php echo $objTelefono->getId(); ?></td>
                        <td><?php
                            $objPersona = $objTelefono->getPersona();
                            echo $objPersona->getNombres() . " " . $objPersona->getApellidos();
                            ?></td>
                        <td><?php echo $objTelefono->getTelefono(); ?></td>
                        <td>
                            <a href="formInsertarTelefono.php?id=<?php echo $objTelefono->getId(); ?>" class="btn btn-info">Editar</a>
                        </td>
                        <td>
                            <form method="POST" action="listaTelefonos.php">
                                <input type="hidden" value="delete" name="task"/>
                                <input type="hidden" value="<?php echo $objTelefono->getIdPersona(); ?>" name="idPersona"/>
                                <input type="hidden" value="<?php echo $objTelefono->getId(); ?>" name="id"/>
                                <input type="submit" class="btn btn-danger btnEliminar" value="Eliminar"/>
                            </form>
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.btnEliminar').on('click', function () {
            var confirmacion = confirm("Está seguro que desea eliminar?");
            return confirmacion;
        });
    });
</script>
<?php include_once './footer.php'; ?>