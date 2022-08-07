<?php
session_start();
session_destroy();
session_start();
define('USER' , 'root');
define('PASS' , 'mysql');
define('DSN' , 'mysql:host=localhost;dbname=myweblog');
try{
    $conn = new PDO(DSN, USER , PASS);
}

catch(PDOException $e){
    echo $e -> getMessage();
}
?>
    <!DOCTYPE html>
    <html lang="fa">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
        <title>myweblog</title>
    </head>

    <body>
        <div class="container-fluid">
            <header>
                <nav class="navbar bg-dark text-light">
                        <a class="navbar-brand text-light" href="../main.php">MY-WEBLOG</a>
                </nav>
            </header>
            <br/>
            <?php
    if(isset($_POST['submit'])){
        if($_POST['email']=="" || $_POST['pass']==""){
            echo "inter email and pass";
        }else{
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $sql = "SELECT * FROM authrs WHERE email=:email AND password=:pass";
            $query = $conn -> prepare($sql);
            $query -> bindParam(':email' , $email);
            $query -> bindParam(':pass' , $pass);
            $query -> execute();
            $result = $query -> fetch();
            if($result){
                $_SESSION['email'] = $email;
                $_SESSION['pass'] = $pass;
                echo "<script>window.location.href='index.php'</script>";
            }else{
                echo"not valid";
            }
        }
    }
    ?>
            <div class="d-flex mt-5 justify-content-center">
            <form class="col-4 p-3 border rounded" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">ایمیل خود را وارد کنید</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">پسوورد خود را وارد کنید</label>
                    <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="w-100 btn btn-primary" name="submit">Submit</button>
            </form>
</div>

<?php
require_once('footer.php');
?>