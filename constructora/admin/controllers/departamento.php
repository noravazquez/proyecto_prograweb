<?php
    require_once(__DIR__."/sistema.php");

    class Departamento extends Sistema
    {
        public function get($id = null)
        {
            $this->db();
            if (is_null($id)) {
                $sql = "select * from departamento";
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = "select * from departamento where id_departamento = :id";
                $st = $this->db->prepare($sql);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data)
        {
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "INSERT INTO departamento (departamento) VALUES (:departamento)";
                $st = $this->db->prepare($sql);
                $st->bindParam(":departamento", $data['departamento'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }


        public function edit($id, $data)
{
    $this->db();

    try {
        $this->db->beginTransaction();

        $sql = "UPDATE departamento SET departamento = :departamento WHERE id_departamento = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":departamento", $data['departamento'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();

        $this->db->commit();

        return $rc;
    } catch (PDOException $e) {
        $this->db->rollBack();
        throw $e;
    }
}

        
        public function delete($id)
{
    $this->db();

    try {
        $this->db->beginTransaction();

        $sql = "DELETE FROM departamento WHERE id_departamento = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();

        $this->db->commit();

        return $rc;
    } catch (PDOException $e) {
        $this->db->rollBack();
        throw $e;
    }
}


    }
    $departamento = new Departamento;
?>