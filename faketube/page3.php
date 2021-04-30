<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="page3.css">
    <title>Video Yükleme</title>
</head>

<body>
    <h1 id="baslıkAdmin"> Video Admin </h1>
    <h2>Video Ekleme</h2>
    <form id="form">
        <div class="container">
            <label>Youtube link </label>
            <input id="youtube" type="text" placeholder="Video link" name="youtube">
            <label>Youtube Description </label>
            <input id="youtubedis" type="text" placeholder="Video discription" name="youtubedis">
            <button type="submit" id="kaydetid">Yükle</button>
            <button onClick='page2.php' " id="vazgecid">Vazgeç</button> 

        </div>
    </form>
    <script>
        $(document).ready(function() {
            $('#vazgecid').click(function (e) {
                e.preventDefault()
                window.location="page2.php"
            })
            $("#kaydetid").click(function() {
                const videolink = document.getElementById("youtube").value
                const videodis = document.getElementById("youtubedis").value
                if (videolink == "") {
                    alert("Video linki giriniz")
                } else if (videodis == "") {
                    alert("Video Description kısmını boş bırakamazsınız")
                } else {
                    const dataArray = ["VideoEkleme", videolink, videodis]
                    const data = JSON.stringify(dataArray)
                    $.ajax({
                        type: "POST",
                        url: "addVideo.php",
                        data: {
                            data: data
                        },
                        cache: false,
                        success: function(res) {
                             alert("Video eklendi")
                             window.location="page3.php"

                        }
                    });
                }
            });

        });
    </script>
</body>

</html>