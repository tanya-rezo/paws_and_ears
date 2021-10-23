import $ from "jquery";
import popper from "popper.js";
import bootstrap from "bootstrap";


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

});
