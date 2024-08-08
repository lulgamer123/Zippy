const formLogin = document.getElementById('formLogin');
const formRecupera = document.getElementById('formRecupera');
const formCadastro = document.getElementById('formCadastro');



function mostrarElemento(elemento) {
    elemento.style.display = "flex";
}

function esconderElemento(elemento) {
    elemento.style.display = "none";
}

document.getElementById('btnEsqueciSenha').addEventListener('click', function (e) {
    e.preventDefault();
    let caixa = document.getElementsByClassName('caixa');
    let containerLogin = document.getElementsByClassName('container-login');
    
    containerLogin[0].className = 'container-login'
    caixa[0].className = 'caixa';
    esconderElemento(formLogin);
    mostrarElemento(formRecupera);
});

document.getElementById("btnVoltarLogin").addEventListener('click', (e)=>{
    e.preventDefault();
    let caixa = document.getElementsByClassName('caixa');
    let containerLogin = document.getElementsByClassName('container-login');
    
    containerLogin[0].className = 'container-login'
    caixa[0].className = 'caixa';
    esconderElemento(formRecupera);
    mostrarElemento(formLogin);
});

document.getElementById("btnCadastro").addEventListener('click', (e) =>{
    e.preventDefault();
    let caixa = document.getElementsByClassName('caixa');
    let containerLogin = document.getElementsByClassName('container-login');
    
    containerLogin[0].className += ' mobile'
    caixa[0].className += ' cadastro';
    esconderElemento(formLogin);
    mostrarElemento(formCadastro);
});

document.getElementById('btnLogin').addEventListener('click', (e) => {
    e.preventDefault();
    let caixa = document.getElementsByClassName('caixa');
    let containerLogin = document.getElementsByClassName('container-login');
    
    containerLogin[0].className = 'container-login'
    caixa[0].className = 'caixa';
    esconderElemento(formCadastro);
    mostrarElemento(formLogin);
});
