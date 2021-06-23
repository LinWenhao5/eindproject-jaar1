<?php
include "connect.php";

?>
<!doctype html>
<html>
    <head></head>
    <body>
        <h1>Admin page</h1>
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