function splitScroll(){
    // creer un controleur & dire que le controleur de console est egal au nouveau controlleur de points magique de defilement
    // = creer quelque chose qui s'appelle des scenes differentes, faire defiler et animer
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
        // ajouter des indicateurs qui nous sont visuel puis le brancher a ce controlleur
        //.addIndicators()
        // ajouter au controleur puis enrengistrer
        .addTo(controller);
}

splitScroll();


