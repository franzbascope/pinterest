<?php

/**
 * Description of Connection
 *
 * @author fbj
 */
class Connection
{

    private $server = "localhost";
    private $usr = "jmacboy_fb";
    private $pass = "franzbascope!123";
    private $db = "jmacboy_franzbascope";
    private $connection;

    public function getConnection()
    {
        if ($this->connection == null) {
            $this->connection = new PDO("mysql:host=$this->server;dbname=$this->db", $this->usr, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return $this->connection;
    }

    public function query($csql)
    {
        return $this->getConnection()->query($csql);
    }

    public function queryWithParams($csql, $paramArray)
    {
        $q = $this->getConnection()->prepare($csql);
        $q->execute($paramArray);
        return $q;
    }

}
