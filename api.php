<?php
require_once 'config.php';
//header('Content-Type: application/json;charset=utf-8');
$requestParts = explode('/',$_GET['request']);

//var_dump($requestParts);
if(isset($_GET['method'])){$method = $_GET['method'];}
else {$method = $requestParts[0];}

if(isset($_GET['secureHash'])){$outhID= $_GET['secureHash'];}
else {$outhID= $requestParts[1];}
$key = $requestParts[2];
$action = $requestParts[2];

//$method=$_GET['method'];
//$key = $_GET['key'];
//$action = $_GET['action'];
$err = [ 'errmsg' => 'you dont have a right to access.'];
$succ = [ 'succmsg'=>'file download started.'];



$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$listt = array();
$result = $conn->query("SELECT ip FROM client_IP WHERE type='default'");

$listRange = array();
$resultRange = $conn->query("SELECT ip FROM client_IP WHERE type='range'");

$oauth = array();
$oauthResult = $conn->query("SELECT oauth_uid FROM users");

if ($oauthResult->num_rows > 0) {

    while($row = $oauthResult->fetch_assoc()) {
        $oauth[] = $row['oauth_uid'];
    }
}
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $listt[] = $row['ip'];
    }
}

if ($resultRange->num_rows > 0) {

    while($row = $resultRange->fetch_assoc()) {
        $listRange[] = $row['ip'];
    }
}
if (in_array($_SERVER['REMOTE_ADDR'],$listt) || in_array(substr($_SERVER['REMOTE_ADDR'], 0, strrpos($_SERVER['REMOTE_ADDR'], '.')), $listRange)){
    if (in_array($outhID,$oauth)){


        if($method =='GET' | $method == 'get'){

            //http://139.59.118.179/api/GET/DOSYA_URI/AUTH_USER_ID/DOSYA_ADI

            if(isset($action)){
                if($action == 'info'){
                     $link = "<script>window.open(\"http://138.197.138.136:3456/uri/$key?t=info\")</script>";
                     
                     echo $link;
                }

                elseif($action == 'json'){
                     $link = "<script>window.open(\"http://138.197.138.136:3456/uri/$key?t=json\")</script>";
                     echo $link;
                }
                elseif(isset($method)){

                    $filename = $requestParts[3];

                    //$filename = $_GET['filename'];
                     //$link = "<script>window.open(\"http://138.197.138.136:3456/uri/$key?filename=$filename&save=true\")</script>";
                     $succ = [ 'succmsg'=>'file download started.'];
                     header("Location: http://138.197.138.136:3456/uri/$key?filename=$filename&save=true");
                     //echo $link;
                }

            }

            //$link = "<script>window.open(\"http://138.197.138.136:3456/uri/$key\")</script>";
            //echo $link;
            echo json_encode($succ);
        }
        else if($method =="PUT"){

            // http://139.59.118.179/api/PUT/SECURE_USER_ID/FILE_NAME
            if(isset($_GET['fileName'])){ $filename = $_GET['fileName'];}
            else{ $filename = $requestParts[2];}
            echo  $filename ;

            // download image to temp file for upload
            //$tmp = tempnam(sys_get_temp_dir(), 'php');
            //file_put_contents($tmp, file_get_contents('http://cdn.soccerwiki.org/images/player/2386.jpg'));
            $filePATH = '';
            if($filename == realpath($filename)){$filePATH = $filename;}
            else{$filePATH = realpath($filename);}
            
            $fields = array(
                't' => "upload",
                'file' => new CURLFile(realpath($filePATH))
                );

            $url="http://139.59.118.179:3456/uri"; 
            $ch = curl_init("http://139.59.118.179:3456/uri"); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
            curl_setopt ($ch, CURLOPT_URL, $url); 
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //needed so that the $result=curl_exec() output is the file and isn't just true/false
            $result = curl_exec ($ch); 
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            //echo $result;  
            preg_match('#<li><b>ANAHTAR: </b><tt><span>(.*?)</span></tt></li>#', $result, $match);
            $fileURI = [ 'fileURI'=> $match[1].''];
            echo json_encode($fileURI);
            //var_dump($result, curl_error($ch));
            unlink($tmp);
            curl_close($ch);
        }


        else{
        //echo json_encode($err);
        }
    }
    else{
        echo json_encode($err);

    }

}
else{
    echo json_encode([ 'errmsg' => 'Your IP is not allowed to access this System. Contact Administator.']);

}
?>
