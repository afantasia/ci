<?
if(is_array($vars)){
	foreach($vars as $k=>$v){
		${$k}=$v;
	}
}
?>
<!-- jQuery -->
<script src="/resource/admin/vendors/jquery/dist/jquery.min.js"></script>

<script>
	function submitRegist(){
		var url=$("#targeturl").val();
		var params=$("#registform").serializeArray();
		var method=$("#method").val();

		if(method=='post'){
			ret=testpostAjax(url,params);
		}else if(method=='get'){
			ret=testgetAjax(url,params);
		}
		$("#resultContent").html( ret );

	}
	function getform(){
		var idx=$("#apilist").val();
		if(idx){
			window.location.href='/api/form/'+idx;
		}else{
			alert('수정할 api를 선택해주세요');
		}
	}
	function regform(){
		window.location.href='/api/form';
	}
</script>
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3><?=$pageTitle?></h3>
		</div>
	</div>
	<div class="row">

		<div class="clearfix"></div>

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>폼선택하기<small>알아서 선택해주세요</small></h2>
					<ul class="nav navbar-right panel_toolbox">

						<li class="dropdown" style="visibility: hidden">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						</li>
						<li style="visibility: hidden"><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
						<li>
							<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<select id="apilist">
						<option value="">API를 선택해주세요</option>
						<?foreach ($data as $k =>$v){?>
							<option value="<?=$v['idx']?>" paramlist='<?=$v['params']?>' urls="<?=$v['url']?>" methods="<?=$v['method']?>"><?=$v['name']?></option>
						<?}?>
					</select>
					<div>
						호출URL
						<input type="text" id="targeturl" required="required" class="form-control col-md-5 col-xs-12" value="" readonly>
					</div>
					<div>
						method타입
						<input type="text" id="method" required="required" class="form-control col-md-5 col-xs-12" value="" readonly>
					</div>
					<form action="javascript:submitRegist();" id="registform" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post" enctype="multipart/form-data" accept-charset="utf-8" >

					</form>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-2 col-sm-1 col-xs-1 col-md-offset-1">
							<button type="button" onclick="submitRegist()" class="btn btn-info btn-sm">SUBMIT</button>
							&nbsp;<button type="button" onclick="getform()" class="btn btn-success btn-sm">수정</button>
							&nbsp;<button type="button" onclick="regform()" class="btn btn-danger btn-sm">등록</button>

						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>결과페이지</h2>
					<ul class="nav navbar-right panel_toolbox">

						<li class="dropdown" style="visibility: hidden">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						</li>
						<li style="visibility: hidden"><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
						<li>
							<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div id='resultContent' style="border: 1px solid #c8c8c8;padding: 10px;border-radius: 10px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$("#apilist").on("change",function(){
		$("#registform").empty();
		var html='';
		$("#targeturl").val('');
		$("#method").val('');
		if($(this).find('option:selected').attr('paramlist')){
			var obj=$.parseJSON($(this).find('option:selected').attr('paramlist'));
			var url=$(this).find('option:selected').attr('urls');
			var method=$(this).find('option:selected').attr('methods');
			$("#targeturl").val(url);
			$("#method").val(method);
			for( var i in obj){
				html+='<div>';
				html+=obj[i]['title']+'[변수명 : '+obj[i]['valName']+' ]';
				html+='<input type="'+obj[i]['itype']+'" name="'+obj[i]['valName']+'" required="required" class="form-control col-md-5 col-xs-12" value="">';
				html+='</div>';
			}
			$("#registform").append(html);
		}
	});
	$(document).ready(function(){
		$("#registform").empty();
		var html='';
		$("#targeturl").val('');
		$("#method").val('');
		if($(this).find('option:selected').attr('paramlist')){
			var obj=$.parseJSON($(this).find('option:selected').attr('paramlist'));
			var url=$(this).find('option:selected').attr('urls');
			var method=$(this).find('option:selected').attr('methods');
			$("#targeturl").val(url);
			$("#method").val(method);
			for( var i in obj){
				html+='<div>';
				html+=obj[i]['title']+'[변수명 : '+obj[i]['valName']+' ]';
				html+='<input type="text" name="'+obj[i]['valName']+'" required="required" class="form-control col-md-5 col-xs-12" value="">';
				html+='</div>';
			}
			$("#registform").append(html);
		}


		$("#dmyfrm input[type='button']").on('click' , function(){
			alert('');
			$.ajax({
				type: "POST",
				url: "/file/upload",
				async: false,
				mimeType: "multipart/form-data",
				dataType:JSON,
				data:$("#dmyfrm").serializeArray(),
				success: function(response){
					console.log(response);
				},
				error: function(response){
				}
			});
		});

	});

</script>