function postAjax(url,params){
    var returns;
    $.ajax({
        url: url,
        type: "POST",
        async: false, // ture: 비동기, false: 동기
        data: params,
        dataType: "json",
        success: function(data){
            returns = data;
        }
    });
    return returns;
}
function getAjax(url,params){
    var returns;
    $.ajax({
        url: url,
        type: "POST",
        async: false, // ture: 비동기, false: 동기
        data: params,
        dataType: "json",
        success: function(data){
            returns = data;
        }
    });
    return returns;
}


function testpostAjax(url,params){
	var returns;
	$.ajax({
		url: url,
		type: "POST",
		async: false, // ture: 비동기, false: 동기
		data: params,
		dataType: "html",
		success: function(data){
			returns = data;
		}
	});
	return returns;
}
function testgetAjax(url,params){
	var returns;
	$.ajax({
		url: url,
		type: "GET",
		async: false, // ture: 비동기, false: 동기
		data: params,
		dataType: "html",
		success: function(data){
			returns = data;
		}
	});
	return returns;
}


function Login(){
	var rtn=postAjax("/members/login",$("#loginForm").serializeArray());
	if(rtn.code=='0000'){
		window.location.href='/admin/';
	}else{
		alert(rtn.msg);
	}

}
function Logout(){
	var rtn=getAjax('/members/logout',[]);
	if(rtn.code=='0000'){
		window.location.href='/admin/login';
	}
}