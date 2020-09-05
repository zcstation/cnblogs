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
        $data = self::getResponseData('blogger.getUsersBlogs', array(), array(
            // appKey 暂时可以填空值，但是该参数要有
            'appKey' => new Value(self::$appKey, 'string'),
        ));

        if (isset($data['data']) && isset($data['data'][0])) {
            return self::success($data['data'][0]);
        }

        return $data;
    }

    /**
     * 删除一篇博客
     * @return array
     */
    public static function deletePost()
    {
        return self::getResponseData('blogger.deletePost', array(
            // 在适用的情况下，指定在文章被删除后是否应该重新发布博客
            'publish' => new Value(Utils::input('post.publish', false), 'boolean')
        ), array(
            // appKey 暂时可以填空值，但是该参数要有
            'appKey' => new Value(self::$appKey, 'string'),
            // 要删除的文章id
            'postid' => new Value(Utils::input('post.postid'), 'string'),
        ));
    }
}