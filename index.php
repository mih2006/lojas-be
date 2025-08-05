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
    <title>𝓒𝓱𝓸𝓬𝓸𝓵í𝓬𝓲𝓪 - 𝐇𝐨𝐦𝐞</title>
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
            <h1>𝓒𝓱𝓸𝓬𝓸𝓵í𝓬𝓲𝓪</h1>
        </div>
        <nav>
            <?php if(isset($_SESSION['usuario'])): ?>
                <span>Olá, <?= $_SESSION['usuario'] ?></span> |
                <a href="pages/produtos.php">𝐏𝐫𝐨𝐝𝐮𝐭𝐨𝐬</a> |
                <a href="pages/carrinho.php">𝐂𝐚𝐫𝐫𝐢𝐧𝐡𝐨</a> |
                <a href="?sair=1">𝐒𝐚𝐢𝐫</a>
            <?php else: ?>
                <a href="pages/login.php">Login</a> |
                <a href="pages/produtos.php">𝐏𝐫𝐨𝐝𝐮𝐭𝐨𝐬</a>
            <?php endif; ?>
        </nav>
    </header>

    <section class="hero-banner">
        <h2>𝐎𝐬 𝐦𝐞𝐥𝐡𝐨𝐫𝐞𝐬 𝐜𝐡𝐨𝐜𝐨𝐥𝐚𝐭𝐞𝐬 𝐚𝐫𝐭𝐞𝐬𝐚𝐧𝐚𝐢𝐬</h2>
        <p>𝐅𝐞𝐢𝐭𝐨𝐬 𝐜𝐨𝐦 𝐚𝐦𝐨𝐫 𝐞 𝐢𝐧𝐠𝐫𝐞𝐝𝐢𝐞𝐧𝐭𝐞𝐬 𝐬𝐞𝐥𝐞𝐜𝐢𝐨𝐧𝐚𝐝𝐨𝐬 𝐩𝐚𝐫𝐚 𝐨𝐬 𝐯𝐞𝐫𝐝𝐚𝐝𝐞𝐢𝐫𝐨𝐬 𝐚𝐦𝐚𝐧𝐭𝐞𝐬 𝐝𝐞 𝐜𝐡𝐨𝐜𝐨𝐥𝐚𝐭𝐞</p>
        <a href="pages/produtos.php" class="btn">𝐂𝐨𝐧𝐡𝐞ç𝐚 𝐧𝐨𝐬𝐬𝐨𝐬 𝐩𝐫𝐨𝐝𝐮𝐭𝐨𝐬</a>
    </section>

    <section class="destaques">
        <h2>𝐍𝐨𝐬𝐬𝐨𝐬 𝐃𝐞𝐬𝐭𝐚𝐪𝐮𝐞𝐬</h2>
        <div class="produtos-container">
            <?php foreach($produtosDestaque as $produto): ?>
                <div class="produto">
                    <!-- Caminho corrigido e fallback melhorado -->
                    <img src="<?= $produto['img'] ?>" alt="<?= $produto['nome'] ?>" 
                         onerror="this.onerror=null; this.src='https://via.placeholder.com/280x200/5d4037/ffffff?text=<?= urlencode(substr($produto['nome'], 0, 20)) ?>'">
                    <h3><?= $produto['nome'] ?></h3>
                    <p><?= $produto['descricao'] ?></p>
                    <p class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                    <a href="pages/produtos.php" class="btn">𝐕𝐞𝐫 𝐝𝐞𝐭𝐚𝐥𝐡𝐞𝐬</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


    <section class="sobre">
        <div class="sobre-container">
            <h2>𝐒𝐨𝐛𝐫𝐞 𝐚 𝐂𝐡𝐨𝐜𝐨𝐥í𝐜𝐢𝐚</h2>
            <p>𝐃𝐞𝐬𝐝𝐞 𝟐𝟎𝟏𝟎, 𝐚 𝐂𝐡𝐨𝐜𝐨𝐥í𝐜𝐢𝐚 𝐯𝐞𝐦 𝐞𝐧𝐜𝐚𝐧𝐭𝐚𝐧𝐝𝐨 𝐩𝐚𝐥𝐚𝐝𝐚𝐫𝐞𝐬 𝐜𝐨𝐦 𝐬𝐞𝐮𝐬 𝐜𝐡𝐨𝐜𝐨𝐥𝐚𝐭𝐞𝐬 𝐚𝐫𝐭𝐞𝐬𝐚𝐧𝐚𝐢𝐬 𝐟𝐞𝐢𝐭𝐨𝐬 𝐜𝐨𝐦 𝐨𝐬 𝐦𝐞𝐥𝐡𝐨𝐫𝐞𝐬 𝐢𝐧𝐠𝐫𝐞𝐝𝐢𝐞𝐧𝐭𝐞𝐬 𝐞 𝐦𝐮𝐢𝐭𝐨 𝐜𝐚𝐫𝐢𝐧𝐡𝐨. 𝐍𝐨𝐬𝐬𝐚 𝐦𝐢𝐬𝐬ã𝐨 é 𝐥𝐞𝐯𝐚𝐫 𝐚𝐥𝐞𝐠𝐫𝐢𝐚 𝐞 𝐦𝐨𝐦𝐞𝐧𝐭𝐨𝐬 𝐞𝐬𝐩𝐞𝐜𝐢𝐚𝐢𝐬 𝐚𝐭𝐫𝐚𝐯é𝐬 𝐝𝐨 𝐬𝐚𝐛𝐨𝐫 𝐢𝐧𝐢𝐠𝐮𝐚𝐥á𝐯𝐞𝐥 𝐝𝐨 𝐯𝐞𝐫𝐝𝐚𝐝𝐞𝐢𝐫𝐨 𝐜𝐡𝐨𝐜𝐨𝐥𝐚𝐭𝐞.</p>
            <p>𝐓𝐨𝐝𝐨𝐬 𝐨𝐬 𝐧𝐨𝐬𝐬𝐨𝐬 𝐩𝐫𝐨𝐝𝐮𝐭𝐨𝐬 𝐬ã𝐨 𝐟𝐚𝐛𝐫𝐢𝐜𝐚𝐝𝐨𝐬 𝐚𝐫𝐭𝐞𝐬𝐚𝐧𝐚𝐥𝐦𝐞𝐧𝐭𝐞, 𝐬𝐞𝐦 𝐜𝐨𝐧𝐬𝐞𝐫𝐯𝐚𝐧𝐭𝐞𝐬 𝐞 𝐜𝐨𝐦 𝐢𝐧𝐠𝐫𝐞𝐝𝐢𝐞𝐧𝐭𝐞𝐬 𝟏𝟎𝟎% 𝐧𝐚𝐭𝐮𝐫𝐚𝐢𝐬.</p>
            <a href="pages/produtos.php" class="btn">𝐍𝐨𝐬𝐬𝐚 𝐂𝐨𝐥𝐞çã𝐨</a>
        </div>
    </section>

    <footer>
        <p>𝓒𝓱𝓸𝓬𝓸𝓵í𝓬𝓲𝓪 &copy; <?= date('Y') ?></p>
    </footer>
</body>
</html>