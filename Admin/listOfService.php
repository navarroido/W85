<html>
  <head>
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css\Admin_SidebarNav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
   
  </head> 
  <body>
  <?php include_once("side-bar.php"); ?> 
    <main class="main">
        <h1>נותני שירות שמחכים לאישור</h1>
            <?php include_once("../include/BLL.php"); ?>
                <?php
                $arrServiceMan = array();
                $arrServiceMan = getAllServiceManNotApproved();
                ?>
                 <?php
                 if($arrServiceMan==null)
                 {
                   ?>
                   <p class="errors">אין נותני שירות שמחכים לאישור</p>
                  <?php
                 }
                 else{
                   ?>
                   <table>
                  <tr id="firstLine">
                      <td class="tdFirstLine" style="width: 20%;">שם מלא</td>
                      <td class="tdFirstLine" style="width:30%;">תחום עיסוק</td>
                      <td class="tdFirstLine" style="width:15%;">ותק</td>
                      <td class="tdFirstLine" style="width:20%;">מסמכים שצורפו</td>
                      <td class="tdFirstLine" style="width:15%;">אישור / דחייה</td>
                  </tr>
                  <?php
                  for ($i =0; $i< sizeof($arrServiceMan);$i++)
                  {
                      ?>
                  
                  <tr class="trRow">
                      <td><?php echo $arrServiceMan[$i]->firstName." ".$arrServiceMan[$i]->lastName; ?></td>
                      <td><?php echo getProfType($arrServiceMan[$i]->proftype); ?></td>
                      <td><?php echo $arrServiceMan[$i]->numofyears;?></td>
                      <td style="text-align:center;">  
                          <button onclick="window.location.href='../login/uploadFiles/<?php echo $arrServiceMan[$i]->idfile;?>'">ת.ז</button>
                          <button onclick="window.location.href='../login/uploadFiles/<?php echo $arrServiceMan[$i]->proffile;?>'">ת.עוסק</button>
                      </td>
                      <td style="text-align:center;">  
                          <button onclick="window.location.href='../include/update.php?type=serviceman&serviceid=<?php echo $arrServiceMan[$i]->id; ?>&status=1'" style="color:green;"><i class="far fa-thumbs-up"></i></button>
                          <button onclick="window.location.href='../include/update.php?type=serviceman&serviceid=<?php echo $arrServiceMan[$i]->id; ?>&status=2'" style="color:red;"><i class="far fa-window-close"></i></button>
                      </td>
                  </tr>
                <?php 
                }
              }
             ?>
        </table>

    </main>

  </body>
</html>