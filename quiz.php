<?php
require_once "config.php";
$sql = "SELECT * FROM quizzes";
$quizzes = mysqli_query($link, $sql);

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
       body, html {
        height: 100%;
        }

        .bg {
        /* The image used */
        background-image: url("./assets/img/bg3.jpeg");

        /* Full height */
        height: 100%;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        }
   </style>
</head>

<body class="bg">
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
            <a href="./index.php" class="btn btn-warning mx-3">الصفحة الرئيسية</a>
            <a href="./login.php" class="btn btn-warning">تسجيل الدخول</a>
        </div>
      </div>
    </nav>
        <div class="alert alert-info mt-3" role="alert">
            اختر الاختبار المناسب .
        </div>
        <div class="row">
            <?php
            if (mysqli_num_rows($quizzes) > 0) {
                while ($row = mysqli_fetch_array($quizzes)) {
            ?>
                    <div class="col-md-3 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name'] ?></h5>
                                <p class="card-text"></p>
                                <a href="./start-quiz.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-primary">بدء الإختبار</a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</body>

</html>