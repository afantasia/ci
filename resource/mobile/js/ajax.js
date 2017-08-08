function httpGet(url,params){
    var r = "";
    $.ajax({
        url: url,
        data:params,
        type: "GET",
        dataType:'json',
        async: false,
        success: function(result){
            r=result;
        },
        error:function(request,status,error){
            console.log(request,status,error);
        }
    });
    return r;
}
function httpPost(url,params){
    var r = "";
    $.ajaxSetup({
        headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
        url: url,
        data:params,
        dataType:'json',
        type: "POST",
        async: false,
        success: function(result){
            r=result;
        },error:function(request,status,error){
            console.log("에러났어요 뿌우'ㅅ'",request,status,error);

        }
    });
    return r;
}