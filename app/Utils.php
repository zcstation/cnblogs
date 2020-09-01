<?php


namespace app;


class Utils
{
    /**
     * @var array $post json 数据
     */
    protected static $post = array();

    /**
     * 解析 get 参数
     * @param string $key 参数名
     * @param mixed $default 默认值
     * @return mixed
     */
    protected static function parseGet($key, $default)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    /**
     * 解析 post 数据
     * @param string $key 参数名
     * @param mixed $default 默认值
     * @return mixed
     */
    protected static function parsePost($key, $default)
    {
        if (empty(self::$post)) {
            // 获取 content-type
            $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
            // 如果post数据为空并且是json格式，从原始请求体解析json，否则使用 $_POST
            if (empty($_POST) && false !== strpos($content_type, 'application/json')) {
                self::$post = json_decode(file_get_contents('php://input'), true);
            } else {
                self::$post = $_POST;
            }
        }

        return isset(self::$post[$key]) ? self::$post[$key] : $default;
    }

    /**
     * 获取请求值
     * @param string $key 键名，如 get.page
     * @param null $default 默认值
     * @return mixed|null
     */
    public static function input($key, $default = null)
    {
        // 请求类型和键值，目前只支持二级
        $data = explode('.', $key);
        switch (strtoupper($data[0])) {
            case 'GET':
                return self::parseGet(isset($data[1]) ? $data[1] : '', $default);
                break;
            case 'POST':
                return self::parsePost(isset($data[1]) ? $data[1] : '', $default);
                break;
            default:
                return $default;
        }
    }
}