function InitAjax() {
  var ajax;
  try { /* пробуем создать компонент XMLHTTP для IE старых версий */
    ajax = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (e) {
      try {//XMLHTTP для IE версий >6
        ajax = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
      try {// XMLHTTP для Mozilla и остальных
        ajax = new XMLHttpRequest();
      } catch(e) { ajax = 0; }
    }
  }
  return ajax
}

function getHtmlDataByGroup(){
  ajax = InitAjax();
  if (!ajax) {
    alert("Ajax не инициализирован");
    return;
  }
  var group_val = document.getElementById("get_group").value;
  ajax.onreadystatechange = (function(){
    if(ajax.readyState == 4){
      if(ajax.status == 200){
        var by_group_div = document.getElementById('results-by-group');
        by_group_div.innerHTML = '<hr>'
        by_group_div.innerHTML += ajax.responseText;
        by_group_div.innerHTML += '<hr>'
      }
    }
  });
  var params = 'group=' + encodeURIComponent(group_val);
  ajax.open("GET", "by_group.php?"+params, true);
  ajax.send(null);
}

function getXMLDataByTeacher(){
  ajax = InitAjax();
  if (!ajax) {
    alert("Ajax не инициализирован");
    return;
  }
  var teacher_val = document.getElementById("get_teacher").value;
  ajax.onreadystatechange = (function(){
    if(ajax.readyState == 4){
      if(ajax.status == 200){
        var results_by_teacher_div = document.getElementById('results-by-teacher');
        var rows = ajax.responseXML.firstChild.children;
        var result = "<hr>";
        for (var i = 0; i < rows.length; i++) {
          result += "<p>";
          result += rows[i].children[0].firstChild.nodeValue + ', ';
          result += rows[i].children[1].textContent + ', ';
          result += rows[i].children[2].textContent + ', ';
          result += rows[i].children[3].textContent + ', ';
          result += rows[i].children[4].textContent + ', ';
          result += "</p>";
        }
        result += "<hr>";
        results_by_teacher_div.innerHTML = result;
      }
    }
  });
  var params = 'teacher=' + encodeURIComponent(teacher_val);
  ajax.open("GET", "by_teacher.php?"+params, true);
  ajax.send(null);
}

function getJSONDataByAuditorium(){
  // if (!ajax) {
  //   alert("Ajax не инициализирован");
  //   return;
  // }
  ajax = InitAjax();
  var auditorium_val = document.getElementById("get_auditorium").value;
  var params = 'auditorium=' + encodeURIComponent(auditorium_val);
  ajax.open("GET","by_auditorium.php?"+ params, true);
  ajax.onload = function() {
      if(ajax.status === 200){
        console.log(ajax.responseText);
        let res = JSON.parse(ajax.response);
        // alert('here');
        let output = "<hr>";
        res.lessons.forEach((lesson, i) => {
          output += `<p>${lesson}</p>`
        });
        output += "<hr>";
        document.getElementById('results-by-auditorium').innerHTML=output;
        }
      }
  // }
  // var params = 'auditorium=' + encodeURIComponent(teacher_val);
  // ajax.open("GET", "by_auditorium.php?"+params, true);
  ajax.send();
}
