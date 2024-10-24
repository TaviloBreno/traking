// JavaScript para a página de consulta de pedidos

document.addEventListener('DOMContentLoaded', function () {
    // Seleciona todos os links de "Ver detalhes"
    const detalhesLinks = document.querySelectorAll('table td a');

    // Adiciona um alerta de confirmação antes de redirecionar para a página de detalhes
    detalhesLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            const confirmacao = confirm("Deseja realmente ver os detalhes deste pedido?");
            if (!confirmacao) {
                // Impede o redirecionamento se o usuário cancelar
                event.preventDefault();
            }
        });
    });
});

// JavaScript para a página de erro 500

document.addEventListener('DOMContentLoaded', function () {
    // Exibe um alerta ao usuário quando tenta voltar para a página inicial
    const voltarLink = document.querySelector('.error-container a');

    voltarLink.addEventListener('click', function (event) {
        const confirmacao = confirm("Tem certeza de que deseja voltar para a página inicial?");
        if (!confirmacao) {
            // Impede a navegação se o usuário cancelar
            event.preventDefault();
        }
    });
});


// JavaScript para interações do footer

document.addEventListener('DOMContentLoaded', function () {
    const footer = document.querySelector('footer');

    // Exemplo de interação: muda a cor de fundo do footer ao clicar
    footer.addEventListener('click', function () {
        footer.style.backgroundColor = footer.style.backgroundColor === 'lightgray' ? '#333' : 'lightgray';
    });
});