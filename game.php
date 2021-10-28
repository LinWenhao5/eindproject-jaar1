<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/game.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.2.0/pad-zeropadding.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.2.0/enc-hex.js" defer></script>
    
    
    <script src="script.js" defer></script>
    <title>Type game</title>
</head>
<body>
    <div class="tooltip">
		<div class="icon" style="font-size: 20px; color: #45a29e">Hover voor uitleg</div>
		<div class="tooltip-content">
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
	</div>

    <div class="timer" id="timer">0</div>
    <div class="container">
        <div class="code-display" id="codeDisplay">Druk op de knop om te starten</div>
        <textarea onpaste="return false" hidden id="codeInput" class="code-input"></textarea> 
        <button  class="front-button-inner" onclick="startTimer();Hidecode()" >Start</button>
        <?php 
        include'connect.php';
        setcookie('name' , "" , time() - 60, "/");
        $result = $pdo->query('SELECT * FROM code WHERE taal ="' . $_GET['id'] . '"ORDER BY RAND() LIMIT 1;');
        if ($_GET['id'] == 'random') {
            $i = rand(1, 5);
            $result = $pdo->query('SELECT * FROM code WHERE id =' . $i);
        } else {
            $result = $pdo->query('SELECT * FROM code WHERE taal ="' . $_GET['id'] . '" ORDER BY RAND() LIMIT 1;');
        }
        while ($row = $result->fetch()) {
            setcookie('id', $row['id'], time() + (86400 * 30), "/");
            setcookie('taal', $row['taal'], time() + (86400 * 30), "/");
            ?>
        <pre id="text" hidden><code><?php echo htmlspecialchars($row['text']); 
        }?></code></pre>
    </div>   
</body>
</html>
