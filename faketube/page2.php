<?php 
$user = 'root';
$pass = '';
try {
    $dbh = new PDO('mysql:host=localhost;dbname=faketube', $user, $pass);

} catch (PDOException $e) {
die();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="page2.css">
    <title>Home</title>
</head>


<body>
    <h1 id="baslıkAdmin"> Video Admin </h1>
    <button type='submit'  class='videoEklemeBtn' id='videoEklemeBtn'>Video Ekleme</button>
<?php 
$sqq="SELECT * FROM videotable WHERE is_deleted = 0";
$query=$dbh->prepare($sqq);
$query->execute();
$result= $query->fetchAll(PDO::FETCH_ASSOC);


foreach ($result as $currentVideo){
    $is_delete_curret=$currentVideo["is_deleted"];
    $videolink_current=$currentVideo["link"];
    $videolDesc_current=$currentVideo["descrip"];
    $video_id_current=$currentVideo["id"];
    $video_date_current=$currentVideo["date_added"];
    if ($is_delete_curret==0) {
        $linkArray_current= explode("=",$videolink_current);
        $aa =$linkArray_current[1];
        echo "<div id='form'>

        <div class='container'>
            <div id='wrapper'>
                <div id='imageDiv'>
                    <img src='https://img.youtube.com/vi/$aa/default.jpg' alt=''>
                </div>
                <div id='labelDiv'>
                    <h5><label>$videolDesc_current</label></h5>
                    <br>
                    <h6><label>$video_date_current</label></h6>
                </div>
            </div>
            <div class='buttonDiv'>
                <form  action='guncelle.php?videoid=$video_id_current' method='POST'>
                <button type='submit' name='$video_id_current' class='guncelleBtn' id='guncelleBtn'>Güncelle</button>
                </form>
                <button type='submit' name='$video_id_current' class='silBtn' id='$video_id_current'>Sil</button>             

            </div>
        </div>
    </div>"
    ;}



}
?>


   <script>
   $(document).ready(function () {
       $('#videoEklemeBtn').click(function () {
            window.location="page3.php"
       })
       $(".silBtn").click(function (e) {
           const videoid=$(this).attr('name')
           const dataArray=["Delete",videoid]
           const data= JSON.stringify(dataArray)
           $.ajax({
                 type:"POST",
                 url:"addVideo.php",
                 data: {
                     data:data
                 },
                 cache:false,
                 success: function(res) {
                     alert("Video Silindi")
                     window.location="page2.php"
                
                }

           })

         })
       
     }) 
    


   </script>
    
</body>

</html>