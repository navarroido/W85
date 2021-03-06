<?php include_once("../include/BLL.php"); 
?>
<html>
  <head>
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css\Admin_SidebarNav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});
      google.charts.load('current', {'packages':['gauge']});
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

     

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'סוג המשתמש');
        data.addColumn('number', 'כמות');
        data.addRows([
          ['יזם/משקיע', <?php echo getCountOfUserType(1);?>],
          ['נותן שירות', <?php echo getCountOfUserType(2);?>]
        ]);


        // Set chart options
        var options = 
        {
          pieHole: 0.45,
          colors: ['#067ab5', '#3aa5dd'],
              'width':600,
              'height':600
          };


             // Instantiate and draw our chart, passing in some options.
             var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);



        var data2 = google.visualization.arrayToDataTable([
         ['', '', { role: 'style' }],
         ['נדחו', <?php echo getCountOfProjectStatus(10);?> , '#e2431e'],
        ['ממתין לאישור', <?php echo getCountOfProjectStatus(0);?> , '#1c91c0'],
        ['ממתין למכרז', <?php echo getCountOfProjectStatus(1);?> , '#f1ca3a'],
        ['ממתין למימון', <?php echo getCountOfProjectStatus(2);?> , '#e7711b'],
        ['בביצוע', <?php echo getCountOfProjectStatus(3);?> , '#43459d'],
        ['הושלם', <?php echo getCountOfProjectStatus(4);?> , '#6f9654']
      ]);

      // Set chart options
      var options2 = {
                'legend':'none',
                'width':800,
                'height':400
               
              };

      var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);

        <?php
          $currentPrice= getAllCurrentPrice();
          $sumOfPrice=getAllProjectPrice();
        ?>
        var sum= <?php echo $sumOfPrice;?> ;
        var current= <?php echo $currentPrice;?> ;
        var data3 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['סך הקופה', current]
        ]);
        
       
        
        var options3 = {
          width:300, height: 300,
          min:0, max:sum,
          redFrom: 0, redTo: 0.3*sum,
          yellowFrom:0.3*sum, yellowTo: 0.7*sum,
          greenFrom:0.7*sum, greenTo:sum,
          minorTicks: 5
        };

        var chart3 = new google.visualization.Gauge(document.getElementById('chart_div3'));
        chart3.draw(data3, options3);
      }




    </script>
   

   

  </head> 
  <body style="background-color:#fff;">
  <?php include_once("side-bar.php"); ?>
    <main class="main" style="background-color:white;">
      <h1>ברוך הבא לפאנל הניהול של המערכת</h1>
   

<table class="charttable">
  <tr>
    <td style="vertical-align: baseline">
    <div class="charts">
        <p>כסף שגויס עד כה עבור כלל הפרויקטים</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div id="chart_div3" ></div>
      </div>
    </td>
    <td>
    <div class="charts">
        <p style="text-align: center;">סוגי משתמשים שמאושרים במערכת </p>
        <div id="chart_div" ></div>
      </div>
    </td>
  </tr>
  <tr>

    <td colspan="2">
    <div class="charts">
        <p>כלל הפרויקטים לפי סטטוס</p>
        <div id="chart_div2" ></div>
      </div>

    </td>
  </tr>
    </table>







   
      <div class="row">

     

    </div>


    <div class="row">

      
      
    </div>

    </main>
    

  </body>
</html>

