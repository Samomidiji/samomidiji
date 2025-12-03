"use strict";
let greenshiftmegamenus = document.querySelectorAll('.wp-block-navigation-item.is-style-gs-megamenufull');

function GSMegaMenuSetTop(obj) {
    let objsize = obj.getBoundingClientRect();
    let topamount = objsize.y + objsize.height - 0.1;
    let menu = obj.querySelector('.wp-block-navigation__submenu-container');
    menu.style.top = topamount + 'px';
}

const BSMegaMenuInit = () => {
    for (let i = 0; i < greenshiftmegamenus.length; i++) {
        let obj = greenshiftmegamenus[i];
        GSMegaMenuSetTop(obj);
    }
}

for (let i = 0; i < greenshiftmegamenus.length; i++) {
    let obj = greenshiftmegamenus[i];
    obj.addEventListener('mouseenter', function () {
        GSMegaMenuSetTop(obj);
    });
}


BSMegaMenuInit();
window.addEventListener("resize", BSMegaMenuInit);