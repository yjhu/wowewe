!(function () {
    'use strict';
    
    var slider;
    var isScrolling;
    var pageX;
    var pageY;
    var deltaX;
    var deltaY;
    var origX;
    var origY;
    
    var getSlider = function (target) {
        var i;
        var sliders = document.querySelectorAll('.woso-slide');

        for (; target && target !== document; target = target.parentNode) {
            for (i = sliders.length; i--;) {
                if (sliders[i] === target) {
                    return target;
                }
            }
        }
    };
    
    var onTouchStart = function (e) {
        slider = getSlider(e.target);
        
        if (!slider)
            return;
        
        isScrolling = undefined;
        origX = e.touches[0].pageX;
        origY = e.touches[0].pageY;
        pageX = e.touches[0].pageX;
        pageY = e.touches[0].pageY;
        deltaX = 0;
        deltaY = 0;
    };
    
    var onTouchMove = function (e) {
        if (e.touches.length > 1 || !slider)
            return;
        
        deltaX = e.touches[0].pageX - pageX;
        deltaY = e.touches[0].pageY - pageY;
        pageX  = e.touches[0].pageX;
        pageY  = e.touches[0].pageY;
        
        if (typeof isScrolling === 'undefined') {
            isScrolling = Math.abs(deltaY) > Math.abs(deltaX);
        }
        
        if (isScrolling)
            return;
        
        e.preventDefault();
    };
    
    var onTouchEnd = function (e) {
        if (!slider || isScrolling) {
            return;
        }
        
//        if (Math.abs(e.touches[0].pageX - origX) < 5)
//            return;
        
        alert(e);
        
        e = new CustomEvent('woso-slide');

        slider.parentNode.dispatchEvent(e);
    };
    
    window.addEventListener('touchstart', onTouchStart);
    window.addEventListener('touchmove', onTouchMove);
    window.addEventListener('touchend', onTouchEnd);
}());


