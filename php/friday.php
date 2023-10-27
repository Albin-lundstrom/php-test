<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js" defer></script>
    <style>
        #friday-div{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        h4{
            text-align: center;
            text-decoration: underline;
            margin-top: 2%;
        }
        p{
            font-weight: bold;
            margin: 2%;
        }
        img{
            height: 10vh;
            width: auto;
        }
    </style>
</head>
<body>
<?php 
    $friday = "";
    session_start();
    include 'fridaysrc.php';
    if ( isset($_POST['Manual'])){
        $day = $_POST['Manual'];
        if($_POST['Manual'] == ""){
            $dayLeft = 5 - date('N');
            if(date("l") == "Friday"){
                $friday = "ITS FRIDAY. FRIYAY!!";
                $GLOBALS['friday'];
                $friDayGif = $friGif[rand(0, 3)];
                $GLOBALS['friDayGif'];
                $imgTumb = "img-thumbnail";
                $GLOBALS['imgTumb'];
            }elseif($dayLeft < 0){
                $dayLeft += 7;
                $friday = "There is" .$dayLeft ."days left until friday";
                $GLOBALS['friday'];
            }
        }
        elseif(date("l", strtotime(date('j', strtotime($_POST['Manual'])) .date('M', strtotime($_POST['Manual'])) . date("Y", strtotime($_POST['Manual'])))) === "Friday"){
            $friday = friday();
            $GLOBALS['friday'];
            $friDayGif = $friGif[rand(0, 3)];
            $GLOBALS['friDayGif'];
            $imgTumb = "img-thumbnail";
            $GLOBALS['imgTumb'];
        }else{
            $friday = "There are " .howManyLeft($day) ." days left until friday, from that date";
            $GLOBALS['friday'];
        }
    }
    //echo "<br>";
    //echo date('N');
    //echo "<br>";
    function howManyLeft($day){
        $dayLeft = 5 - date('N', strtotime(date('j', strtotime($day)) .date('M', strtotime($day)) . date("Y", strtotime($day))))
    ;
        if($dayLeft < 0){
            $dayLeft += 7;
        }
        return $dayLeft;
    }function friday(){
        $friday = "That date is a Friday.";
        $GLOBALS['friday'];
        return $friday;
    }
    echo "<div class='container-lg' id='friday-div'>";
    echo "<h4>";
        echo "Write a date to check if it's a Friday. If you leave the input empty it will check todays date.";
    echo "</h4>";
    echo "<br>";
    echo "<p>";
    echo $friday;
    echo "</p>";
    echo "<br>";
    echo "<img src='$friDayGif' alt='' class='img-fluid $imgTumb'>";
    echo "</div>";
?> 
<div class="container-lg" id="manual-date">
    <form method="post" action="" class="input-group mb-3">
        <input type="text" name="Manual" class="form-control" placeholder="Check how long until Friday. Write in a YYYY-MM-DD form.">
        <input type="submit" value="Check Date" class="btn btn-danger">  
    </form>
    <!-- <form method="post" action=""> -->
    <!-- <input type="submit" name="reset" value="reset" class="btn btn-secondary" id="reset"> -->
    <!-- </form> -->
</div>
</body>
</html>