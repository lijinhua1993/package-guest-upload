# Guest 上传服务

## 安装

```shell
composer require lijinhua/guest-upload
```

发布配置文件

```shell
php artisan vendor:publish --provider="Lijinhua\GuestUpload\ServiceProvider"
```

配置上传站点域名信息

config/guest-upload.php

```php
    // 域名
    'host'       => env('GUEST_UPLOAD_HOST', ''),
```

## 使用方法

### 上传图片

上传失败抛出异常:

Illuminate\Http\Client\RequestException

\Lijinhua\GuestUpload\UploadException

```php
// 上传图片-文件原始内容
$r = \GuestUpload::image("file",file_get_contents('photo.jpg'),'avatarFolder');
// 上传图片-Stream 流数据
$r = \GuestUpload::image("file",fopen('photo.jpg', 'r'),'avatarFolder');

// 上传成功返回内容获取
$path = $r->getPath();
$url = $r->getUrl();
```

### 拼接图片访问地址

```php
$url = \GuestUpload::imageUrl($path);
```
