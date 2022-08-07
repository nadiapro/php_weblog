<aside class="mt-3 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="bg-light p-4">
                    <p class="h4">
                        جستجو در وبلاگ
                    </p>
                    <br/>
                    <form method="get" class="d-flex" role="search" action="search.php">
                        <input class="form-control me-2" type="search" placeholder="Search" name="searchtext">
                        <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                    </form>
                </div>
                <div class="list-group mt-3">
                    <p class="list-group-item list-group-item-action active mb-0" aria-current="true">
                        گروه ها
                    </p>
                        <?php
                        $sql = "SELECT * FROM categories";
                        $query = $conn -> query($sql);
                        $results = $query -> fetchAll();
                        foreach($results as $result){
                        ?>
                    <a href="single.php?cat=<?php echo $result['id']?>" class="list-group-item list-group-item-action"><?php echo $result['title']?></a>
                    <?php
                        }
                        ?>
                </div>
                <?php
                if(isset($_POST['submitt'])){
                    if($_POST['username'] == ""){
                        echo '<script> alert( "لطفا نام خود را وارد نمایید") </script>';
                    } elseif($_POST['email'] == ""){
                        echo '<script> alert( "لطفا ایمیل خود را وارد نمایید") </script>';
                    }else{
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $sql1 = "INSERT INTO members (fname,email) VALUE(:fname,:email)";
                        $query1 = $conn -> prepare($sql1);
                        $query1 -> bindParam(':fname' , $username);
                        $query1 -> bindParam(':email' , $email);
                        $query1 -> execute();
                        echo '<script> alert( "ثبت نام شما انجام شد") </script>';
                    }
                } ?>
                <form method="post" class="bg-light border rounded p-3 mt-3">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">نام خود را وارد کنید</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">ایمیل خود را وارد کنید</label>
                        <input type="email" name="email" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">مرا به خاطر بسپار</label>
                    </div>
                    <button type="submit" name="submitt" class="btn btn-success w-100">Submit</button>
                </form>

                <div class="card mt-3">
                    <div class="card-header">
                        درباره ما
                    </div>
                    <div class="card-body">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsum illum atque, quas placeat, maiores omnis similique pariatur perspiciatis minus, voluptate distinctio tenetur! Recusandae optio, consectetur adipisci debitis expedita
                            sit. Atque.</p>
                    </div>
                </div>
            </aside>