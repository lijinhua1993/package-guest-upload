<?php

return [

    // 域名
    'host'       => env('GUEST_UPLOAD_HOST', ''),

    // 资源访问地址前缀 必须以`/`开头
    'url_prefix' => env('GUEST_UPLOAD_URL_PREFIX', '/storage'),

    // 路由(必须以`/`开头)
    'route'      => [
        'upload-image' => '/api/upload/image', // 上传图片
    ],

];