<?php
include_once './BD/DAL/Connection.php';

$objTablero = null;
if (isset($_GET["tableroid"])) {
    $id = $_REQUEST["tableroid"];
    $tableroBLL = new tableroBLL();
    $objTablero = $tableroBLL->selectbyid($id);
    echo "<script type='text/javascript'>
    $(document).ready(function(){
    $('#tableromodal').modal('show');
    });
    </script>";

}

?>


<!-- Modal -->
<div class="modal fade" id="tableromodal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear Tablero</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="listaTableros.php" method="POST">
                <input type="hidden" name="task" value="<?php echo ($objTablero == null) ? "tablero_insert" : "update"; ?>"/>
                 <input type="hidden" name="idtablero"  value="<?php if ($objTablero != null) {
    echo $objTablero->id;
}?>">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nombre</label>
                        <input name="nombre" required="required" type="text" class="form-control" id="formGroupExampleInput"
                        placeholder="Indica el nombre del tablero"  autocomplete="off" value="<?php if ($objTablero != null) {
    echo $objTablero->nombre;
}?>">
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

