    <!-- banner : head -->

    <div id="wrap" class="event_popup" style="text-align:center; padding:10px;">

      <div class="banner">
        <div>
          <a href="<?= $VIEW['link']; ?>" target="_blank">
            <img src="<?= $URL['core']['root']; ?>core/file/&file=popup/<?= $VIEW['popup_banner']; ?>&hash=<?= hash('md5', filesize(DATA_PATH . 'popup/' . $VIEW['popup_banner'])); ?>" alt="<?= $VIEW['title']; ?>" />
          </a>
        </div>
        <div class="btn_close">
          <input type="checkbox" id="close_today" />
          <label for="close_today">1일간 열지 않음</label>
          <button type="button" class="glyphicon glyphicon-remove btn_close_popup"></button>
        </div>
      </div>

      </div>

    </div>
    <script>
      function notice_setCookie( name, value, expiredays ){ //Cookie 값 확인 function
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
      }

      $( ".btn_close_popup" ).click(function() {
        $( ".event_popup" ).hide( "fold", 1000 );
      });
      $( "#close_today").click(function() {
        notice_setCookie( "event_popup", "done" , 1);
        $(".btn_close_popup").click();
      });
    </script>

    <!-- banner : tail -->

