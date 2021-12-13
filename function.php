<?php
    function old($inputName){
        if(isset($_POST[$inputName])){
            return $_POST[$inputName];
        }else{
            return " ";
        }
    }
    function textFilter($text){
        $txt = trim($text);
        $txt = htmlentities($txt,ENT_QUOTES);
        $txt = stripcslashes($txt);
        return $txt;
    }

    function setError($inputName,$message){ //error save
        $_SESSION['error'][$inputName] =$message;
    }

    function getError($inputName){ //error tot kyi kyi ta ku si
        if(isset($_SESSION['error'][$inputName])){
            return $_SESSION['error'][$inputName];
        }else{
            return " ";
        }
    }

    function clearError(){ //error clear
        $_SESSION['error'] = [];
    }

    function runQuery($sql){
        $con = conn();
        if(mysqli_query($con, $sql)){
            return true;
        }else{
            die("db error". mysqli_error($con));
        }
    }

    function linkTo($l){
        echo "<script> location.href = '$l'</script>";
    }

    function fetchAll($sql){
        $query = mysqli_query(conn(),$sql);
        $rows = [];
        while($row = mysqli_fetch_assoc($query)){
            array_push($rows,$row);
        }
        return $rows;
    }

    function fetch($sql){
        $query = mysqli_query(conn(),$sql);
        $row = mysqli_fetch_assoc($query);
        return $row;
    }
    function contactAdd(){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $supportFileType = ['image/jpeg','image/png'];
        $file = $_FILES['upload'];
        $fileName = $file['name'];
        $fileTemp = $file['tmp_name'];
        $savefolder = "store/";

        $sql = "INSERT INTO list (name,phone,photo) VALUES ('$name','$phone','$fileName')";
        // die($sql);
        if(runQuery($sql)){
            linkTo("index.php");
        }
    }

    function contacts(){
        $sql = "SELECT * FROM list";
        return fetchAll($sql);
    }

    function createContact(){
        $errorStatus = 0;
        $name = "";
        $phone = "";
        
        if(empty($_POST['name'])){
            setError('name',"Name is required");
            $errorStatus=1;
        }else{
            if(strlen($_POST['name']) < 5){
                setError('name','Name is Short');
                $errorStatus=1;
            }else{
                if(strlen($_POST['name']) > 20){
                    setError('name','Name is Long');
                    $errorStatus=1;
                }else{
                    if (!preg_match("/^[a-zA-Z' ]*$/",$_POST['name'])) {
                        setError("name", "Only letters and white space allowed");
                        $errorStatus = 1;
                    }else{
                        $name = $_POST['name'];
                    }
                }
            }
        }


        if(empty($_POST['phone'])){
            setError('phone','Phone is required');
            $errorStatus=1;
        }else{
            if(!preg_match("/^[0-9 ]*$/",$_POST['phone'])){
                setError('phone','Phone format incorrect!');
                $errorStatus=1;
            }else{
                $phone = textFilter($_POST['phone']);
            }
        }

        $supportFileType = ['image/jpeg','image/png'];
        if(isset($_FILES['upload']['name'])){
            $tempfile = $_FILES['upload']['tmp_name'];
            $filename = $_FILES['upload']['name'];

            if(in_array($_FILES['upload']['type'],$supportFileType)){        
                $profile = $_FILES['profile']['name'];
                $savefolder = "store/";
                if(move_uploaded_file($tempfile,$savefolder.$filename)){
                    header("location:index.php");
                }
            }else{
                setError('upload','File is incorrect');
                $errorStatus=1;
            }
            
        }else{
            setError('upload','File is required');
            $errorStatus=1;
        }

        if(!$errorStatus){ //no error
            print_r($_POST);
            print_r($_FILES);
            contactAdd();
        }

    }


?>