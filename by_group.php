<?php
if(isset($_GET['group']))
{
      $group_opt = $_GET['group'];

      require_once 'connect.php'; // подключаем скрипт

      // подключаемся к серверу
      $link = mysqli_connect($host, $user, $password, $database)
          or die("Ошибка " . mysqli_error($link));

      // выполняем операции с базой данных
      $query ="SELECT week_day, lesson_number,auditorium, disciple, type FROM lesson INNER JOIN lesson_groups on lesson.ID_Lesson = lesson_groups.FID_Lesson2 WHERE lesson_groups.FID_Groups = $group_opt";
      $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
      if($result)
      {
          // echo "Выполнение запроса прошло успешно";
          while ($row = mysqli_fetch_assoc($result))
          {
             echo "<p>{$row['week_day']},  {$row['lesson_number']} lesson, {$row['auditorium']} auditorium,  {$row['disciple']},  {$row['type']}</p>";
          }
      }
      // закрываем подключение
      mysqli_close($link);

}
else
{
    echo "Введенные данные некорректны";
}
?>
