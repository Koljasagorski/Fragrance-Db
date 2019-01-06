$(function() {
$("a").tipsy({gravity: $.fn.tipsy.autoNS, fade: true});
$("title").tipsy({gravity: $.fn.tipsy.autoNS, fade: true});
$("img").tipsy({gravity: $.fn.tipsy.autoNS, fade: true});
$("i").tipsy({gravity: $.fn.tipsy.autoNS, fade: true});
$("span").tipsy({gravity: $.fn.tipsy.autoNS, fade: true});
$("div").tipsy({gravity: $.fn.tipsy.autoNS, fade: true});
});

var tooltips = document.querySelectorAll('.ttbt');

window.onmousemove = function (e) {
    var x = (e.clientX + 20) + 'px',
        y = (e.clientY + 20) + 'px';
    for (var i = 0; i < tooltips.length; i++) {
        tooltips[i].style.top = y;
        tooltips[i].style.left = x;
    }
};