function closepromo() {
 var promo = document.getElementById("promo");
 //promo.remove();
 var promobox = document.getElementById("promobox");
 promo.classList.add("promo-out");
promobox.classList.add("promo-box-out");
    setTimeout(function() {
        promo.remove();
    }, 1000)
}