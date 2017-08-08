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
	function memberRegist(){
		syncJson();
		var url='/api/regist';
		var params=$("#registform").serializeArray();
		ret=postAjax(url,params);
		console.log(ret);
		if(ret.code=='0000'){
			alert(ret.msg);
			location.href='/api/';
		}
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
					<h2>Form Design <small>different form elements</small></h2>
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

					<form action="javascript:memberRegist();" id="registform" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
						<?if(isset($data['idx'])){?>
							<input type="hidden" name="idx" value="<?=$data['idx']?>">
						<?}?>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">API이름 <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="name" required="required" class="form-control col-md-7 col-xs-12" value="">
							</div>
						</div>

						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">method타입 <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="method" required="required" class="form-control col-md-7 col-xs-12" value="">
							</div>
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">API URL <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="url" required="required" class="form-control col-md-7 col-xs-12" value="">
							</div>
						</div>
						<div class="item form-group" :style="display: none;">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">히든 파라미터<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<textarea name="params" id="jsonText" class="form-control col-md-7 col-xs-12"></textarea>
							</div>
						</div>
						<?if(isset($data['params'])){?>
							<?foreach(json_decode($data['params'],1) as $k=>$v){?>
								<div class="item form-group loops">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">파라미터<span class="required">*</span>
									</label>
									<div class="col-md-1 col-sm-12 col-xs-12 form-group">
										항목명<input type="text" name="title" class="form-control" onkeypress="syncJson()" onchange="syncJson()" value="<?=$v['title']?>">
									</div>
									<div class="col-md-2 col-sm-12 col-xs-12 form-group">
										항목변수명<input type="text" name="valName" class="form-control" onkeypress="syncJson()" onchange="syncJson()" value="<?=$v['valName']?>">
									</div>

									<div class="col-md-1 col-sm-12 col-xs-12 form-group">
										인풋타입<input type="text" name="itype" class="form-control" onkeypress="syncJson()" onchange="syncJson()" value="<?=isset($v['itype']) ? $v['itype'] : '';?>">
									</div>
									<div class="col-md-4 col-sm-12 col-xs-12 form-group">
										<span class="glyphicon glyphicon-minus" aria-hidden="true" onclick="delNode($(this))"></span>
										<span class="glyphicon glyphicon-plus" aria-hidden="true" onclick="addNode($(this))"></span>
									</div>
								</div>
							<?}?>
						<?}else{?>
						<div class="item form-group loops">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">파라미터<span class="required">*</span>
							</label>
							<div class="col-md-1 col-sm-12 col-xs-12 form-group">
								항목명<input type="text" name="title" class="form-control" onkeypress="syncJson()" onchange="syncJson()">
							</div>
							<div class="col-md-1 col-sm-12 col-xs-12 form-group">
								항목변수명<input type="text" name="valName" class="form-control" onkeypress="syncJson()" onchange="syncJson()">
							</div>
							<div class="col-md-1 col-sm-12 col-xs-12 form-group">
								인풋타입<input type="text" name="itype" class="form-control" onkeypress="syncJson()" onchange="syncJson()" value="">
							</div>
							<div class="col-md-2 col-sm-12 col-xs-12 form-group">
								<span class="glyphicon glyphicon-minus" aria-hidden="true" onclick="delNode($(this))"></span>
								<span class="glyphicon glyphicon-plus" aria-hidden="true" onclick="addNode($(this))"></span>
							</div>
						</div>
						<?}?>
						<script>
							function syncJson(){
								var objects=[];
								var i=0;
								$(".loops").each(function(){
									objects[i]={
										'title':$(this).find("input[name='title']").val(),
										'valName':$(this).find("input[name='valName']").val(),
										'itype':$(this).find("input[name='itype']").val(),
									};
									console.log($(this).find("input[name='itype']").val());
									i++;
								});
								$("#jsonText").val( JSON.stringify(objects) );
							}
							function addNode(obj){
								var htmls='<div class="item form-group loops">'+
									'<label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">파라미터<span class="required">*</span>'+
									'</label>'+
									'<div class="col-md-1 col-sm-12 col-xs-12 form-group">'+
									'항목명<input type="text" name="title" class="form-control" onkeypress="syncJson()">'+
									'</div>'+
									'<div class="col-md-1 col-sm-12 col-xs-12 form-group">'+
									'항목변수명<input type="text" name="valName" class="form-control"  onkeypress="syncJson()">'+
									'</div>'+
									'<div class="col-md-1 col-sm-12 col-xs-12 form-group">'+
									'항목변수명<input type="text" name="itype" class="form-control"  onkeypress="syncJson()">'+
									'</div>'+
									'<div class="col-md-4 col-sm-12 col-xs-12 form-group">'+
									'<span class="glyphicon glyphicon-minus" aria-hidden="true" onclick="delNode($(this))"></span> '+
									'<span class="glyphicon glyphicon-plus" aria-hidden="true" onclick="addNode($(this))"></span>'+
									'</div>'+
									'</div>';
								obj.parent().parent().after(htmls);
								syncJson();
							}
							function delNode(obj){
								obj.parent().parent().remove();
								syncJson();
							}
						</script>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button class="btn btn-primary" type="button" onclick="window.history.back()">취소</button>
								<button type="submit" class="btn btn-success">수정</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?if(isset($data['idx'])){?>
<script>
	$("#registform input[name='name']").val('<?=$data['name']?>');
	$("#registform input[name='url']").val('<?=$data['url']?>');
	$("#registform input[name='method']").val('<?=$data['method']?>');
	syncJson();
	//$("#registform input[name='']").val();
	//$("#registform input[name='']").val();

</script>
<?}?>
