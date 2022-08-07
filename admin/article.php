<?php
session_start();
if(!isset($_SESSION['email']) || !isset($_SESSION['pass'])){
    echo"first lgin";
    echo "<script>window.location.href='signin.php'</script>";
}else{
require_once('top.php');

if(isset($_GET['delarticle'])){
    $articleid = $_GET['delarticle'];
    $sql4 = "DELETE FROM article WHERE id=:id";
    $query4 = $conn -> prepare($sql4);
    $query4 -> bindParam(':id' , $articleid);
    $query4 -> execute();
    echo '<script> alert("مقاله حذف شد")</script>';
}
?>
<main class="col-9">
    <div class="d-flex justify-content-between">
    <h2> مقالات </h2>
    <a href="singlearticle.php" class="btn btn-primary"> افزودن مقاله</a>
    </div>
    <hr/>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ردیف</th>
            <th>عنوان</th>
            <th>نویسنده</th>
            <th>دسته بندی</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sql = "SELECT * FROM article";
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

        $categoryid = $result['categoryid'];
        $sql2 = "SELECT * FROM categories WHERE id=:categoryid";
        $query2 = $conn -> prepare($sql2);
        $query2 -> bindParam(':categoryid', $categoryid);
        $query2 -> execute();
        $result2 = $query2 -> fetch();

        $i++;

        ?>
        <tr>
            <th><?php echo $i ?></th>
            <td><?php echo $result['title']?></td>
            <td><?php echo $result1['name']?></td>
            <td><?php echo $result2['title']?></td>
            <td>
            <a href="singlearticle.php?articleid=<?php echo $result['id']?>" class="btn btn-primary">ویرایش</a>
            <a href="article.php?delarticle=<?php echo $result['id']?>" class="btn btn-danger">حذف</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
        </main>
        <?php
require_once('footer.php');}
?>