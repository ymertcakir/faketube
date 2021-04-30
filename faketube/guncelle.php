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
    <link rel="stylesheet" href="page4.css">
    <title>Video Güncelleme</title>
</head>

<body>
    <h1 id="baslıkAdmin"> Video Admin </h1>
    <h2>Video Güncelleme</h2>
    <?php 

     $id=array_key_first($_POST);
     $sqq="SELECT * FROM videotable WHERE id = :id";
     $query=$dbh->prepare($sqq);
     $query->bindparam(":id",$id);
     $query->execute();
     $result= $query->fetch();
     $videolink=$result['link'];
     $videoDesc=$result['descrip'];
     echo "<form id='form'>
     <div class='container'>
         <label>Youtube link </label>
         <input id='idinput' type='hidden' value='$id' name='inputlink'>
         <input id='inputlink' type='text' value='$videolink' name='inputlink'>
         <label>Youtube Discription </label>
         <input id='inputDesc' type='text' value='$videoDesc' name='inputDesc'>
         <button type='submit' id='guncelle'>Güncelle</button>
         <button type='submit' id='vazgecid'>Vazgeç</button>

     </div>

 </form>"

    ?>
    
 
    <script>
        $(document).ready(function() {
            $('#vazgecid').click(function (e) {
                e.preventDefault()
                window.location="page2.php"
            })
            $("#guncelle").click(function() {
                const gVideolink = document.getElementById("inputlink").value
                const gVideoDesc = document.getElementById("inputDesc").value
                const gVideoid=document.getElementById("idinput").value
                if (gVideolink == "") {
                    alert("Video link kısmını boş bırakmayınız")

                } else if (gVideoDesc == "") {
                    alert("Video Descripton kısmını boş bırakamazsınız")

                } else {
                    const arrayGüncelleme = ["Guncelle", gVideolink, gVideoDesc,gVideoid]
                    const data = JSON.stringify(arrayGüncelleme)
                   
                     $.ajax({
                        type: "POST",
                        url: "addVideo.php",
                        data: {
                            data: data
                        },
                        cache: false,
                        success: function(res) {
                            const rest=JSON.parse(res)
                            console.log(rest);
                            if(rest.error==0){
                                alert("Video Güncellendi")
                                window.location="page2.php"
                            }
                            
                            

                        }
                    }); 


                }


            });

        });
    </script>
</body>

</html>