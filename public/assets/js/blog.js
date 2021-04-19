/*-----------------------------------------------------------
* Template Name    : RectCV - Personal Bootstrap 4 HTML Template
* Author           : Narek Sukiasyan
* Version          : 1.0.0
* Created          : April 2020
* File Description : Custom functions file for blog page
*--
*/

"use strict";

//Scroll Bar Width Check Function

function getScrollBarWidth() {
    var inner = document.createElement('p');
    inner.style.width = "100%";
    inner.style.height = "200px";
  
    var outer = document.createElement('div');
    outer.style.position = "absolute";
    outer.style.top = "0px";
    outer.style.left = "0px";
    outer.style.visibility = "hidden";
    outer.style.width = "200px";
    outer.style.height = "150px";
    outer.style.overflow = "hidden";
    outer.appendChild(inner);
  
    document.body.appendChild(outer);
    var w1 = inner.offsetWidth;
    outer.style.overflow = 'scroll';
    var w2 = inner.offsetWidth;
    if (w1 == w2) w2 = outer.clientWidth;
  
    document.body.removeChild(outer);
  
    return (w1 - w2);
};


//Init Template for Prelaoder

$('body').css({'margin-right': getScrollBarWidth() + "px"});
$('body').addClass('overflow-hidden');
$('header.navigation').css({'padding-right': getScrollBarWidth() + "px"});
$('.backgound-section').addClass('preload');


$(window).on("load", function(){
    $("#preloader").fadeOut("slow");

    setTimeout(function(){
        $("body").removeClass('overflow-hidden');
        $("body").removeAttr('style');
        $("header.navigation").removeAttr('style');
        $('.backgound-section').removeClass('preload');
    },400);

    
});