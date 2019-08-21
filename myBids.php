<?php include_once("header.php"); ?>
<?php include_once("include/BLL.php"); ?>
<?php
   if(!isset($_SESSION["userID"])){
    header("Location:login/signIn.php");
    }
    session_start();   
    $arrFunds=Array();
    $arrFunds=getFundsByUser( $_SESSION["userID"]);
    if($arrFunds==null)
    {
        ?>
        <p>אין מכרזים שמחכים לביצוע שלך</p>
    <?php
    }
    $userType=get_user_type($_SESSION["userID"]);
    $userApproves=getServiceApproved($_SESSION["userID"]);
    if($userType== 2 &&  $userApproves== 1)
    {
        ?>
        <main>

        <section>
            <div class="row">
                <?php
                for($i=0;$i<sizeof($arrFunds);$i++)
                {
                    ?>
                <div class="card2"> 
                    <?php
                    if($arrFunds[$i]->projectstatus==10)
                    {
                        ?>
                        <div class="notapprovedtext">הפרויקט לא מאושר</div>
                            <div class="notapprovedcard"> </div>
                        <?php
                    } 
                    ?>
        
                 
                    <div class="pictureCard2" style="background-image:url('images/project_types/<?php echo $arrFunds[$i]->projecttype; ?>_s.png');"></div>
                    <div class="descCard2">
                        <h3><?php echo getProjectType($arrFunds[$i]->projecttype);?></h3>
                        <p class="loc">מיקום: רחוב
                            <?php echo $arrFunds[$i]->loccity." ".$arrFunds[$i]->locstreet." ".$arrFunds[$i]->locnum;?>
                        </p>
                        <div id="statusBar">
                            <div id="allStatus">
                                <?php echo getStatusBarColors($arrFunds[$i]->projectstatus,1);?>
                            </div>
                            <div class="bar2">
                                <p style="text-align:right; font-size:14px; margin-bottom:0px; color:#36ba2f"><?php echo $arrFunds[$i]->projectcost;?><i class="fas fa-shekel-sign"></i></p>
                                <div id="mainBar2">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="max-width:100%; width:<?php echo ($arrFunds[$i]->projectcurrentprice/$arrFunds[$i]->projectcost)*100;?>%;border-radius: 20px; ">
                                        <?php echo $arrFunds[$i]->projectcurrentprice?>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </div>
                    <div id="cardFooter">
                        
                        <button class="icon" onclick="window.location.href='include/update.php?type=doneProject&id=<?php echo $arrProjects[$i]->projectid; ?>" style="color:green; width:50%; height:10%;"><i class="far fa-thumbs-up"></i>
                            לאישור ביצוע
                        </button>
                        <a href="projectFund.php?projectid=<?php echo $arrFunds[$i]->projectid; ?>" style="color:black;width:50%;"><p id="view">לצפייה<i class="far fa-eye"></i></p></a>
                    </div>
                </div>
            </div>
                 <?php
                }
                  ?>
        </section>
        <?php
    }
    else {
        ?>
            <p>אין לך הרשאה מתאימה</p>
        <?php
    }
    ?>
      <link rel="stylesheet" type="text/css" href="CSS\myProject.css">



</main>
<?php include_once("footer.php"); ?>