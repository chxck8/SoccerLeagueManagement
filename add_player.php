<?php

    require_once 'init.php';

    if (!empty($_POST)){

        if (isset($_POST['dni'], $_POST['dni_vrf'], $_POST['last_name'], $_POST['first_name'], $_POST['position'], $_POST['number'], $_POST['club'], $_POST['status'])) {
            $dni = $_POST['dni'];
            $dni_vrf = $_POST['dni_vrf'];
            $last_name = $_POST['last_name'];
            $first_name = $_POST['first_name'];
            $position = $_POST['position'];
            $number = $_POST['number'];
            $club = $_POST['club'];
            $status = $_POST['status'];

            $indexed = $es->index([
                'index' => 'players',
                'type' => 'player',
                'body' => [
                    'dni' => $dni,
                    'dni_vrf' => $dni_vrf,
                    'last_name' => $last_name,
                    'first_name'=> $first_name,
                    'position' => $position,
                    'number' => $number,
                    'club' => $club,
                    'status' => $status
                ]
            ]);

            if ($indexed){
                print_r($indexed);
            }
        }
    }
?>
