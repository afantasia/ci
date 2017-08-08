<?
if(is_array($vars)){
	foreach($vars as $k=>$v){
		${$k}=$v;
	}
}
?>
<!-- jQuery -->
<script src="/resource/admin/vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function (e) {
		$('#upload').on('click', function () {
			var file_data = $('#file').prop('files')[0];
			var form_data = new FormData();
			form_data.append('file', file_data);
			$.ajax({
				url: '/file/upload', // point to server-side controller method
				dataType: 'text', // what to expect back from the server
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#msg').html(response); // display success response from the server
				},
				error: function (response) {
					$('#msg').html(response); // display error response from the server
				}
			});
		});
	});
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
					<p id="msg"></p>
					<input type="file" id="file" name="file" />
					<button id="upload">Upload</button>
				</div>
			</div>
		</div>
	</div>
</div>
