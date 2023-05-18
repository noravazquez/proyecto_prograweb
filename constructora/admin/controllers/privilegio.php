<?php 
require_once(__DIR__."/sistema.php");

class Privilegio extends Sistema
{
    public function get($id = null){
        $this->db();
        if (is_null($id)) {
            $sql = 'select * from privilegio';
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = 'select * from privilegio where id_privilegio = :id';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
}

$privilegio = new Privilegio;
?>