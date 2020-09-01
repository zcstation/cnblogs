<?php


namespace app;


use PhpXmlRpc\Client;
use PhpXmlRpc\Request;
use PhpXmlRpc\Response;

/**
 * Class Common
 * 公共类，包含一些公共的方法
 * @package app
 */
class Common
{
    /**
     * @var string $domain 博客园 rpc 地址，后面加上 博客地址名 就是自己的地址
     */
    protected static $domain = "https://rpc.cnblogs.com/metaweblog/";

    /**
     * @var string $addressName 博客地址名，根据自己实际情况修改
     * 在设置页面下可以查看和修改 https://i.cnblogs.com/settings
     */
    protected static $addressName = "lantor";

    /**
     * 返回成功的结果
     * @param mixed $data 数据结果
     * @return array
     */
    protected static function success($data)
    {
        return array(
            'code' => 1,
            'msg' => '',
            'data' => $data
        );
    }

    /**
     * 返回失败的提示
     * @param string $msg 提示信息
     * @return array
     */
    protected static function error($msg)
    {
        return array(
            'code' => 0,
            'msg' => $msg
        );
    }

    /**
     * 获取响应对象
     * @param string $method 请求方法，如 blogger.getUsersBlogs
     * @param array $data 请求的数据，每一个元素都应该是 PhpXmlRpc\Value 对象
     * @return Response|Response[]
     */
    protected static function getResponse($method, $data = array())
    {
        // 客户端连接rpc地址
        $client = new Client(self::$domain . self::$addressName);
        // 是否使用curl，如果使用curl报以下错误可以禁用，或者配置php.ini
        // CURL error: SSL certificate problem: unable to get local issuer certificate
        $client->setUseCurl(1);
        // 组织请求体
        $request = new Request($method, $data);
        // 返回响应对象
        return $client->send($request);
    }
}