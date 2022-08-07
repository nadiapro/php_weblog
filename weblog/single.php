<?php require_once("header.php");
?>
        <div class="row">
            <main class="mt-3 col-8">
                <?php
                if(isset($_GET['cat'])){
                $categoryid = $_GET['cat'];
                $sql = "SELECT * FROM categories WHERE id=:id";
                $query = $conn -> prepare($sql);
                $query -> bindParam(':id', $categoryid);
                $query -> execute();
                $result = $query -> fetch();
                ?>
                <div class="col-12">
                    <image src="<?php echo $result['image']?>" class="w-100"></image>
                    <!-- <div class="d-flex justify-content-between"> -->
                        <h3>
                        <?php echo $result['title']?>
                        </h3>
                        <!-- <p class="badge text-bg-info">گروه : اول </p> -->
                    <p>
                    <?php echo $result['body']?>
                    </p>
                </div>
                                <?php 
                if(isset($_POST['submit'])){
                    if($_POST['name'] == ""){
                        echo '<script> alert("inter your name") </script>';
                    }
                    elseif($_POST['comment'] == ""){
                        echo '<script> alert("inter your comment") </script>';
                    }
                    else{
                        $fname = $_POST['name'];
                        $comment = $_POST['comment'];
                        $categoryid = $_GET['cat'];
                        $sql3 = "INSERT INTO comments (fname,comment,categoryid) VALUE(:fname, :comment , :catid)";
                        $query3 = $conn -> prepare($sql3);
                        $query3 ->bindParam(':fname' , $fname);
                        $query3 ->bindParam(':comment' , $comment);
                        $query3 ->bindParam(':catid' , $categoryid);
                        $query3 -> execute();
                        echo '<script> alert("thanks") </script>';
                    } } ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">نام شما</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">دیدگاه شما</label>
                        <textarea class="form-control" name="comment" id="exampleInputPassword1"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
                <hr/>

                <?php
                $categoryid = $_GET['cat'];
                $sql4 = "SELECT * FROM comments WHERE categoryid=:id AND status=1";
                $query4 = $conn -> prepare($sql4);
                $query4 -> bindParam(':id' , $categoryid);
                $query4 -> execute();
                $results4 = $query4 -> fetchAll();
                if($query4 -> rowCount()>0){
                ?>
                <p>تعداد کامنت : <span> <?php echo $query4 -> rowCount() ?> </span></p>
                <?php foreach($results4 as $result4){?>
                <div class="alert alert-secondary">
                    <p><?php echo $result4['fname'] ?></p>
                    <hr/>
                    <p>
                    <?php echo $result4['comment'] ?>
                    </p>
                </div>
                <?php }   } else{ ?>
                <p>تعداد کامنت : <span> کامنتی وجود ندارد </span></p> 
            <?php }
                    ?>
                         <?php
                }
                ?>  

             <?php

                if(isset($_GET['article'])){
                $articleid = $_GET['article'];
                $sql = "SELECT * FROM article WHERE id=:id";
                $query = $conn -> prepare($sql);
                $query -> bindParam(':id', $articleid);
                $query -> execute();
                $result = $query -> fetch();

                $authorid = $result['authorid'];
                $sql1 = "SELECT * FROM authrs WHERE id=:id";
                $query1 = $conn -> prepare($sql1);
                $query1 -> bindParam(':id', $authorid);
                $query1 -> execute();
                $result1 = $query1 -> fetch();

                $categoryid = $result['categoryid'];
                $sql2 = "SELECT * FROM categories WHERE id=:id";
                $query2 = $conn -> prepare($sql2);
                $query2 -> bindParam(':id', $categoryid);
                $query2 -> execute();
                $result2 = $query2 -> fetch();
                ?>
                    <image src="<?php echo $result['image']?>" class="col-12"></image>
                    <div class="d-flex justify-content-between">
                        <h3>
                        <?php echo $result['title']?>
                        </h3>
                        <p class="badge text-bg-info"> <?php echo $result2['title']?></p>
                    </div>    
                    <p>
                    <?php echo $result['body']?>
                    </p>
                    <p>نویسنده: <span><?php echo $result1['name'] ?></span></p>
                <hr/>
                <?php 
                if(isset($_POST['submit'])){
                    if($_POST['name'] == ""){
                        echo '<script> alert("inter your name") </script>';
                    }
                    elseif($_POST['comment'] == ""){
                        echo '<script> alert("inter your comment") </script>';
                    }
                    else{
                        $fname = $_POST['name'];
                        $comment = $_POST['comment'];
                        $articleid = $_GET['article'];
                        $sql5 = "INSERT INTO comments (fname,comment,articleid) VALUE(:fname, :comment , :artid)";
                        $query5 = $conn -> prepare($sql5);
                        $query5 ->bindParam(':fname' , $fname);
                        $query5 ->bindParam(':comment' , $comment);
                        $query5 ->bindParam(':artid' , $articleid);
                        $query5-> execute();
                        echo '<script> alert("thanks") </script>';
                    } } ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">نام شما</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">دیدگاه شما</label>
                        <textarea class="form-control" name="comment" id="exampleInputPassword1"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
                <hr/>

                <?php
                $articleid = $_GET['article'];
                $sql6 = "SELECT * FROM comments WHERE articleid=:id AND status=1";
                $query6 = $conn -> prepare($sql6);
                $query6 -> bindParam(':id' , $articleid);
                $query6 -> execute();
                $results6 = $query6 -> fetchAll();
                if($query6 -> rowCount()>0){
                ?>
                <p>تعداد کامنت : <span> <?php echo $query6 -> rowCount() ?> </span></p>
                <?php foreach($results6 as $result6){?>
                <div class="alert alert-secondary">
                    <p><?php echo $result6['fname'] ?></p>
                    <hr/>
                    <p>
                    <?php echo $result6['comment'] ?>
                    </p>
                </div>
                <?php }   } else{ ?>
                <p>تعداد کامنت : <span> کامنتی وجود ندارد </span></p> 
            <?php }
                    ?>
                         <?php
                }
                ?>               
            </main>
        <?php require_once("aside.php");
?>
        </div>
        <?php require_once("footer.php");
?>
