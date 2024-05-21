<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <nav class="container-fluid nav-menu-top">
        <section class="row p-3">
            <div class="text-center text-white d-flex justify-content-center">
                <h3 class="d-flex">
                    <form action="index.php" method="get">
                    <?php
                        $prevMonth = clone $data;
                        $prevMonth->modify('-1 month');
                    ?>
                        <input type="hidden" name="set_data" value="<?=$prevMonth->format('Y-m-d')?>">
                        <button class="btn-nav-month"> <i class="fa fa-chevron-left"></i></button>
                    </form>
                     CALENDÁRIO 
                    <form action="index.php" method="get">
                    <?php
                        $nextMonth = clone $data;
                        $nextMonth->modify('+1 month');
                    ?>
                        <input type="hidden" name="set_data" value="<?=$nextMonth->format('Y-m-d')?>">
                        <button class="btn-nav-month"> <i class="fa fa-chevron-right"></i></button>
                    </form>
                </h3>
            </div>
        </section>
    </nav>
