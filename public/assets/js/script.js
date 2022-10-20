// menu

function openMenu(){
    const navMobile = document.querySelector('.nav-mobile');
    const mobileOverlay = document.querySelector('.mobile-overlay')

    if(navMobile.classList.contains('active')){
        navMobile.classList.remove('active');
        mobileOverlay.classList.remove('active');
    }else{
        navMobile.classList.add('active');
        mobileOverlay.classList.add('active')
    }
}