<?php
require_once(__DIR__."/sistema.php");

class Factura extends Sistema
{
    public function new ($data)
        {
            $this->db();
            $sql = "insert into facturas (data) values (:data)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":data", $data);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }
}
$factura = new Factura;
?>