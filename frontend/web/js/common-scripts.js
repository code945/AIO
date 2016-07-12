var Script = function () {


//    tool tips

    $('.tooltips').tooltip();

//    popovers

    $('.popovers').popover();

//    bxslider

    $('.bxslider').show();
    $('.bxslider').bxSlider({
        minSlides: 4,
        maxSlides: 4,
        slideWidth: 276,
        slideMargin: 20
    });
}();


$(function () {
    $.scrollUp({
        animation: 'fade',
        activeOverlay: '#00FFFF',
        activeOverlay: false,
        scrollImg: {
            active: true,
            type: 'background',
            src: '/img/top.png'
        }
    });
});