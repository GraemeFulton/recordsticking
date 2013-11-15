


function ajaxUpdateDesignElement(obj,strElement,strE,strV)
{
	// Check box to check if one is passed
	if(obj)
	 {	  strValue = obj.checked; 	 }	
	 else { strValue = ""; strElement = "" }
	 if(strV)		// Quick patch to make it work with none-checkboxes..
	 {	  strValue = strV;
	 	  strElement = strE; }
	 
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
      alert("Unfortunately your browser does not support AJAX.\nTherefore, auto-price updating will not work.");
      return false;
      }
    }
  }
  xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
      var xmlDoc=xmlHttp.responseXML.documentElement;

       // Price updating elements...
       for (i=1;i<=9;i++)
		{
		 strOrderElem = "Order" + i;
		 strOrderElemb = "Order" + i + "b";
		 			
		 strOrderElemValue  = xmlDoc.getElementsByTagName(strOrderElem)[0].childNodes[0].nodeValue;
		 strOrderElemValueb = xmlDoc.getElementsByTagName(strOrderElemb)[0].childNodes[0].nodeValue;
		 
		 
		 // Show hide divs
		 if (strOrderElemValueb == "0.00")
			{		 
				strOrderElemValue = " "; 
				strOrderElemValueb = " "; 
			    document.getElementById(strOrderElem).style.display = "none";
			    document.getElementById(strOrderElemb).style.display = "none";
			 }
			 else
			 {
			 	document.getElementById(strOrderElem).style.display = "block";
			    document.getElementById(strOrderElemb).style.display = "block";
			 }
				
		 document.getElementById(strOrderElem).innerHTML = strOrderElemValue;
		 document.getElementById(strOrderElemb).innerHTML = strOrderElemValueb;
		}


       
      }
    }
  //var url="mod_session.php"
  /*url=url%2b_9ec8.html?e="+strElement;
  url=url%2b_%26v%3d_%2bstrValue%3b.html  
  url=url%2b_%26sid%3d_%2bMath.html
  xmlHttp.open("GET",url,true);
  xmlHttp.send(null);*/
  }

