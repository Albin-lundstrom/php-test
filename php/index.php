<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href=../css/style.css>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js" defer></script>
    <title>Document</title>
</head>
<body>
    <table class="table table-striped table-dark">
        <tr>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
            <th class="bg-danger">Sunday</th>
        </tr>
        <?php
        global $m;
        
          if (isset($_GET['lastMonth'])) {
            global $m;
            $m = date("m");
        } 
        $current_url = $_SERVER['REQUEST_URI']; 
        $link_array = explode('?',$current_url);
        echo $page = end($link_array);
        echo "<br>";
        $numberOfDays = date("t", strtotime($page));
        $s = 0;
        do{
            $s++;
        }while(date("l", strtotime($s .date('M', strtotime($page)) . date("Y"))) !== "Sunday");
        $math = 0;
        for($s2 = 7; $s2 > $s; $s2--){
            echo("<td>");
            echo("</td>");
        }
        for ($x = 1; $x <= $numberOfDays; $x++) {
            //echo($x ."<br>");
            if(date("l", strtotime($x .date('M', strtotime($page)) . date("Y"))) === "Monday"){
                echo("<tr>");
            }
            if(date("l", strtotime($x .date('M', strtotime($page)) . date("Y"))) === "Sunday"){
                echo("<td class='bg-danger'>");
                    echo date($x ." ");
                    echo date("F", strtotime($x .date('M', strtotime($page)) . date("Y")));
               echo("</td>");
                echo("</tr>");
            }else{
               echo("<td>");
                    echo date($x ." ");
                    echo date("F", strtotime($x .date('M', strtotime($page)) . date("Y")));
               echo("</td>");
            }
        }
        echo date('Y') .'-' .date('m') .'-' .date('d', strtotime(date('d') . date('M') . date('Y')));
        
        ?>
    </table>
    <button>
        <a href="index.php?<?php 

        echo date('Y', strtotime(date('t') . date('M') . date('Y'))) .'-' .date('m', strtotime(date('t') . date('M') . date('Y'))) .'-' .date('d', strtotime(date('d') . date('M') . date('Y'))); 
        
        ?>">Next Month</a>
    </button>
</body>
</html>