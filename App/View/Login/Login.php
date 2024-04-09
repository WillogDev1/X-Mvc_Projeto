<?php
echo $DATA;
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="/login" method="post">
        <label for="email">First name:</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="senha">Last name:</label>
        <input type="text" id="senha" name="senha"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>