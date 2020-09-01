<?php
// 输出json字符串
header('Content-Type: application/json;charset=utf-8');
// 不输出任何错误信息
error_reporting(0);
// 自动加载
require_once __DIR__ . '/vendor/autoload.php';
// 请求路径，去除两边 /，需配置 url rewrite 规则
// 也可以以参数形式传递，以第一个参数为准
if (PHP_SAPI == 'cli') {
    $request_uri = isset($_SERVER['argv']) && isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : "/";
} else {
    $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "/";
}
$uri = trim($request_uri, '/');
// 以 / 划分类名和方法名
$path_info = explode('/', $uri);
// 类名
$class = ucfirst($path_info[0]);
// 完整类名
$class_name = 'app\\' . ($class ?: 'Index');
// 判断类是否存在
if (class_exists($class_name)) {
    // 判断方法是否存在
    $method_name = isset($path_info[1]) ? $path_info[1] : 'index';
    // 方法是否存在
    if (method_exists($class_name, $method_name)) {
        // 有返回值取返回值，没有返回值按输出
        $result = call_user_func(array($class_name, $method_name));

        if (empty($result)) {
            $result = array(
                'code' => 0,
                'msg' => "方法{$method_name}无返回值"
            );
        }
    } else {
        $result = array(
            'code' => 0,
            'msg' => $method_name . '方法不存在'
        );
    }
} else {
    $result = array(
        'code' => 0,
        'msg' => $class_name . '类不存在'
    );
}

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
