<?php require_once("header.php");
?>
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
                </div>
                <?php
                $sql = "SELECT * FROM categories";
                $query = $conn -> query($sql);
                $results = $query -> fetchAll();
                foreach($results as $result){?>
                <div class="carousel-inner">
                    <div class="carousel-item <?php echo $result['status']?>">
                        <img src="<?php echo $result['image']?>" class="d-block w-100 h-50" height="300px" alt="picture">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo $result['title']?></h5>
                            <p><?php echo substr($result['body'],0,100)."..."?></p>
                            <a href="single.php?cat=<?php echo $result['id']?>" class="btn btn-primary">مشاهده مطلب</a>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </header>
        <div class="row">
            <main class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12 d-flex flex-wrap">
                <?php
                $sql = "SELECT * FROM article";
                $query = $conn -> query($sql);
                $results = $query -> fetchAll();
                foreach($results as $result){
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
                <div class="mt-2 p-2 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <img src="<?php echo $result['image'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title"><?php echo $result['title'] ?></h5>
                            <p class="badge text-bg-secondary"><?php echo $result2['title'] ?></p>
                        </div>
                        <p class="card-text"><?php echo substr($result['body'],0,150)."..."?></p>
                        <div class="d-flex justify-content-between">
                            <a href="single.php?article=<?php echo $result['id'] ?>" class="btn btn-primary">ادامه مطلب</a>
                            <p>نویسنده: <span><?php echo $result1['name'] ?></span></p>
                        </div>
                    </div>
                </div>
                </div>
                <?php
                }
                ?>
            </main>
            <?php require_once("aside.php");
?>
        </div>
        <?php require_once("footer.php");
?>
