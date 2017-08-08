<?
if(is_array($vars)){
	foreach($vars as $k=>$v){
		${$k}=$v;
	}
}
?>
<div class="">
	<div class="row">
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>회원정보</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li style="visibility: hidden"><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
						<li style="visibility: hidden">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						</li>
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<!--<p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p>-->
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action">
							<thead>
							<tr class="headings">
								<th>
									<input type="checkbox" id="check-all" class="flat">
								</th>
								<th class="column-title">아이디 </th>
								<th class="column-title">분류 </th>
								<th class="column-title">이름 </th>
								<th class="column-title">이메일주소 </th>
								<th class="column-title">전화번호 </th>
								<th class="column-title">상태 </th>
								<th class="column-title">가입날짜 </th>
								<th class="column-title no-link last"><span class="nobr">관리</span>
								</th>
								<th class="bulk-actions" colspan="8">
									<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
								</th>
							</tr>
							</thead>
							<tbody>
							<?if($datas_count > 0){?>
								<? foreach ( $datas as $dt ):?>
									<tr>
										<td class="a-center ">
											<input type="checkbox" class="flat" name="table_records">
										</td>
										<!--a-right a-right  last -->
										<td class=" "><?=$dt['email']?></td>
										<td class=" "><?=$dt['email']?></td>
										<td class=" "><?=$dt['email']?></td>
										<td class=" "><?=$dt['email']?> <i class="success fa fa-long-arrow-up"></i></td>
										<td class=" "><?=$dt['email']?></td>
										<td class=" "><?=$dt['email']?></td>
										<td class=" "><?=$dt['regdate']?> </td>
										<td class=" "><a href="/admin/member/form/<?=$dt['idx']?>">상세보기</a>
										</td>
									</tr>
								<?endforeach; ?>
							<?}else{?>
								<tr>
									<td colspan="9">내역이 없습니다.</td>
								</tr>
							<?}?>

							</tbody>
							<tfoot>
								<tr>
									<td colspan="9" align="center">
										<?=$paging?>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>