<?php

const ERROR_TYPE_DATABASE = 1;

$user = 'root';
$pass = '';
$response=array("error"=>null,"message"=>"");
try {
    $dbh = new PDO('mysql:host=localhost;dbname=faketube', $user, $pass);

} catch (PDOException $e) {
    $response["error"] = ERROR_TYPE_DATABASE; //database error
    $response["message"] = "Hata!: " . $e->getMessage();
    die(json_encode($response,JSON_UNESCAPED_UNICODE));
}



$data = json_decode($_POST['data']);
$username=$data[0];
$pw=$data[1];

$query  = $dbh->prepare("SELECT * FROM admin_tabble WHERE (dbusername = :username AND dbpassword = :pw)");
$query ->bindParam(":username", $username);
$query ->bindParam(":pw", $pw);
$query->execute();
$haveQuery=$query->fetch();
if ($haveQuery == false) {
    $response["error"]=0;
    echo json_encode($response);
}else{
    $response["error"]=1;
    $response['message']="giriş yapıldı";
    echo json_encode($response);


}


?>