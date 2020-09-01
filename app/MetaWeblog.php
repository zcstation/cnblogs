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

    public static function getCategories()
    {
        $blogData = Blogger::getUsersBlogs();

        if ($blogData['code'] == 0) {
            return $blogData;
        }

        $response = self::getResponse('metaWeblog.getCategories', array(
            'blogid' => new Value($blogData['data']['blogid'], 'string'),
            'username' => new Value(Utils::input('post.username'), 'string'),
            'password' => new Value(Utils::input('post.password'), 'string')
        ));

        if ($response->faultCode() != 0) {
            return self::error($response->faultString());
        }

        $data = array();

        foreach ($response->value() as $item) {
            // 临时数据
            $tmp = array();
            /**
             * @var Value $datum
             */
            foreach ($item as $key => $datum) {
                $val = $datum->scalarval();
                /*if ($key == 'title') {
                    if (mb_substr($val, 0, 6, 'utf-8') == '[随笔分类]') {
                        $tmp[$key] = mb_substr($val, 6, mb_strlen($val) - 6, 'utf-8');
                    }
                } else {
                    $tmp[$key] = $val;
                }*/
                $tmp[$key] = $val;
            }
            // 非自己的分类不显示
            if (!isset($tmp['title'])) {
                continue;
            }
            $data[] = $tmp;
        }

        return self::success($data);
    }

    public static function getPost()
    {

    }

    public static function getRecentPosts()
    {

    }

    public static function newMediaObject()
    {

    }

    public static function newPost()
    {

    }
}