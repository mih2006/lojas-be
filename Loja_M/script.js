// Função para adicionar ao carrinho
function adicionarCarrinho(id) {
    fetch('adicionar_carrinho.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Anima o ícone do carrinho
                const carrinhoIcon = document.querySelector('.carrinho-icon');
                carrinhoIcon.style.transform = 'scale(1.5)';
                setTimeout(() => {
                    carrinhoIcon.style.transform = 'scale(1)';
                }, 300);
                
                // Atualiza contador
                if(document.getElementById('contador-carrinho')) {
                    document.getElementById('contador-carrinho').textContent = data.totalItems;
                }
                
                // Mostra notificação
                alert('Chocolate adicionado ao carrinho!');
            }
        });
}

// Efeito hover nos produtos
document.querySelectorAll('.produto').forEach(produto => {
    produto.addEventListener('mouseover', () => {
        produto.querySelector('img').style.transform = 'scale(1.05)';
    });
    
    produto.addEventListener('mouseout', () => {
        produto.querySelector('img').style.transform = 'scale(1)';
    });
});