<?php
session_start();

// Dados simulados (substitua por banco de dados depois)
$_SESSION['produtos'] = [
    1 => ['nome' => 'Trufas de Morango', 'preco' => 12.90, 'img' => 'trufa-morango.jpg'],
    2 => ['nome' => 'Barra 70% Cacau', 'preco' => 24.90, 'img' => 'barra-cacau.jpg']
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chocolates Delícia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Chocolates Delícia</h1>
        </div>
        <nav>
            <?php if(isset($_SESSION['usuario'])): ?>
                <span>Olá, <?= $_SESSION['usuario'] ?></span> |
                <a href="produtos.php">Produtos</a> |
                <a href="carrinho.php">Carrinho</a> |
                <a href="?sair=1">Sair</a>
            <?php else: ?>
                <a href="login.php">Login</a> |
                <a href="produtos.php">Produtos</a>
            <?php endif; ?>
        </nav>
    </header>

    <main class="banner">
        <h2>Os melhores chocolates artesanais</h2>
        <p>Feitos com amor e ingredientes selecionados</p>
        <a href="produtos.php" class="btn">Conheça nossos produtos</a>
    </main>

    <footer>
        <p>Chocolates Delícia &copy; 2023</p>
    </footer>
</body>
</html>