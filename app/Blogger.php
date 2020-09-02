<?php


namespace app;


use PhpXmlRpc\Value;

/**
 * Class Blogger
 * 博客相关的类，包含获取博客信息和删除文章
 * @package app
 */
class Blogger extends Common
{
    /**
     * Returns information on all the blogs a given user is a member.
     * 返回给定用户是成员的所有博客上的信息。
     * @return array
     */
    public static function getUsersBlogs()
    {
        $response = self::getResponse('blogger.getUsersBlogs', array(
            // appKey 暂时可以填空值，但是该参数要有
            'appKey' => new Value(self::$appKey, 'string'),
            // 登录用户名
            'username' => new Value(Utils::input('post.username'), 'string'),
            // 密码
            'password' => new Value(Utils::input('post.password'), 'string')
        ));

        if ($response->faultCode() != 0) {
            return self::error($response->faultString());
        }

        $data = array();

        foreach ($response->value() as $datum) {
            /**
             * @var Value $item
             */
            foreach ($datum as $key => $item) {
                $data[$key] = $item->scalarval();
            }
        }

        return self::success($data);
    }

    public static function deletePost()
    {

    }
}