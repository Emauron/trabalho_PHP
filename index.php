<?php 
date_default_timezone_set('America/Sao_Paulo');
include 'conn.php'; 
session_start();

$id_usuario = (isset($_SESSION['id']) && $_SESSION['id'] != NULL) ? $_SESSION['id'] : header ('location: login_register.php') ;
$nome = (isset($_SESSION['nome']) && $_SESSION['nome'] != NULL) ? $_SESSION['nome'] : '' ;

$set_data = (isset($_REQUEST['set_data']) || $_REQUEST != NULL) ? $_REQUEST['set_data'] : '';
if((isset($_REQUEST['add-task']) && $_REQUEST['add-task'] != NULL) && $_REQUEST['add-task'] != ''){
    $task = $_REQUEST['add-task'];
    $sqlData = "INSERT INTO tasks (task, data_task, id_usuario) VALUES ('$task', '$set_data', $id_usuario);";
    actionDB($sqlData);
}
if((isset($_REQUEST['remove-task']) && $_REQUEST['remove-task'] != NULL) && $_REQUEST['remove-task'] != ''){
    $id = $_REQUEST['remove-task'];
    $sqlData = "DELETE FROM `tasks` WHERE id = $id";
    actionDB($sqlData);
}

if($set_data == ''){
    $data = new DateTime();  
}else{
    $data = new DateTime(date($set_data));
    $_SESSION['set_data'] = $set_data;
}

include 'menu.php';

$month = $data->format('m');
$day = $data->format('d');
$dayWeek = $data->format('w');

$year = $data->format('Y');

$firstDmonth = clone $data;
$firstDmonth->modify('first day of this month');

$lastDmonth = clone $data;
$lastDmonth->modify('last day of this month');

$daysMonth = [];

for ($loadDay = clone $firstDmonth; $loadDay <= $lastDmonth; $loadDay->modify('+1 day')) {
    $dayOfMonth = $loadDay->format('j') ; 
    $firstDayWeekDay = $firstDmonth->format('w'); 
    $weekOfMonth = (($dayOfMonth + $firstDayWeekDay - 1) / 7) + 1; 
    if (!isset($daysMonth[$weekOfMonth])) {
        $daysMonth[$weekOfMonth] = []; 
    }
    $dayOfWeek =  $loadDay->format('w'); 
    $daysMonth[$weekOfMonth][$dayOfWeek] = "$dayOfWeek"; 
}
function convertIntDay($num){
    switch($num){
        case 0:
            return  "domingo";
        case 1:
            return  "segunda";
            break;
        case 2:
            return  "terça";
            break;
        case 3:
            return  "quarta";
            break;
        case 4:
            return "quinta";
            break;
        case 5:
            return  "sexta";
            break;
        case 6:
            return  "sabado";
            break;
        default:
            echo 'error';
    }
}
$dayWeek = convertIntDay($data->format('w'));
function convertIntMonth($num){
    switch($num){
        case '1':
            return  "Janeiro";
            break;
        case '2':
            return  "Fevereiro";
            break;
        case '3':
            return  "Maio";
            break;
        case '4':
            return  "Abril";
            break;
        case '5':
            return  "Março";
            break;
        case '6':
            return  "Junho";
            break;
        case '7':
            return  "Julho";
            break;
        case '8':
            return  "Agosto";
            break;
        case '9':
            return  "Setembro";
            break;
        case '10':
            return  "Outubro";
            break;
        case '11':
            return  "Novembro";
            break;
        case '12':
            return  "Dezembro";
            break;
        default :
            
    }
}
?>
<section class="row">
    <?php include 'menu_lateral.php'; ?>
    <div class="col col-md-9" style="padding:0;">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <td class="text-center bg-dark" colspan=7>
                        <h4><strong><?=mb_strtoupper(convertIntMonth($month), 'UTF-8');?></strong></h4>
                    </td>
                </tr>
                <tr>
                <?php
                    for($i = 0; $i < 7; $i++){
                        $templateDay = convertIntDay($i);
                ?>
                    <td class="text-center">
                        <h5><strong><?=mb_strtoupper($templateDay, 'UTF-8');?></strong></h5>
                    </td>
                <?php
                    }
                ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    $contDays = 1;
                    for($i = 1; $i <= 6; $i++){
                ?>
                    <tr>
                    <?php
                        for($y = 0; $y <= 6; $y++){
                    ?>
                        <td class="text-center">
                            <div class="cell d-flex justify-content-center align-content-center">
                                <?php
                                    if(isset($daysMonth[$i][$y]) && $daysMonth[$i][$y] == $y){
                                        if($contDays == $day){
                                            echo "<h5 class='text-danger'>$contDays</h5>";
                                        }else {
                                            echo "<h5>$contDays</h5>";
                                        }
                                        $contDays++;
                                        
                                    }
                                ?>
                            </div>
                        </td>
                    <?php
                        }
                    ?>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center" colspan = 7>
                        <h4><strong><?=$year?></strong></h4>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</section>
