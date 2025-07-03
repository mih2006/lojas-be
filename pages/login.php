<?php
session_start();

// Load users from JSON file
$usersJson = file_get_contents(__DIR__ . '/users.json');
$usersData = json_decode($usersJson, true);
$users = $usersData['users'] ?? [];

// Bypass login without DB active
if (isset($_GET['bypasslogin']) && $_GET['bypasslogin'] == '1') {
    $_SESSION['usuario'] = 'bypassuser';
    $_SESSION['nome'] = 'Bypass User';
    header("Location: produtos.php");
    exit;
}

// Guest access bypass
if (isset($_GET['guest']) && $_GET['guest'] == '1') {
    $_SESSION['usuario'] = 'guest';
    $_SESSION['nome'] = 'Guest';
    header("Location: produtos.php");
    exit;
}

// Verifica se já está logado
if(isset($_SESSION['usuario'])) {
    header("Location: produtos.php");
    exit;
}

// Processa o formulário
$erro = '';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (!empty($usuario) && !empty($senha)) {
        $userFound = null;
        foreach ($users as $user) {
            if ($user['usuario'] === $usuario) {
                $userFound = $user;
                break;
            }
        }
        if ($userFound) {
            if ($senha === $userFound['senha']) {
                $_SESSION['id'] = $userFound['id'];
                $_SESSION['usuario'] = $usuario;
                header("Location: produtos.php");
                exit();
            } else {
                $erro = "Erro: Senha incorreta!";
            }
        } else {
            $erro = "Erro: Usuário não encontrado!";
        }
    } else {
        $erro = "Por favor, preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Chocolates Delícia</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(93, 64, 55, 0.2);
        }
        
        .login-container h1 {
            color: var(--marrom);
            text-align: center;
            margin-bottom: 30px;
            font-family: 'Brush Script MT', cursive;
            font-size: 2.5rem;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--marrom);
            font-weight: bold;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--rosa);
            border-radius: 25px;
            font-size: 1rem;
        }
        
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: var(--marrom);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn-login:hover {
            background-color: var(--marrom-claro);
        }
        
        .cadastro-link {
            text-align: center;
            margin-top: 20px;
            color: var(--marrom);
        }
        
        .cadastro-link a {
            color: var(--marrom-claro);
            font-weight: bold;
            text-decoration: none;
        }
        
        .erro-login {
            color: #d32f2f;
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #ffebee;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Chocolicia</h1>
        
        <?php if($erro): ?>
            <div class="erro-login"><?= $erro ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required placeholder="seu@email.com">
            </div>
            
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required placeholder="Sua senha">
            </div>
            
        <button type="submit" class="btn-login" style="display: block;">Entrar</button>
        </form>
        
        <div class="cadastro-link">
            Não tem conta? <a href="cadastro.php">Cadastre-se aqui</a>
        </div>
    </div>
</body>
</html>