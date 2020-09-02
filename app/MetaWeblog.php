<?php


namespace app;


use PhpXmlRpc\Value;

/**
 * Class MetaWeblog
 * 博客文章操作类，包含增改查等
 * @package app
 */
class MetaWeblog extends Common
{

    public static function editPost()
    {

    }

    /**
     * Retrieves a list of valid categories for a post using the metaWeblog API. Returns the metaWeblog categories struct collection.
     * 使用metaWeblog API检索帖子的有效类别列表。返回metaWeblog类别的struct集合。
     * @return array
     */
    public static function getCategories()
    {
        return self::getResponseData('metaWeblog.getCategories');
    }

    public static function newPost()
    {

    }

    /**
     * Retrieves a list of the most recent existing post using the metaWeblog API. Returns the metaWeblog struct collection.
     * 使用metaWeblog API检索最新的现有帖子列表。返回metaWeblog结构集合。
     * @return array
     */
    public static function getRecentPosts()
    {
        return self::getResponseData('metaWeblog.getRecentPosts', array(
            'numberOfPosts' => new Value(Utils::input('post.numberOfPosts', 5), 'int')
        ));
    }

    /**
     * Makes a new file to a designated blog using the metaWeblog API. Returns url as a string of a struct.
     * 使用metaWeblog API将新文件制作到指定的博客。返回url作为结构的字符串。
     * @return array
     */
    public static function newMediaObject()
    {
        if (!isset($_FILES['file'])) {
            return self::error("上传文件不能为空");
        }
        // 上传的文件
        $file = $_FILES['file'];

        return self::getResponseData('metaWeblog.newMediaObject', array(
            'file' => new Value(array(
                'bits' => new Value(file_get_contents($file['tmp_name']), 'base64'),
                'name' => new Value($file['name'], 'string'),
                'type' => new Value($file['type'], 'string')
            ), 'struct')
        ));
    }

    /**
     * Retrieves an existing post using the metaWeblog API. Returns the metaWeblog struct.
     * 使用metaWeblog API检索现有帖子。返回metaWeblog结构。
     * @return array
     */
    public static function getPost()
    {
        return self::getResponseData('metaWeblog.getPost', array(), array(
            'postid' => new Value(Utils::input('post.postid'), 'string')
        ));
    }
}