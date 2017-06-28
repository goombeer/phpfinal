 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>管理画面</title>
     <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
     <link rel="stylesheet" href="./css/show.css">
     <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
   </head>
   <body id="body">
     <div class="main">
     <div class="table_area">
       <table id="table">
         <tr class="article">
         </tr>
       </table>
       <button type="button" name="show" id="show">一覧表示</button>
       <button type="button"  id="notice">合否を通知する</button>
       <a href="logout.php"><button type="button" name="logout" id="logout" >ログアウト</button></a>
     </div>
      <div class="chat">
          <ul id="output"></ul>
          <div id="input">
            <input type="text" name="" value="" id="text" placeholder="メッセージ内容を入力してください"><button type="button" name="button" id="send">送信</button>
          </div>
      </div>
     </div>
     <script src="https://www.gstatic.com/firebasejs/4.1.1/firebase.js"></script>
     <script>
     //firebase部分
     var config = {
       apiKey: "AIzaSyCwoztDzCyiGFSJdOocdVDAdg48fkY_kG8",
       authDomain: "linebot-834b3.firebaseapp.com",
       databaseURL: "https://linebot-834b3.firebaseio.com",
       projectId: "linebot-834b3",
       storageBucket: "linebot-834b3.appspot.com",
       messagingSenderId: "616427642771"
     };
     firebase.initializeApp(config);
     let path ;
     let newPostRef = firebase.database().ref('U9c5456ca15f105b2e732347277497114');
     let userID ;
    // ---firebase部分---
    //mobile_idの取り出し
      $(document).on('click','.check',function(e){
        let number =e.target.value;
        console.log(number);
        $.ajax('mobile_id_get.php',
        {
          type: 'POST',
          dataType: 'text',
          data:{number:number}
        })
        .done(function (data) {
          userID = data;
      })

        .fail(function (data) {
        });

      });

      $("#send").click(function(){
        let text =$("#text").val();
        newPostRef.push({
            name:"root",
            text: text,
        });
        $.ajax('push_message.php',
        {
          type: 'POST',
          dataType: 'text',
          data:{
            userID:userID,
            text:text
          }
        })

        .done(function (data) {
          $("#text").val("");
      })

      });



      newPostRef.on('child_added',function(snapshot){
        let obj = snapshot.val();
        console.log(obj);
        let username = obj.name;
        console.log(username);
        let message = obj.text;
        console.log(message);

        if ( username == "root" ) {
               var str = $("<il><p class='sender_name me'></p><p class='right_balloon'>" + message + "</p><p class='clear_balloon'></p></il>");
           } else {
               var str = $("<il><p class='sender_name'></p><p class='left_balloon'>" + message + "</p><p class='clear_balloon'></p></il>");
           }
           $("#output").append(str);
           //投稿された最新を表示
           $("#output").animate({
             scrollTop: $('#output').prop("scrollHeight")
                      }, 0);


      });





      //データベースから結果を取り出す
      $('#show').click(function(){
        $('#show').hide();
        $('#notice').show();
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
              if (i == 0) {
                td += '<td class="data"><input type="radio" name="num" id="num" class="check" value='+data2[j][i]+'>'+data2[j][i]+'</td>';
              }
              else if (data2[j][i] == "" || data2[j][i] == null) {
                td += '<td class="data"><select name="judge" id="judge"><option value="pass">合格</option><option value="unpass">不合格</option></td>';
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

      //合否通知
      $('#notice').click(function(){
        var s =$("[name='judge']").serializeArray();
        console.log(s);
        $.ajax('notice.php',
        {
          type: 'POST',
          dataType: 'json',
          data:{judge:s}
        })
        .done(function (data) {
          console.log(data);

      })

        .fail(function (data) {
          console.log(data);
        });
      });





     </script>
   </body>
 </html>
