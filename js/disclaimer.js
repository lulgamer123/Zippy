let  aviso = document.getElementById('aviso');

document.getElementById('caixaOriginal').addEventListener('click', function () {
    
    aviso.style.display = 'block';
})

document.getElementById('caixaAvulsa').addEventListener('click', function(){
    aviso.style.display = 'none';
})