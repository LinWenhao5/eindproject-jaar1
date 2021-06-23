<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Home</title>
</head>
<body>
    <div class="admin">
    <a href="login.php"`class='admin_knop'><img src="icon/usericon.png"></a>
    </div>
    <div class="upperContainer">
        <div class="header">
            <h1 class="title">Programing Type Racer</h1>
            <h4 class="subTitle">By NonStopPings</h4>
        </div>
    </div>
    <div class="lowerContainer">
        <div class="boxes">
            <div class="box1">
                <h3>Uitleg</h3>
                <p>De game is een race tegen de tijd om zo snel mogelijk de code te schrijven.
                <br>
                   1. Kies de programming taal die u wilt proberen.
                   <br>
                   2. Druk op de startknop om te beginnen.
                   <br>
                   3. Probeer zo snel mogelijk de code te schrijven.
                   <br>
                   4. Je krijgt je score te zien.
                   <br>
                   5. Vul je naam in om je score op te slaan.</p>
            </div>
            <div class="box2">
                <h3> Kies jouw programing language</h3>
                <a href="game.php?id=JS" class='knop_twee'>Javascript</a>
                <a href="game.php?id=PHP" class='knop_twee'>PHP</a>
                <a href="game.php?id=HTML" class='knop_twee'>HTML</a>
                <a href="game.php?id=C" class='knop_twee'>C</a>
                <a href="game.php?id=random" class='knop_twee'>Random</a>
            </div>
            <div class="box3">
            <?php 
                include 'connect.php';
            ?>
                <style> 
                    td {
                    border: 1px solid;
                    color: #1f2833;
                    text-align: center;
                    }
                    th {
                    color: #1f2833;
                    border: 1px solid;
                    text-align: center;
                    font-size: large;
                    padding: 10px;
                    background-color:yellow;
                    }
                    .rank {
                        background-color: #66fcf1;
                    }
                   
                </style>
                <h1 class = "title_lb">Leader Board</h1>
                <table class = 'leaderboard' style="display: flex; justify-content: center; border-collapse: collapse; ">
                <tr>
                    <th>Rank</th>
                    <th>Score(TPM)</th>
                    <th>name</th>
                    <th>taal</th>
                </tr>
                <?php
                $num = 0;
                $result = $pdo->query('SELECT * FROM leaderBoard ORDER BY score DESC');
                while ($row = $result->fetch()) {
                    $num += 1;
                    if ($num < 11) {
                        ?>
                        <tr>
                            <td class='rank'><?php echo $num ?></td>
                            <td><?php echo $row['score'] ?></td>
                            <td><?php echo $row['naam'] ?></td>
                            <td><?php echo $row['taal'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                            
                            <?php
                }
                ?><div class=""></div>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
