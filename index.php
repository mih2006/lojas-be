<?php
session_start();

$produtosJson = file_get_contents(__DIR__ . '/pages/products.json');
$produtosData = json_decode($produtosJson, true);
$produtos = $produtosData['products'] ?? [];
$produtosDestaque = array_slice($produtos, 0, 3);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chocolates Delícia</title>
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --marrom: #5d4037;
            --marrom-claro: #a1887f;
            --rosa: #e91e63;
            --rosa-claro: #f8bbd0;
        }
        body {
            background-color: white;
            font-family: Arial, sans-serif;
            color: var(--marrom);
            margin: 0;
            padding: 0;
        }
        header {
            background-color: var(--marrom);
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo h1 {
            margin: 0;
            font-size: 1.8rem;
        }
        nav a, nav span {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-weight: bold;
        }
        nav a:hover {
            color: var(--rosa);
        }
        main.banner {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(93, 64, 55, 0.2);
            text-align: center;
        }
        main.banner h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-family: 'Brush Script MT', cursive;
        }
        main.banner p {
            font-size: 1.2rem;
            margin-bottom: 25px;
        }
        main.banner .btn {
            background-color: var(--marrom);
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        main.banner .btn:hover {
            background-color: var(--marrom-claro);
        }
        footer {
            text-align: center;
            padding: 15px 0;
            background-color: var(--marrom);
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
            font-weight: bold;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <h1>CHOCOLICIA</h1>
    </div>
<nav>
    <?php if(isset($_SESSION['usuario'])): ?>
        <span>Olá, <?= $_SESSION['usuario'] ?></span> |
        <a href="pages/produtos.php">Produtos</a> |
        <a href="pages/carrinho.php">Carrinho</a> |
        <a href="?sair=1">Sair</a>
    <?php else: ?>
        <a href="pages/login.php">Login</a> |
        <a href="pages/produtos.php">Produtos</a>
    <?php endif; ?>
</nav>
</header>

    <main class="banner">
        <h2>Os melhores chocolates artesanais</h2>
        <p>Feitos com amor e ingredientes selecionados</p>
        <a href="pages/produtos.php" class="btn">Conheça nossos produtos</a>
    </main>

    <section class="destaque-container" style="max-width: 900px; margin: 40px auto; display: flex; justify-content: space-around; gap: 20px;">
        <?php foreach($produtosDestaque as $produto): ?>
            <div class="card-destaque" style="background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(93, 64, 55, 0.3); width: 300px; padding: 20px; text-align: center; font-family: Arial, sans-serif;">
                <img src="pages/images/<?= $produto['img'] ?>" alt="<?= $produto['nome'] ?>" style="width: 100%; height: 250px; object-fit: cover; border-radius: 15px; margin-bottom: 15px;">
                <h3 style="margin: 0 0 10px 0; color: var(--marrom); font-size: 1.8rem;"><?= $produto['nome'] ?></h3>
                <p class="preco" style="font-weight: bold; color: var(--marrom-claro); font-size: 1.3rem; margin-bottom: 15px;">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    <footer>
        <p>Chocolates Delícia &copy; 2023</p>
    </footer>
</body>
</html>
