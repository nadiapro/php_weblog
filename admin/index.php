<?php
session_start();
if(!isset($_SESSION['email']) || !isset($_SESSION['pass'])){
    echo"first lgin";
    echo "<script>window.location.href='signin.php'</script>";
}else{
require_once('top.php');
if(isset($_GET['delcomment'])){
    $commentid = $_GET['delcomment'];
    $sql3 = "DELETE FROM comments WHERE id=:id";
    $query3 = $conn -> prepare($sql3);
    $query3 -> bindParam(':id' , $commentid);
    $query3 -> execute();
    echo '<script> alert("کامنت حذف شد")</script>';
}

if(isset($_GET['delarticle'])){
    $articleid = $_GET['delarticle'];
    $sql4 = "DELETE FROM article WHERE id=:id";
    $query4 = $conn -> prepare($sql4);
    $query4 -> bindParam(':id' , $articleid);
    $query4 -> execute();
    echo '<script> alert("مقاله حذف شد")</script>';
}

if(isset($_GET['confirmcomment'])){
    $commentid = $_GET['confirmcomment'];
    $sql5 = "UPDATE comments SET status=1 WHERE id=:id";
    $query5 = $conn -> prepare($sql5);
    $query5 -> bindParam(':id' , $commentid);
    $query5 -> execute();
    echo '<script> alert("کامنت تایید شد")</script>';
}
if(isset($_GET['delcat'])){
    $catid = $_GET['delcat'];
    $sql7 = "DELETE FROM categories WHERE id=:id";
    $query7 = $conn -> prepare($sql7);
    $query7 -> bindParam(':id' , $catid);
    $query7 -> execute();
    echo '<script> alert("گروه حذف شد")</script>';
}
?>
<main class="col-9">
    <h2> داشبورد</h2>
    <hr/>
    <h2> مقالات اخیر</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ردیف</th>
                <th>نام مقاله</th>
                <th>نویسنده</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT * FROM article ORDER BY id DESC LIMIT 2";
            $query = $conn -> query($sql);
            $results = $query -> fetchAll();
            $i = 0 ;

            foreach($results as $result) {
            $authorid = $result['authorid'];
            $sql1 = "SELECT * FROM authrs WHERE id=:authorid";
            $query1 = $conn -> prepare($sql1);
            $query1 -> bindParam(':authorid', $authorid);
            $query1 -> execute();
            $result1 = $query1 -> fetch();
            $i++;

            ?>
            <tr>
                <th><?php echo $i ?> </th>
                <td> <?php echo $result['title']?></td>
                <td><?php echo $result1['name']?></td>
                <td>
                    <a href="singlearticle.php?articleid=<?php echo $result['id']?>" class="btn btn-primary">ویرایش</a>
                    <a href="index.php?delarticle=<?php echo $result['id']?>" class="btn btn-danger">حذف</a>
                </td>
            </tr>
            <?php }      ?>
        </tbody>
    </table>

    <hr/>
    <h2> کامنتهای اخیر</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ردیف</th>
                <th>نام </th>
                <th>کامنت</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>

        <?php 
            $sql2 = "SELECT * FROM comments WHERE status=0";
            $query2 = $conn -> query($sql2);
            $results2 = $query2 -> fetchAll();
            $i = 0 ;
            if($query2 -> rowCount() <= 0){ ?>
                <div class="alert alert-success" role="alert">
              کامنتی برای تایید وجود ندارد
            </div>
<?php
            } else{

            foreach($results2 as $result2) {
            $i++;

            ?>
            <tr>
                <th><?php echo $i ?> </th>
                <td> <?php echo $result2['fname']?></td>
                <td><?php echo $result2['comment']?></td>
                <td>
                    <a href="index.php?confirmcomment=<?php echo $result2['id']?>" class="btn btn-success">تایید</a>
                    <a href="index.php?delcomment=<?php echo $result2['id']?>" class="btn btn-danger">حذف</a>
                </td>
            </tr>
            <?php }   } ?>
        </tbody>
    </table>

    <hr/>
    <h2> گروهها </h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ردیف</th>
                <th>عنوان</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $sql6 = "SELECT * FROM categories";
            $query6 = $conn -> query($sql6);
            $results6 = $query6 -> fetchAll();
            $i = 0 ;

            foreach($results6 as $result6) {
            $i++; ?>
            <tr>
                <th><?php echo $i ?></th>
                <td><?php echo $result6['title']?></td>
                <td>
                    <a href="singlecat.php?catid=<?php echo $result6['id']?>" class="btn btn-primary">ویرایش</a>
                    <a href="index.php?delcat=<?php echo $result6['id']?>" class="btn btn-danger">حذف</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
<?php
require_once('footer.php');}
?>