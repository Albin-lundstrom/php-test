<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js" defer></script>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            background-color: #292b2c ;
            color: white;
        }
        #manual-date{
            margin-top: 2%;
        }
        .container-lg{
            padding: 0 !important;
        }
        h1, h3{
            text-align: center;
            font-weight: bolder;
        }
        table{
            height: 40vh;
            text-align: center;
        }

        #month-date{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #reset{
            flex-grow: 2;
        }
    </style>
    <title>Document</title>
</head>
<body>
<div>
    <h1 class="">
        PHP Calender
    </h1>
</div>
    <?php
        include 'namnsdag.php';
        include 'emoji.php';

        // POST METOD TO ADD AND SUBTRACT THE MONTH AND YEARS

        $monthNum = date('m', strtotime(date('t') . date('M') . date('Y')));
        session_start();
        if( !isset( $_SESSION['clicks'] ) ) $_SESSION['clicks'] = $monthNum;
        if( !isset( $_SESSION['clicks'] ) ) $_SESSION['year']=0;

        $month = $_SESSION['clicks'];
            // ADDING MONTH
        if(isset( $_POST['btn1'])) {
            $_SESSION['clicks']++;
            if($_SESSION['clicks'] > 13 || $_SESSION['clicks'] < -1){
                $_SESSION['clicks'] = 1;
            }
            if($_SESSION['clicks'] != 13){
                header('Location:http://localhost/te4/php-test/php/index.php?' .date('Y', strtotime(date('t') . date('M') . date('Y')))+$_SESSION['year'] .'-' .$_SESSION['clicks'] .'-' .'1'); 
            }
            else if($_SESSION['clicks'] == 13){
                $_SESSION['year']++;

                $_SESSION['clicks'] = 1;

                header('Location:http://localhost/te4/php-test/php/index.php?'.date('Y', strtotime(date('t') . date('M') . date('Y')))+$_SESSION['year'] .'-' .$_SESSION['clicks'] .'-' .'1'); 
            }
        } 
            // SUBTRACTING MONTH
        elseif( isset( $_POST['btn2'] ) ){
            $_SESSION['clicks']--;
            if($_SESSION['clicks'] > 13 || $_SESSION['clicks'] < 0){
                $_SESSION['clicks'] = 12;
            }
            if($_SESSION['clicks'] !== 0){
                header('Location:http://localhost/te4/php-test/php/index.php?' .date('Y', strtotime(date('t') . date('M') . date('Y')))+$_SESSION['year'] .'-' .$_SESSION['clicks'] .'-' .'1'); 
            }
            else if($_SESSION['clicks'] == 0){
                    $_SESSION['year']--;

                    $_SESSION['clicks'] = 12;
    
                    header('Location:http://localhost/te4/php-test/php/index.php?'.date('Y', strtotime(date('t') . date('M') . date('Y')))+$_SESSION['year'] .'-' .$_SESSION['clicks'] .'-' .'1');    
            }
        } 
            // RESETING TO TODAYS DATE
        elseif( isset( $_POST['reset'])){
            $_SESSION['clicks'] = date('m', strtotime(date('t') . date('M') . date('Y')));
            $_SESSION['year'] = 0;
            header('Location:http://localhost/te4/php-test/php/index.php?'.date('Y') .'-' .date('m') .'-' .date('j'));
        } 
            // SUBMIT TO GET SHOW DATE
        elseif ( isset($_POST['Manual'])){
            header('Location:http://localhost/te4/php-test/php/index.php?' .$_POST['Manual']);
            $_SESSION['clicks'] = date('m', strtotime(date('t', strtotime($_POST['Manual'])) .date('M', strtotime($_POST['Manual'])) .date('Y', strtotime($_POST['Manual']))));
            $_SESSION['year'] = date('Y', strtotime(date('t', strtotime($_POST['Manual'])) .date('M', strtotime($_POST['Manual'])) .date('Y', strtotime($_POST['Manual'])))) -date('Y');
            if(date("l", strtotime(date('j', strtotime($_POST['Manual'])) .date('M', strtotime($_POST['Manual'])) . date("Y", strtotime($_POST['Manual'])))) === "Friday"){
                $friday = "FRIDAY";
                $GLOBALS['friday'];
            }
            else{
                $friday = "TEST";
                $GLOBALS['friday'];
            }
        }

              // GETTING THE CURENT URL TO THEN SHOW THE DATES
            $current_url = $_SERVER['REQUEST_URI']; 
            $link_array = explode('?',$current_url);
            $page = end($link_array);
            $numberOfDays = date("t", strtotime($page));
            echo "<div>";
            echo "<h3>"; 
            echo date("F", strtotime($page));
            echo " " .$emoji[$_SESSION['clicks'] -1][rand(0, 2)];
            echo "</h3>";
            echo "</div>";
            echo "<div>";
            echo "<table class='table table-striped table-dark'>";
            echo "<tr>";
            echo "<th>Week Number</th>";
                echo "<th>Monday</th>";
                echo"<th>Tuesday</th>";
                echo "<th>Wednesday</th>";
                echo"<th>Thursday</th>";
                echo "<th>Friday</th>";
                echo "<th>Saturday</th>";
                echo "<th class='bg-danger'>Sunday</th>";
            echo "</tr>";

        //echo date("l", strtotime(date("j", strtotime($_POST['Manual']))) .date('M', strtotime($_POST['Manual'])) .date('Y', strtotime($_POST['Manual'])));

            //ERROR CHECK FOR THE VARIABLES
        //echo 'clicks: '. $_SESSION['clicks'];
        //echo '<br>';
        // echo 'Year:' .$_SESSION['year'];
        // echo '<br>';

            // MAKEING IT SO THE DATE SHOW UNDER CORRECT WEEKDAY 
        $s = 0;
        do{
            $s++;
        }while(date("l", strtotime($s .date('M', strtotime($page)) . date("Y", strtotime($page)))) !== "Sunday");

            //MAKEING THE EXTRA <td> AND THE FIRST WEEK NUBMER IF NEEDED
        for($s2 = 8; $s2 > $s; $s2--){
            if($s == 7){
                break;
            }elseif($s2 == 8){
            echo "<th>";
                $weekDate= date("W", strtotime(-1 .date('M', strtotime($page)) . date("Y", strtotime($page))));
                if(substr($weekDate, 0, -1) == 0){
                    echo substr($weekDate, 1);
                }
                else{
                    echo $weekDate;
                }
            echo "</th>";
            $s2--;
            }
            echo("<td>");
            echo("</td>");
        }
            //ERROR CHECK FOR THE VARIABLES
        //echo $s2;
        //echo "<br>";
        //echo $s;
        // foreach($namnsdag as $namn){
        //     foreach($namn as $n){
        //      echo  "<br>" .$name;
        //     }
        // }
            // CALANDER - THE PART THAT SHOWS
        for ($x = 1; $x <= $numberOfDays; $x++) {
            $weekDate= date("W", strtotime($x .date('M', strtotime($page)) . date("Y", strtotime($page))));
                if(substr($weekDate, 0, -1) == 0){
                    $weekNum = substr($weekDate, 1);
                }
                else{
                    $weekNum = $weekDate;
                }
            $dagsNum = date("z", strtotime($x .date('M', strtotime($page)) . date("Y" , strtotime($page)))) +1;
            $name = $namnsdag[$dagsNum];
                // IF ITS MONDAY THEN NEW TABLE ROW
            if(date("l", strtotime($x .date('M', strtotime($page)) . date("Y", strtotime($page)))) === "Monday"){
                echo("<tr>");
                echo "<th>";
                    echo $weekNum;
                echo "</th>";
                echo("<td>");
                echo "<span>";
                    echo "<strong>";
                        echo date($x ." ");
                        echo date("F", strtotime($x .date('M', strtotime($page)) . date("Y" , strtotime($page))));
                    echo "</strong>";
                echo "</span>";
                echo "<br>" .$dagsNum;
                echo "<br>" ;
                $l = count($name);
                foreach($name as $n){
                    if(count($name) >= 2){
                        if($l == count($name)){
                            $l++;
                            echo $n .", ";
                        }else{
                            echo $n;
                        }
                    }
                    else{
                            echo $n;
                    }
                }
                echo("</td>");
            }
                // IF ITS SUNDAY ADD THE RIGHT CLASS AND THEN CLOSE THE TABLE ROW
            elseif(date("l", strtotime($x .date('M', strtotime($page)) . date("Y", strtotime($page)))) === "Sunday"){
                echo("<td class='text-danger'>");
                    echo "<span>";
                        echo "<strong>";
                            echo date($x ." ");
                            echo date("F", strtotime($x .date('M', strtotime($page)) . date("Y" , strtotime($page))));
                        echo "</strong>";
                    echo "</span>";
                    echo "<br>" .$dagsNum;
                    echo "<br>";
                    $l = count($name);
                    foreach($name as $n){
                        if(count($name) >= 2){
                            if($l == count($name)){
                                $l++;
                                echo $n .", ";
                            }else{
                             echo $n;
                            }
                        }
                        else{
                             echo $n;
                        }
                    }
               echo("</td>");
                echo("</tr>");
            }else{
                // OTHERWISE JUST SHOW THE DATE
               echo("<td>");
                    echo "<span>";
                        echo "<strong>";
                            echo date($x ." ");
                            echo date("F", strtotime($x .date('M', strtotime($page)) . date("Y" , strtotime($page))));
                        echo "</strong>";
                    echo "</span>";
                    echo "<br>" .$dagsNum;
                    echo "<br>";
                    $l = count($name);
                    foreach($name as $n){
                        if(count($name) >= 2){
                            if($l == count($name)){
                                $l++;
                                echo $n .", ";
                            }else{
                             echo $n;
                            }
                        }
                        else{
                             echo $n;
                        }
                    }
               echo("</td>");
            }
        }
        ?>
    </table>
</div>
<?php 
    global $friday;
    echo("<div class='container-lg'>");
    echo "<h2 id='friday'>";
    echo $friday;
    echo "</h2>";
    echo("</div>");
?>
<div class="container-lg" id="manual-date">
        <!-- THE FORM ELEMENT TO MANUALY WRITE THE DATE -->
    <form method="post" action="" class="input-group mb-3">
        <input type="text" name="Manual" class="form-control" placeholder="Write date in YYYY-MM-D form">
        <input type="submit" value="Check Date" class="btn btn-danger">  
    </form>
</div>
<div id="month-date">
        <!-- THE FORM ELEMENT TO CHANGE THE MONTH -->
    <form action="" method="post">
        <input type="submit" name="btn2" value="-1" class="btn btn-danger">
        <input type="submit" name="reset" value="reset" class="btn btn-secondary" id="reset">
        <input type="submit" name="btn1" value="+1" class="btn btn-danger" >
    </form>
</div>
</body>
</html>