<?php
session_start();

// Verifica se já está logado
if(isset($_SESSION['usuario'])) {
    header("Location: produtos.php");
    exit;
}

// Dados de login (em produção, use banco de dados)
$usuariosValidos = [
    'cliente@email.com' => password_hash('senha123', PASSWORD_DEFAULT),
    'admin@chocolates.com' => password_hash('admin123', PASSWORD_DEFAULT)
];

// Processa o formulário
$erro = '';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    
    if(isset($usuariosValidos[$email]) && password_verify($senha, $usuariosValidos[$email])) {
        $_SESSION['usuario'] = $email;
        $_SESSION['nome'] = explode('@', $email)[0]; // Pega o nome antes do @
        header("Location: produtos.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
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
        <h1>Chocolates Delícia</h1>
        
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
            
            <button type="submit" class="btn-login">Entrar</button>
        </form>
        
        <div class="cadastro-link">
            Não tem conta? <a href="cadastro.php">Cadastre-se aqui</a>
        </div>
    </div>
</body>
</html>