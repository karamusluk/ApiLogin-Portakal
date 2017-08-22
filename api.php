<html>
<head>
<title>API v2.1</title>
<?php
//header('Content-Type: application/json;charset=utf-8');
$requestParts = explode('/',$_GET['request']);
$method = $requestParts[0];
$key = $requestParts[1];
$action = $requestParts[2];


$err = [ 'errmsg' => 'you dont have a right to access.'];
$succ = [ 'succmsg'=>'file download started.'];

if($method =='URI' | $method == 'uri'){

    if(isset($action)){
        if($action == 'info'){
             $link = "<script>window.open(\"http://138.197.138.136:3456/uri/$key?t=info\")</script>";
             echo $link;
        }

        elseif($action == 'json'){
             $link = "<script>window.open(\"http://138.197.138.136:3456/uri/$key?t=json\")</script>";
             echo $link;
        }
        elseif($action == 'download'){
             $link = "<script>window.open(\"http://138.197.138.136:3456/uri/$key\")</script>";
             echo $link;
        }

    }

    //$link = "<script>window.open(\"http://138.197.138.136:3456/uri/$key\")</script>";
    //echo $link;
    echo xmlrpc_encode($succ);
}


else{
echo json_encode($err);
}



?>

</head>

</html>