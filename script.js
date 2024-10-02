document.getElementById('submitBtn').addEventListener('click', function() {
    var additionalInput = document.getElementById('additionalInput');
    var submitBtn = document.getElementById('submitBtn');
    var icon = submitBtn.querySelector('i');

    if (icon.classList.contains('fa-plus')) {
        additionalInput.style.display = 'inline-block';
        icon.classList.remove('fa-plus');
        icon.classList.add('fa-check');
        submitBtn.type = 'button'; // Mantém o tipo como botão até que o usuário clique novamente
    } else if (icon.classList.contains('fa-check')) {
        // Aqui você pode adicionar a lógica para submeter o formulário
        // Por exemplo: document.querySelector('.to-do-form').submit();
        submitBtn.type = 'submit'; // Muda o tipo para submit quando o usuário clicar para submeter
    }
});




