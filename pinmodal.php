<?php
include_once './BD/DAL/Connection.php';
include_once './BD/DTO/Tablero.php';
include_once './BD/BLL/TableroBLL.php';

$tableroBLL = new TableroBLL();
$listaTableros = $tableroBLL->selectAll();

$objPin = null;
if (isset($_GET["id"])) {

    $id = $_REQUEST["id"];
    $pinBLL = new PinBLL();
    $objPin = $pinBLL->selectbyid($id);
    echo "<script type='text/javascript'>
    $(document).ready(function(){
    $('#myModal').modal('show');
    });
    </script>";

}

?>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear Pin</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="index.php" method="POST">
                <input type="hidden" name="task" value="<?php echo ($objPin == null) ? "insert" : "update"; ?>"/>
                 <input type="hidden" name="id"  value="<?php if ($objPin != null) {
    echo $objPin->id;
}?>">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Sitio Web</label>
                        <input name="url" required="required" type="text" class="form-control" id="formGroupExampleInput"
                        placeholder="Añade la URL con la que enlaza este Pin"  autocomplete="off" value="<?php if ($objPin != null) {
    echo $objPin->url;
}?>">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Titulo</label>
                        <input name="titulo"  required="required"  autocomplete="off" type="text" class="form-control" id="formGroupExampleInput2"
                        placeholder="Di algo más sobre este Pin" value="<?php if ($objPin != null) {
    echo $objPin->titulo;
}?>">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Selecciona el Tablero al que pertenece</label>
                        <select   required="required" class="form-control" name="tablero" required="required">
                        <?php
foreach ($listaTableros as $objTablero) {
    ?>
              <option value="<?php echo $objTablero->id ?>"
            <?php if ($objPin != null && $objPin->fktablero == $objTablero->id) {
        echo 'selected';
    }?>>
              <?php echo $objTablero->nombre ?>
                </option>




     <?php
}
?>
                        </select>
                    </div>
                    <div class="form-group">
    <label for="exampleFormControlFile1">Sube una imagen para tu pin</label>
    <input name='imagen'  <?php if ($objPin == null) {echo 'required';}?>  autocomplete="off" type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>

            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input id="enviar" class="btn btn-primary" type="submit" value="Enviar"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>
<script>

$( "#enviar" ).click(function() {
    window.location = "http://localhost:8090/pruebadatos";
});
</script>

