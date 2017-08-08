<?php
/*
 * 뷰 페이지입니다
 * */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .bluetop {
            border-collapse: collapse;
            border-top: 3px solid #168;width:100%;
        }
        .bluetop th {
            color: #168;
            background: #f0f6f9;
        }
        .bluetop th, .bluetop td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .bluetop th:first-child, .bluetop td:first-child {
            border-left: 0;
        }
        .bluetop th:last-child, .bluetop td:last-child {
            border-right: 0;
        }
    </style>
</head>
<body>
<div id="container">
    <h1>
        테이블 <?=$return['basic']->TABLE_NAME?>
        <?=anchor('/demo/tablelist', '뒤로가기', 'title="뒤로가기"');?>
    </h1>
    <table class="bluetop">
        <colgroup>
            <col width="15%" />
            <col width="15%" />
            <col width="70%" />
        </colgroup>
        <thead>
        <tr>
            <th>컬럼명</th>
            <th>컬럼타입</th>
            <th>주석</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($return['infos'] as $data):?>
            <tr>
                <td><?=$data->COLUMN_NAME?></td>
                <td><?=$data->COLUMN_TYPE?></td>
                <td><?=$data->COLUMN_COMMENT?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

</body>
</html>