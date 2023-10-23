<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <?php
        for ($x = 1; $x <= date("t"); $x++) {
            echo("<tr>");
                echo("<td>");
                    echo date("l", strtotime($x . "-" . date("M") . "-" . date("Y")));
                    echo date(" ". $x . " " ."F");
                echo("</td>");
            echo("</tr>");
        }
        ?>
    </table>
    <?php
    // echo("Hello World<br>");
    // echo date("1463097600");
    // echo("<br>");
    // echo date("F", strtotime(1 . "-" . date("M") . "-" . date("Y"))) . " " . 1 . "," . date("Y") . "(" . date("l") . ")";
    // echo("<br>");
    
    //for ($x = 1; $x <= date("t"); $x++) {
    //    echo date("F", strtotime($x . "-" . date("M") . "-" . date("Y"))) . " " . $x . "," . date("Y") . "(" . date("l", strtotime($x . "-" . date("M") . "-" . date("Y"))) . ")<br/>";
    //}
    ?>
</body>
</html>