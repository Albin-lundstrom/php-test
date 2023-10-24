<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href=../css/style.css>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js" defer></script>
    <style>
        body{
            background-color: #292b2c ;
        }
        #manual-date{
            margin-top: 2%;
        }
        .container-lg{
            padding: 0 !important;
        }
        h1{
            text-align: center;
            color: white;
            font-weight: bolder;
        }
        table{
            margin-top: 2%;
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
<div>
    <table class="table table-striped table-dark">
        <tr>
            <th>Week Number</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
            <th class="bg-danger">Sunday</th>
        </tr>
        <?php

        // POST METOD TO ADD AND SUBTRACT THE MONTH AND YEARS

        $monthNum = date('m', strtotime(date('t') . date('M') . date('Y')));
        session_start();
        if( !isset( $_SESSION['clicks'] ) ) $_SESSION['clicks'] = $monthNum;
        if( !isset( $_SESSION['clicks'] ) ) $_SESSION['year']=0;

        $month = $_SESSION['clicks'];
            // ADDING MONTH
        if(isset( $_POST['btn1'])) {
            $_SESSION['clicks']++;
            if($_SESSION['clicks'] >= 13 || $_SESSION['clicks'] <= 0){
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
            if($_SESSION['clicks'] >= 13 || $_SESSION['clicks'] <= 0){
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
            header('Location:http://localhost/te4/php-test/php/index.php?'.date('Y', strtotime(date('t') . date('M') . date('Y'))) .'-' .date('m', strtotime(date('t') . date('M') . date('Y'))) .'-' .date('j', strtotime(date('t') . date('M') . date('Y'))));
        } 
            // SUBMIT TO GET SHOW DATE
        elseif ( isset($_POST['Manual'])){
            header('Location:http://localhost/te4/php-test/php/index.php?' .$_POST['Hex']);
        }

            //ERROR CHECK THE VARIABLES
        // echo 'clicks: '. $_SESSION['clicks'];
        // echo '<br>';
        // echo 'Year:' .$_SESSION['year'];
        // echo '<br>';

            // GETTING THE CURENT URL TO THEN SHOW THE DATES
        $current_url = $_SERVER['REQUEST_URI']; 
        $link_array = explode('?',$current_url);
        $page = end($link_array);
        $numberOfDays = date("t", strtotime($page));


            // MAKEING IT SO THE DATE SHOW UNDER CORRECT WEEKDAY 
        $s = 0;
        do{
            $s++;
        }while(date("l", strtotime($s .date('M', strtotime($page)) . date("Y"))) !== "Sunday");
        for($s2 = 8; $s2 > $s; $s2--){
            if($s == 7){
                break;
            }elseif($s2 == 8){
            echo "<td>";
                echo date("W", strtotime(-1 .date('M', strtotime($page)) . date("Y")));
            echo "</td>";
            $s2--;
            }
            echo("<td>");
            echo("</td>");
        }
            // CALANDER - THE PART THAT SHOWS
        for ($x = 1; $x <= $numberOfDays; $x++) {
                // IF ITS MONDAY THEN NEW TABLE ROW
            if(date("l", strtotime($x .date('M', strtotime($page)) . date("Y"))) === "Monday"){
                echo("<tr>");
                echo "<td>";
                echo date("W", strtotime($x .date('M', strtotime($page)) . date("Y")));
                echo "</td>";
                echo("<td>");
                    echo date($x ." ");
                    echo date("F", strtotime($x .date('M', strtotime($page)) . date("Y")));
               echo("</td>");
            }
                // IF ITS SUNDAY ADD THE RIGHT CLASS AND THEN CLOSE THE TABLE ROW
            elseif(date("l", strtotime($x .date('M', strtotime($page)) . date("Y"))) === "Sunday"){
                echo("<td class='text-danger'>");
                    echo date($x ." ");
                    echo date("F", strtotime($x .date('M', strtotime($page)) . date("Y")));
               echo("</td>");
                echo("</tr>");
            }else{
                // OTHERWISE JUST SHOW THE DATE
               echo("<td>");
                    echo date($x ." ");
                    echo date("F", strtotime($x .date('M', strtotime($page)) . date("Y")));
               echo("</td>");
            }
        }
        ?>
    </table>
</div>
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