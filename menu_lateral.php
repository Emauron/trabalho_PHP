<?php
    $data_menu = (isset($_SESSION['set_data']) && $_SESSION['set_data'] != NULL) ? $_SESSION['set_data'] : '';
?>
<div class="menu-lateral col col-md-3">
    <div class="col col-md-12 p-3 ms-2">
        <form action="index.php" method="get" class="d-flex justify-content-center align-items-center">
            <input type="date" name="set_data" id="set_data" value="<?=($data_menu != null) ? $data_menu : '';?>">
            <button class="btn btn-info btn-search"><i class="fa fa-search text-white"></i></button>
        </form>
    </div>
    <div class="col col-md-12 p-3 bg-dark ms-2">
        <h4 class="text-white text-center">ATIVIDADES <?php echo $day . '/' . $month . '/' . '' . $year?></h4>
        <div >
            <ul>
            <?php
                $sqlTasks    = "SELECT id, task FROM tasks WHERE data_task = '$data_menu' AND id_usuario = $id_usuario;";
                $resultTasks = $PDO->query($sqlTasks);
                while($consultaTasks = $resultTasks->fetch(PDO::FETCH_OBJ)){
            ?>
                <li class="text-white list-tasks">
                    <form action="index.php?set_data=<?=$data_menu?>" method="post" class="d-flex justify-content-between align-items-center">
                        <p><?=$consultaTasks->task?></p>
                        <input type="hidden" name="remove-task" value="<?=$consultaTasks->id?>">
                        <button class="btn btn-danger btn-remove-task">
                            <i class="fa fa-times"></i>
                        </button>
                    </form>
                </li>
            <?php
                }
            ?>
            </ul>
        </div>
        <form action="index.php?set_data=<?=$data_menu?>" method="post" class="d-flex justify-content-center align-items-center">
            <input type="text" name="add-task" id="add-task">
            <button class="btn btn-success btn-add-task"><i class="fa fa-plus text-white"></i></button>
        </form>
    </div>
</div>
