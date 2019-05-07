<?php include_once './header.php';?>
<?php
include_once './BD/DAL/Connection.php';
include_once './BD/DTO/Tablero.php';
include_once './BD/BLL/TableroBLL.php';
include_once './tableromodal.php';
include_once './pinmodal.php';

$tableroBLL = new TableroBLL();
$task = "list";
if (isset($_REQUEST["task"])) {
    $task = $_REQUEST["task"];
}

switch ($task) {
    case "tablero_insert":
        if (isset($_REQUEST["nombre"])) {
            $nombre = $_REQUEST["nombre"];
            $tableroBLL->insert($nombre);

        }
        break;
    case "update":
        if (isset($_REQUEST["idtablero"]) && isset($_REQUEST["nombre"])) {
            $idtablero = $_REQUEST["idtablero"];
            $nombre = $_REQUEST["nombre"];
            $tableroBLL->update($nombre, $idtablero);
        }
        break;
    case "delete":
        if (isset($_REQUEST["idtablero"])) {

            $idtablero = $_REQUEST["idtablero"];
            $tableroBLL->delete($idtablero);
        }
        break;
}
if ($task != 'search') {
    $listaTableros = $tableroBLL->selectAll();
}
?>

<div class="container">
    <div class="col-md-12">

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
foreach ($listaTableros as $objTablero) {
    ?>
                    <tr>
                        <td><?php echo $objTablero->id; ?></td>
                        <td><?php echo $objTablero->nombre; ?></td>
                        <td>   <form method="post" action="index.php" class="form-inline my-2 my-lg-0">
                                 <input type="hidden" value="filtrar_pines" name="task"/>
                                <input   type="hidden" value="<?php echo $objTablero->id; ?>" name="fk">
                                 <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ver Pines</button>
                             </form></td>
                        <td><a href="?tableroid=<?php echo $objTablero->id; ?>"  class="btn btn-info">Editar</a></td>
                        <td >
                            <form method="POST" action="listaTableros.php">
                                <input type="hidden" value="delete" name="task"/>
                                <input type="hidden" value="<?php echo $objTablero->id; ?>" name="idtablero"/>
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
<?php include_once './footer.php';?>