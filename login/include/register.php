<?php
require_once '../../include/BLL.php';

session_start();


$command = $_REQUEST["type"];


switch ($command) {

    case "1":
        // הרשמה יזם משקיע
        if(if_user_exist($_POST["id"])>0)
        {
            header("Location: ../signInCiv.php?Error=UserExist");
            break;
        }
        else{
            registerUser(
                $_POST["id"],
                $_POST["firstName"],
                $_POST["lastName"],
                $_POST["password"],
                $_POST["email"],
                $_POST["type"]
            );
            header("Location: ../signIn.php?Error=Success");
            break;
        }
       

    case "2":
        // הרשמה נותן שירות
        if(if_user_exist($_POST["id"])>0)
        {
            header("Location: ../signInService.php?Error=UserExist");
            break;
        }
        else{
            if(isset($_FILES['idFile'])){
                $errors= array();
                $file_name = $_FILES['idFile']['name'];
                $file_tmp = $_FILES['idFile']['tmp_name'];
                $file_ext=strtolower(end(explode('.',$_FILES['idFile']['name'])));
                
                $extensions= array("jpeg","jpg","png","gif");
                
                if(in_array($file_ext,$extensions)=== false){
                   $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }
    
                
                if(empty($errors)==true) {
                   move_uploaded_file($file_tmp,"../uploadFiles/".$_POST["id"]."_idFile.". $file_ext);
                   echo "Success";
                }else{
                   print_r($errors);
                }
             }
    
    
             if(isset($_FILES['profFile'])){
                $errors= array();
                $file_name = $_FILES['profFile']['name'];
                $file_tmp = $_FILES['profFile']['tmp_name'];
                $file_ext=strtolower(end(explode('.',$_FILES['profFile']['name'])));
                
                $extensions= array("jpeg","jpg","png","gif");
                
                if(in_array($file_ext,$extensions)=== false){
                   $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }
    
                if(empty($errors)==true) {
                   move_uploaded_file($file_tmp,"../uploadFiles/".$_POST["id"]."_profFile.". $file_ext);
                   echo "Success";
                }else{
                   print_r($errors);
                }
             }

            registerServiceMan(
                $_POST["id"],
                $_POST["firstName"],
                $_POST["lastName"],
                $_POST["password"],
                $_POST["email"],
                $_POST["idService"],
                $_POST["profType"],
                $_POST["numOfYears"],
                $_POST["id"]."_idFile.". $file_ext,
                $_POST["id"]."_profFile.". $file_ext,
                $_POST["type"]
            );
            header("Location: ../signIn.php?Error=Success");
            break;
        }
        

    case "signin":
    {
        session_start();
        //אם יוזר קיים, והסיסמא נכונה - מתחבר
         if (is_user_exist($_POST["userID"],$_POST["password"])>0) {
            $_SESSION["userID"]=$_POST["userID"];
            $_SESSION["firstName"]=get_user_name($_POST["userID"]);
            $_SESSION["type"]=get_user_type($_POST["userID"]);
           
            //חזרה לדף האחרון
            $curPage=$_SESSION['page'];
            if($curPage==null){
                header("Location: ../../index.php"); 
            }
            else{
                header("Location: $curPage");
            }        
        }
        //אם סיסמא לא נכונה 
        else
            header("Location: ../signIn.php?Error=IncorrectUsernameOrPassword");
        break;
    }

    case "signinAdmin":
    {
        session_start();
         if (get_user_type($_POST["userID"]) == 3) 
         {
             if(is_user_exist($_POST["userID"],$_POST["password"])>0)
             {
                $_SESSION["userID"]=$_POST["userID"];
                $_SESSION["firstName"]=get_user_name($_POST["userID"]);
                $_SESSION["type"]=get_user_type($_POST["userID"]);
                header("Location: ../../Admin/index.php");
             }
            else{
            header("Location: ../../Admin/loginAdmin.php?Error=IncorrectUsernameOrPassword");
            }
        }
        else{
            header("Location: ../../Admin/loginAdmin.php?Error=AccessDenied");
        }
        break;
    }

}
