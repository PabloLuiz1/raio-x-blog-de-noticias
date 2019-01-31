    function validarSenhaNova(senha){
        if (senha.length > 0 && senha.length < 6){
            alert ('a');
            document.getElementById('errosenha').classList.remove('d-none');
            document.getElementById('errosenha').classList.remove('d-block');
        }
    }