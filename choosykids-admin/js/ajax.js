// JavaScript Document
var xmlHttp; 
var is_ie = (navigator.userAgent.indexOf('MSIE') >= 0) ? 1 : 0; 
var is_ie5 = (navigator.appVersion.indexOf("MSIE 5.5")!=-1) ? 1 : 0; 
var is_opera = ((navigator.userAgent.indexOf("Opera 6")!=-1)||(navigator.userAgent.indexOf("Opera/6")!=-1)) ? 1 : 0; 
var is_netscape = (navigator.userAgent.indexOf('Netscape') >= 0) ? 1 : 0; 

function funCategory(valu,name,filename){
	var url= filename+"manage.php?p="+name+"&CategoryID="+valu;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}
function funGetSubCat(CategoryId){
	
	var requestURL ='manage.php?p=subcat&CategoryId='+CategoryId; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}


function setLogOut(LoginID){
	if(LoginID!='' || LoginID!=0){
		var requestURL ='manage.php?p=loggingout&RegID='+LoginID; 
		var url = requestURL;
		xmlHttp = GetXmlHttpObject(stateChangeHandler);
		xmlHttp_Get(xmlHttp, url);
	}
}
function stateChangeHandler() 
{ 	

	if (xmlHttp.readyState == 3)
	{ 
		//document.getElementById('availability').innerHTML = "<font color=\"#FF0000\">checking...</font>";	
	} 
	
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 'complete')
	{ 
		var str = xmlHttp.responseText;	
		var myArr = str.split("^_^");
		showavailability(str);		
	} 
} 

function xmlHttp_Get(xmlhttp, url) 
{ 

	xmlhttp.open('GET', url, true); 
	xmlhttp.send(null); 
}

function GetXmlHttpObject(handler) 
{
//	document.getElementById('title'+0).focus();

	var objXmlHttp = null;    //Holds the local xmlHTTP object instance 
	if (is_ie)
	{ 
		var strObjName = (is_ie5) ? 'Microsoft.XMLHTTP' : 'Msxml2.XMLHTTP'; 
		try
		{ 
			
			objXmlHttp = new ActiveXObject(strObjName); objXmlHttp.onreadystatechange = handler; 		} 
		catch(e)
		{
			
			alert('IE detected, but object could not be created. Verify that active scripting and activeX controls are enabled');  
			return; 
		} 
	} 
	else if (is_opera)
	{ 

		alert('Opera detected. The page may not behave as expected.');
		return; 
	} //Opera has some issues with xmlHttp object functionality 
	else
	{
		
		objXmlHttp = new XMLHttpRequest();
		objXmlHttp.onload = handler; objXmlHttp.onerror = handler; 
	} 
	return objXmlHttp; 
} 
function LTrim(str)
{
	 for (var i=0; ((str.charAt(i)<=" ")&&(str.charAt(i)!="")); i++);
	 return str.substring(i,str.length);
}
function addslashes(str) {
str=str.replace(/\\/g,'\\\\');
str=str.replace(/\'/g,'\\\'');
str=str.replace(/\"/g,'\\"');
str=str.replace(/\0/g,'\\0');
return str;
}
function stripslashes(str) {
str=str.replace(/\\'/g,'\'');
str=str.replace(/\\"/g,'"');
str=str.replace(/\\0/g,'\0');
str=str.replace(/\\\\/g,'\\');
return str;
}
function showavailability(str)
{
	var temp=LTrim(str);
	var myArr = temp.split("^_^");
	switch(myArr[0]){
		case 'subcat':
			document.getElementById('SubCat').innerHTML = myArr[1];
			break;
			
			case 'subcat1':
			document.getElementById('Spansubcat').innerHTML = myArr[1];
			break;
		default:
			break;
	}
}