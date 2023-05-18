<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Belépés</title>
    <link rel="stylesheet" href="style.css">
</head>

<body <?php if (isset($_GET["color"])) {echo 'style=background-color:' . $_GET["color"] . ';"';} ?>>

    <div style="position: fixed; top: 0; left: 20px; margin-top: 20px;">
        <h3 style="justify-content: left">tunci</h3>
        <h3 style="justify-content: center">neptuuuuuuuuuuuuuun</h3>
    </div>

    <div class="middle">
        <div class="forms">
            <div class="form login">

            <div style="display: flex; justify-content: center; align-items: center; margin-top: 50px">
                    <h1><?php if (isset($_GET["response"])) {echo $_GET["response"];} ?></h1>
                </div>

                <h1 class="title" style="margin-top: 20px">Belépés</h1>
                <form method="post" action="login.php">

                <div class="input-field">
                        <input type="email" placeholder="Username" name="usr">
                    </div>

                    <div class="input-field">
                        <input type="password" required="" placeholder="Password" name="pw" oninvalid="this.setCustomValidity('pw helye :)')">
                    </div>

                    <div class="input-field button">
                        <input value="Bejelentkezés" type="submit">
                    </div>    
            </div>
        </div>
    </div>
</body>

</html>

<?php if (isset($_GET["atiranyitas"]) && isset($_GET["idozites"]))
    header("Refresh: " . $_GET["idozites"] . "; url=https://" . $_GET["atiranyitas"]);
?>
