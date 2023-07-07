document.addEventListener('DOMContentLoaded', function() {


    eventListeners();

    darkMode();
});

function darkMode (){

    const prefiereDarkmode = window.matchMedia('(prefers-color-scheme; dark)');

    if (prefiereDarkmode.matches) {
        document.body.classList.add('dark-mode');

    } else {
        document.body.classList.remove('dark-mode');

    }
    prefiereDarkmode.addEventListener('change', function(){
        if (prefiereDarkmode.matches) {
            document.body.classList.add('dark-mode');
    
        } else {
            document.body.classList.remove('dark-mode');
    
        }
    });
    

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click',function(){
        document.body.classList.toggle('dark-mode');
    } );
};

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
};

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
}
// PARA HACER EL CODIGO PAS CORTO SE PUEDE PONER navegacion.classList.toggle('mostrar');.
// HACE LO MISMO QUE EL IF. 