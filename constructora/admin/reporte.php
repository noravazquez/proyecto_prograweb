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
                    <div style='text-align:center;'>
                        <img src='images/logo_constructora.png' style='display:block; margin:0 auto; width: 25%;'>
                    </div>
                    <h1 style='border-top: 1px solid  #5D6975; border-bottom: 1px solid  #5D6975; color: #5D6975; font-size: 2.4em; line-height: 1.4em; font-weight: normal; text-align: center; margin: 0 0 20px 0; background: url(images/dimension.png);'>
                        INVOICE 3-2-1
                    </h1>
                ";
                /*
                <h1>INVOICE 3-2-1</h1>
                    <div id='company' class='clearfix'>
                    <div>Company Name</div>
                    <div>455 Foggy Heights,<br /> AZ 85004, US</div>
                    <div>(602) 519-0450</div>
                    <div><a href='mailto:company@example.com'>company@example.com</a></div>
                    </div>
                    <div id='project'>
                    <div><span>PROJECT</span> Website development</div>
                    <div><span>CLIENT</span> John Doe</div>
                    <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
                    <div><span>EMAIL</span> <a href='mailto:john@example.com'>john@example.com</a></div>
                    <div><span>DATE</span> August 17, 2015</div>
                    <div><span>DUE DATE</span> September 17, 2015</div>
                    </div>
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
                ";*/
            break;
        
        default:
            $html='<h1>Sin reporte</h1>No hay ningun reporte para generar';
            break;
    }
    $html2pdf->writeHTML($html);
    $html2pdf->output();
?>