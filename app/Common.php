<?php


namespace app;


use PhpXmlRpc\Client;
use PhpXmlRpc\Request;
use PhpXmlRpc\Response;
use PhpXmlRpc\Value;

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
     * @var string $appKey 接口参数需要有这个值，但是为空也可以
     */
    protected static $appKey = "";

    /**
     * 解析数据
     * @param array|Value $datum
     * @return array
     */
    protected static function parseData($datum)
    {
        $data = array();
        /**
         * @var Value $item
         */
        foreach ($datum as $key => $item) {
            if (is_object($item) && in_array($item->scalartyp(), array('array', 'struct'))) {
                $data[$key] = self::parseData($item);
            } else {
                $data[$key] = is_object($item) ? $item->scalarval() : $item;
            }
        }

        return $data;
    }

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

    /**
     * 获取返回数据，有的接口参数一样所以此处公用
     * @param string $method 方法
     * @param array $other 其他参数
     * @param array $base 基础参数
     * @return array
     */
    protected static function getResponseData($method, $other = array(), $base = array())
    {
        if (empty($base)) {
            // 没有指定基础参数则传递blogid参数
            $blogData = Blogger::getUsersBlogs();

            if ($blogData['code'] == 0) {
                return $blogData;
            }

            $base = array(
                'blogid' => new Value($blogData['data']['blogid'], 'string'),
            );
        }
        // 必须的参数
        $param = array(
            'username' => new Value(Utils::input('post.username'), 'string'),
            'password' => new Value(Utils::input('post.password'), 'string')
        );
        // 参数似乎和前后顺序有关
        $response = self::getResponse($method, array_merge($base, $param, $other));

        if ($response->faultCode() != 0) {
            return self::error($response->faultString());
        }

        return self::success(self::parseData($response->value()));
    }
}