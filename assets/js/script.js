function getXMLHTTPRequest() {
	var req = false;
	try {
		/* for Firefox */
		req = new XMLHttpRequest();
	} catch (err) {
		try {
			/* for some versions of IE */
			req = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (err) {
			try {
				/* for some other versions of IE */
				req = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (err) {
				req = false;
			}
		}
	}
	return req;
}

function getKotkab() {
	var xmlhttp = getXMLHTTPRequest();
	//get input value
	var id = encodeURI(document.getElementById('provinsi').value);
	//set url and inner
	var inner = "kotkab";
	var url = "assets/processKotkab.php";
	var params = "id=" + id;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML = '';
			document.getElementById('kecamatan').innerHTML = '<option selected value="0">Pilih kecamatan</option> <option value="0">pilih dahulu kecamatan</option>';
			document.getElementById('desa').innerHTML = '<option selected value="0">Pilih desa</option> <option value="0">pilih dahulu desa</option>';
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(params);
}

function getKecamatan() {
	var xmlhttp = getXMLHTTPRequest();
	//get input value
	var id = encodeURI(document.getElementById('kotkab').value);
	//set url and inner
	var inner = "kecamatan";
	var url = "assets/processKecamatan.php";
	var params = "id=" + id;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML = '';
			document.getElementById('desa').innerHTML = '<option selected value="0">Pilih desa</option> <option value="0">pilih dahulu desa</option>';
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(params);
}

function getDesa() {
	var xmlhttp = getXMLHTTPRequest();
	//get input value
	var id = encodeURI(document.getElementById('kecamatan').value);
	//set url and inner
	var inner = "desa";
	var url = "assets/processDesa.php";
	var params = "id=" + id;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(params);
}
