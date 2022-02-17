<?php
    // setcookie('rate','php',time()+30);
    // echo "<pre>";
    // print_r($_COOKIE);
    // setcookie('rate','php',888);
    try{
        // datebase connect
        $con = new PDO('mysql:host=localhost; dbname=cookie','root','loveispain');
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    // check the rate onclick
    if(isset($_POST['rate'])){
        $rate = $_POST['rate'];

        if(isset($_COOKIE['rate'])){
            echo "<h3 style='margin-left:40%'>Already voted for ".$_COOKIE['rate']."</h3>";
        }else{
            setcookie('rate',$rate,time()+2);
            $update_sql = "update rate set option_value = option_value + 1 where option='$rate'";
            $update_stmt = $con->prepare($update_sql);
            $update_stmt->execute();
            echo "<h3 style='margin-left:40%'>Thank you for rating</h3>";
        }
    }

    $sql = "select * from rate";
    // Prepares a statement for execution and returns a statement object
    $stml = $con->prepare($sql);
    // Executes a prepared statement
    $stml->execute();
    // Fetches the remaining rows from a result set
    $data = $stml->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($data);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating</title>

    <!-- mini framework -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">

    <style>
        body{
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="column column-60 column-offset-20">                  
                <form action="" method="post">
                    <table>
                        <tr>
                            <td>
                                <input type="submit" name="rate" value="<?php echo $data['0']['option'] ?>">
                                (<?php echo $data['0']['option_value'] ?>)
                            </td>
                            <td>
                                <h3>vs</h3>
                            </td>
                            <td>
                                <input type="submit" name="rate" value="<?php echo $data['1']['option'] ?>">
                                (<?php echo $data['1']['option_value'] ?>)
                            </td>
                            <td>
                                <h3>vs</h3>
                            </td>
                            <td>
                                <input type="submit" name="rate" value="<?php echo $data['2']['option'] ?>">
                                (<?php echo $data['2']['option_value'] ?>)
                            </td>
                            <td>
                                <h3>vs</h3>
                            </td>
                            <td>
                                <input type="submit" name="rate" value="<?php echo $data['3']['option'] ?>">
                                (<?php echo $data['3']['option_value'] ?>)
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>