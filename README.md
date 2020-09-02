# cnblogs
=========
cnblogs(博客园)接口和文章管理

本项目依赖于 [phpxmlrpc](https://github.com/gggeek/phpxmlrpc) 类库，使用前执行 `composer install` 即可

使用前需要将自己的 **博客名地址** 修改掉

```php
// 编辑 app/Common.php 文件第28行修改，如下所示
protected static $addressName = "lantor";
```

web服务器访问需要配置 url rewrite 规则，入口文件为 `public/index.php`，所有请求都为 `HTTP POST` 请求，请求方法及参数如下

<div id="content">
<span>
<h2><a name="#blogger.deletePost">method blogger.deletePost</a></h2>
<p class="intro">Deletes a post.</p>
<h3>Parameters</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>appKey</td></tr><tr><td width="33%">string</td><td>postid</td></tr><tr><td width="33%">string</td><td>username</td></tr><tr><td width="33%">string</td><td>password</td></tr><tr><td width="33%">boolean</td><td>publish - Where applicable, this specifies whether the blog should be republished after the post has been deleted.</td></tr></table>
<h3>Return Value</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">boolean</td><td>Always returns true.</td></tr></table>
</span>
<span>
<h2><a name="#blogger.getUsersBlogs">method blogger.getUsersBlogs</a></h2>
<p class="intro">Returns information on all the blogs a given user is a member.</p>
<h3>Parameters</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>appKey</td></tr><tr><td width="33%">string</td><td>username</td></tr><tr><td width="33%">string</td><td>password</td></tr></table>
<h3>Return Value</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">array of struct <a href="#BlogInfo">BlogInfo</a></td><td>&nbsp;</td></tr></table>
</span>
<span>
<h2><a name="#metaWeblog.editPost">method metaWeblog.editPost</a></h2>
<p class="intro">Updates and existing post to a designated blog using the metaWeblog API. Returns true if completed.</p>
<h3>Parameters</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>postid</td></tr><tr><td width="33%">string</td><td>username</td></tr><tr><td width="33%">string</td><td>password</td></tr><tr><td width="33%">struct <a href="#Post">Post</a></td><td>post</td></tr><tr><td width="33%">boolean</td><td>publish</td></tr></table>
<h3>Return Value</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">any</td><td>&nbsp;</td></tr></table>
</span>
<span>
<h2><a name="#metaWeblog.getCategories">method metaWeblog.getCategories</a></h2>
<p class="intro">Retrieves a list of valid categories for a post using the metaWeblog API. Returns the metaWeblog categories struct collection.</p>
<h3>Parameters</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>blogid</td></tr><tr><td width="33%">string</td><td>username</td></tr><tr><td width="33%">string</td><td>password</td></tr></table>
<h3>Return Value</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">array of struct <a href="#CategoryInfo">CategoryInfo</a></td><td>&nbsp;</td></tr></table>
</span>
<span>
<h2><a name="#metaWeblog.getPost">method metaWeblog.getPost</a></h2>
<p class="intro">Retrieves an existing post using the metaWeblog API. Returns the metaWeblog struct.</p>
<h3>Parameters</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>postid</td></tr><tr><td width="33%">string</td><td>username</td></tr><tr><td width="33%">string</td><td>password</td></tr></table>
<h3>Return Value</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">struct <a href="#Post">Post</a></td><td>&nbsp;</td></tr></table>
</span>
<span>
<h2><a name="#metaWeblog.getRecentPosts">method metaWeblog.getRecentPosts</a></h2>
<p class="intro">Retrieves a list of the most recent existing post using the metaWeblog API. Returns the metaWeblog struct collection.</p>
<h3>Parameters</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>blogid</td></tr><tr><td width="33%">string</td><td>username</td></tr><tr><td width="33%">string</td><td>password</td></tr><tr><td width="33%">integer</td><td>numberOfPosts</td></tr></table>
<h3>Return Value</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">array of struct <a href="#Post">Post</a></td><td>&nbsp;</td></tr></table>
</span>
<span>
<h2><a name="#metaWeblog.newMediaObject">method metaWeblog.newMediaObject</a></h2>
<p class="intro">Makes a new file to a designated blog using the metaWeblog API. Returns url as a string of a struct.</p>
<h3>Parameters</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>blogid</td></tr><tr><td width="33%">string</td><td>username</td></tr><tr><td width="33%">string</td><td>password</td></tr><tr><td width="33%">struct <a href="#FileData">FileData</a></td><td>file</td></tr></table>
<h3>Return Value</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">struct <a href="#UrlData">UrlData</a></td><td>&nbsp;</td></tr></table>
</span>
<span>
<h2><a name="#metaWeblog.newPost">method metaWeblog.newPost</a></h2>
<p class="intro">Makes a new post to a designated blog using the metaWeblog API. Returns postid as a string.</p>
<h3>Parameters</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>blogid</td></tr><tr><td width="33%">string</td><td>username</td></tr><tr><td width="33%">string</td><td>password</td></tr><tr><td width="33%">struct <a href="#Post">Post</a></td><td>post</td></tr><tr><td width="33%">boolean</td><td>publish</td></tr></table>
<h3>Return Value</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>&nbsp;</td></tr></table>
</span>
<span>
<h2><a name="#wp.newCategory">method wp.newCategory</a></h2>
<p class="intro">Create a new category</p>
<h3>Parameters</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>blog_id</td></tr><tr><td width="33%">string</td><td>username</td></tr><tr><td width="33%">string</td><td>password</td></tr><tr><td width="33%">struct <a href="#WpCategory">WpCategory</a></td><td>category</td></tr></table>
<h3>Return Value</h3>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">integer</td><td>&nbsp;</td></tr></table>
</span>
<span>
<h2><a name="#BlogInfo">struct BlogInfo</a></h2>
<h3>Members</h3>
</span>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>blogid </td></tr><tr><td width="33%">string</td><td>url </td></tr><tr><td width="33%">string</td><td>blogName </td></tr></table>
<span>
<h2><a name="#Post">struct Post</a></h2>
<h3>Members</h3>
</span>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">dateTime</td><td>dateCreated - Required when posting.</td></tr><tr><td width="33%">string</td><td>description - Required when posting.</td></tr><tr><td width="33%">string</td><td>title - Required when posting.</td></tr><tr><td width="33%">array of string</td><td>categories  (optional) </td></tr><tr><td width="33%">struct <a href="#Enclosure">Enclosure</a></td><td>enclosure  (optional) </td></tr><tr><td width="33%">string</td><td>link  (optional) </td></tr><tr><td width="33%">string</td><td>permalink  (optional) </td></tr><tr><td width="33%">any</td><td>postid  (optional) </td></tr><tr><td width="33%">struct <a href="#Source">Source</a></td><td>source  (optional) </td></tr><tr><td width="33%">string</td><td>userid  (optional) </td></tr><tr><td width="33%">any</td><td>mt_allow_comments  (optional) </td></tr><tr><td width="33%">any</td><td>mt_allow_pings  (optional) </td></tr><tr><td width="33%">any</td><td>mt_convert_breaks  (optional) </td></tr><tr><td width="33%">string</td><td>mt_text_more  (optional) </td></tr><tr><td width="33%">string</td><td>mt_excerpt  (optional) </td></tr><tr><td width="33%">string</td><td>mt_keywords  (optional) </td></tr><tr><td width="33%">string</td><td>wp_slug  (optional) </td></tr></table>
<span>
<h2><a name="#CategoryInfo">struct CategoryInfo</a></h2>
<h3>Members</h3>
</span>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>description </td></tr><tr><td width="33%">string</td><td>htmlUrl </td></tr><tr><td width="33%">string</td><td>rssUrl </td></tr><tr><td width="33%">string</td><td>title </td></tr><tr><td width="33%">string</td><td>categoryid </td></tr></table>
<span>
<h2><a name="#FileData">struct FileData</a></h2>
<h3>Members</h3>
</span>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">base64</td><td>bits </td></tr><tr><td width="33%">string</td><td>name </td></tr><tr><td width="33%">string</td><td>type </td></tr></table>
<span>
<h2><a name="#UrlData">struct UrlData</a></h2>
<h3>Members</h3>
</span>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>url </td></tr></table>
<span>
<h2><a name="#WpCategory">struct WpCategory</a></h2>
<h3>Members</h3>
</span>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>name </td></tr><tr><td width="33%">string</td><td>slug  (optional) </td></tr><tr><td width="33%">integer</td><td>parent_id </td></tr><tr><td width="33%">string</td><td>description  (optional) </td></tr></table>
<span>
<h2><a name="#Enclosure">struct Enclosure</a></h2>
<h3>Members</h3>
</span>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">integer</td><td>length  (optional) </td></tr><tr><td width="33%">string</td><td>type  (optional) </td></tr><tr><td width="33%">string</td><td>url  (optional) </td></tr></table>
<span>
<h2><a name="#Source">struct Source</a></h2>
<h3>Members</h3>
</span>
<table cellspacing="0" cellpadding="5" width="90%"><tr><td width="33%">string</td><td>name  (optional) </td></tr><tr><td width="33%">string</td><td>url  (optional) </td></tr></table>
</div>