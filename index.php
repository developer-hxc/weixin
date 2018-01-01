<?php
require_once __DIR__.'/vendor/autoload.php';
use WeiXin\Mina;

$config = [
            'js_code' => "071Xkone1Ustrs0y4ype1EkGne1XkonF",
            'appid'   => 'wx0d0d86992206033f',
            'secret'  => '489fa2a9030585653e1bf20acef0729f'
        ];

print_r(Mina::Login($config));