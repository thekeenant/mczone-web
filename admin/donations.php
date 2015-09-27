
<? connect() ?>

<script type="text/javascript">
Highcharts.visualize = function(table, options) {
        // the categories
        options.xAxis.categories = [];
        $('tbody th', table).each( function(i) {
          options.xAxis.categories.push(this.innerHTML);
        });
        
        // the data series
        options.series = [];
        $('tr', table).each( function(i) {
          var tr = this;
          $('th, td', tr).each( function(j) {
            if (j > 0) { // skip first column
              if (i == 0) { // get the name and init the series
                options.series[j - 1] = { 
                  name: this.innerHTML,
                  data: []
                };
              } else { // add values
                options.series[j - 1].data.push(parseFloat(this.innerHTML));
              }
            }
          });
        });
        
        var chart = new Highcharts.Chart(options);
        
        
      }
      
      // On document ready, call visualize on the datatable.
      $(document).ready(function() {      
        var table = document.getElementById('datatable'),
        options = {
         chart: {
          renderTo: 'container',
          defaultSeriesType: 'line',
          backgroundColor:'rgba(255, 255, 255, 0.1)'
        },
        title: {
          text: 'Donations'
        },
        xAxis: {
        },
        yAxis: {
          title: {
           text: 'Donation (USD)'
         }
       },
       tooltip: {
        formatter: function() {
         return '<b>'+ this.series.name +'</b><br/>$'+
         this.y;
       }
     }
   };
   
   
   Highcharts.visualize(table, options);
 });
      </script>

      <script type="text/javascript">
      Highcharts.visualize = function(table, options) {
        // the categories
        options.xAxis.categories = [];
        $('tbody th', table).each( function(i) {
          options.xAxis.categories.push(this.innerHTML);
        });
        
        // the data series
        options.series = [];
        $('tr', table).each( function(i) {
          var tr = this;
          $('th, td', tr).each( function(j) {
            if (j > 0) { // skip first column
              if (i == 0) { // get the name and init the series
                options.series[j - 1] = { 
                  name: this.innerHTML,
                  data: []
                };
              } else { // add values
                options.series[j - 1].data.push(parseFloat(this.innerHTML));
              }
            }
          });
        });
        
        var chart = new Highcharts.Chart(options);
        
        
      }
      
      // On document ready, call visualize on the datatable.
      $(document).ready(function() {      
        var table = document.getElementById('datatable2'),
        options = {
         chart: {
          renderTo: 'container1',
          defaultSeriesType: 'line',
          backgroundColor:'rgba(255, 255, 255, 0.1)'
        },
        title: {
          text: 'Hourly Donations'
        },
        xAxis: {
        },
        yAxis: {
          title: {
           text: 'Donation (USD)'
         }
       },
       tooltip: {
        formatter: function() {
         return '<b>'+ this.series.name +'</b><br/>$'+
         this.y;
       }
     }
   };
   
   
   Highcharts.visualize(table, options);
 });
      </script>

      <?
      $g1 = array();
      $g2 = array();

      $q = mysql_query("SELECT * FROM donations ORDER BY date ASC");
      while ($row = mysql_fetch_array($q)) {
        $time = strftime('%b %d, %Y', strtotime($row['date']));
        $g1[$time] += $row['amount'];

        $time = strftime('%k', strtotime($row['date']));
        $g2[$time] += $row['amount'];
      }

      ksort($g2);
      
      $curday = null;
      $lastmonth = 0.0;
      $c = 0;
      $q = mysql_query("SELECT * FROM donations WHERE MONTH(date) = MONTH(CURDATE() - INTERVAL 1 MONTH) ORDER BY date DESC");
      while ($row = mysql_fetch_array($q)) {
        $d = date_parse($row['date']);
        if ($curday != $d['day']) {
          $curday = $d['day'];
          $c += 1;
        }
        $lastmonth += $row['amount'];
      }
      $lastmonth = round($lastmonth);
      $lastav = round($lastmonth / $c);
      
      $curday = null;
      $c = 0;
      $month = 0.0;
      $q = mysql_query("SELECT * FROM donations WHERE MONTH(date) = MONTH(CURDATE()) ORDER BY date DESC");
      while ($row = mysql_fetch_array($q)) {
        $d = date_parse($row['date']);
        if ($curday != $d['day']) {
          $curday = $d['day'];
          $c += 1;
        }
        $month += $row['amount'];
      }
      $month = round($month);
      $av = round($month / $c);
      
      
      $lastvotes = 0;
      $q = mysql_query("SELECT * FROM votes WHERE MONTH(date) = MONTH(CURDATE() - INTERVAL 1 MONTH)");
      while ($row = mysql_fetch_array($q)) {
        $lastvotes += 1;
      }
      
      $thisvotes = 0;
      $q = mysql_query("SELECT * FROM votes WHERE MONTH(date) = MONTH(CURDATE())");
      while ($row = mysql_fetch_array($q)) {
        $thisvotes += 1;
      }
      
      $lastusers = 0;
      $q = mysql_query("SELECT * FROM players WHERE MONTH(created) = MONTH(CURDATE() - INTERVAL 1 MONTH)");
      while ($row = mysql_fetch_array($q)) {
        $lastusers += 1;
      }
      
      $thisusers = 0;
      $q = mysql_query("SELECT * FROM players WHERE MONTH(created) = MONTH(CURDATE())");
      while ($row = mysql_fetch_array($q)) {
        $thisusers += 1;
      }
      ?>
      
      <div class="row facts">
        <div class="span2">
          <center>
            Last month:
            <h1>$<?= $lastmonth ?></h1>
            <h5>$<?= $lastav ?>/day</h5>
          </center>
        </div>
        <div class="span2">
          <center>
            This month:
            <h1>$<?= $month ?></h1>
            <h5>$<?= $av ?>/day</h5>
          </center>
        </div>
        <div class="span2">
          <center>
            Last month users:
            <h1><?= $lastusers ?></h1>
          </center>
        </div>
        <div class="span2">
          <center>
            This month users:
            <h1><?= $thisusers ?></h1>
          </center>
        </div>
        <div class="span2">
          <center>
            Last month votes:
            <h1><?= $lastvotes ?></h1>
          </center>
        </div>
        <div class="span2">
          <center>
            This month votes:
            <h1><?= $thisvotes ?></h1>
          </center>
        </div>
      </div>
      
      <table id="datatable" style="display:none;">
        <thead>
          <tr>
            <th>Date</th>
            <th>Donation</th>
          </tr>
        </thead>
        <tbody>
          <? foreach ($g1 as $day => $count) { ?>
          <tr>
            <th><?= $day ?></th>
            <td><?= $count ?></td>
          </tr>
          <? } ?>
        </tbody>
      </table>

      <table id="datatable2" style="display:none;">
        <thead>
          <tr>
            <th>Date</th>
            <th>Donation</th>
          </tr>
        </thead>
        <tbody>
          <? foreach ($g2 as $day => $count) { ?>
          <tr>
            <th><?= $day ?></th>
            <td><?= $count ?></td>
          </tr>
          <? } ?>
        </tbody>
      </table>
      
      <!-- 3. Add the container -->
      <div id="container" style="width: 97%; height: 400px"></div>
      <hr />
      <div id="container1" style="width: 97%; height: 400px"></div>
      