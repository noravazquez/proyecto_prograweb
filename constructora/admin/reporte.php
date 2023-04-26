<?php
    require_once('controllers/sistema.php');
    require_once ('../vendor/autoload.php');
    use Spipu\Html2Pdf\Html2Pdf;
    $html2pdf = new Html2Pdf();

    $action = (isset($_GET['action'])) ? $_GET['action'] : null;
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;

    $sistema->db();

    switch ($action) {
        case 'proyecto':
                $sql = "select * from vw_proyecto where id_proyecto = :id_proyecto";
                $st = $sistema->db->prepare($sql);
                $st->bindParam(":id_proyecto", $id, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
                $html="
                    <div class = 'row'>
                        <div class='col-4'>
                        <img src='images/logo.jpg'>
                        </div>
                        <div class='col-8'>
                            <h3 align=center >Constructora NSVD</h3>
                        </div>
                    </div>
                ";
                $html.="<h4 style='color:red'>Departamento: ".$data[0]['departamento']."</h4>";
                $html.="<h4 style='color:blue'>Proyecto: ".$data[0]['proyecto']."</h4>";
                $html.="<p style='color:blue'>Descripcion proyecto: ".$data[0]['descripcion']."</p>";
                $html.="<p>Fecha inicio: ".$data[0]['fecha_inicio']." Fecha fin: ".$data[0]['fecha_fin']."</p>";
                $html.="<h5>Tareas: </h5>";
                $html.="
                    <table>
                    <thead>
                        <tr>
                            <th>Tarea</th>
                            <th>Porcentaje de avance</th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
                foreach ($data as $key => $value):
                $html.="<tr>
                        <td>1</td>
                        <td>Hola</td>
                        <td>10</td>
                    </tr>
                    </tbody>";
                endforeach;
                $html.="        
                    </table>
                ";
            break;
        
        default:
            $html='<h1>Sin reporte</h1>No hay ningun reporte para generar';
            break;
    }
    $html2pdf->writeHTML($html);
    $html2pdf->output();
?>