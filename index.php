<?php include_once './header.php';?>
<?php
include_once './BD/DAL/Connection.php';
include_once './BD/DTO/Pin.php';
include_once './BD/BLL/PinBLL.php';
include_once './BD/BLL/TableroBLL.php';

include_once './tableromodal.php';
include_once './pinmodal.php';

$pinBLL = new PinBLL();
$tableroBLL = new TableroBLL();
$task = "list";
if (isset($_REQUEST["task"])) {
    $task = $_REQUEST["task"];
}
switch ($task) {

    case "insert":
        if (isset($_REQUEST["url"]) && isset($_REQUEST["titulo"]) && isset($_REQUEST["tablero"]) && isset($_FILES["imagen"])) {
            $url = $_REQUEST["url"];
            $titulo = $_REQUEST["titulo"];
            $tablero = $_REQUEST["tablero"];
            //Insertando Imagen
            $path = "assets/imgs/";
            $path = $path . basename($_FILES['imagen']['name']);
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $path)) {
                $pinBLL->insert($titulo, $path, $url, (int) $tablero);
            } else {
                echo "There was an error uploading the file, please try again!";
            }
        }
        break;
    case "update":
        if (isset($_REQUEST["url"]) && isset($_REQUEST["titulo"]) && isset($_REQUEST["tablero"]) && isset($_REQUEST["id"])) {
            $url = $_REQUEST["url"];
            $titulo = $_REQUEST["titulo"];
            $tablero = $_REQUEST["tablero"];
            $id = $_REQUEST["id"];
            if (basename($_FILES['imagen']['name']) != '') {
                $path = "assets/imgs/";
                $path = $path . basename($_FILES['imagen']['name']);
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $path)) {
                    $pinBLL->update($titulo, $path, $url, $tablero, $id);
                } else {
                    echo "There was an error uploading the file, please try again!";
                }
            }
            // if (isset($_FILES["imagen"])) {

            // }
            $path = '';
            $pinBLL->updateni($titulo, $url, $tablero, $id);
        }
        break;
    case "delete":
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $pinBLL->delete((int) $id);
        }
        break;
    case "search":
        if (isset($_REQUEST["q"])) {
            $q = $_REQUEST["q"];
            $listaPines = $pinBLL->search($q);
        }
        break;
    case "filtrar_pines":
        if (isset($_REQUEST["fk"])) {
            $q = $_REQUEST["fk"];
            $listaPines = $pinBLL->selectbytablero($q);
        }
        break;
}
if ($task != 'search' && $task != 'filtrar_pines') {
    $listaPines = $pinBLL->selectAll();
}
?>



         <div id="columns">
     <?php

foreach ($listaPines as $objPin) {
    ?>
                 <div class="container">
                <a href="<?php echo $objPin->url; ?>">
                <figure >
                        <img  class="image"  src="<?php echo $objPin->imagen; ?>" >
                        <div class="overlay">
                            <a   href="<?php echo $objPin->url; ?>"  >
                                <i  class="far fa-eye icon"></i>
                            </a>
                        <a class="edit"  href="?id=<?php echo $objPin->id; ?>"  >
                            <i style="margin-left:40px;"  class="far fa-edit icon"></i>
                            </a>
                            <form method="POST" action="index.php">
                                <input type="hidden" value="delete" name="task"/>
                                <input type="hidden" value="<?php echo $objPin->id; ?>" name="id"/>
                                <button style="background:transparent;border-style:none"  type="submit" class="btnEliminar">
                                <a href="#" class="edit">
                                <i style="margin-left:70px;" class="far fa-trash-alt icon "></i>
                                </a>
                                 </button>
                            </form>

                        </div>
	                    <figcaption><?php echo $objPin->titulo; ?></figcaption>
	            </figure>
                </a>
                </div>







     <?php
}
?>
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