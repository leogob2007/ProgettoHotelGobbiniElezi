
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricette</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <h1>Ricette</h1>
    <?php
        $url = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ricetta = htmlspecialchars($_POST['ricetta']);

            if (!empty($ricetta)) {
                $url = "https://www.themealdb.com/api/json/v1/1/search.php?s=" . $ricetta;
            }
        }
    ?>

    <header>
        <h1>Agriturismo da <span class="pando">Pando</span></h1>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid pel">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active homo" aria-current="page" href="home.html">Home</a>
                        <a class="nav-link" href="posto.html">Dove siamo?</a>
                        <a class="nav-link" href="ristorante.php">Il nostro Ristorante</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <h2>quello che vuoi cercare</h2>
    <form method="post" action="">
        <label for="ricetta">ricetta:</label><br>
        <input type="text" id="ricetta" name="ricetta"><br><br>

        <input type="submit" value="Invia">
    </form>

    <?php
        if (!empty($url)) {
            echo $url;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $info = curl_exec($curl);
            //curl_close($curl);
            
            echo "<br/><br/>";
            $stringa = json_decode($info, true);

            if (!empty($stringa['meals'])) {
                foreach ($stringa['meals'] as $meal) {
                    echo "<h2>" . $meal['strMeal'] . "</h2>";
                    echo "<p>" . $meal['strCategory'] . "</p>";
                    echo "<p>" . $meal['strInstructions'] . "</p>";
                }
            }
        }
    ?>
</body>
</html>