<?php
session_start();

// Produtos em destaque de exemplo - caminhos corrigidos
$produtosDestaque = [
    [
        'id' => 1,
        'nome' => 'Trufas de Chocolate Belga',
        'preco' => 24.90,
        'img' => 'pages/images/trufa.png', // Caminho completo corrigido
        'descricao' => 'Trufas artesanais feitas com chocolate belga de primeira qualidade'
    ],
    [
        'id' => 2,
        'nome' => 'Barra 70% Cacau',
        'preco' => 18.50,
        'img' => 'pages/images/cacau.png', // Caminho completo corrigido
        'descricao' => 'Barra de chocolate amargo com 70% de cacau puro'
    ],
    [
        'id' => 3,
        'nome' => 'Caixa de Bombons Sortidos',
        'preco' => 45.00,
        'img' => 'pages/images/bombom.png', // Caminho completo corrigido
        'descricao' => 'Seleção premium de 12 bombons com recheios especiais'
    ]
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>𝓒𝓱𝓸𝓬𝓸𝓵í𝓬𝓲𝓪 - Home</title>
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --marrom: #5d4037;
            --marrom-claro: #a1887f;
            --rosa: #e91e63;
            --rosa-claro: #f8bbd0;
            --bege: #f9f5f0;
        }
        
        body {
            background-color: var(--bege);
            font-family: Arial, sans-serif;
            color: var(--marrom);
            margin: 0;
            padding: 0;
            padding-bottom: 60px;
        }
        
        /* Header/Navbar */
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
        
        /* Banner Principal */
        .hero-banner {
            background: linear-gradient(rgba(93, 64, 55, 0.7), rgba(93, 64, 55, 0.7)), 
                        url('images/banner-chocolate.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 20px;
            margin-bottom: 40px;
        }
        
        .hero-banner h2 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-family: 'Brush Script MT', cursive;
        }
        
        .hero-banner p {
            font-size: 1.3rem;
            max-width: 700px;
            margin: 0 auto 30px;
        }
        
        .btn {
            background-color: var(--marrom);
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s;
            display: inline-block;
            border: 2px solid var(--marrom);
        }
        
        .btn:hover {
            background-color: transparent;
            color: white;
            border-color: white;
        }
        
        /* Seção de Destaques */
        .destaques {
            max-width: 1200px;
            margin: 0 auto 60px;
            padding: 0 20px;
        }
        
        .destaques h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 40px;
            font-family: 'Brush Script MT', cursive;
            color: var(--marrom);
        }
        
        .produtos-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }
        
        .produto {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(93, 64, 55, 0.1);
            width: 280px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s;
        }
        
        .produto:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(93, 64, 55, 0.2);
        }
        
        .produto img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        
        .produto h3 {
            margin: 0 0 10px 0;
            font-size: 1.3rem;
            color: var(--marrom);
        }
        
        .produto p {
            color: var(--marrom-claro);
            font-size: 0.9rem;
            min-height: 40px;
            margin-bottom: 15px;
        }
        
        .preco {
            font-weight: bold;
            color: var(--marrom);
            margin-bottom: 15px;
            font-size: 1.2rem;
        }
        
        /* Sobre Nós */
        .sobre {
            background-color: white;
            padding: 60px 20px;
            text-align: center;
        }
        
        .sobre-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .sobre h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            font-family: 'Brush Script MT', cursive;
            color: var(--marrom);
        }
        
        .sobre p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        /* Footer */
        footer {
            text-align: center;
            padding: 20px 0;
            background-color: var(--marrom);
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
            font-weight: bold;
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                padding: 15px;
            }
            
            nav {
                margin-top: 15px;
            }
            
            .hero-banner {
                padding: 60px 20px;
            }
            
            .hero-banner h2 {
                font-size: 2.2rem;
            }
            
            .produtos-container {
                flex-direction: column;
                align-items: center;
            }
        }
        </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>C𝓒𝓱𝓸𝓬𝓸𝓵í𝓬𝓲𝓪</h1>
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

    <section class="hero-banner">
        <h2>Os melhores chocolates artesanais</h2>
        <p>Feitos com amor e ingredientes selecionados para os verdadeiros amantes de chocolate</p>
        <a href="pages/produtos.php" class="btn">Conheça nossos produtos</a>
    </section>

    <section class="destaques">
        <h2>Nossos Destaques</h2>
        <div class="produtos-container">
            <?php foreach($produtosDestaque as $produto): ?>
                <div class="produto">
                    <!-- Caminho corrigido e fallback melhorado -->
                    <img src="<?= $produto['img'] ?>" alt="<?= $produto['nome'] ?>" 
                         onerror="this.onerror=null; this.src='https://via.placeholder.com/280x200/5d4037/ffffff?text=<?= urlencode(substr($produto['nome'], 0, 20)) ?>'">
                    <h3><?= $produto['nome'] ?></h3>
                    <p><?= $produto['descricao'] ?></p>
                    <p class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                    <a href="pages/produtos.php" class="btn">Ver detalhes</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


    <section class="sobre">
        <div class="sobre-container">
            <h2>Sobre a Chocolícia</h2>
            <p>Desde 2010, a Chocolícia vem encantando paladares com seus chocolates artesanais feitos com os melhores ingredientes e muito carinho. Nossa missão é levar alegria e momentos especiais através do sabor inigualável do verdadeiro chocolate.</p>
            <p>Todos os nossos produtos são fabricados artesanalmente, sem conservantes e com ingredientes 100% naturais.</p>
            <a href="pages/produtos.php" class="btn">Nossa Coleção</a>
        </div>
    </section>

    <footer>
        <p>𝓒𝓱𝓸𝓬𝓸𝓵í𝓬𝓲𝓪 &copy; <?= date('Y') ?></p>
    </footer>
</body>
</html>