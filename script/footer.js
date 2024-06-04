function adjustFooterPosition() {
    var body = document.body;
    var html = document.documentElement;

    var windowHeight = window.innerHeight;
    var bodyHeight = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);

    var footer = document.getElementById('footer');
    
    if (bodyHeight <= windowHeight) {
        footer.style.position = 'fixed';
        footer.style.left = '0';
        footer.style.bottom = '8px';
        footer.style.width = '100%';
    } else {
        footer.style.position = 'static';
    }
}

// On appelle la fonction lors du chargement de la page et lors du redimensionnement de la fenêtre
window.onload = adjustFooterPosition;
window.onresize = adjustFooterPosition;