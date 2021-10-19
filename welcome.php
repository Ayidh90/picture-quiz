<?php 
include_once('./header.php');
$sql = "SELECT * FROM quizzes";
$quizzes = mysqli_query($link, $sql);

include_once('./header.php');
?>
  <div class="bg-light p-5 rounded">
  <div class="card">
  <div class="card-header p-4">
  <div class="container">
  <div class="row">
    <div class="col">   
      <h3 class="text-gray-dark">الاختبارات</h3>
    </div>
    <div class="col text-end">
      <a href="./add-quiz.php" class="btn btn-primary">اضافة</a>
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
              if(mysqli_num_rows($quizzes) > 0){
                while($row = mysqli_fetch_array($quizzes)){
            ?>
              <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td> 
                  <div class="btn-group">
                    <a href="./questions.php?id=<?php echo $row['id'] ?>" class="btn btn-warning">الاسئلة </a>
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
