<?php
session_start();
if(!isset($_SESSION['email']) || !isset($_SESSION['pass'])){
    echo"first lgin";
    echo "<script>window.location.href='signin.php'</script>";
}else{
require_once('top.php');
$message = "";
if(isset($_POST['submit'])){
    if($_POST['input1'] == "" || $_POST['input2'] == "" || $_POST['input3'] == "" || $_POST['input4'] == ""){
        $message = "لطفا همه فیلدها را پرکنید"; }
else{
    if(isset($_GET['articleid'])){
        $articlid = $_GET['articleid'];
        $title = $_POST['input1'];
        $body = $_POST['input4'];
        $image = $_POST['input5'];
        $sql6 = "UPDATE article SET title=:title, body=:body WHERE id=:id";
        $query6 = $conn -> prepare($sql6);
        $query6 -> bindParam(':id' , $articlid);
        $query6 -> bindParam(':title' , $title);
        $query6 -> bindParam(':body' , $body);
        $query6 -> execute();
        echo '<script> alert("مقاله ویرایش شد")</script>'; }
else{
    $title = $_POST['input1'];
    $author = $_POST['input2'];
    $body = $_POST['input4'];
    $image = $_POST['input5'];
    $categry = $_POST['input3'];

    $sql2 = "SELECT id FROM authrs WHERE name=:author";
    $query2 = $conn -> prepare($sql2);
    $query2 -> bindParam(':author' , $author);
    $query2 -> execute();

    $results2 = $query2 -> fetch();
    $result2 = intval($results2['id']);

    $sql3 = "SELECT id FROM categories WHERE title=:category";
    $query3 = $conn -> prepare($sql3);
    $query3 -> bindParam(':category' , $categry);
    $query3 -> execute();
    $results3 = $query3 -> fetch();
    $result3 =intval($results2['id']);


    $sql4 = "INSERT INTO article (title,body,image,categoryid,authorid) VALUE (:title , :body, :image, :categoryid, :authorid)";
    $query4 = $conn -> prepare($sql4);
    $query4 -> bindParam(':title' , $title);
    $query4 -> bindParam(':body' , $body);
    $query4 -> bindParam(':image' , $image);
    $query4 -> bindParam(':categoryid' , $result3);
    $query4 -> bindParam(':authorid' , $result2);
    $result4 = $query4 -> execute();
    echo '<script> alert("مقاله ایجاد شد")</script>';}
} }


?>
<div class="col-9">
    <h2>ایجاد مقاله</h2>
    <?php if($message != ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $message ?>
    </div>
    <?php } ?>
    <hr/>
    <form method="post">
        <?php
    if(isset($_GET['articleid'])){
    $articlid = $_GET['articleid'];
    $sql5 = "SELECT * FROM article WHERE id=:id";
    $query5 = $conn -> prepare($sql5);
    $query5 -> bindParam(':id' , $articlid);
    $query5 -> execute();
    $result5 = $query5 -> fetch();

        $authorid = $result5['authorid'];

        $sql7 = "SELECT name FROM authrs WHERE id=:id";
        $query7 = $conn -> prepare($sql7);
        $query7 -> bindParam(':id' , $authorid);
        $query7 -> execute();
        $result7 = $query7 -> fetch();

        $catid = $result5['categoryid'];

        $sql8 = "SELECT title FROM categories WHERE id=:id";
        $query8 = $conn -> prepare($sql8);
        $query8 -> bindParam(':id' , $catid);
        $query8 -> execute();
        $result8 = $query8 -> fetch();
    ?>

        <label for="input1">عنوان: </label>
        <input type="text" class="form-control" id="input1" name="input1" value="<?php echo $result5['title'] ?>">
        <br/>
        <label for="input2">نویسنده: </label>
        <input list="input2" class="form-control" name="input2" value="<?php echo $result7['name'] ?>">
        <datalist id="input2">
            <?php $sql = "SELECT * FROM authrs";
            $query = $conn -> query($sql);
            $results = $query -> fetchAll();
            foreach($results as $result){ ?>
            <option value="<?php echo $result['name'] ?>">
            <?php } ?>
        </datalist>
        <br/>
        <label for="input3">گروه: </label>
        <input list="input3" class="form-control" name="input3" value="<?php echo $result8['title'] ?>">
        <datalist id="input3">
        <?php $sql1 = "SELECT * FROM categories";
            $query1 = $conn -> query($sql1);
            $results1 = $query1 -> fetchAll();
            foreach($results1 as $result1){ ?>
            <option value="<?php echo $result1['title'] ?>">
            <?php }  ?>
        </datalist>
        <br/>
        <label for="input4">متن مقاله: </label>
        <textarea class="form-control" id="input4" name="input4"> <?php echo $result5['body'] ?></textarea>
        <br/>
        <label for="input5">بارگزاری تصویر: </label>
        <input type="file" class="form-control" id="input5" name="input5" value="<?php echo $result5['image'] ?>">
        <br/>
        <button type="submit" name="submit" class="btn btn-primary mb-3"> ویرایش مقاله</button>

   <?php }  else{ ?>
    <label for="input1">عنوان: </label>
        <input type="text" class="form-control" id="input1" name="input1">
        <br/>
        <label for="input2">نویسنده: </label>
        <input list="input2" class="form-control" name="input2">
        <datalist id="input2">
            <?php $sql = "SELECT * FROM authrs";
            $query = $conn -> query($sql);
            $results = $query -> fetchAll();
            foreach($results as $result){ ?>
            <option value="<?php echo $result['name'] ?>">
            <?php } ?>
        </datalist>
        <br/>
        <label for="input3">گروه: </label>
        <input list="input3" class="form-control" name="input3">
        <datalist id="input3">
        <?php $sql1 = "SELECT * FROM categories";
            $query1 = $conn -> query($sql1);
            $results1 = $query1 -> fetchAll();
            foreach($results1 as $result1){ ?>
            <option value="<?php echo $result1['title'] ?>">
            <?php }  ?>
        </datalist>
        <br/>
        <label for="input4">متن مقاله: </label>
        <textarea class="form-control" id="input4" name="input4"></textarea>
        <br/>
        <label for="input5">بارگزاری تصویر: </label>
        <input type="file" class="form-control" id="input5" name="input5">
        <br/>
        <button type="submit" name="submit" class="btn btn-primary mb-3"> ایجاد مقاله</button>

<?php   }?>
    </form>
</div>
<?php
require_once('footer.php');}
?>