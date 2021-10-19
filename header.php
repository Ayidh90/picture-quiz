<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";
?>
 
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      body {
  padding-bottom: 20px;
}

.navbar {
  margin-bottom: 20px;
}

    </style>
<title>Welcome</title>
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
            <a href="reset-password.php" class="btn btn-warning">اعد ضبط كلمه السر</a>
            <a href="logout.php" class="btn btn-danger ms-3">تسجيل الخروج من حسابك</a>
        </div>
      </div>
    </nav>
    <div class="alert alert-secondary" role="alert">
        <h4 class="">أهلا, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. مرحبا بكم في موقعنا.</h4>
    </div>
