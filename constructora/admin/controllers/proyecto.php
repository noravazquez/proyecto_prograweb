<?php
    require_once("sistema.php");

    class Proyecto extends Sistema
    {
        public function get($id = null){
            $this->db();
            if (is_null($id)) {
                $sql= "select * from proyecto p left join departamento d on p.id_departamento = d.id_departamento";
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }else {
                $sql = "select * from proyecto p left join departamento d on p.id_departamento = d.id_departamento where p.id_proyecto = :id";
                $st = $this->db->prepare($sql);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            $nombrearchivo = str_replace(" ","_", $data['proyecto']);
            $nombrearchivo = substr($nombrearchivo, 0,20);
            $sql = "insert into proyecto (proyecto, descripcion, fecha_inicio, fecha_fin, id_departamento) values (:proyecto, :descripcion, :fecha_inicio, :fecha_fin, :id_departamento)";
            $sesubio = $this->uploadfile("archivo", 'uploads/proyectos/', $nombrearchivo);
            if ($sesubio) {
                $sql = "insert into proyecto (proyecto, descripcion, fecha_inicio, fecha_fin, id_departamento, archivo) values (:proyecto, :descripcion, :fecha_inicio, :fecha_fin, :id_departamento, :archivo)";
            }
            $st = $this->db->prepare($sql);
            $st->bindParam(":proyecto", $data['proyecto'], PDO::PARAM_STR);
            $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $st->bindParam(":fecha_inicio", $data['fecha_inicio'], PDO::PARAM_STR);
            $st->bindParam(":fecha_fin", $data['fecha_fin'], PDO::PARAM_STR);
            $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
            if ($sesubio) {
                $st->bindParam(":archivo", $sesubio, PDO::PARAM_STR);
            }
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function delete($id){
            $this->db();
            $sql = "delete from tarea where id_proyecto = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $sql = "delete from proyecto where id_proyecto = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function edit($id, $data){
            $archivo_fijo = "ruta/";
            $this->db();
            $nombrearchivo = str_replace(" ","_", $data['proyecto']);
            $nombrearchivo = substr($nombrearchivo, 0,20);
            $nombrearchivo = $this->uploadfile("archivo", 'uploads/proyectos/', $nombrearchivo);
            if ($nombrearchivo) {
                $sql = "update proyecto set proyecto = :proyecto, descripcion = :descripcion, fecha_inicio =  :fecha_inicio, fecha_fin = :fecha_fin, id_departamento = :id_departamento, archivo = :archivo where id_proyecto = :id";
            }else {
                $sql = "update proyecto set proyecto = :proyecto, descripcion = :descripcion, fecha_inicio =  :fecha_inicio, fecha_fin = :fecha_fin, id_departamento = :id_departamento where id_proyecto = :id";
            }
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->bindParam(":proyecto", $data['proyecto'], PDO::PARAM_STR);
            $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $st->bindParam(":fecha_inicio", $data['fecha_inicio'], PDO::PARAM_STR);
            $st->bindParam(":fecha_fin", $data['fecha_fin'], PDO::PARAM_STR);
            $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
            
            if ($nombrearchivo) {
                $st->bindParam(":archivo", $nombrearchivo, PDO::PARAM_STR);
            }
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function getTask($id = null){
            $this->db();
            if (is_null($id)) {
                $sql = "select * from tarea t left join proyecto p on p.id_proyecto = t.id_proyecto";
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }else {
                $sql = "select * from tarea t left join proyecto p on p.id_proyecto = t.id_proyecto where t.id_proyecto = :id";
                $st = $this->db->prepare($sql);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function deleteTask($id){
            $this->db();
            $sql = "delete from tarea where id_tarea=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function newTask ($id, $data)
        {
            $this->db();
            $sql = "insert into tarea (id_proyecto, tarea, avance) values (:id_proyecto, :tarea, :avance)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id_proyecto", $id, PDO::PARAM_INT);
            $st->bindParam(":tarea", $data['tarea'], PDO::PARAM_STR);
            $st->bindParam(":avance", $data['avance'], PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }

        public function getTaskOne($id){
            $data=null;
            $this->db();
            if (is_null($id)) {
                die("Ocurrio un error");
            }else {
                $sql = "select * from tarea t left join proyecto p on p.id_proyecto = t.id_proyecto where t.id_tarea = :id";
                $st = $this->db->prepare($sql);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function editTask($id, $id_tarea, $data)
        {
            $this->db();
            $sql = "update tarea set tarea = :tarea, avance = :avance where id_tarea = :id_tarea and id_proyecto = :id_proyecto";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id_proyecto", $id, PDO::PARAM_INT);
            $st->bindParam(":id_tarea", $id_tarea, PDO::PARAM_INT);
            $st->bindParam(":tarea", $data['tarea'], PDO::PARAM_STR);
            $st->bindParam(":avance", $data['avance'], PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            return $rc;
        }
    }
    $proyecto = new Proyecto;
?>