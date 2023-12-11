<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUTÓK</title>

    <script scr="js/jquery-3.7.1.js" type="text/javascript"></script>
    <script scr="js/cars.js" type="text/javascript"></script>
    
    <link href="fontawesome/css/all.css" rel="stylesheet" type="text/css">
    <!--
        <link href="css/cars.css" rel="stylesheet" type="text/css">
-->
</head>
<body>
    <nav>
        <a href="index.php"><i class="fa fa-home" title="Kezdőlap"></i></a>
        <a href="makers.php"><button>Gyártók</button></a>
        <a href="models.php"><button>Modellek</button></a>
    </nav>
    <h1>GYÁRTók</h1>
    <?php
        require_once 'DBMaker.php';
        $carMaker = new DBMaker();
        $abc = $carMaker->getAbc();
        /*var_dump($abc);
        return;*/
        echo "<div style='display: flex'>";
        foreach ($abc as $char){
            echo" 
                <form method='post' action='makers.php'>
                    <input type='hidden' name='ch' value='{$char['L']}'>
                    <button type'submit'>{$char['L']}</button>&nbsp;
                </form>
                ";
            
        }
        echo "</div><br>";

        if (isset($_POST['ch'])) {
            $ch = $_POST['ch'];
            $all = $carMaker->getByFirstCh($ch);
            //var_dump($all);
            echo "<table border='1'>
                    <thead>
                            
                        <tr>

                        <th>#</th>

                        <th>Gyártó</th>

                        <th>Művelet <button id='newButton' name='newButton'>Új</button></th>

                        </tr>
                        <tr style='display:none'>
                        <td colspan=3><input type='search' name='name' id='edit-box' value=''><input type='hidden' name='id' id='id' value=''><button id'saveButton' name='saveButton'>Ment</button><button id='cancelButton' name='cancelButton'>Mégse</button></td>
                            
                        </tr>
                    </thead>
                    <tbody>";
                    foreach($all as $makers){
                        echo "<tr><td>{$makers['id']}</td><td>{$makers['name']}</td><td><button type='submit' id='modosit'>Módosít</button><button type='submit' id='torol'>Töröl</button></td></tr>";
                    }
            echo        "</tbody>
                    <tfooter></tfooter>
                    </table>";


        }
        
    ?>
</body>
</html>