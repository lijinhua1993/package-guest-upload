<?php

return [

    // 域名
    'host'          => env('GUEST_UPLOAD_HOST', ''),

    // 资源访问地址前缀 必须以`/`开头
    'url_prefix'    => env('GUEST_UPLOAD_URL_PREFIX', '/storage'),

    // 接口鉴权
    'client_id'     => env('GUEST_UPLOAD_CLIENT_ID', ''),
    'client_secret' => env('GUEST_UPLOAD_CLIENT_SECRET', ''),

    // 路由(必须以`/`开头)
    'route'         => [
        'upload-image' => '/api/upload/image', // 上传图片
    ],

];