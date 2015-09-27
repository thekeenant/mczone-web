    <?
    $m_time = explode(" ",microtime());
    $m_time = $m_time[0] + $m_time[1];
    $loadend = $m_time;
    $loadtotal = ($loadend - $loadstart);
    $loadtime = round($loadtotal,4);
    connect();
    $q = mysql_query("SELECT now()");
    while ($row = mysql_fetch_array($q))
      $time = $row['now()'];
    ?>
    <!--
    <hr>
    <footer>
      <ul class="nav nav-pills">
        <li class="pull-left">
          <a>© 2012-<?= date("Y"); ?> MC Zone</a>
        </li>
        <li class="pull-left">
          <a><?= date("F jS Y g:i A", strtotime($time)); ?></a>
        </li>
        <li class="pull-right">
          <a href="/terms">Terms</a>
        </li>
        <li class="pull-right">
          <a href="/staff">Staff</a>
        </li>
        <li class="pull-right">
          <a href="/infractions">Infractions</a>
        </li>
      </ul>
    </footer>
    -->
  </div>
      <style>
        html, body {
            height: 100%;
        }
        footer {
            color: #999;
            background: #f5f5f5;
            padding: 17px 0 20px 0;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }
        footer .divider {
          color: #999;
        }
        footer a {
            color: #888;
        }
        .wrapper {
            min-height: 100%;
            height: auto !important;
            height: 100%;
            margin: 0 auto -63px;
        }
        .push {
            height: 63px;
        }
        /* not required for sticky footer; just pushes hero down a bit */
        .wrapper > .container {
            padding-top: 60px;
        }
    </style>
    <br />
    <footer>
      <div class="container">
        © 2012-<?= date("Y"); ?> MC Zone</a>
        <div class="pull-right">
          <a href="/terms">Terms</a> <span class="divider">/</span> 
          <a href="/staff">Staff</a> <span class="divider">/</span>
          <a href="/infractions">Infractions</a>
        </div>
       </div>
    </footer>
  <? if ($title != null) { ?>
  <script type="text/javascript">
  $('title').html('MC Zone » <?= $title ?>');
  </script>
  <? } ?>

  <script src="/assets/js/wysihtml.js"></script>
  <script src="/assets/js/parser.js"></script>
  <script src="/assets/js/texteditor.js"></script>
  <script src="/assets/js/application.js" type="text/javascript"></script>

  <script>
  $('#forum-sidebar').find('a').each(function() {
    if ("<?= $category ?>" != "")
      $(this).parent().removeClass("active");

    var equal = $(this).html().toUpperCase() == "<?= $category ?>".toUpperCase();
    if (equal) {
      $(this).parent().addClass("active");
      return false;
    }
  });
  </script>

  <script>
  $('.texteditor').wysihtml5();
  </script>
</body>
</html>

<? ob_flush() ?>