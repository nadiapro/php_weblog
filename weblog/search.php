<?php require_once("header.php");
?>
            <div class="row">
               <main class="col-8 d-flex flex-wrap">
                    <?php
                        if($_GET['searchtext'] == ""){ ?>
                        <div class="col-12 mt-2">
                            <p class="alert alert-danger text-center" role="alert">
                          لطفا کلمه مورد نظر را وارد نمایید!
                        </p>
                        </div>
                        <?php }
                        else{
                        $text = $_GET['searchtext'];
                        $sql1 = 'SELECT * FROM article WHERE title LIKE :textt';
                        $query1 = $conn -> prepare($sql1);
                        $query1 -> execute([':textt' => "%$text%"]);
                        $results1 = $query1 -> fetchAll();
                          if($query1->rowCount() <= 0){?>
                            <div class="col-12 mt-2">
                                <p class="alert alert-danger text-center" role="alert">
                          متاسفانه نتیجه مورد نظر یافت نشد.
                          </p>
                        </div>
                        <?php }
                          else{
                            foreach($results1 as $result1){?>   
                        <div class="col-6 mt-2 p-2">    
                         <div class="card">
                            <img src="<?php echo $result1['image'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title"> <?php echo $result1['title'] ?> </h5>
                                </div>
                                <p class="card-text">
                                    <?php echo substr($result1['body'],0,150)."..."?>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="single.php?article=<?php echo $result1['id'] ?>" class="btn btn-primary">ادامه مطلب</a>
                                </div>
                            </div>
                         </div>
                        </div><?php } } }  ?>
                </main>
                
                <?php require_once("aside.php");
?>
            <?php require_once("footer.php");
?>