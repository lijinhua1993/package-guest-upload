<?php

namespace Lijinhua\GuestUpload;

use Illuminate\Support\Facades\Http;

class Upload
{

    /**
     * 域名
     *
     * @var string
     */
    protected string $host;

    /**
     * 资源访问地址前缀
     *
     * @var string
     */
    protected string $urlPrefix;

    /**
     * 响应成功状态码
     *
     * @var int
     */
    protected int $responseSuccessCode = 0;

    /**
     * 初始化
     */
    public function __construct()
    {
        $this->host      = config('guest-upload.host');
        $this->urlPrefix = rtrim($this->host, '/') . rtrim(config('guest-upload.url_prefix'), '/') . '/';
    }

    /**
     * 获取接口token
     *
     * @return mixed
     */
    private function getToken()
    {
        $response = Http::asForm()->post($this->host . '/oauth/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => config('guest-upload.client_id'),
            'client_secret' => config('guest-upload.client_secret'),
        ]);

        return $response->json()['access_token'];
    }

    /**
     * 上传图片
     *
     * @param  string|array  $name
     * @param  string|resource  $contents
     * @param  string|null  $folder
     * @return \Lijinhua\GuestUpload\Response
     * @throws \Illuminate\Http\Client\RequestException
     * @throws \Lijinhua\GuestUpload\UploadException
     */
    public function image($name, $contents = '', $folder = null)
    {
        $url = $this->host . config('guest-upload.route.upload-image');

        $postData = [];

        if (!is_null($folder)) {
            $postData['folder'] = $folder;
        }

        $response = Http::withToken($this->getToken())
            ->attach($name, $contents)
            ->post($url, $postData);

        // 在客户端或服务端错误发生时抛出异常
        $response->throw();

        $responseArray = $response->json();

        $code = $responseArray['code'] ?? null;
        if (is_null($code) || $code !== $this->responseSuccessCode) {
            throw new UploadException($responseArray['msg']);
        }

        return new Response($responseArray['data']);
    }

    /**
     * 图片地址
     *
     * @param $path
     * @return string
     */
    public function imageUrl($path)
    {
        return $this->urlPrefix . ltrim($path, '/');
    }

}