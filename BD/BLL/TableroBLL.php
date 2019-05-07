<?php
include_once './tableromodal.php';
/**
 * Description of TelefonoBLL
 *
 * @author jmacb
 */
class TableroBLL
{

    private $tableName = "tbl_tablero";

    public function insert($nombre)
    {
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
             CALL usp_tablero_insert
                (:nombre)", array(
            ":nombre" => $nombre,
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $ultimoId = $row["ultimoId"];
        return $ultimoId;
    }

    public function update($nombre, $p_id)
    {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            CALL usp_tablero_update
                (:nombre,
                :p_id)", array(
            ":nombre" => $nombre,
            ":p_id" => $p_id,
        ));
    }

    public function delete($id)
    {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            CALL usp_tablero_delete
                (:pid)", array(
            ":pid" => $id,
        ));
    }

    public function selectbyid($id)
    {
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
            CALL usp_tablero_selectbyid
                (:id)", array(
            ":id" => $id,
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objTablero = $this->rowToDto($row);
        return $objTablero;
    }

    public function selectAll()
    {
        $objConexion = new Connection();
        $res = $objConexion->query("
            CALL usp_tablero_selectall()");
        $listaTableros = array();

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $objTablero = $this->rowToDto($row);
            $listaTableros[] = $objTablero;
        }

        return $listaTableros;
    }

    public function rowToDto($row)
    {
        $objTablero = new Tablero();
        $objTablero->id = ($row["id"]);
        $objTablero->nombre = ($row["nombre"]);
        return $objTablero;
    }

}
