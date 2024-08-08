window.onload = function() {
    var inputsPreenchidos = document.querySelectorAll('.form-control.end');
    const btn = document.getElementById('btn-cadastrar-end');
    var disableBtn = true;

    for (var i = 0; i < inputsPreenchidos.length; i++) {
        if (inputsPreenchidos[i].value) {
            inputsPreenchidos[i].disabled = true;
        } else {
            disableBtn = false;
        }
    }

    if (disableBtn) {
        btn.disabled = true;
    }
};