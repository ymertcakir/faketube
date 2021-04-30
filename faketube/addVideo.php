<?php

const ERROR_TYPE_DATABASE = 1;

$user = 'root';
$pass = '';
$isdeleted=0;
$date_added=date("Y-m-d",time());
$response=array("error"=>null,"message"=>"");
try {
    $dbh = new PDO('mysql:host=localhost;dbname=faketube', $user, $pass);

} catch (PDOException $e) {
    $response["error"] = ERROR_TYPE_DATABASE; //database error
    $response["message"] = "Hata!: " . $e->getMessage();
    die(json_encode($response,JSON_UNESCAPED_UNICODE));
}

$data = json_decode($_POST['data']);
$funType=$data[0];
$videoekleme="VideoEkleme";
$guncelle="Guncelle";
$delete="Delete";
$set_delete=1;
if (isset($_POST['data']) && $funType==$videoekleme) {
    $videolink=$data[1];
    $videoDis=$data[2];
    $qq="INSERT INTO videotable (link, descrip, date_added, is_deleted) VALUES ( :videolink, :videodis, :date_added, :isdeleted)";
    $insertquery  = $dbh->prepare($qq);
    $insertquery->bindparam(":videolink",$videolink);
    $insertquery->bindparam(":videodis",$videoDis);
    $insertquery->bindparam(":date_added",$date_added);
    $insertquery->bindparam(":isdeleted",$isdeleted);
    $insertquery->execute(); 
    $response["error"]=0;
    $response["message"]="Ekleme Başarılı";
    echo json_encode($response);
    
}else if (isset($_POST['data']) && $funType==$guncelle) {
    $videolink=$data[1];
    $videoDis=$data[2];
    $id=$data[3];
    $qq="UPDATE videotable SET link=:videolink, descrip=:videodis WHERE id=:id";
    $insertquery  = $dbh->prepare($qq);
    $insertquery->bindparam(":id",$id);
    $insertquery->bindparam(":videolink",$videolink);
    $insertquery->bindparam(":videodis",$videoDis);
    $insertquery->execute(); 
    $response['message']="video guncellendi";
    $response['error']=0;
}else if(isset($_POST['data']) && $funType==$delete){
    $id=$data[1];
    $qq="UPDATE videotable SET is_deleted=:sil WHERE id=:id";
    $insertquery  = $dbh->prepare($qq);
    $insertquery->bindparam(":id",$id);
    $insertquery->bindparam(":sil",$set_delete);
    $insertquery->execute(); 
}
echo json_encode($response);
?>