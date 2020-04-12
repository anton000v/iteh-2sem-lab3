<?php
if(isset($_GET['teacher']))
{
    $teacher_opt = $_GET['teacher'];

      require_once 'connect.php'; // подключаем скрипт

      // подключаемся к серверу
      $link = mysqli_connect($host, $user, $password, $database)
          or die("Ошибка " . mysqli_error($link));

      // выполняем операции с базой данных
      // $query ="SELECT week_day, lesson_number,auditorium, disciple, type FROM lesson INNER JOIN lesson_teacher on lesson.ID_Lesson = lesson_teacher.FID_Lesson1 WHERE lesson_teacher.FID_Teacher = $teacher_opt";
      //
      //
      // $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
      // if($result)
      // {
      //     // echo "Выполнение запроса прошло успешно";
      //     while ($row = mysqli_fetch_assoc($result))
      //     {
      //        echo "<p>{$row['week_day']},  {$row['lesson_number']} lesson, {$row['auditorium']} auditorium,  {$row['disciple']},  {$row['type']}</p>";
      //     }
      // }


      $query="SELECT week_day, lesson_number,auditorium, disciple, type FROM lesson INNER JOIN lesson_teacher on lesson.ID_Lesson = lesson_teacher.FID_Lesson1 WHERE lesson_teacher.FID_Teacher =?"; // объявляем переменную с запросом
      // echo $query;
      $stmt = $link->prepare($query); // подготавливаем наш запрос
      $stmt->bind_param('s', $teacher_opt); // присваеваем первому ? в запросе параметр с типом данных s (string)
      $stmt->execute(); // выполняем подготовленный запрос
      $result=$stmt->get_result(); // получаем результат из подготовленного запроса
      // $rows=$result->num_rows; // получаем кол-во строк в полученном результате из запроса
      if($result)
      {
        header('Content-Type: text/xml');
        header("Cache-Control: no-cache, must-revalidate");
        echo '<?xml version="1.0" encoding="utf8" ?>';
        echo "<root>";
          // echo "Выполнение запроса прошло успешно";
          while ($row = mysqli_fetch_assoc($result))
          {
            $week_day = $row['week_day']; $lesson_number = $row['lesson_number'];
            $auditotium = $row['auditorium']; $disciple = $row['disciple'];
            $type = $row['type'];
            print "<row><WeekDay>$week_day</WeekDay><LessonNumber>$lesson_number</LessonNumber>
            <Auditorium>$auditotium</Auditorium> <Disciple>$disciple</Disciple>
            <Type>$type</Type></row>";
             // echo "<p>{$row['week_day']},  {$row['lesson_number']} lesson, {$row['auditorium']} auditorium,  {$row['disciple']},  {$row['type']}</p>";
          }
          echo "</root>";
      }
      $result->free(); // очищаем результат
      $stmt->close(); // закрываем подготовленный запрос
      // закрываем подключение
      mysqli_close($link);

}
else
{
    echo "Введенные данные некорректны";
}
?>
