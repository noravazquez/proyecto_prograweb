<?php
require_once(__DIR__."/sistema.php");

class Rol extends Sistema
{
    public function get($id = null){
        $this->db();
        if (is_null($id)) {
            $sql = 'select * from rol';
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }else {
            $sql = 'select * from rol where id_rol = :id';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function new($data){
        $this->db();
        $sql = 'insert into rol (rol)  values (:rol)';
        $st = $this->db->prepare($sql);
        $st->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id){
        $this->db();
        $sql = 'delete from rol_privilegio where id_rol = :id';
        $st = $this->db->prepare($sql);
        $st->bindParam(':id', $id, PDO::PARAM_INT);
        $sql2 = 'delete from rol_usuario where id_rol = :id';
        $st2 = $this->db->prepare($sql2);
        $st2->bindParam(':id', $id, PDO::PARAM_INT);
        $sql3 = 'delete from rol where id_rol = :id';
        $st3 = $this->db->prepare($sql3);
        $st3->bindParam(':id', $id, PDO::PARAM_INT);
        $st->execute();
        $st2->execute();
        $st3->execute();
        $rc = $st3->rowCount();
        return $rc;
    }

    public function edit($id, $data){
        $this->db();
        $sql = 'update rol set rol = :rol where id_rol = :id';
        $st = $this->db->prepare($sql);
        $st->bindParam(':id', $id, PDO::PARAM_INT);
        $st->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function getPrivilegio($id){
        $this->db();
        $sql = 'select r.id_rol, r.rol, p.id_privilegio, p.privilegio from rol r join rol_privilegio rp on r.id_rol = rp.id_rol join privilegio p on rp.id_privilegio = p.id_privilegio where r.id_rol = :id';
        $st = $this->db->prepare($sql);
        $st->bindParam(':id', $id, PDO::PARAM_INT);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function deletePrivilegio($id, $id_privilegio){
        $this->db();
        $sql = 'delete from rol_privilegio where id_rol = :id_rol and id_privilegio = :id_privilegio';
        $st = $this->db->prepare($sql);
        $st->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $st->bindParam(':id_privilegio', $id_privilegio, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newPrivilegio($id, $data){
        $this->db();
        $sql = 'insert into rol_privilegio (id_rol, id_privilegio) values (:id_rol, :id_privilegio)';
        $st = $this->db->prepare($sql);
        $st->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $st->bindParam(':id_privilegio', $data['id_privilegio'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$rol = new Rol;
?>