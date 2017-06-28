<?php
session_start();
if(
!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id() 
){
echo "LOGIN ERROR";
header("Location: index.php");
}

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>管理画面</title>
     <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
     <link rel="stylesheet" href="./css/show.css">
     <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
   </head>
   <body>
     <form id="notice" method="post">
     <div class="main">
     <div class="table_area">
       <table id="table">
         <tr class="article">
         </tr>
       </table>
       <button type="button" name="show" id="show">一覧表示</button>
       <a href="logout.php"><button type="button" name="logout" id="logout" >ログアウト</button></a>
     </div>

     </div>
   </form>
     <script>
      $('#show').click(function(){
        $.ajax('database.php',
        {
          type: 'GET',
          dataType: 'json'
        })
        .done(function (data) {
          var data2 = [];
          for (var i = 0; i < data.length; i++) {
            data2.push([]);
            Object.keys(data[i]).map(function(key, index) {
              data2[i].push(data[i][key]);
            });
          }
          var data3 = Object.keys(data[0]).map(function(key, index) {
            return key;
          });

          for (var i = 0; i < data3.length; i++) {
            var th='<th class='+data3[i]+'>'+data3[i]+'</th>';
            $('.article').append(th);
          }
          for (var j = 0; j < data2.length; j++) {
            var td ='<tr>';
            for (var i = 0; i < data2[j].length; i++) {
              if (data2[j][i] == "") {
                td += '<td class="data"><select name="judge" id="judge"><option value="pass" >合格</option><option value="unpass">不合格</option></td>';
              } else {
                td += '<td class="data">'+data2[j][i]+'</td>';
              }
            }
            td += '<tr>';
            $('#table').append(td);

        }

      })

        .fail(function (data) {
          console.log(data);
        });
      });

     </script>
   </body>
 </html>
