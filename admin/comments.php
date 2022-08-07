<?php
session_start();
if(!isset($_SESSION['email']) || !isset($_SESSION['pass'])){
    echo"first lgin";
    echo "<script>window.location.href='signin.php'</script>";
}else{
require_once('top.php');

if(isset($_GET['delcomment'])){
    $delcomment = $_GET['delcomment'];
    $sql4 = "DELETE FROM comments WHERE id=:id";
    $query4 = $conn -> prepare($sql4);
    $query4 -> bindParam(':id' , $delcomment);
    $query4 -> execute();
    echo '<script> alert("کامنت حذف شد")</script>';
}
if(isset($_GET['confirmcomment'])){
    $commentid = $_GET['confirmcomment'];
    $sql5 = "UPDATE comments SET status=1 WHERE id=:id";
    $query5 = $conn -> prepare($sql5);
    $query5 -> bindParam(':id' , $commentid);
    $query5 -> execute();
    echo '<script> alert("کامنت تایید شد")</script>';
}
?>
<main class="col-9">
    <div class="d-flex justify-content-between">
    <h2>کامنتها </h2>
    </div>
    <hr/>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ردیف</th>
            <th>نام </th>
            <th>کامنت</th>
            <th>وضعیت نمایش</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sql = "SELECT * FROM comments";
        $query = $conn -> query($sql);
        $results = $query -> fetchAll();
        $i = 0 ;

        foreach($results as $result) {
        $i++;

        ?>
        <tr>
            <th><?php echo $i ?></th>
            <td><?php echo $result['fname']?></td>
            <td><?php echo $result['comment']?></td>
            <td><?php echo $result['status']?></td>
            <td>
            <a href="comments.php?confirmcomment=<?php echo $result['id']?>" class="btn btn-primary">تایید</a>
            <a href="comments.php?delcomment=<?php echo $result['id']?>" class="btn btn-danger">حذف</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
        </main>
        <?php
require_once('footer.php');}
?>