<?php
    require_once(__DIR__."/sistema.php");

    class Empleado extends Sistema{
        public function get($id = null){
            $this->db();
            if (is_null($id)) {
                $sql="select * from empleado e left join departamento d on e.id_departamento = d.id_departamento";
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql="select * from empleado e left join departamento d on e.id_departamento = d.id_departamento where e.id_empleado = :id";
                $st = $this->db->prepare($sql);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
        try {
            
            $this->db->beginTransaction();
            $sql = "INSERT INTO empleado (nombre, primer_apellido, segundo_apellido,
            fecha_nacimiento, rfc, curp,foto,id_departamento) 
            VALUES (:nombre, :primer_apellido, :segundo_apellido, :fecha_nacimiento, 
            :rfc, :curp,:foto, :id_departamento)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
            $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
            $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
            $st->bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);
            $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
            $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
            $st->bindParam(":foto", $data['foto'], PDO::PARAM_LOB); 
            $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
            if($st->execute()){
                
                $rc = $st->rowCount();
            $this->db->commit();
            }else{
                echo "No se pudo";
                print_r($st->errorInfo());
            }
            
        } catch (PDOException $Exception) {
            $rc = 0;
            //print "DBA FAIL:" . $Exception->getMessage();
            $this->db->rollBack();
        }
        return $rc;
        }

        public function convImgToBlob($path)
    {
        $mimetype = "image/".pathinfo($path,PATHINFO_EXTENSION);
        $source = file_get_contents($path);
        $base64 = base64_encode($source);
        return  $source;
    }
    }
    $empleado = new Empleado;
?>