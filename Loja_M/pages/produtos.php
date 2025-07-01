<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Produtos de chocolate (simplificado)
$produtos = [
    ['id' => 1, 'nome' => 'Trufas de Morango', 'preco' => 12.90, 'img' => 'trufa-morango.jpg'],
    ['id' => 2, 'nome' => 'Barra 70% Cacau', 'preco' => 24.90, 'img' => 'barra-cacau.jpg'],
    ['id' => 3, 'nome' => 'Bombons Sortidos', 'preco' => 35.90, 'img' => 'bombons.jpg'],
    ['id' => 4, 'nome' => 'Ovo de Páscoa', 'preco' => 89.90, 'img' => 'ovo-pascoa.jpg'],
    ['id' => 5, 'nome' => 'Chocolate Branco', 'preco' => 19.90, 'img' => 'branco.jpg'],
    ['id' => 6, 'nome' => 'Cupcake de Chocolate', 'preco' => 14.90, 'img' => 'cupcake.jpg']
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nossos Chocolates</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main>
        <h2 style="text-align: center; margin-top: 2rem;">Nossos Deliciosos Chocolates</h2>
        
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