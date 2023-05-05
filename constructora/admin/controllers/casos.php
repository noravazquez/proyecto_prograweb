<?php
    require_once("sistema.php");

    class Casos extends Sistema{
        public function get($id = null){
            $this->db();
            if (is_null($id)) {
                $sql= "select * from casos_exito";
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }else {
                $sql = "select * from casos_exito ce where ce.id_caso = :id";
                $st = $this->db->prepare($sql);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            echo ($data);
            die();
            $sql = "INSERT INTO casos_exito (caso_exito, descripcion, resumen, imagen, activo) VALUES (:caso_exito, :descripcion, :resumen, :imagen, :activo)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":caso_exito", $data['caso_exito'], PDO::PARAM_STR);
            $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $st->bindParam(":resumen", $data['resumen'], PDO::PARAM_STR);
            $st->bindParam(":imagen", $data['imagen'], PDO::PARAM_STR);
            $st->bindParam(":activo", $data['activo'], PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }
    }

    $caso = new Casos;
?>