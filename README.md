# cnblogs
=========
cnblogs(博客园)接口和文章管理

本项目依赖于 [phpxmlrpc](https://github.com/gggeek/phpxmlrpc) 类库，使用前执行 `composer install` 即可

如果是web服务器访问需要配置 url rewrite 规则，入口文件为 `public/index.php`，命令行访问则可以直接使用 `php public/index.php "blogger/getUsersBlogs"`

