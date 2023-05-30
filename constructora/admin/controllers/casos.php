<?php
    require_once(__DIR__."/sistema.php");

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
            $nombrearchivo = str_replace(" ","_", $data['caso_exito']);
            $nombrearchivo = substr($nombrearchivo, 0,20);
            $activo = isset($_POST['activo']) && $_POST['activo'] == 1 ? 1 : 0;
            $sql = "INSERT INTO casos_exito (caso_exito, descripcion, resumen, imagen, activo) VALUES (:caso_exito, :descripcion, :resumen, :imagen, :activo)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":caso_exito", $data['caso_exito'], PDO::PARAM_STR);
            $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $st->bindParam(":resumen", $data['resumen'], PDO::PARAM_STR);
            $secargo = $this->uploadfile("imagen", 'images/', $nombrearchivo);
            $imagen = "images/default-image.png";
            if ($secargo) {
                $imagen = $secargo;
            }
            $st->bindParam(":imagen", $imagen, PDO::PARAM_STR);
            $st->bindParam(":activo", $activo, PDO::PARAM_INT);
            $st->execute();
            try {
                $rc = $st->rowCount();
                return $rc;
            } catch(PDOException $e) {
                echo $e->getMessage(); // Imprime el mensaje de error
            }
        }

        public function delete($id){
            $this->db();
            $sql = "delete from casos_exito where id_caso = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function edit($id, $data){
            $this->db();
            $nombrearchivo = str_replace(" ","_", $data['caso_exito']);
            $nombrearchivo = substr($nombrearchivo, 0,20);
            $secargo = $this->uploadfile("imagen", 'images/', $nombrearchivo);
            $activo_actual = 0; //definir la variable fuera del if
            if (isset($data['activo']) && $data['activo'] == '1') {
                $activo_actual = 1; //asignar un valor si la casilla está marcada
            }
            if (isset($_POST['activo']) && $_POST['activo'] == '1') {
                $activo_nuevo = 1;
            } else {
                $activo_nuevo = 0;
            }
            if ($secargo) {
                $sql = "update casos_exito set caso_exito = :caso_exito, descripcion = :descripcion, resumen =  :resumen, activo = :activo, imagen = :imagen where id_caso = :id";
            }else {
                $sql = "update casos_exito set caso_exito = :caso_exito, descripcion = :descripcion, resumen =  :resumen, activo = :activo where id_caso = :id";
            }
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->bindParam(":caso_exito", $data['caso_exito'], PDO::PARAM_STR);
            $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $st->bindParam(":resumen", $data['resumen'], PDO::PARAM_STR);
            if ($secargo) {
                $st->bindParam(":imagen", $secargo, PDO::PARAM_STR);
            }
            if ($activo_nuevo != $activo_actual) {
                $st->bindParam(":activo", $activo_nuevo, PDO::PARAM_INT);
            }else {
                $st->bindParam(":activo", $activo_actual, PDO::PARAM_INT);
            }
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }
    }
    $caso = new Casos;
?>