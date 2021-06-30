<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/end.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" defer></script>
    <title>Results</title>
</head>
<body>
    <?php
    include 'connect.php';
    include 'berekening.php';

    if (!empty($_GET["name"])) {
        $sql = "INSERT INTO leaderBoard (score, naam, taal) VALUES(:score, :naam, :taal)";
        $pdo->prepare($sql)->execute([
            ':score' => $TPM,
            ':naam' => $_GET["name"],
            ':taal' => $_COOKIE["taal"]
        ]);
        setcookie('name', $_GET["name"], time() + (86400 * 30), "/");
        header('Location: end_page.php?do=hidden');
    }
    
    ?>
    <!-- midden -->
    <h1 class = "title">Jouw score:</h1>
    <div class="mid">
        <div class = "mid_links">
            <?php
            if ($_GET["do"] !== "hidden") {
                echo <<<EOF
                    <div class = "mid_links_top">
                        <a class='cancel' href='end_page.php?do=hidden'><img src="icon/cancel.png"></a>
                        <form action="#" Method="GET">
                            <input type="text" id="name" name="name" placeholder="Jouw naam">
                            <input type="text" id="do" name="do" value="display" hidden>
                            <input type="submit" value="verzenden">
                        </form>
                    </div>
                EOF;
            } 
            ?>
            <div class = "mid_links_mid">
                <div class = "mid_links_klein">
                    <h2><?php echo 'aantal tekens'; ?></h2>
                    <h1><?php echo $aantal_tekens; ?></h1>
                </div>

                <div class = "mid_links_klein">
                    <h2><?php echo 'tijd'?></h2>
                    <h1><?php echo $decrypted_msg; ?></h1>
                    <p>Seconden</p>
                </div>

                <div class = "mid_links_klein">
                    <h2><?php echo 'TPM'?></h2>
                    <h1><?php echo $TPM; ?></h1>
                    <small>aantal tekens per minuut</small>
                </div>

                <div class = "mid_links_klein">
                <h2><?php
                    $result = $pdo->query('SELECT MAX(score) FROM leaderBoard');
                while ($row = $result->fetch()) {
                    ?>
                        <h2><?php echo 'High Score'; ?></h2>
                        <h1><?php echo $row['MAX(score)']; ?></h1>
                    <?php
                }  
                ?></h2>
                </div>
                </div>
            <?php
            if ($_GET["do"] == "hidden") {
                ?>
                <div class = "mid_links_onder">
                <h3>Code die is getypt
                <?php
                $result = $pdo->query('SELECT * FROM code WHERE id =' . $_COOKIE['id']);
                while ($row = $result->fetch()) {
                    echo'<pre><code>';
                    echo htmlspecialchars($row['text']);
                    echo'</code></pre>';
                }
                ?></h3>
                </div>
                <?php 
            }
            ?>
        </div>

        <div class = "mid_rechts">
                <h1 class = "title_lb">Leader Board</h1>
                <p class = "title_lb">filter op:</p>
                <div class = "select">
                    <form method = "POST" action="#" class = "select">
                        <input type ='text' value = "Score" name = "sort" hidden>
                        <input type = 'submit' value = "Score" class = "knop_twee">
                    </form>
                    <form method = "POST" action="#" class = "select">
                        <input type ='text' value = "taal" name = "sort" hidden>
                        <input type ='submit' value = "<?php echo $_COOKIE["taal"]?>" class = "knop_twee">
                    </form>
                    <?php
                        if (isset($_COOKIE["name"])) {
                            echo <<<EOF
                                <form method = "POST" action="#" class = "select">
                                <input type ='text' value = "Naam" name = "sort" hidden>
                            EOF;
                            echo "<input type ='submit' value = " . $_COOKIE["name"] .  " class = 'knop_twee'>";
                            echo "</form>";
                            
                        }
                    ?>
                </div>
    
                <table class = 'leaderboard'>
                    <tr>
                        <th>Rank</th>
                        <th>Score(TPM)</th>
                        <th>name</th>
                        <th>taal</th>
                    </tr>
                    <?php
                        $num = 0;
                    if (!isset($_POST['sort'])) {
                            $result = $pdo->query('SELECT * FROM leaderBoard ORDER BY score DESC');
                    } else {
                        if ($_POST['sort'] == 'taal') {
                                $result = $pdo->query('SELECT * FROM leaderBoard WHERE taal=\'' . $_COOKIE['taal'] . '\' ORDER BY score DESC');
                            } 
                            if ($_POST['sort'] == 'Naam') {
                                $result = $pdo->query('SELECT * FROM leaderBoard WHERE naam=\'' . $_COOKIE['name'] . '\' ORDER BY score DESC');
                            }
                            if  ($_POST['sort'] == 'Score') {
                                $result = $pdo->query('SELECT * FROM leaderBoard ORDER BY score DESC');
                        }
                    }
                    while ($row = $result->fetch()) {
                        $num += 1;
                        if ($num < 11) {
                            if ($row['score'] == $TPM && $row['naam'] == $_COOKIE['name']) {
                                ?>
                            <tr class='me'>
                                <td class='td'><?php echo $num ?></td>
                                <td><?php echo $row['score'] ?></td>
                                <td><?php echo $row['naam'] ?></td>
                                <td><?php echo $row['taal'] ?></td>
                            </tr>
                                <?php
                            } else {
                                ?>
                            <tr>
                                <td class='td'><?php echo $num ?></td>
                                <td><?php echo $row['score'] ?></td>
                                <td><?php echo $row['naam'] ?></td>
                                <td><?php echo $row['taal'] ?></td>
                            </tr>
                                <?php
                            }
                            ?>
                            
                            <?php
                        }
                    }
                    ?><div class="
                    "></div>
                </table>
                <div class="reset">
                <a href="index.php"><img class='reset' src="icon/reset.png"></a>
                </div>
        </div>
    </div>
    <br>
    <!-- footer -->
</body>
</html>