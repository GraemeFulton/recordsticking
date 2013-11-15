function ajaxUpdateInfoBox(strT,strST)
{

var xmlHttp;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Unfortunately your browser does not support AJAX.\nTherefore, auto-info box updating will not work.");
      return false;
      }
    }
  }
  xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
      var xmlDoc=xmlHttp.responseXML.documentElement;

       // Info box updating elements...
   			
		 strTitle  = xmlDoc.getElementsByTagName('Title')[0].childNodes[0].nodeValue;
		 strImageURL = xmlDoc.getElementsByTagName('ImageURL')[0].childNodes[0].nodeValue;
		 strDescription = xmlDoc.getElementsByTagName('Description')[0].childNodes[0].nodeValue;
		 
		 document.getElementById('infoboxtitle').innerHTML = strTitle;
		 document.getElementById('infoboximg').src = strImageURL+"#";
		 document.getElementById('infoboxdesc').innerHTML = strDescription;
	       
      }
    }
  var url="shirtdescriptionxml.php"
  url=url+"?t="+strT;
  url=url+"&st="+strST;  
  url=url+"&sid="+Math.random();
  xmlHttp.open("GET",url,true);
  xmlHttp.send(null);

  }
