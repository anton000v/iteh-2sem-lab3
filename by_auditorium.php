<?php
if(isset($_GET['auditorium']))
{
      $auditorium = trim($_GET['auditorium']);
      require_once 'connect.php'; // подключаем скрипт

      // подключаемся к серверу
      $link = mysqli_connect($host, $user, $password, $database)
          or die("Ошибка " . mysqli_error($link));

      // выполняем операции с базой данных

      $query ="SELECT week_day, lesson_number,auditorium, disciple, type FROM lesson where auditorium='".$auditorium."'";
      $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
      if($result)
      {
        header('Content-Type: application/json');
        header("Cache-Control: no-cache, must-revalidate");
        $for_json_encode = array('lessons' => []);
        while ($row = mysqli_fetch_assoc($result))
        {
          array_push($for_json_encode['lessons'], "{$row['week_day']},  {$row['lesson_number']} lesson, {$row['auditorium']} auditorium,  {$row['disciple']},  {$row['type']}");
        }
        echo json_encode($for_json_encode);
      }
      // закрываем подключение
      mysqli_close($link);

}
else
{
    echo "Введенные данные некорректны";
}
?>
