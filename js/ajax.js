// JavaScript Document
var xmlHttp; 
var is_ie = (navigator.userAgent.indexOf('MSIE') >= 0) ? 1 : 0; 
var is_ie5 = (navigator.appVersion.indexOf("MSIE 5.5")!=-1) ? 1 : 0; 
var is_opera = ((navigator.userAgent.indexOf("Opera 6")!=-1)||(navigator.userAgent.indexOf("Opera/6")!=-1)) ? 1 : 0; 
var is_netscape = (navigator.userAgent.indexOf('Netscape') >= 0) ? 1 : 0; 

function funGetState(CountryId){
	
	var requestURL ='manage.php?p=county&CountryId='+CountryId; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}

function funGetResult(){
	var ser = document.getElementById('ser').value;
	
	var requestURL ='manage.php?p=result&ProductName='+ser; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}
function funGetCity(StateId){
	
	var requestURL ='manage.php?p=city&StateId='+StateId; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}
function funGetBrand(BrandId,SubcategoryId){
	
	var requestURL ='manage.php?p=brand&BrandId='+BrandId+'&SubcategoryId='+SubcategoryId; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}
function funGetColor(ColorId,SubcategoryId){
	
	var requestURL ='manage.php?p=color&ColorId='+ColorId+'&SubcategoryId='+SubcategoryId; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}
function funGetSize(SizeId,SubcategoryId){
	
	var requestURL ='manage.php?p=size&SizeId='+SizeId+'&SubcategoryId='+SubcategoryId; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}
function funGetMaterial(MaterialId,SubcategoryId){
	
	var requestURL ='manage.php?p=material&MaterialId='+MaterialId+'&SubcategoryId='+SubcategoryId; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}

function funGetDesign(DesignId,SubcategoryId){
	
	var requestURL ='manage.php?p=design&DesignId='+DesignId+'&SubcategoryId='+SubcategoryId; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}

function funGetCollar(CollarId,SubcategoryId){
	
	var requestURL ='manage.php?p=collar&CollarId='+CollarId+'&SubcategoryId='+SubcategoryId; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}
function funRemove(cartid,no,totid){
	//alert(ProductId);
	var requestURL ='manage.php?p=remove&a=delete&ProductId='+cartid+'&No='+no+'&totid='+totid; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
	
}
function addtocart(itemttl,id,totalproduct,proid){
	var Qyt = document.getElementById('Qyt'+id).value;
	
	var total = itemttl;
	var ival = document.getElementById('price'+id).value;

	if(Qyt == 0){
		
		document.getElementById('Qyt'+id).value = 1;	
		var ttl = ival * 1;
		document.getElementById('total'+id).innerHTML = ttl;
		document.getElementById('totalamount').innerHTML = ttl;
		document.getElementById('Qyt'+id).focus();
		
	} else if(Qyt > 0) {
		if(Qyt <= total){
			//alert(Qyt);
			document.getElementById('Qyt'+id).value = Qyt;
			var ttl = (ival)*(Qyt);
			document.getElementById('total'+id).innerHTML = ttl;
			document.getElementById('totalamount').innerHTML = ttl;
			document.getElementById('Qyt'+id).focus();
			var requestURL ='manage.php?p=remove&a=update&ProductId='+proid+'&Qyt='+Qyt; 
			var url = requestURL;
			xmlHttp = GetXmlHttpObject(stateChangeHandler);
			xmlHttp_Get(xmlHttp, url);
		} else {
			alert("Out Of Stock");
			document.getElementById('Qyt'+id).value = total;
			var ttl = ival*total;
			document.getElementById('total'+id).innerHTML = ttl;
			document.getElementById('totalamount').innerHTML = ttl;
			document.getElementById('Qyt'+id).focus();
			var requestURL ='manage.php?p=remove&a=update&ProductId='+proid+'&Qyt='+total; 
			var url = requestURL;
			xmlHttp = GetXmlHttpObject(stateChangeHandler);
			xmlHttp_Get(xmlHttp, url);
		}
	} else if(Qyt < 0) {
		document.getElementById('Qyt'+id).value = 1;	
		var ttl = ival * 1;
		document.getElementById('total'+id).innerHTML = ttl;
		document.getElementById('totalamount').innerHTML = ttl;
		document.getElementById('Qyt'+id).focus();
	}
	var totalPrice = 0;
	for(var i=0;i<totalproduct;i++){
		var quantity = document.getElementById('Qyt'+i).value;
		var itemprice = document.getElementById('price'+i).value;
		var totalpricei = quantity*itemprice;
		totalPrice += totalpricei;
	}
	document.getElementById('totalamount').innerHTML = totalPrice;
}
function addcartpro(a,proid){
	var requestURL ='manage.php?p=cart&a='+a+'&ProductId='+proid; 
	var url = requestURL;
	xmlHttp = GetXmlHttpObject(stateChangeHandler);
	xmlHttp_Get(xmlHttp, url);
}
function stateChangeHandler() 
{ 	

	if (xmlHttp.readyState == 3)
	{ 
		document.getElementById('availability').innerHTML = "<font color=\"#FF0000\">checking...</font>";	
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
		case 'STATEID':
			document.getElementById("SpanState").innerHTML=myArr[1];
			return;
			case 'getbrand':
			document.getElementById("brand").innerHTML=myArr[1];
			return;
			case 'getcolor':
			document.getElementById("brand").innerHTML=myArr[1];
			return;
			case 'getsize':
			document.getElementById("brand").innerHTML=myArr[1];
			return;
			case 'getmaterial':
			document.getElementById("brand").innerHTML=myArr[1];
			return;
			case 'getdesign':
			document.getElementById("brand").innerHTML=myArr[1];
			return;
			case 'getcollar':
			document.getElementById("brand").innerHTML=myArr[1];
			return;
			case 'result':
			document.getElementById("result").innerHTML=myArr[1];
			return;
			case 'getaddress':
			document.getElementById("shp").innerHTML=myArr[1];
			return;
			case 'DELETE':
				var amount = $("label#total"+myArr[1]+"").text();
				var totalamount = $("label#totalamount").text();
				var total = totalamount - amount;
				document.getElementById("totalamount").innerHTML=total;
				$('#cart'+myArr[1]+'').remove();
				var totalPrice = 0;
				for(var i=0;i<myArr[2];i++){
					var itemprice = $('#total'+i).text();
					var totalpricei = 1*itemprice;
					totalPrice += totalpricei;
				}
				document.getElementById('totalamount').innerHTML = totalPrice;
				$('#tntpro').html(""+myArr[3]+"");
			return;
		case 'CITYID':
		//alert(myArr[1]);
			document.getElementById("SpanCity").innerHTML=myArr[1];
			return;
				default:
			break;
		}
}
	/*switch(myArr[0]){
		case 'CHK_USER':
			document.getElementById('useravabilities').innerHTML = myArr[1];
			if(myArr[1]=='1'){
				return false;
			} else {
				return true;
			}
			break;
		case 'COMMENT':
			document.getElementById('responce').innerHTML = myArr[1];
			break;
		case 'Rpl_comment':
			id = "rpluser_"+myArr[1];
			document.getElementById(id).innerHTML = myArr[2];
			document.getElementById('RComment_'+id).value = '';
			break;		
		default:
			break;
	}
}*/