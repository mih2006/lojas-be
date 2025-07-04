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

// Lista de produtos da Chocolícia
$produtos = [
    [
        'id' => 1,
        'nome' => 'Trufas de Chocolate Belga',
        'preco' => 24.90,
        'img' => 'trufa.png',
        'categoria' => 'finos'
    ],
    [
        'id' => 2,
        'nome' => 'Barra 70% Cacau',
        'preco' => 18.50,
        'img' => 'cacau.png',
        'categoria' => 'finos'
    ],
    [
        'id' => 3,
        'nome' => 'Caixa de Bombons Sortidos',
        'preco' => 45.00,
        'img' => 'bombom.png',
        'categoria' => 'finos'
    ],
    [
        'id' => 4,
        'nome' => 'Ovo de Páscoa Recheado',
        'preco' => 89.90,
        'img' => 'ovo.png',
        'categoria' => 'finos'
    ],
    [
        'id' => 5,
        'nome' => 'Chocolate com Amêndoas',
        'preco' => 32.75,
        'img' => 'amendoas.png',
        'categoria' => 'finos'
    ],
    [
        'id' => 6,
        'nome' => 'Fondue de Chocolate',
        'preco' => 65.00,
        'img' => 'fondue.jpg',
        'categoria' => 'finos'
    ],
    [
        'id' => 7,
        'nome' => 'Barrinha de Chocolate Branco',
        'preco' => 12.90,
        'img' => 'branco.jpg',
        'categoria' => 'especiais'
    ],
    [
        'id' => 8,
        'nome' => 'Kit Presente Chocolícia',
        'preco' => 120.00,
        'img' => 'kit-presente.jpg',
        'categoria' => 'especiais'
    ],
    [
        'id' => 9,
        'nome' => 'Chocolate com Pimenta',
        'preco' => 28.50,
        'img' => 'pimenta.jpg',
        'categoria' => 'especiais'
    ],
    [
        'id' => 10,
        'nome' => 'Cupcake de Chocolate',
        'preco' => 15.00,
        'img' => 'cupcake.jpg',
        'categoria' => 'especiais'
    ],
    [
        'id' => 11,
        'nome' => 'Chocolate Vegano',
        'preco' => 22.90,
        'img' => 'vegano.jpg',
        'categoria' => 'especiais'
    ],
    [
        'id' => 12,
        'nome' => 'Tablete de Chocolate com Café',
        'preco' => 19.75,
        'img' => 'cafe.jpg',
        'categoria' => 'especiais'
    ]
];

// Função para verificar se a imagem existe
function getImagemProduto($img) {
    $caminhoImagem = 'images/' . $img;
    if (file_exists($caminhoImagem)) {
        return $caminhoImagem;
    } else {
        return 'https://via.placeholder.com/250x180/5d4037/ffffff?text=Chocolícia';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nossos Produtos - Chocolícia</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        :root {
            --marrom: #5d4037;
            --marrom-claro: #a1887f;
            --rosa: #e91e63;
            --rosa-claro: #f8bbd0;
            --bege: #f9f5f0;
        }
        
        /* Estilos da Navbar */
        header {
            background-color: var(--marrom);
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        header .logo h1 {
            margin: 0;
            font-size: 1.8rem;
            font-family: 'Brush Script MT', cursive;
        }
        
        nav a, nav span {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-weight: bold;
            transition: color 0.3s;
        }
        
        nav a:hover {
            color: var(--rosa-claro);
        }
        
        /* Estilos do conteúdo principal */
        body {
            background-color: var(--bege);
            font-family: Arial, sans-serif;
            color: var(--marrom);
            margin: 0;
            padding: 0;
            padding-bottom: 60px;
        }
        
        main {
            max-width: 1200px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(93, 64, 55, 0.1);
        }
        
        h2.title-font {
            text-align: center;
            margin-top: 0;
            font-size: 2.5rem;
            margin-bottom: 30px;
            font-family: 'Brush Script MT', cursive;
            color: var(--marrom);
        }
        
        .produtos-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
        }
        
        .produto {
            background: #fff9f0;
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(93, 64, 55, 0.1);
            width: 250px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid #e0d6cc;
        }
        
        .produto:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(93, 64, 55, 0.2);
        }
        
        .produto img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
            border: 1px solid #e0d6cc;
        }
        
        .produto-info h3 {
            margin: 0 0 10px 0;
            font-size: 1.3rem;
            color: var(--marrom);
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .preco {
            font-weight: bold;
            color: var(--marrom-claro);
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .btn {
            background-color: var(--marrom);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: var(--marrom-claro);
        }
        
        .categoria-titulo {
            width: 100%;
            text-align: center;
            margin: 40px 0 20px;
            font-size: 1.8rem;
            color: var(--marrom);
            font-weight: bold;
            padding-bottom: 10px;
            border-bottom: 2px solid #d7ccc8;
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
        
        /* Fallback para imagens */
        .sem-imagem {
            background-color: #f5eee9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8d6e63;
            font-weight: bold;
            height: 180px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>CHOCOLÍCIA</h1>
        </div>
        <nav>
            <?php if(isset($_SESSION['usuario'])): ?>
                <span>Olá, <?= $_SESSION['usuario'] ?></span> |
                <a href="../index.php">Home</a> |
                <a href="produtos.php">Produtos</a> |
                <a href="carrinho.php">Carrinho</a> |
                <a href="../?sair=1">Sair</a>
            <?php else: ?>
                <a href="login.php">Login</a> |
                <a href="produtos.php">Produtos</a>
            <?php endif; ?>
        </nav>
    </header>
    
    <main>
        <h2 class="title-font">Nossos Deliciosos Chocolates</h2>
        
        <div class="produtos-container">
            <h3 class="categoria-titulo">Chocolates Finos</h3>
            <?php foreach(array_filter($produtos, function($p) { return $p['categoria'] === 'finos'; }) as $produto): ?>
                <div class="produto">
                    <?php if(file_exists('images/' . $produto['img'])): ?>
                        <img src="images/<?= $produto['img'] ?>" alt="<?= $produto['nome'] ?>">
                    <?php else: ?>
                        <div class="sem-imagem">Imagem não disponível</div>
                    <?php endif; ?>
                    <div class="produto-info">
                        <h3><?= $produto['nome'] ?></h3>
                        <p class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                        <button class="btn" onclick="adicionarCarrinho(<?= $produto['id'] ?>)">
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <h3 class="categoria-titulo">Chocolates Especiais</h3>
            <?php foreach(array_filter($produtos, function($p) { return $p['categoria'] === 'especiais'; }) as $produto): ?>
                <div class="produto">
                    <?php if(file_exists('images/' . $produto['img'])): ?>
                        <img src="images/<?= $produto['img'] ?>" alt="<?= $produto['nome'] ?>">
                    <?php else: ?>
                        <div class="sem-imagem">Imagem não disponível</div>
                    <?php endif; ?>
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
    
    <footer>
        <p>Chocolícia &copy; <?= date('Y') ?></p>
    </footer>

    <script>
        function adicionarCarrinho(idProduto) {
            alert('Produto ' + idProduto + ' adicionado ao carrinho!');
            // Aqui você pode implementar a lógica real de adicionar ao carrinho
        }
    </script>
</body>
</html>