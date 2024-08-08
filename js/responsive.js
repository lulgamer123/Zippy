
function navResponsive(){
    const logo = document.getElementById('logo');
    const header = document.getElementById('header');
    const ul = document.getElementById('ul');
    const nav = document.getElementById('nav');

   
    if(ul.className == ''){
        ul.className += 'responsive'
        nav.style.display = "block";
        logo.className += ' responsive';
        header.className += 'responsive';
    }else{
        ul.className = ''
        nav.style.display = "none";
        logo.className = 'logo';
        header.className = '';
    }

}

