<?php
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
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <title>myweblog</title>
</head>

<body>
    <div class="container-fluid">
        <header>
            <nav class="navbar bg-dark text-light">
                <div class="container-fluid d-flex justify-content-between">
                    <a class="nav-link text-light" href="signin.php"> خروج </a>
                    <a class="navbar-brand text-light" href="../main.php">MY-WEBLOG</a>
                </div>
            </nav>
        </header>
        <br/>
        <div class="row d-flex">
            <aside class="col-3 bg-light">
                <ul class="">
                    <li>
                        <a href="index.php">داشبورد</a>
                    </li>
                    <li>
                        <a href="article.php">مقالات</a>
                    </li>
                    <li>
                        <a href="comments.php">کامنتها</a>
                    </li>
                    <li>
                        <a href="category.php">گروهها</a>
                    </li>
                </ul>
            </aside>