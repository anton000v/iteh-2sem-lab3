
<html>
  <head>
     <meta charset="utf-8">
    <title>Обработка HTML формы с помощью PHP</title>

  </head>
  <body>
        <h1>Lab 2</h1>
        <p>By group:</p>
        <form method="get">
           <p><select size="1" name="group" id="get_group">
            <option disabled>Выберите группу</option>
            <?php
              require_once 'connect.php'; // подключаем скрипт

              // подключаемся к серверу
              $link = mysqli_connect($host, $user, $password, $database)
                  or die("Ошибка " . mysqli_error($link));

              // выполняем операции с базой данных
              $query ="SELECT ID_GROUPS,title FROM groups";
              $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
              if($result)
              {
                  // echo "Выполнение запроса прошло успешно";
                  while ($row = mysqli_fetch_assoc($result))
                  {
                     // echo $row['title'];

                  echo '<option value=" '.$row['ID_GROUPS'].' "> '.$row['title'].' </option>';
                  // echo "<option value=".`$row['ID_GROUPS']`.`>$row['title']`."</option>";
                  }
              }
              // закрываем подключение
              mysqli_close($link);
              ?>
           </select>
         </p>
         <p><input type="button" name="getByGroupButton" value="Узнать" onclick="getHtmlDataByGroup();"/></p>
        </form>
        <div id="results-by-group">
        </div>

        <p>By teacher:</p>
        <form method="get">
           <p><select size="1" name="teacher" id="get_teacher">
            <option disabled>Выберите учителя</option>
            <?php
              require_once 'connect.php'; // подключаем скрипт

              // подключаемся к серверу
              $link = mysqli_connect($host, $user, $password, $database)
                  or die("Ошибка " . mysqli_error($link));

              // выполняем операции с базой данных
              $query ="SELECT ID_Teacher, name FROM teacher";
              $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
              if($result)
              {
                  // echo "Выполнение запроса прошло успешно";
                  while ($row = mysqli_fetch_assoc($result))
                  {
                     // echo $row['title'];

                  echo '<option value=" '.$row['ID_Teacher'].' "> '.$row['name'].' </option>';
                  // echo "<option value=".`$row['ID_GROUPS']`.`>$row['title']`."</option>";
                  }
              }
              // закрываем подключение
              mysqli_close($link);
              ?>
           </select>
         </p>
         <p><input type="button" name="getByTeacherButton" value="Узнать" onclick="getXMLDataByTeacher();"/></p>
        </form>
        <div id="results-by-teacher">
        </div>


        <p>By auditorium:</p>
        <form action="by_auditorium.php" method="post">
           <p><select size="1" name="auditorium" id="get_auditorium">
            <option disabled>Выберите аудиторию</option>
            <?php
              require_once 'connect.php'; // подключаем скрипт

              // подключаемся к серверу
              $link = mysqli_connect($host, $user, $password, $database)
                  or die("Ошибка " . mysqli_error($link));

              // выполняем операции с базой данных
              $query ="SELECT auditorium FROM lesson";
              $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
              if($result)
              {
                  // echo "Выполнение запроса прошло успешно";
                  while ($row = mysqli_fetch_assoc($result))
                  {
                     // echo $row['title'];

                  echo '<option value=" '.$row['auditorium'].' "> '.$row['auditorium'].' </option>';
                  // echo "<option value=".`$row['ID_GROUPS']`.`>$row['title']`."</option>";
                  }
              }
              // закрываем подключение
              mysqli_close($link);
              ?>
           </select>
         </p>
         <p><input type="button" name="GetByAuditoriumButton" value="Узнать" onclick="getJSONDataByAuditorium();"></p>
        </form>
        <div id="results-by-auditorium">
        </div>


        <p>Add practical:</p>
        <form action="add_practical.php" method="post">
          <p><select size="1" name="group">
           <option disabled>Выберите группу</option>
           <?php
             require_once 'connect.php'; // подключаем скрипт

             // подключаемся к серверу
             $link = mysqli_connect($host, $user, $password, $database)
                 or die("Ошибка " . mysqli_error($link));

             // выполняем операции с базой данных
             $query ="SELECT ID_GROUPS,title FROM groups";
             $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
             if($result)
             {
                 // echo "Выполнение запроса прошло успешно";
                 while ($row = mysqli_fetch_assoc($result))
                 {
                    // echo $row['title'];

                 echo '<option value=" '.$row['ID_GROUPS'].' "> '.$row['title'].' </option>';
                 // echo "<option value=".`$row['ID_GROUPS']`.`>$row['title']`."</option>";
                 }
             }
             // закрываем подключение
             mysqli_close($link);
             ?>
          </select>
        </p>
        <p><select size="1" name="teacher" id="teacher">
         <option disabled>Выберите учителя</option>
         <?php
           require_once 'connect.php'; // подключаем скрипт

           // подключаемся к серверу
           $link = mysqli_connect($host, $user, $password, $database)
               or die("Ошибка " . mysqli_error($link));

           // выполняем операции с базой данных
           $query ="SELECT ID_Teacher, name FROM teacher";
           $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
           if($result)
           {
               // echo "Выполнение запроса прошло успешно";
               while ($row = mysqli_fetch_assoc($result))
               {
                  // echo $row['title'];

               echo '<option value=" '.$row['ID_Teacher'].' "> '.$row['name'].' </option>';
               // echo "<option value=".`$row['ID_GROUPS']`.`>$row['title']`."</option>";
               }
           }
           // закрываем подключение
           mysqli_close($link);
           ?>
        </select>
      </p>
      <label for="week_day">id:</label>
      <input type="text" id="id" name="id" required><br><br>
      <label for="week_day">week_day:</label>
      <input type="text" id="week_day" name="week_day" required><br><br>
      <label for="lesson_number">lesson_number:</label>
      <input type="text" id="lesson_number" name="lesson_number" required><br><br>
      <label for="auditorium">auditorium:</label>
      <input type="text" id="auditorium" name="auditorium" required><br><br>
      <label for="disciple">disciple:</label>
      <input type="text" id="disciple" name="disciple" required><br><br>

      <p><input type="submit" value="Создать"></p>
      </form>
  
      <script src="AjaxGetFunctions.js"></script>
    </body>
</html>
