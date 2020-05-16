<?php

$buyers = json_decode(file_get_contents('../data.json'), true)['buyers'];

switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':

            // The data-source is a json file, so I had to implement two simulated 'select' statments here

            if (isset($_GET['ID'])){ // select * from buyers where ID = $_GET['ID'] limit 1
                foreach ($buyers as $buyer){
                    if ($buyer['ID'] == $_GET['ID']) {
                        echo json_encode([$buyer]);
                        break;
                    }
                }
            } else if (isset($_GET['Name'])){ // select * from buyers where Name like ('%' + $_GET['Name'] + '%')
                $result = [];
                foreach ($buyers as $buyer){
                    if (strpos($buyer['Name'], $_GET['Name']) !== false) {
                        $result[] = $buyer;
                    }
                }
                echo json_encode($result);
            }
            else {
                echo 0;
            }
            break;
        case 'POST':

            $buyer = json_decode(file_get_contents('php://input'), true);

            // This section would contain the 'insert' or 'update' statements

            // If ID is set then update

            // Otherwise insert new row

            break;
        case 'DELETE':

            if (isset($_GET['ID'])){
                // And a delete statement where ID = $_GET['ID']
            }

            break;
    }