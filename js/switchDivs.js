document.getElementById('compradoresBtn').addEventListener('click', function (e) {
    e.preventDefault();
    var compradoresContainers = document.getElementById('compradores');
    var viajantesContainers = document.getElementById('viajantes');

    viajantesContainers.style.display = 'none';
    compradoresContainers.style.display = 'grid'
});

document.getElementById('viajantesBtn').addEventListener('click', function (e) {
    e.preventDefault();
    var compradoresContainers = document.getElementById('compradores');
    var viajantesContainers = document.getElementById('viajantes');
    
    compradoresContainers.style.display = 'none';
    viajantesContainers.style.display = 'grid';

        
});


