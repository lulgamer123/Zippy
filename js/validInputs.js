
document.getElementById('confSenha').addEventListener('blur', function() {
    validarSenha();
});

function validarSenha() {
    var senha = document.getElementById('senha').value;
    var confSenha = document.getElementById('confSenha').value;
    var senhaError = document.getElementById('senhaError');
    
    if (senha === confSenha) {
        senhaError.style.display = 'none';
    } else {
        senhaError.style.display = 'block'; 
        document.getElementById('senha').value = "";
        document.getElementById('confSenha').value = "";
    }
}

