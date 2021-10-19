<?php
require_once "config.php";

function getData($link)
{
    $sql = "SELECT * FROM questions  WHERE id_quiz = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        // Set parameters
        $param_id = trim($_GET["id"]);
        if (mysqli_stmt_execute($stmt)) {
            return  mysqli_stmt_get_result($stmt);
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
}

$questions = getData($link);

if (isset($_POST['submit_quiz'])) {
    $count_correct = 0 ;
    $count_incorrect = 0 ;
    while ($row = mysqli_fetch_array($questions)) {
        $corrects[$row['id']] = $row['correct'];
    }
    foreach ($corrects as $key => $value) {
        $answers[$key] = ($_POST['choice'][$key] == $value) ? "t" : "f";
        $count_correct = ($answers[$key] == "t") ? ++$count_correct : ++$count_incorrect ;
        // die(print ($count_correct));
    }
    $questions = getData($link);
}
// Close connection
mysqli_close($link);

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quizzes</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <style>
        body {
            background-color: #eee
        }
    </style>
</head>

<body>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded" aria-label="Eleventh navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.php">
                    <img class="d-block mx-auto mb-4" src="./assets/img/logo.jpeg" alt="" width="72" height="57">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample09">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    </ul>
                    <a href="./index.php" class="btn btn-outline-secondary">العودة للصفحة الرئيسية</a>
                </div>
            </div>
        </nav>
        <div class="alert alert-info mt-3" role="alert">
            اختر الصورة المناسبة .
        </div>
        <?php if (isset($count_correct)) { ?>
            <div class="alert alert-info mt-3" role="alert">
                عدد الإجابات الصحيحة  = <?php echo $count_correct ?>
            </div>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $_GET["id"] ?>" method="POST">
            <input type="hidden" name="id_quiz" value="<?php echo $_GET["id"] ?>">
            <?php
            if (mysqli_num_rows($questions) > 0) {
                while ($row = mysqli_fetch_array($questions)) {
            ?>
                    <div class="card mt-3">
                        <div class="card-header ">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="text-gray-dark"><?php echo $row['question'] ?> ؟ </h4>
                                    </div>
                                    <?php if ($answers[$row['id']] == 't') { ?>
                                        <div class="col-md-4 offset-md-4 text-end">
                                            اجابة صح
                                        </div>
                                    <?php } ?>
                                    <?php if ($answers[$row['id']] == 'f') { ?>
                                        <div class="col-md-4 offset-md-4 text-end">
                                            اجابة خاطئة
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row g-2">
                                    <div class="col-3">
                                        <div class="p-3 border bg-light">
                                            <input class="form-check-input" type="radio" name="choice[<?php echo $row['id'] ?>]" id="choice-<?php echo $row['id'] ?>-1" value="1">
                                            <label class="form-check-label" for="choice-<?php echo $row['id'] ?>-1">
                                                <img src="./uploads/<?php echo $row['answer1'] ?>" class="img-fluid img-thumbnail" alt="...">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="p-3 border bg-light">
                                            <input class="form-check-input" type="radio" name="choice[<?php echo $row['id'] ?>]" id="choice-<?php echo $row['id'] ?>-2" value="2">
                                            <label class="form-check-label" for="choice-<?php echo $row['id'] ?>-2">
                                                <img src="./uploads/<?php echo $row['answer2'] ?>" class="img-fluid img-thumbnail " alt="...">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="p-3 border bg-light">
                                            <input class="form-check-input" type="radio" name="choice[<?php echo $row['id'] ?>]" id="choice-<?php echo $row['id'] ?>-3" value="3">
                                            <label class="form-check-label" for="choice-<?php echo $row['id'] ?>-3">
                                                <img src="./uploads/<?php echo $row['answer3'] ?>" class="img-fluid img-thumbnail " alt="...">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="p-3 border bg-light">
                                            <input class="form-check-input" type="radio" name="choice[<?php echo $row['id'] ?>]" id="choice-<?php echo $row['id'] ?>-4" value="4">
                                            <label class="form-check-label" for="choice-<?php echo $row['id'] ?>-4">
                                                <img src="./uploads/<?php echo $row['answer4'] ?>" class="img-fluid img-thumbnail " alt="...">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
            <div class="card text-center my-5">
                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-success mx-3" name="submit_quiz">ارسال الإجابة </button>
                    <button type="button" class="btn btn-danger">الغاء </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>