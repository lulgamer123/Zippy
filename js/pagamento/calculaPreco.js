function calculaPreco() {
    let precoCombinado = parseFloat(document.getElementById("valorCombinado").textContent);
    let porcentViajanteElemento = document.getElementById("porcentViajante")
    let porcentZippyElemento = document.getElementById("porcentZippy")
    let valorTotalElemento = document.getElementById("valorTotal")

   
    let porcentViajante = precoCombinado * 0.1; // 10%
    let porcentZippy = precoCombinado * 0.05;   // 5%

   
    let valorTotal = precoCombinado + porcentViajante + porcentZippy;
   
   // Atualiza os valores na tela
    porcentViajanteElemento.textContent = porcentViajante.toFixed(2);
    porcentZippyElemento.textContent = porcentZippy.toFixed(2);
    valorTotalElemento.textContent = valorTotal.toFixed(2);
    
}

calculaPreco();