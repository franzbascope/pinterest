<?php

/**
 * Description of PersonaBLL
 *
 * @author fbj
 */
class PinBLL
{

    private $tableName = "tbl_pin";

    public function insert($titulo, $imagen, $url, $fktablero)
    {
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
             CALL usp_pin_insert
                (:titulo,
                :imagen,
                :url,
                :fktablero)", array(
            ":titulo" => $titulo,
            ":imagen" => $imagen,
            ":url" => $url,
            ":fktablero" => $fktablero,
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $ultimoId = $row["ultimoId"];
        return $ultimoId;
    }

    public function update($titulo, $imagen, $url, $fktablero, $id)
    {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            CALL usp_pin_update
                (:titulo,
                :imagen,
                :url,
                :fktablero,
                :p_id)", array(
            ":titulo" => $titulo,
            ":imagen" => $imagen,
            ":url" => $url,
            ":fktablero" => $fktablero,
            ":p_id" => $id,
        ));
    }

    public function updateni($titulo, $url, $fktablero, $id)
    {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            CALL usp_pin_updateni
                (:p_id,
                :titulo,
                :url,
                :fktablero)", array(
            ":p_id" => $id,
            ":titulo" => $titulo,
            ":url" => $url,
            ":fktablero" => $fktablero,
        ));
    }

    public function selectbyid($id)
    {
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
            CALL usp_pin_selectbyid
                (:id)", array(
            ":id" => $id,
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objPin = $this->rowToDto($row);
        return $objPin;
    }

    public function selectAll()
    {
        $objConexion = new Connection();
        $res = $objConexion->query("
            CALL usp_pin_selectall");
        $listaPines = array();

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $objPin = $this->rowToDto($row);
            $listaPines[] = $objPin;
        }

        return $listaPines;
    }

    public function selectbytablero($id)
    {
        $listaPines = [];
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
            CALL usp_tablero_selectpines
                (:id)", array(
            ":id" => $id,
        ));
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $objPin = $this->rowToDto($row);
            $listaPines[] = $objPin;
        }
        return $listaPines;
    }

    public function search($query)
    {
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
            CALL usp_pin_search(:pSearch)", array(
            ":pSearch" => $query,
        ));
        $listaPines = array();

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $objPin = $this->rowToDto($row);
            $listaPines[] = $objPin;
        }

        return $listaPines;
    }

    public function delete($id)
    {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            CALL usp_pin_delete
                (:pid)", array(
            ":pid" => $id,
        ));
    }

    public function rowToDto($row)
    {
        $objPin = new Pin();
        $objPin->id = ($row["id"]);
        $objPin->titulo = ($row["titulo"]);
        $objPin->imagen = ($row["imagen"]);
        $objPin->url = ($row["url"]);
        $objPin->fktablero = ($row["fktablero"]);
        return $objPin;
    }

}
