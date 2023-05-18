<?php
    require_once(__DIR__."/sistema.php");

    class Usuario extends Sistema
    {
        public function get($id = null){
            $this->db();
            if (is_null($id)) {
                $sql= "select * from usuario";
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }else {
                $sql = "select * from usuario where id_usuario = :id";
                $st = $this->db->prepare($sql);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            $sql = "insert into usuario (correo, contrasena) values (:correo, md5(:contrasena))";
            $st = $this->db->prepare($sql);
            $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $st->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function delete($id){
            $this->db();
            $sql = "delete from rol_usuario where id_usuario = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $sql2 = "delete from usuario where id_usuario = :id";
            $st2 = $this->db->prepare($sql2);
            $st2->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $st2->execute();
            $rc = $st2->rowCount();
            return $rc;
        }

        public function edit($id, $data){
            $this->db();
            $sql = "update usuario set correo = :correo, contrasena = md5(:contrasena) where id_usuario = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $st->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function getRol($id){
            $this->db();
            $sql = "select u.id_usuario, u.correo, r.id_rol, r.rol from usuario u join rol_usuario ru on u.id_usuario = ru.id_usuario join rol r on ru.id_rol = r.id_rol where u.id_usuario = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function deleteRol($id, $id_rol){
            $this->db();
            $sql = 'delete from rol_usuario where id_usuario = :id_usuario and id_rol = :id_rol';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $st->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function newRol($id, $data){
            $this->db();
            $sql = 'insert into rol_usuario (id_usuario, id_rol) values (:id_usuario, :id_rol)';
            $st = $this->db->prepare($sql);
            $st->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $st->bindParam(':id_rol', $data['id_rol'], PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }
    }
    $usuario = new Usuario;
?>