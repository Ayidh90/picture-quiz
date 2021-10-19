<?php 
include_once('./header.php');
$name_err = '';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["name"]))){
        $name_err = "الرجاء كتابة اسم للاختبار";
    }else{
        $name = trim($_POST["name"]);
        $sql = "INSERT INTO quizzes (name) VALUES (?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            
            // Set parameters
            $param_name = $name;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                header("location: welcome.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
}
include_once('./header.php');
?>
<div class="bg-light p-5 rounded">
    <div class="card">
        <div class="card-header">
            <h4 class="text-gray-dark">إضافة اختبار جديد</h4>
        </div>
        <div class="card-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label class="form-label">اسم الإختبار </label>
                    <input type="text" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid': '' ?> "  name="name" >
                    <?php if(!empty($name_err)){?>
                    <div  class="invalid-feedback"><?php echo $name_err; ?></div>
                    <?php } ?>
                </div>
                <div class="form-group pt-3">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="./welcome.php" class="btn btn-warning">إلغاء</a>
                </div>
        </form>
        </div>
    </div>
</div>
<?php 
include_once('./footer.php');
?>