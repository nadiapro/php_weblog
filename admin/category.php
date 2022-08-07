<?php
session_start();
if(!isset($_SESSION['email']) || !isset($_SESSION['pass'])){
    echo"first lgin";
    echo "<script>window.location.href='signin.php'</script>";
}else{
require_once('top.php');

if(isset($_GET['delcat'])){
    $catid = $_GET['delcat'];
    $sql4 = "DELETE FROM categories WHERE id=:id";
    $query4 = $conn -> prepare($sql4);
    $query4 -> bindParam(':id' , $catid);
    $query4 -> execute();
    echo '<script> alert("گروه حذف شد")</script>';
}
?>
<main class="col-9">
    <div class="d-flex justify-content-between">
    <h2>گروهها  </h2>
    <a href="singlecat.php" class="btn btn-primary"> افزودن گروه</a>
    </div>
    <hr/>
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
        $sql = "SELECT * FROM categories";
        $query = $conn -> query($sql);
        $results = $query -> fetchAll();
        $i = 0 ;

        foreach($results as $result) {

        $i++;

        ?>
        <tr>
            <th><?php echo $i ?></th>
            <td><?php echo $result['title']?></td>
            <td>
            <a href="singlecat.php?catid=<?php echo $result['id']?>" class="btn btn-primary">ویرایش</a>
            <a href="category.php?delcat=<?php echo $result['id']?>" class="btn btn-danger">حذف</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
        </main>
        <?php
require_once('footer.php');}
?>