<?php 
include_once('./header.php');

function uploadedAnswer($id_quiz,$file,$answer) {
    $name = $file["name"];
    $tempname = $file["tmp_name"];
    $filename = 'quiz'.$id_quiz.'q'. time().'_'. $answer.'.'.pathinfo($name,PATHINFO_EXTENSION);
    $url_file = "uploads/".$filename;
    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $url_file))  {
        return $filename;
    }else{
        echo "Oops! Something went wrong. Please try again later".$file["error"];
        exit();
    }
}
// form post 
if (isset($_POST['add_question'])) {
    //uploade
    $answer1_name = uploadedAnswer($_POST['id_quiz'],$_FILES["answer1"],'answer1');
    $answer2_name = uploadedAnswer($_POST['id_quiz'],$_FILES["answer2"],'answer2');
    $answer3_name = uploadedAnswer($_POST['id_quiz'],$_FILES["answer3"],'answer3');
    $answer4_name = uploadedAnswer($_POST['id_quiz'],$_FILES["answer4"],'answer4');

    // insert question
    $sql = "INSERT INTO questions (id_quiz,question,answer1,answer2,answer3,answer4,correct) VALUES (?,?,?,?,?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isssssi", $id_quiz, $question, $answer1_name, $answer2_name, $answer3_name, $answer4_name, $correct);

            // Set parameters
            $id_quiz = trim($_POST["id_quiz"]);
            $correct = trim($_POST["correct"]);
            $question = trim($_POST["question"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                header("location: questions.php?id=".$id_quiz);
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
}

// get data quiz
if(empty($_GET['id'])){
    echo "Oops! Something went wrong. Please try again later.";
    exit();
}else{
    $sql = "SELECT * FROM quizzes WHERE id = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        // Set parameters
        $param_id = trim($_GET["id"]);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $name = $row["name"];
                $id = $row["id"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                echo "Oops! Something went wrong. Please try again later.";
                exit();
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}

 // Close connection
 mysqli_close($link);

?>

<div class="bg-light p-5 rounded">
    <div class="card">
        <div class="card-header">
            <h4 class="text-gray-dark">إضافة سؤال جديد لإختبار : <?php echo $name ?> </h4>
        </div>
        <div class="card-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_quiz" value="<?php echo $id ?>">
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">السؤال : </label>
            <div class="col-sm-10">
                <input type="text"  class="form-control  <?php echo (!empty($question_err)) ? 'is-invalid': '' ?>" name="question">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">الصورة الاولى</label>
            <div class="col-sm-10">
                <input type="file" id="formFile"  class="form-control  <?php echo (!empty($answer1_err)) ? 'is-invalid': '' ?>" name="answer1">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">الصورة الثانية </label>
            <div class="col-sm-10">
            <input type="file" id="formFile"  class="form-control  <?php echo (!empty($answer2_err)) ? 'is-invalid': '' ?>" name="answer2">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">الصورة الثالثة </label>
            <div class="col-sm-10">
                <input type="file" class="form-control  <?php echo (!empty($answer3_err)) ? 'is-invalid': '' ?>" name="answer3" > 
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">الصورة الرابعة </label>
            <div class="col-sm-10">
            <input type="file" id="formFile"  class="form-control  <?php echo (!empty($answer4_err)) ? 'is-invalid': '' ?>" name="answer4">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">رقم الصورة الصحيحة </label>
            <div class="col-sm-10">
                <input type="number"  class="form-control  <?php echo (!empty($correct_err)) ? 'is-invalid': '' ?>" name="correct" min="1" max="4">
            </div>
        </div>
        <div class="form-group pt-3">
            <button type="submit" class="btn btn-primary" name="add_question">حفظ</button>
            <a href="./welcome.php" class="btn btn-warning">إلغاء</a>
        </div>
        </form>
        </div>
    </div>
</div>
<?php 
include_once('./footer.php');
?>