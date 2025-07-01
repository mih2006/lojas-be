<?php
session_start();

// Redireciona se não estiver logado
if(!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Inicializa carrinho se não existir
if(!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Remove item do carrinho
if(isset($_GET['remover'])) {
    $id = $_GET['remover'];
    if(isset($_SESSION['carrinho'][$id])) {
        unset($_SESSION['carrinho'][$id]);
    }
    header("Location: carrinho.php");
    exit;
}

// Atualiza quantidades
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach($_POST['quantidade'] as $id => $qtd) {
        if($qtd > 0) {
            $_SESSION['carrinho'][$id] = $qtd;
        } else {
            unset($_SESSION['carrinho'][$id]);
        }
    }
    header("Location: carrinho.php");
    exit;
}

// Simulação de produtos (em produção, use banco de dados)
$produtos = [
    1 => ['nome' => 'Trufas de Morango', 'preco' => 12.90, 'img' => 'trufa-morango.jpg'],
    2 => ['nome' => 'Barra 70% Cacau', 'preco' => 24.90, 'img' => 'barra-cacau.jpg'],
    3 => ['nome' => 'Bombons Sortidos', 'preco' => 35.90, 'img' => 'bombons.jpg'],
    4 => ['nome' => 'Ovo de Páscoa', 'preco' => 89.90, 'img' => 'ovo-pascoa.jpg'],
    5 => ['nome' => 'Chocolate Branco', 'preco' => 19.90, 'img' => 'branco.jpg'],
    6 => ['nome' => 'Cupcake de Chocolate', 'preco' => 14.90, 'img' => 'cupcake.jpg']
];

// Calcula total
$total = 0;
foreach($_SESSION['carrinho'] as $id => $qtd) {
    if(isset($produtos[$id])) {
        $total += $produtos[$id]['preco'] * $qtd;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carrinho - Chocolates Delícia</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .carrinho-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(93, 64, 55, 0.2);
        }
        
        .carrinho-container h1 {
            color: var(--marrom);
            text-align: center;
            margin-bottom: 30px;
            font-family: 'Brush Script MT', cursive;
            font-size: 2.5rem;
        }
        
        .carrinho-vazio {
            text-align: center;
            color: var(--marrom-claro);
            font-size: 1.2rem;
            padding: 30px;
        }
        
        .item-carrinho {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--rosa-claro);
        }
        
        .item-carrinho img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }
        
        .item-info {
            flex-grow: 1;
        }
        
        .item-info h3 {
            margin: 0;
            color: var(--marrom);
        }
        
        .item-info p {
            margin: 5px 0;
            color: var(--marrom-claro);
        }
        
        .item-quantidade {
            display: flex;
            align-items: center;
        }
        
        .item-quantidade input {
            width: 50px;
            text-align: center;
            padding: 5px;
            border: 1px solid var(--rosa);
            border-radius: 5px;
            margin: 0 10px;
        }
        
        .btn-remover {
            background: none;
            border: none;
            color: var(--marrom-claro);
            cursor: pointer;
            font-size: 1.2rem;
        }
        
        .resumo-carrinho {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid var(--rosa);
        }
        
        .total {
            display: flex;
            justify-content: space-between;
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--marrom);
        }
        
        .btn-finalizar {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: var(--marrom);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 1.1rem;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn-finalizar:hover {
            background-color: var(--marrom-claro);
        }
        
        .btn-continuar {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: var(--marrom-claro);
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="carrinho-container">
        <h1>Seu Carrinho</h1>
        
        <?php if(empty($_SESSION['carrinho'])): ?>
            <div class="carrinho-vazio">
                <p>Seu carrinho está vazio</p>
                <a href="produtos.php" class="btn-continuar">Continuar comprando</a>
            </div>
        <?php else: ?>
            <form method="POST">
                <?php foreach($_SESSION['carrinho'] as $id => $qtd): ?>
                    <?php if(isset($produtos[$id])): ?>
                        <div class="item-carrinho">
                            <img src="images/<?= $produtos[$id]['img'] ?>" alt="<?= $produtos[$id]['nome'] ?>">
                            
                            <div class="item-info">
                                <h3><?= $produtos[$id]['nome'] ?></h3>
                                <p>R$ <?= number_format($produtos[$id]['preco'], 2, ',', '.') ?></p>
                            </div>
                            
                            <div class="item-quantidade">
                                <button type="button" class="btn-remover" onclick="location.href='carrinho.php?remover=<?= $id ?>'">×</button>
                                <input type="number" name="quantidade[<?= $id ?>]" value="<?= $qtd ?>" min="1">
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                
                <div class="resumo-carrinho">
                    <div class="total">
                        <span>Total:</span>
                        <span>R$ <?= number_format($total, 2, ',', '.') ?></span>
                    </div>
                    
                    <button type="submit" class="btn-atualizar">Atualizar Carrinho</button>
                    <button type="button" class="btn-finalizar" onclick="location.href='checkout.php'">Finalizar Compra</button>
                    <a href="produtos.php" class="btn-continuar">Continuar comprando</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>