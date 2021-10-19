<?php 
include_once('./header.php');
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
                header("location: welcome.php");
                exit();
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
    
    $sql = "SELECT * FROM questions  WHERE id_quiz = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        // Set parameters
        $param_id = trim($_GET["id"]);
        if(mysqli_stmt_execute($stmt)){
            $questions = mysqli_stmt_get_result($stmt);
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // Close connection
    mysqli_close($link);
}

include_once('./header.php');
?>
<div class="bg-light p-5 rounded">
    <div class="card">
        <div class="card-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="text-gray-dark">إضافة اسئلة للاختبار  : <?php echo $name ?></h4>
                    </div>
                    <div class="col-md-4 offset-md-4 text-end">
                        <a href="./add-question.php?id=<?php echo $id ?>" class="btn btn-primary ">اضافة</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">الاسم</th>
              <th scope="col">التفاصيل</th>
            </tr>
          </thead>
          <tbody>

            <?php 
              if(mysqli_num_rows($questions) > 0){
                while($row = mysqli_fetch_array($questions)){
            ?>
              <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['question'] ?></td>
                <td> 
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">حذف </button>
                  </div>
                </td>
              </tr>
            <?php }}?>
          </tbody>
        </table>
      </div>
      </div>
    </div>
        </div>
    </div>
</div>
<?php 
include_once('./footer.php');
?>