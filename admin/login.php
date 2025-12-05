<?php

session_start();

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $admin_email = "admin@treadja.com";
    $admin_senha = "12345";

    if ($email === $admin_email && $senha === $admin_senha) {

        $_SESSION["admin_logado"] = true;
        header("Location: painel.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Administrativo</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 0 10px #aaa;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            background: #0c6;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<form method="POST">
    <h2>Painel Administrativo</h2>
    <input type="email" name="email" placeholder="E-mail do admin" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>

    <p style="color:red;"><?php echo $erro ?? ''; ?></p>
</form>

</body>
</html>