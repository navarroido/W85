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
          ['נותן שירות', <?php echo getCountOfUserType(2);?>],

        ]);


        // Set chart options
        var options = {'title':' סוג המשתמש-עבור משתמשים מאושרים בלבד',
                       'width':600,
                       'height':600};


             // Instantiate and draw our chart, passing in some options.
             var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);



        var data2 = google.visualization.arrayToDataTable([
         ['סטטוס פרויקט', 'כמות', { role: 'style' }],
         ['נדחו', <?php echo getCountOfProjectStatus(10);?> , '#ff0000'],
        ['ממתין לאישור', <?php echo getCountOfProjectStatus(0);?> , '#ffff00'],
        ['ממתין למכרז', <?php echo getCountOfProjectStatus(1);?> , '#999966'],
        ['ממתין למימון', <?php echo getCountOfProjectStatus(2);?> , '#ffff00'],
        ['בביצוע', <?php echo getCountOfProjectStatus(3);?> , '#999966'],
        ['הושלם', <?php echo getCountOfProjectStatus(4);?> , '#66ff33']
      ]);

              // Set chart options
              var options2 = {'title':'פרויקטים לפי סטטוס',
                       'width':600,
                       'height':600};

      var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);

        <?php
          $arrprojects=Array();
          $arrprojects=getAllProjects();
          $currentPrice=0;
          $sumOfPrice=0;
          for($i=0;$i<sizeof($arrprojects);$i++)
          {
            $sumOfPrice+=$arrprojects[$i]->projectcost;
            $currentPrice+=$arrprojects[$i]->projectcurrentprice;
          }
        ?>
        var data3 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          /*['Memory', 80],
          ['CPU', 55],
          */
          [' כסף שגויס עד כה', <?php echo $sumOfPrice;?>]
        ]);
        
        

        var options3 = {
          min: 0, max: <?php echo $sumOfPrice;?>,
          width: 400, height: 120,
          redFrom: 0 , redTo: (0.4 * <?php echo $sumOfPrice;?>) ,
          yellowFrom: (0.41 * <?php echo $sumOfPrice;?>), yellowTo: (0.8 * <?php echo $sumOfPrice;?>),
          greenFrom: (0.81 * <?php echo $sumOfPrice;?>), greenTo: (<?php echo $sumOfPrice;?>),
          minorTicks: 5
        };

        var chart3 = new google.visualization.Gauge(document.getElementById('chart_div3'));
        data3.setValue(<?php echo $currentPrice;?>);
        chart3.draw(data3, options);
      }




    </script>
   

   

  </head> 
  <body>
  <?php include_once("side-bar.php"); ?>
    <main class="main">
        <p>ברוך הבא לפאנל הניהול של המערכת</p>


    <!--Div that will hold the pie chart-->
    <div>
    <div id="chart_div"></div>
    <div id="chart_div2"></div>
    </div>
    <div id="chart_div3"></div>






    </main>
    

  </body>
</html>