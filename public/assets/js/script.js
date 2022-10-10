function splitScroll(){
    // creer un controleur & dire que le controleur de console est egal au nouveau controlleur de points magique de defilement
    // = creer quelques chose aui s'appelle des scenes differentres, faire defiler et animer
    const controller = new ScrollMagic.Controller();

    new ScrollMagic.Scene({
        // definir certaines propriétés
        // combien de temps notre scroll va durer
        duration: '200%',
        // definir un element declencheur avec le point d'accord
        triggerElement: '.about-accueil',
        // crochet de declenchement
        triggerHook: 0
    })

        .setPin('.about-accueil')
        // ajouter au controleur puis enrengistrer
        .addTo(controller);
}

splitScroll();

// on defini les variables body et button
// grace à leurs classes selectionnées
const body = document.querySelector(".nav");
const button = document.querySelector(".nuit");
// si dans le localstorage : nuit = true alors on active le mode nuit
if (localStorage.getItem('nuit') === 'true') {
    body.classList.add('nuit')
}
// fonction ou on ecoute si le click du bouton se produit
button.addEventListener('click', function (){

    // si, le body contient deja la classe nuit c'est que c'est deja activé
    if(body.classList.contains("nuit")){
// on active le mode nuit, l'info est dans le localstorage
        body.classList.remove("nuit");
        localStorage.removeItem('nuit');
    } else {
        // sinon, on ajoute le mode nuit
        body.classList.add("nuit");
        localStorage.setItem('nuit', 'true');
    }
});
