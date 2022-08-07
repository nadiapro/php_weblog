<?php
session_start();
if(!isset($_SESSION['email']) || !isset($_SESSION['pass'])){
    echo"first lgin";
    echo "<script>window.location.href='signin.php'</script>";
}else{
require_once('top.php');
$message = "";
if(isset($_POST['submit'])){
    if($_POST['input1'] == "" || $_POST['input4'] == ""){
        $message = "لطفا همه فیلدها را پرکنید"; }
else{
    if(isset($_GET['catid'])){
        $catid = $_GET['catid'];
        $title = $_POST['input1'];
        $body = $_POST['input4'];
        $image = $_POST['input5'];
        $sql6 = "UPDATE categories SET title=:title, body=:body WHERE id=:id";
        $query6 = $conn -> prepare($sql6);
        $query6 -> bindParam(':id' , $catid);
        $query6 -> bindParam(':title' , $title);
        $query6 -> bindParam(':body' , $body);
        $query6 -> execute();
        echo '<script> alert("گروه ویرایش شد")</script>'; }
else{
    $title = $_POST['input1'];
    $body = $_POST['input4'];
    $image = $_POST['input5'];

    $sql4 = "INSERT INTO categories (title,body,image) VALUE (:title , :body, :image)";
    $query4 = $conn -> prepare($sql4);
    $query4 -> bindParam(':title' , $title);
    $query4 -> bindParam(':body' , $body);
    $query4 -> bindParam(':image' , $image);
    $result4 = $query4 -> execute();
    echo '<script> alert("گروه ایجاد شد")</script>';}
} }

?>
<div class="col-9">
    <h2>ایجاد گروه</h2>
    <?php if($message != ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $message ?>
    </div>
    <?php } ?>
    <hr/>
    <form method="post">
         <?php
    if(isset($_GET['catid'])){
    $catid = $_GET['catid'];
    $sql5 = "SELECT * FROM categories WHERE id=:id";
    $query5 = $conn -> prepare($sql5);
    $query5 -> bindParam(':id' , $catid);
    $query5 -> execute();
    $result5 = $query5 -> fetch(); ?>

        <label for="input1">عنوان: </label>
        <input type="text" class="form-control" id="input1" name="input1" value="<?php echo $result5['title'] ?>">

        <br/>
        <label for="input4">متن: </label>
        <textarea class="form-control" id="input4" name="input4"> <?php echo $result5['body'] ?></textarea>
        <br/>
        <label for="input5">بارگزاری تصویر: </label>
        <input type="file" class="form-control" id="input5" name="input5" value="<?php echo $result5['image'] ?>">
        <br/>
        <button type="submit" name="submit" class="btn btn-primary mb-3"> ویرایش گروه</button>
        <?php } else{ ?>

   
    <label for="input1">عنوان: </label>
        <input type="text" class="form-control" id="input1" name="input1">
        <br/>
        <label for="input4">متن: </label>
        <textarea class="form-control" id="input4" name="input4"></textarea>
        <br/>
        <label for="input5">بارگزاری تصویر: </label>
        <input type="file" class="form-control" id="input5" name="input5">
        <br/>
        <button type="submit" name="submit" class="btn btn-primary mb-3"> ایجاد گروه</button>
<?php } ?>
    </form>
</div>
<?php
require_once('footer.php');}
?>