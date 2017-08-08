<?
$menuArr=[
	['name'=>'홈으로','class'=>'fa-home','link'=>'/admin/'],
	[
		'name'=>'회원관리',
		'class'=>'fa-users',
		'childlinks'=>[
			['name'=>'공생회원','link'=>'/admin/member/lists/user'],
			['name'=>'관리인','link'=>'/admin/member/lists/admin'],
			['name'=>'소유자','link'=>'/admin/member/lists/owner'],
			['name'=>'임차인','link'=>'/admin/member/lists/lessee'],
		]
	],
	[
		'name'=>'건물관리',
		'class'=>'fa-building',
		'childlinks'=>[
			['name'=>'건물관리','link'=>'/admin/building/buildinglists'],
			['name'=>'차량관리','link'=>'/admin/building/carlists'],
			['name'=>'관리단집회관리','link'=>'/admin/building'],
			['name'=>'건물공지사항','link'=>'/admin/building'],
			['name'=>'민원신고','link'=>'/admin/building'],
		]
	],
	[
		'name'=>'관리비 항목관리',
		'class'=>'fa-print',
		'childlinks'=>[
			[
				'name'=>'카테고리관리','link'=>'/admin/costcontrol',
				'childlinks'=>[
					['name'=>'대분류 관리','link'=>'/admin/costcontrol'],
					['name'=>'소분류 관리','link'=>'/admin/costcontrol'],
				],
			
			],
			['name'=>'건물별 항목 관리','link'=>'/admin/costcontrol'],
		]
	],
	[
		'name'=>'관리비관리',
		'class'=>'fa-credit-card',
		'childlinks'=>[
			['name'=>'관리비 등록관리','link'=>'/admin/cost'],
			['name'=>'관리비 수납관리','link'=>'/admin/cost'],
			['name'=>'연체료관리','link'=>'/admin/cost'],
		]
	],
	[
		'name'=>'수납관리',
		'class'=>'fa-krw',
		'childlinks'=>[
			['name'=>'통장관리','link'=>'/admin/storage'],
			['name'=>'수납관리','link'=>'/admin/storage'],
		]
	],
	[
		'name'=>'생활정보마켓',
		'class'=>'fa-newspaper-o',
		'childlinks'=>[
			['name'=>'업체등록','link'=>'/admin/livinginfo'],
			['name'=>'업체관리','link'=>'/admin/livinginfo'],

		]
	],
	[
		'name'=>'관리규약마켓',
		'class'=>'fa-folder-open',
		'childlinks'=>[
			['name'=>'관리규약등록','link'=>'/admin/protocol'],
			['name'=>'관리규약관리','link'=>'/admin/protocol'],
		]
	],

	[
		'name'=>'고객센터',
		'class'=>'fa-phone',
		'childlinks'=>[
			['name'=>'공지사항','link'=>'/admin/servicecenter'],
			[
				'name'=>'1:1문의','link'=>'/admin/servicecenter',
				'childlinks'=>[
					['name'=>'스마트 위탁관리','link'=>'/admin/servicecenter'],
					['name'=>'앱운영자 문의','link'=>'/admin/servicecenter'],
				],
			],
			['name'=>'FAQ','link'=>'/admin/faq'],
		]
	],

]
?>
<div class="left_col scroll-view">
	<div class="navbar nav_title" style="border: 0;">
		<a href="/admin" class="site_title"><i class="fa fa-circle"></i> <span>관리자 시스템</span></a>
	</div>
	<div class="clearfix"></div>
	<!-- menu profile quick info -->
	<div class="profile clearfix">
		<div class="profile_pic">
			<img src="/images/img.jpg" alt="..." class="img-circle profile_img">
		</div>
		<div class="profile_info">
			<span>어서오세요,</span>
			<h2>이름</h2>
		</div>
	</div>
	<!-- /menu profile quick info -->
	<br />

	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		<div class="menu_section">
			<h3>주메뉴</h3>
			<ul class="nav side-menu">

				<?foreach ($menuArr as $k=>$item){?>
					<?if(isset($item['link'])){?>
						<li>
							<a href="<?=$item['link']?>">
								<i class="fa <?=$item['class']?>"></i>

								<?=$item['name']?>
							</a>
							<span class="fa "></span>
						</li>
					<?}else{?>
						<li>
							<a>
								<i class="fa <?=$item['class']?>"></i>
								<?=$item['name']?>
								<span class="fa fa-chevron-down"></span>
							</a>
							<ul class="nav child_menu">
								<?foreach ($item['childlinks'] as $k2=>$child){?>
									<?if(isset($child['childlinks'])){?>
										<li>
											<a><?=$child['name']?><span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu">
												<?foreach($child['childlinks'] as $k3=>$grandChild){?>
													<li><a href="<?=$grandChild['link']?>"><?=$grandChild['name']?></a></li>
												<?}?>

											</ul>
										</li>
									<?}else{?>
									<li><a href="<?=$child['link']?>"><?=$child['name']?></a></li>
									<?}?>
								<?}?>
							</ul>
						</li>
					<?}?>
				<?}?>

			</ul>
		</div>
	</div>
	<!-- /sidebar menu -->
</div>