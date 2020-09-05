<?php


namespace app;


use PhpXmlRpc\Value;

/**
 * Class Wp
 * 类别管理
 * @package app
 */
class Wp extends Common
{
    /**
     * 添加新的分类
     * @return array
     */
    public static function newCategory()
    {
        return self::getResponseData('wp.newCategory', array(
            'category' => new Value(array(
                'name' => new Value(Utils::input('post.name'), 'string'),
                // 显示在浏览器地址栏上域名后面的地址,
                'slug' => new Value(Utils::input('post.slug', ''), 'string'),
                'parent_id' => new Value(Utils::input('post.parentId', 0), 'int'),
                // 描述
                'description' => new Value(Utils::input('post.description', ''), 'string')
            ), 'struct')
        ), array(), 'blog_id');
    }
}