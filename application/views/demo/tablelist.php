<?php
/*
 * 뷰 페이지입니다
 * */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<div id="container">
    <h1>테이블 생성리스트</h1>
    <ul>
        <?php foreach ($datas as $item): ?>
            <li>
                <?=anchor('/demo/tableview/'.$item->Tables_in_dev, $item->Tables_in_dev, 'title="'.$item->Tables_in_dev.'상세보기"');?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>