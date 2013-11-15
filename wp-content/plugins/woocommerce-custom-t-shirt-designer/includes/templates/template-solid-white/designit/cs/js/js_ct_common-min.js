

$(function(){var a=$("#newnav li");a.each(function(c,b){var e=$(b);var f=e.find("a");var d=$(f).attr("href");d="link_"+d;$(f).bind("click",function(){document.frmDesign.redirect.value=d;jsPreSubmit()});$(f).attr("href","#")})});