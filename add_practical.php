<?php
if(isset($_POST['teacher'],$_POST['group'],$_POST['id'],$_POST['week_day'],
$_POST['lesson_number'], $_POST['auditorium'], $_POST['disciple']))
{

      $teacher_opt = $_POST['teacher'];
      $group_opt = $_POST['group'];

      $id = $_POST['id'];
      $week_day = $_POST['week_day'];
      $lesson_number = $_POST['lesson_number'];
      $auditorium = $_POST['auditorium'];
      $disciple = $_POST['disciple'];
      $type = "Practical";


      require_once 'connect.php'; // подключаем скрипт

      // BY TRANSACTION
      $conn = new mysqli($host, $user, $password, $database);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $conn->begin_transaction();
      if (!($stmt = $conn->prepare("INSERT INTO lesson (ID_Lesson, week_day, lesson_number, auditorium, disciple, type) VALUES (?,?,?,?,?,?)"))) {
          die("Не удалось подготовить запрос: (" . $conn->errno . ") " . $conn->error);
      }
      // $id = 1;
      if (!$stmt->bind_param("isisss", $id, $week_day, $lesson_number, $auditorium, $disciple, $type)) {
          die("Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error);
      }

      if (!$stmt->execute()) {
          die("Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error);
      }
      else{
          echo "<p>New lesson created successfully</p>" ;
      }

      $sql = "INSERT INTO lesson_groups
      VALUES ('{$id}','{$group_opt}')";
      if ($conn->query($sql) === TRUE) {
          echo "<p>Lesson group created successfully</p>";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $sql = "INSERT INTO lesson_teacher
      VALUES ('{$group_opt}','{$id}')";
      if ($conn->query($sql) === TRUE) {
          echo "<p>Teacher lesson created successfully</p>";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $conn->commit();

      $conn->close();


      // #---------------------------------------------------------------------------------
      //
      //       // Create connection
      // $conn = new mysqli($host, $user, $password, $database);
      // // Check connection
      // if ($conn->connect_error) {
      //     die("Connection failed: " . $conn->connect_error);
      // }
      //
      // $sql = "INSERT INTO lesson (ID_Lesson, week_day, lesson_number, auditorium, disciple, type)
      // VALUES ('{$id}','{$week_day}', '{$lesson_number}', '{$auditorium}','{$disciple}','{$type}')";
      // // echo $sql;
      // if ($conn->query($sql) === TRUE) {
      //     echo "<p>New lesson created successfully</p>";
      // } else {
      //     echo "Error: " . $sql . "<br>" . $conn->error;
      // }
      //
      // $sql = "INSERT INTO lesson_groups
      // VALUES ('{$id}','{$group_opt}')";
      // if ($conn->query($sql) === TRUE) {
      //     echo "<p>Lesson group created successfully</p>";
      // } else {
      //     echo "Error: " . $sql . "<br>" . $conn->error;
      // }
      //
      // $sql = "INSERT INTO lesson_teacher
      // VALUES ('{$group_opt}','{$id}')";
      // if ($conn->query($sql) === TRUE) {
      //     echo "<p>Teacher lesson created successfully</p>";
      // } else {
      //     echo "Error: " . $sql . "<br>" . $conn->error;
      // }
      //
      //
      // $conn->close();

}
else
{
    echo "Введенные данные некорректны";
}
?>
