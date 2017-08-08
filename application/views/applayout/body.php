<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="Wv2Ch2yA9tNjL1lsdOnWEh9DhBLuSj0bEMggh9ua">

    <script src="/resource/mobile/js/jquery.1.11.1.min.js"></script>
    <script src="/resource/mobile/js/vue.min.js"></script>
    <script src="/resource/mobile/js/ajax.js"></script>
    <!--원래 밑에가있었는데 혹시나해서 위로 올려둠-->
    <?foreach($ResourceTop as $k =>$r01):?><?=$r01.PHP_EOL?><?endforeach;?>
</head>
<body>
    <?$this->view($head)?>
    <div class="container">
        <div class="page-header" style="margin-top:52px">
            <?$this->view($template_name)?>
        </div>
    </div>
    <?$this->view($foot)?>

<?foreach($ResourceBottom as $k =>$r02):?><?=$r02.PHP_EOL?><?endforeach;?>

</body>
</html>