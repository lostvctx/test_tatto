document.addEventListener('DOMContentLoaded', function () {

    // Tabs
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.getAttribute('data-tab');
            switchTab(tabName);
        });
    });


    // BOTÃO FAZER AGENDAMENTO
    const btnAgendamento = document.getElementById("btnFazerAgendamento");

    if (btnAgendamento) {
        btnAgendamento.addEventListener("click", function () {
            switchTab("novo");
        });
    }


    // Booking type selector
    const typeOptions = document.querySelectorAll('.type-option');
    const tipoInput = document.getElementById('tipo_agendamento');
    const tattooFields = document.querySelector('.tattoo-fields');

    if (typeOptions.length > 0) {

        typeOptions.forEach(option => {

            option.addEventListener('click', () => {

                typeOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');

                const type = option.getAttribute('data-type');

                if (tipoInput) {
                    tipoInput.value = type;
                }

                if (tattooFields) {

                    if (type === 'tattoo') {

                        tattooFields.style.display = 'block';

                        document.getElementById('tipo_tatuagem').required = true;
                        document.getElementById('primeira_tatuagem').required = true;
                        document.getElementById('parte_corpo').required = true;
                        document.getElementById('tamanho').required = true;
                        document.getElementById('descricao').required = true;

                    } else {

                        tattooFields.style.display = 'none';

                        document.getElementById('tipo_tatuagem').required = false;
                        document.getElementById('primeira_tatuagem').required = false;
                        document.getElementById('parte_corpo').required = false;
                        document.getElementById('tamanho').required = false;
                        document.getElementById('descricao').required = false;

                    }
                }
            });
        });
    }


    // Mensagem sucesso
    if (window.location.search.includes('sucesso=1')) {
        showNotification('Agendamento solicitado com sucesso!', 'success');
    }

});



function switchTab(tabName) {

    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(btn => {

        if (btn.getAttribute('data-tab') === tabName) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }

    });

    tabContents.forEach(content => {

        if (content.id === tabName) {
            content.classList.add('active');
        } else {
            content.classList.remove('active');
        }

    });
}



function removerTattoo(id) {

    if (confirm('Tem certeza que deseja remover esta tatuagem?')) {
        window.location.href = 'remover-tattoo.php?id=' + id;
    }

}



function showNotification(message, type) {

    const notification = document.createElement('div');

    notification.className = `alert alert-${type}`;
    notification.textContent = message;

    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 3000);

}