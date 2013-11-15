$(function(){$('#util-international').toggle(function(){$("#util-regions").remove().prependTo("#placeholder-regions").slideToggle('swing');$("#expandSign").html('[&minus;]');},function(){$("#util-regions").slideToggle('swing');$("#expandSign").html('[+]');});});function jsOpacity(o,i){o.style.opacity=i;o.style.MozOpacity=i;o.style.KhtmlOpacity=i;o.style.filter="alpha(opacity="+(i*100)+");";}
function gID(i){g=document.getElementById(i);return g;}
function fetch_unix_timestamp(){return parseInt(new Date().getTime().toString().substring(0,10))}
function testForObject(Id,Tag){var o=document.getElementById(Id);if(o){if(Tag){if(o.tagName.toLowerCase()==Tag.toLowerCase()){return o;}}
else{return o;}}
return null;}
function disableUI(){if(!testForObject('overlay')){var bgdiv=document.createElement('div');bgdiv.style.height=document.documentElement.scrollHeight+'px';bgdiv.style.width='100%';bgdiv.style.opacity=0;bgdiv.style.filter='alpha(opacity=45)';bgdiv.style.background='white';bgdiv.style.position='absolute';bgdiv.style.top='0px';bgdiv.style.left='0px';bgdiv.style.zIndex=100;bgdiv.id='overlay';document.body.appendChild(bgdiv);}
$("#overlay").fadeTo(50,0.45,function(){gID('overlay').style.display='block';});}
function enableUI(){$("#overlay").fadeTo(50,0,function(){gID('overlay').style.display='none';});}
function centreObject(o){d=gID(o);var t=(document.body.clientHeight-parseInt(d.style.height))/2;var l=(document.body.clientWidth-parseInt(d.style.width))/2;d.style.left=(l+document.body.scrollLeft)+'px';d.style.top=(300)+'px';}
$(function(){$(".cbClass").tipTip({defaultPosition:"bottom",delay:0});});