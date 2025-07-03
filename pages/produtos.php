<?php
session_start();

// Bypass login without DB active
if (isset($_GET['bypass']) && $_GET['bypass'] == '1') {
    $_SESSION['usuario'] = 'bypassuser';
    $_SESSION['nome'] = 'Bypass User';
}

if(!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$produtosJson = file_get_contents(__DIR__ . '/products.json');
$produtosData = json_decode($produtosJson, true);
$produtos = $produtosData['products'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nossos Chocolates</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
    <style>
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
            color: #5d4037;
            margin: 0;
            padding: 0;
        }
        main {
            max-width: 900px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(93, 64, 55, 0.2);
        }
        h2.title-font {
            text-align: center;
            margin-top: 0;
            font-size: 2.5rem;
            margin-bottom: 30px;
            font-family: 'Brush Script MT', cursive;
        }
        .produtos-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
        }
        .produto {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(93, 64, 55, 0.1);
            width: 250px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s;
        }
        .produto:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(93, 64, 55, 0.2);
        }
        .produto img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 15px;
        }
        .produto-info h3 {
            margin: 0 0 10px 0;
            font-size: 1.3rem;
            color: #5d4037;
        }
        .preco {
            font-weight: bold;
            color: #a1887f;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        .btn {
            background-color: #5d4037;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #a1887f;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main>
        <h2 class="title-font">Nossos Deliciosos Chocolates</h2>
        
        <div class="produtos-container">
            <?php foreach($produtos as $produto): ?>
                <div class="produto">
                    <img src="images/<?= $produto['img'] ?>" alt="<?= $produto['nome'] ?>">
                    <div class="produto-info">
                        <h3><?= $produto['nome'] ?></h3>
                        <p class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                        <button class="btn" onclick="adicionarCarrinho(<?= $produto['id'] ?>)">
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    
    <?php include 'footer.php'; ?>
</body>
</html>
