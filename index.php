<?php
// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";
$nameErr = $emailErr = $genderErr = $websiteErr = "";



//echo $_SERVER["REQUEST_METHOD"] . "<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Preencher o nome";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Zà-úÀ-Ú ]*$/", $name)) {
            $nameErr = "Apenas letras e espaços em branco são permitidos";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Preencher o e-mail";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato de e-mail inválido";
        }
    }

    if (empty($_POST["website"])) {
        $website = "";
    } else {
        $website = test_input($_POST["website"]);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
            $websiteErr = "URL inválido";
        }
    }

    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["comment"]);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }
}

//Limpeza dos dados de entrada
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>



<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .err{
                outline: 1px dashed red;
                background-color: rgba(255,0,0,0.2);
            }
        </style>
    </head>
    <body>
        <h1>Manuseio de Formulário com PHP</h1>
        <h2>Referências:</h2>
        <ul>

            <li><a href="http://www.w3schools.com/php">
                    W3Schools</a></li>

            <li><a href="http://php.net/">
                    Manual do PHP</a></li>

        </ul>

        <form method="post" 
              action="<?php
echo htmlspecialchars($_SERVER["PHP_SELF"]);
?>">

            Name: <input type="text" name="name" class="<?= strlen($nameErr) != 0 ? "err" : ""; ?>">
            <span class="error">* <?= $nameErr; ?></span>
            <br><br>
            E-mail:
            <input type="text" name="email" class="<?= strlen($emailErr) != 0 ? "err" : ""; ?>">
            <span class="error">* <?= $emailErr; ?></span>
            <br><br>
            Website:
            <input type="text" name="website">
            <span class="error"><?= $websiteErr; ?></span>
            <br><br>
            Comment: <textarea name="comment" rows="5" cols="40"></textarea>
            <br><br>
            Gender:
            <input type="radio" name="gender" value="female" class="<?= strlen($genderErr) != 0 ? "err" : ""; ?>">Female
            <input type="radio" name="gender" value="male" class="<?= strlen($genderErr) != 0 ? "err" : ""; ?>">Male
            <span class="error">* <?= $genderErr; ?></span>
            <br><br>
            <input type="submit" name="submit" value="Submit"> 
        </form>

    </body>
</html>
