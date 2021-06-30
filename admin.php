<?php
include "connect.php";
if (!isset($_COOKIE['user'])) {
    header('location: login.php');
    exit();
}
?>
<!doctype html>
<html>
    <head></head>
    <body>
        <h1>Admin page</h1>
        <button onclick="window.location.href='admin.php?mode=home';">Home</button>
        <br></br>
        <?php
        if ($_GET['mode'] == 'home') {
            ?>
            <p>Wat will je doen<p>
            <button onclick="window.location.href='admin.php?mode=leaderboard';" type="button">Leaderboard veranderen</button>
            <button onclick="window.location.href='admin.php?mode=code';" type="button">Toevoegen van code</button>
        <?php
        }
        if ($_GET['mode'] == 'code') {
            
            ?>
            <form method="POST">
                <textarea style="resize: none;" name="code" placeholder="Doe hier de code" cols="30" rows="10" id="code" required></textarea>
                <br></br>
                <input type="radio" id="HTML" name="taal" value="HTML">
                <label for="HTML">HTML</label><br>
                <input type="radio" id="PHP" name="taal" value="PHP">
                <label for="PHP">PHP</label><br>
                <input type="radio" id="JS" name="taal" value="JS">
                <label for="JS">JavaScript</label>
                <br>
                <input type="radio" id="C" name="taal" value="C">
                <label for="C">C</label>
                <br></br>
                <input type="submit" name="submit" class="button" value="Submit code">
            </form>
            <?php
            if (!empty($_POST['code']) || empty($_POST['taal'])) {
                echo "empty";
                if (isset($_POST['submit'])) {
                    $_POST['code'];
                    $_POST['taal'];
                        echo "gg";
                        $sql = "INSERT INTO code (text, taal) VALUES (:text, :taal)";
                        $pdo->prepare($sql)->execute([
                            ':text' => $_POST['code'],
                            ':taal' => $_POST['taal']
                        ]);
                        $_POST['code'] = '';
                        $_POST['taal'] = '';
                        header('location: admin.php?mode=code');
                    }
                }
            }
        if ($_GET['mode'] == 'leaderboard') {
            ?>
        
        <form method="post">
            <label for="username">Wat is het id van de score die je wilt verwijderen <br/></label>
            <input type="id" name="id" value="">
            <input type="submit" name="submit" value="delete">
        </form>
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
                    }
                    .logout {
                        margin-top:100px;
                    }
                </style>
                <h1 class = "title_lb">Leader Board</h1>
                <table class = 'leaderboard' style="display: flex; justify-content: left; border-collapse: collapse; ">
                <tr>
                    <th>Id</th>
                    <th>Rank</th>
                    <th>Score(TPM)</th>
                    <th>name</th>
                    <th>taal</th>
                </tr>
                <?php
                    if (isset($_POST['submit'])) {
                        // sql to delete a record
                        $sql = 'DELETE FROM leaderBoard WHERE id= :id';

                        $pdo->prepare($sql)->execute([
                            ':id' => $_POST['id']
                        ]);

                    }

                    $num = 0;
                    if (!isset($_POST['sort'])) {
                        $result = $pdo->query('SELECT * FROM leaderBoard ORDER BY score DESC');
                        
                    } else {
                        if ($_POST['sort'] == 'taal') {
                            $result = $pdo->query('SELECT * FROM leaderBoard WHERE taal=\'' . $_COOKIE['taal'] . '\' ORDER BY score DESC');
                        } else {
                        $result = $pdo->query('SELECT * FROM leaderBoard ORDER BY score DESC');
                        }
                    }
                
                while ($row = $result->fetch()) {
                    $num += 1;
                    if ($num < 11) {
                            ?>
                        <tr class='me'>
                            <td><?php echo $row['id'] ?></td>
                            <td class='rank'><?php echo $num ?></td>
                            <td><?php echo $row['score'] ?></td>
                            <td><?php echo $row['naam'] ?></td>
                            <td><?php echo $row['taal'] ?></td>                            
                        </tr>
                            <?php
                            } else {
                                ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
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
        <?php 
        }
        ?>
        <br></br>
        <form method="POST" class="logout" action="login.php">
        <input type="submit" class="btn" name="logout_user" value="Logout">
        </form>
    </body>
</html>
<?php

if (isset($_POST['logout_user'])) {
    setcookie('user', $username, time() + (0), "/");
    header('Location: index.php');
    
}
?>