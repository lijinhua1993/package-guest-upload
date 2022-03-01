<?php

namespace Lijinhua\GuestUpload;

class Response
{

    /**
     * 响应内容
     *
     * @var array
     */
    protected array $responseData = [];

    protected string $path = '';

    protected string $url = '';

    public function __construct($data)
    {
        $this->responseData = $data;

        $this->checkResponseData();
        $this->setData();
    }

    /**
     * 检查响应内容
     *
     * @return void
     * @throws \Lijinhua\GuestUpload\UploadException
     */
    private function checkResponseData()
    {
        if (!isset($this->responseData['path'])) {
            throw new UploadException('响应内容缺少`path`');
        }
        if (!isset($this->responseData['url'])) {
            throw new UploadException('响应内容缺少`url`');
        }
    }

    private function setData()
    {
        $this->path = $this->responseData['path'];
        $this->url  = $this->responseData['url'];
    }

    /**
     * 获取文件相对路径
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * 获取文件访问地址
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * 获取原始响应内容
     *
     * @return array
     */
    public function getResponseData(): array
    {
        return $this->responseData;
    }
}