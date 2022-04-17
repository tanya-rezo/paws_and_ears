import $ from "jquery";
import popper from "popper.js";
import bootstrap from "bootstrap";
import slick from "slick-carousel";


$(function () {
    var mainContainer = $(".main-container");
    var menuContainer = $(".menu-container");
    var hamburger = $("button.hamburger");

    hamburger.on("click", function () {
        if (mainContainer.is(":visible")) {
            mainContainer.hide();
            menuContainer.show();

            hamburger.addClass("is-active");
        } else {
            menuContainer.hide();
            mainContainer.show();

            hamburger.removeClass("is-active");
        }
    });

    $('.carousel-container').slick({
        slidesToShow: 2,
        slidesToScroll: 2,
        dots: true,
        arrows: false,
    });
});
