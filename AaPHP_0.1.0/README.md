这个是AaPHP 0.1.0 的代码，早就作废！！！AaPHP 1.0.0 使用方法也早已于此不同。下面仅供参考，AaPHP 1.0.0 的 MDL 层早已更新，基于 PDO，而不是 0.1.0 的 MySQLi。

AaPHP 版本规律是：  
```
0.1.0 ->  0.1.1 ->  0.1.2 ->  0.1.3 ->  0.8.9 ->  1.0.0

当前是 1.0.0 版本，基于在线使用的原因，暂不开源。
```
# AaPHP 的特点

取自项目，学习了Restful API (由于SOA博大精深，我一时间无法领悟，我在restful上面也属于学生阶段，这里只能浅谈)，希望未来能在项目中不断打磨API开发。



## 接近原生的Mdl设计，重构和优化MySQL再也不用那么麻烦了

数据库一直是一个性能瓶颈问题，而不同程序员对数据库语句的用功程度也不同、熟练程度也不同。而往往大家一起开发的时候，代码质量往往不那么好保证。而代码在不断的增量迭代之后，数据库表越建越多、连表关系越来越复杂…… 而以往的框架数据库语句与model层耦合度很高，由于人员的更替，代码复杂度又会变高。而线上环境还在跑，此时数据库重构就会变得异常困难……

而AaPHP在设计的时候，核心目的就是解决这个问题。

AaPHP引入了Mdl层，用数据库名做目录（并不强制），里面每个表一个文件，连表也同样一个文件，每个表文件里面有 tableStruct 用于描述表的结构，然后就是几乎原生的MySQL 语句。

这是一个MySQL程序员也可以很轻松看懂的文件，而且当时分工也是这样，这个文件未来就由优秀的数据库人员去直接做优化。

数据库语句的性能优化，从此再也不用到处去看业务代码了，可预估表文件里面有 tableStruct 用于描述表的结构，然后就是几乎原生的MySQL 语句。

而且更加便捷、可易读写的数据库字段隐藏方案，这样在避免暴露数据库字段上面使用起来非常实用。

其实很多时候，公司开始无法预估未来数据库建表和关系，往往数据库越建越复杂，连表越来越频繁……而由于耦合于业务的数据库语句，往往会使未来数据库重构变得更加力不从心。而倘若在业务层中，有一层，能够非常接近于原生的MySQL语句，这样便于未来数据库程序员去重构表的时候，完全不必再考虑业务层代码，那么数据库重整起来就会变得更加轻松。而AaPHP的 Mdl层就是这一层。

## AaPHP 自动准确告诉前端开发者错误原因，减少沟通成本

举个最简单的例子，假如开发完了一个接口，客户端也都完成上线了。两三个月后发现该接口有安全风险，需要添加一个效验参数，而如果客户端大量使用了该接口，那么就需要一遍又一遍的查找代码该接口的使用情况…… 如果没有找到，测试是否能很快发现？ 前端程序员能否很快的知道修改了哪个参数？传统的API并无法实现这个功能，往往需要手动的去找，因为参数传的不完整，可能并不会报错。

而AaPHP在Controller层和Mdl层都可以设置过滤和字段是否是必选项，如果客户端没有传某些参数，或者传的参数不符合Controller里面的规则，或者是 Mdl里面的规则，都一样会被返回错误代码，并准确提示哪个参数没有传、以及规则是什么（开启debug等级来决定显示错误信息的程度）。

下面一个简单的代码提示示例：
```php
/**
 * Mdl
 */
namespace Mdl\AaTest;
class Test extends \AbIf\Db\Mdl {
    public static isValidToken(&$token) {
        return preg_match('/^[a-fA-F\d+]{32}$/', $token)
    }
    public static $tableStruct = [
        'aa_test',
        'gender'       => [
            'sex',                                  // Model和客户端的字段别名
            self::T_ENUM,                           // 数据类型，T_ENUM，枚举
            [                                       // ENUM 数据说明
              'female' => 2,
              'male' => 1,
              'unknown' => 0
            ]
        ],
        'id'        => [
            self::T_INT,                            // 数据类型，T_INT，整数型
            'uid',                                  // 别名
            '/^1\d+$/'                              // 正则规则，以数字1开头的数字
        ],
        'token'     => [self::T_VARCHAR, 'static::isValidToken']
    ];
    
    const INSERT = '
        INSERT INTO $table (gender, token, id) VALUES ?
    ';
    
    const GET = '
        SELECT id,gender FROM $table WHERE token = ? LIMIT 1
    ';
}


/**
 * Controller 
 */
namespace Controller;
use Aa;
class Test {
    private function getTest() {
        $token = Aa::request(['GET' => 'token']);          // 必传，只获取GET方式传递的参数
        $model = new \Model\Test();
        $model->set('token', $token);
        return $model->getInfo();
    }
    private function postTest() {
        $id = Aa::request('id', '/^1\d+$/');    // 必传参数，客户端传递  id 参数，要以数字1开头
        $sex = Aa::request('sex', false);       // 可传参数，
        $token = Aa::request(['GET' => 'token']);          // 必传，只获取GET方式传递的参数
        $model = new \Model\Test();
        $model->set('id', $id);
         $model->set('token', $token);
          $model->set('sex', $sex);
        return $model->insertInfo();
    }
    public function index() {
        if('POST' == $_SERVER['REQUEST_METHOD']){      // 传递方式为POST
            return postTest();
        } elseif ('GET' == $_SERVER['REQUEST_METHOD']) {
            return getTest();
        }
    }
}

 
/**
 * Model
 */
namespace Model;
use Aa;
class Test extends \AbIf\Db\Model {
    public function insertInfo() {
        $mdl = new \Mdl\AaTest\Test($this);         // 把$this的数据装载进 一个Mdl
        $query_string = $mdl->queryString($mdl::INSERT);
        $db = \Unit\Mysqli::db();                   // 获取实例化的MySQLi
        return $db->query($query_string);
    }
    public function getInfo() {
        $mdl = new \Mdl\AaTest\Test($this);         // 把$this的数据装载进 一个Mdl
        $query_string = $mdl->queryString($mdl::GET);
        $db = \Unit\Mysqli::db();                   // 获取实例化的MySQLi
        $sex_map = [
            'female'    => '女',
            'male'      => '男',
            'unknown'   => '为止'
        ];
        return $query->fetchOneRow(
            $query_string,                          // 完整的数据库语句
            $mdl,                                   // 关联的Mdl 
            ['sex'],                                // 从查询结果，只保留 'sex' 字段
            function(&$data, $params){              // 修改数据
            $data['sex'] = $params['sex_map'][$data['sex']];
            },
            ['sex_map' => $sex_map]                 // 传参给上面的 $params
        );
    }
}


```

那么如果客户端执行下面请求：
```
POST http://xxxx/v1/test     ==> 等价于： http://xxxx/v1/test/index
    {
        "id" : "1000",                  // 数据类型为字符串，后台会自动改成INT，所以这里
                                        // 传任意数据类型都行，只要是以1开头的全数字即可
                                        // "id": 1000 是等价的
                                        
        "sex" : "famele",               // 拼错了female
        "token" : "fa876c3a54a0eaef68e722bba5b68732"
    }
```
那么服务器将会反馈：
```json
    {
        "errcode": 400,
        "errmsg": "参数 `sex` 不符合Enum规则，请传递 female, male, unknown"
    }
```

如果客户端请求：
```
GET  http://xxxx/v1/test 
    {
        "token" : "123"
    }
```
那么服务器会反馈：
```json
    {
        "errcode": 400,
        "errmsg": "参数 `token` 不符合规则"                    // 如果开启的 debug 界别较低
        "errmsg": "参数 `token` 不符合 static::isValidToken "  // 如果开启的 debug 级别高
    }
```

如果客户端传递请求成功：
```
GET   http://xxxx/v1/test 
    {
        "token" : "fa876c3a54a0eaef68e722bba5b68732"
    }
```
那么服务端将会返回强类型的数据：
```json
    {
        "errcode": 200,
        "data": {
            "sex" : "女"         // 在Mdl层，只select id, gender from
                                 //   而 gender 是数据库隐藏字段名
                                 // 在Model层，选择只保留 ['sex'] 数据，
                                 //     那么应该返回 ['sex' => 'female']
                                 //     而又在Model层对该数据进行了修饰，
                                 //     于是返回 {"sex": "女"}
        }
```

单纯这个功能，就可以减少很多前后端联合排错的时间成本。

## api.yaml 抽象代码文件，实现自动生成API文档、自动遍历测试API接口

已经规划中的 api.yaml（估量过实现难度，对我现阶段而言，是完全可以实现的。纯粹只是有没有时间和项目去促进实现……），以往的API文档都是word文件手动写的，前后端传来传去，代码改来改去，API文档也就改来改去，真是令人头疼。后来我采用过直接写成HTML格式的，访问简单了点，不过一样有修改API接口后的通知问题。

api.yaml 的机制跟传统单元测试、验收测试是有本质区别的。传统的测试都是在代码完成之后，再去模拟测试。其实很多人早都知道单元测试，但是很少有人能坚持这种“体力活”。

而 api.yaml 是 API 接口的抽象描述，里面会有测试用例，而 api.yaml 是在代码实现之前由富有经验的程序员，或者技术管理所写的，只要 api.yaml 抽象接口文件写完，就能自动生成前端（HTML5/Android/iOS)假接口，不用等后端程序员再写假接口；同时能自动生成后端代码模板，后端代码按照模板（含传参方式、传参、返回等）实现代码细节。

在代码验收阶段，可以根据 api.yaml 启动自动测试后端代码的功能。

而如果配合上面自动告知参数错误原因，还有通过 api.yaml 自动生成HTML格式的API文档，而且再自动遍历测试API接口，又可以节省不少联调就错的时间。


## 为什么强类型？

HTTP/TCP传输有个特点是：为了节省性能还是怎么的，基本都是以字符串格式传输。其实学过《Unix Network Programming - by Richard Stevens》的，应该都清楚，第一卷里面的案例都是以字符串形式传递；而我当初在学习的过程中，特意全部采用简易 struct 来传递（可见[https://github.com/AarioAi/NotesPublic/tree/master/NetworkProgramming](https://github.com/AarioAi/NotesPublic/tree/master/NetworkProgramming) ），所以传递的参数和结果也就有了类型；其实如果采用C主流的 Struct 接对齐数据的格式，这样就可以传递更丰富的数据类型和不定长度的数据。

毫无疑问，主流的还是以字符串形式传递着。当然这也没有问题，即使数据库字段为非字符串（如int 100），传输过程中到PHP接收到的结果也还是一样是字符串类型的类型。

可以这么说，在主流原生HTTP的世界里，数据都是以字符串形式传递。当我从事API开发后，很多事情不再像以前做PHP/HTML/CSS/JS 那样可以一个人控制所有，开发Restful API之后，更注重的是合作、妥协。

最开始开发API的时候，iOS/Android的同事都没有特殊要求，我返回什么数据，他们都能解析，并且有的推荐我使用Protobuf 和 Thrift做接口，我也小范围尝试过，那些封装了的强类型二进制数据，前后端也不会产生任何问题。

而后来公司来了新的iOS/Android同事，他们的代码全是靠框架映射的，虽然靠框架映射代码，以前的同事就跟我说过，但是那会儿我跟他们说：映射的这种写法太死了，我们公司还是不要采用吧，全部手写接口。而这次不太妙，有时候仓促写好的假接口结果包含数字，如：
```php
function pseudoAPI() {
  return [
    "age" : 18            // 注意这里
  ];
}
```

那么客户端会获取到：
```json
{
  "errcode": 200, 
  "data": {
    "age" : 18          // 注意这里是 int 类型哦
  }
}
```

而到时候写成真接口了，数据需要从MySQL获取，或者从Redis获取，而Redis数据是从MySQL获取的：
```php 
function pseudoAPI() {
  $model = ....;
  return $model->age();
}
```

熟悉数据库返回数据的，都会知道，这里如果成功了，json 会封装成：
```json
{
  errcode: "200", 
  data: {
    "age" : "18"          // 注意这里是 string 类型哦
  }
}
```

这样返回，那些做接口映射的客户端就崩了！！！以前的同事完全没问题，但是当时写Android的是新手，他脱离了那个框架就不会写代码了，没办法只能我来妥协！！！客户端崩了也都怪服务端原因，没办法谁让你类型返回的不一致呢。我当时的做法就是从数据库取出来的值，再强制转一下类型。

这还没完，由于PHP json_encode() 有对空结果编码有很奇怪也可理解的做法，比如上面，从数据库拿值，拿出来的是一个`["age" => "18"]` 这样的数组结构，而转成json 对象：`{"age" : "18"}`； 
但是如果从数据库取出来的是空`[]`，那么PHP 就会转成数组了：`[]`； 这样一会儿对象，一会儿数组的结果，又在实际开发中，莫名其妙的客户端代码又崩了……

我以前同事写代码的时候，大家都认为做接口映射不太友善，所以他们要么根据后台反馈数据类型，对映射的接口做了修改，要么手写接口。

而由于遇到了，离开映射接口的框架就写不好代码的同事，也促使我开发了一套传递和返回强类型的PHP API，当然也不会直接暴露数据库字段的方式也是不错的。


# 使用 AaPHP 开发API的流程   <a id="how_to_make_api_with_AaPHP"></a>

## AaPHP 目录结构
* /vendor/                                  --> 包括AaPHP核心代码，及第三方代码
  * /aa/                                    --> AaPHP 核心代码
  * /fonts/
  * /composer/
  *  ...
* composer.json                             --> composer 自动安装第三方代码

直接通过 composer 就能安装第三方优质的库，比如使用 swoole 去做异步通信, 使用 PHP-reque 去做PHP队列，使用各种开源的邮件系统去发送邮件…… 

所以AaPHP是兼容composer的，那么源源不断的第三方库就可以很轻松的被项目使用。

### AaPHP 代码设计
```
vendor/
    aa/
        AbIf/           Abstract slasses and interface
            Identity.php
                Identity : \AbIf\Data\DataAccess
                Auth
        Db/             Database and cache
        Helper/
        Loader/
        Net/
        resources/
        Widget/
        
api/
    public/         Entrance
        index.php   
        web/        HTML5

    Module/
    Controller/
    Model/
    Mdl/
    Aa/ 
    Instance/       Singleton instances
    run/            Shell script
    aa_base.php     
```
    

## 数据传递结构 Data Struct   <a id="Struct"></a>

AaPHP 的所有数据（Model, Mdl, Session, Cache...) 基于 Struct 类，即这些数据都有相同的操作方式；并且可以通过相同的方式互相将自己的数据，装载到其他数据模型内。
```php
class Struct implements DataAccess {
    private $dataStruct;

    function __construct(\AbIf\Data\Struct $struct = null) {
        $this->dataStruct = null !== $struct ? $struct->get() : [];
    }

    /**
     * @param mixed $data
     */
    function reset($data) {
        $this->dataStruct = $data;
    }

    /**
     *  In Json, [key:null] is very common. But isset() a null value key is very
     *   difficult in PHP, Using array_key_exists($key, $arr) is necessary
     * @return bool
     */
    function exists($key = null) {
        return null === $key ? !empty($this->dataStruct) : array_key_exists($key, $this->dataStruct);
    }

    function get($key = null, $required = true) {
        return null === $key ? $this->dataStruct : ($this->exists($key) ? $this->dataStruct[$key] : null);
    }

    function set($key, $value = null) {
        if (is_array($key)) {
            $this->dataStruct = array_merge($this->dataStruct, $key);
        } else {
            $this->dataStruct[$key] = $value;
        }
    }

    function del(...$keys) {
        if (empty($keys)) {
            $this->dataStruct = null;
        } else {
            if (is_array($keys[0])) {
                $keys = $keys[0];
            }
            foreach ($keys as $k) {
                unset($this->dataStruct[$k]);
            }
        }

    }
}
```
### 装载数据的简单示例
```php
class User extends \AbIf\Db\Model {
    public function isAccountAvaliable(){
        $account = $this->get('account');       // 获取自己的数据
        
        $struct = new \AbIf\Data\Struct();      // 一个空数据结构
        $struct->set('account', $account);      // 装载一个数据

        $mdl = new \Mdl\User\User($struct);     // 将$struct数据装载进 Mdl
        $mdl->set('account') = 'Hello, ' . $mdl->get('account');     // 重新修改数据
        
        $mdl2 = new \Mdl\Test\Test($this);      // 把自己的数据，装载进 Mdl
        
       

    }
}
```
## 开发一个简单的API

此时AaPHP 在 `/htdocs/AaPHP/vendor/`

1. 在任意目录新建一个目录，假如叫做/htdocs/AaPHP/example/ 
2. 在 example 根目录，添加aa_base.php
```php
    <?php
    $vendor_root = __DIR__ . '/../vendor';   // AaPHP/vendo/ 相对aa_base.php 文件位置
    include $vendor_root . '/autoload.php';


    $aa_root = $vendor_root . '/aa';

    include $aa_root . '/Loader/Autoload.php';
    include $aa_root . '/resources/base/constant.php';

    /**
     * 语言设置，
     */
    $locale = 'zh-cn';


    //define('DEBUG', true);

    $autoload = new \Loader\Autoload(__DIR__ . '/Aa');
    //$autoload->mapNamespace('Imagine', $aa_root .'/extensions/Imagine');
    $autoload->mapBaseDir(__DIR__);   // should be the last map

    $autoload->register();
    Aa::$vendorRoot = $vendor_root;
    Aa::appendLangMap(include $aa_root . '/resources/lang/' . $locale . '.php');
```

3. 设置一个程序入口，如 public/index.php  ，在入口里面设置了简单的路由规则，这里可以根据自己需求自己重写路由规则，由于URL优化，是通过Nginx伪静态来做的，性能更佳，所以AaPHP没有做路由

4. 常见的 MVC 结构

    * Controller/                                   控制器
    * Model/                                        数据模型
    * modules/                                      模块
    * Mdl/$DatabaseName/$TableName                  数据库的映射，提供MySQL语句
    * public/index.php                              程序入口

Model 和 Mdl 是同属于数据模型，任何数据都是通过 \Data\Struct 来传递数据，在Controller 里面 new 了一个Model，之后通过 ->set() 来为这个 Model 绑定数据，而 Model 可以直接将自己$this，传递给 Mdl，也可以通过 `Mdl ->set()` 为 Mdl 设置新的数据。

#### 一个简单的案例，判断用户名是否被注册

1. 设计数据库简单模型，建立数据库 user_db ，建立表 user_db.user_tb ，表结构如下：

```sql
    uid         用户ID，自增
    passwd      密码，规则是32为的 md5()，由于password是MySQL关键字，所以这里用passwd
    username    用户名，规则是英文字母开头、英文和数字的，6-16位用户名
```

2. 写 Mdl 代码，建立  /Mdl/$DatabaseName/$TableName， 如这里建立 /Mdl/User/User.php
在该Mdl 的 tableStruct 里面描述 MySQL 表结构，这里先写个最简单的
```php
<?php
namespace Mdl\User;
class User extends \AbIf\Db\Mdl {
    public static $tableStruct = [
        'user_tb',                                        // 数据库表名
        'uid'       => [self::T_INT],                     // 字段名，及数据类型
        'username'  => [self::T_STRING],
        'passwd'    => [self::T_STRING]
    ];
    
    // 判断账号是否存在
    const IS_ACCOUNT_VALIABLE = '
        SELECT EXISTS(
          SELECT 1 FROM $tb WHERE username=? AND passwd=? LIMIT 1
        )
    ';
}
```

3. 然后来写Controller 和 Model
```php
<?php 
// Controller 文件 /Controller/User.php

    namespace Controller;

    use Aa;

    class User {
        public function isAccoutAvaliable() {
            $account = Aa::request('account'); // 获取用户传递来的 account 参数
            $model = new \Model\User();    // 选定数据模型， \Model\User
            $model->set('account', $account);       // 绑定数据
            return $model->isAccountAvaliable();    // 返回模型
        }
    }
```    
 
在 Model 中，我们来获取该MySQL 语句，建立 `/Model/User.php`

```php
<?php
namespace Model;
use Aa;
class User extends \AbIf\Db\Model {
    public function isAccountAvaliable(){
        $account = $this->get('account');       // 获取从Controller装载的数据
        // 获取一个Mdl，来
        //$mdl = new \Mdl\User\User($this);     // 把自己的数据装载进Mdl
        $mdl = new \Mdl\User\User();            // 建立一个没有数据的Mdl
        $mdl->set('account', $account);         // 装载一个数据到 Mdl
        
        // 获取 MySQL 装载数据后的语句
        $query_string = $mdl->queryString($mdl::IS_ACCOUNT_VALIABLE);
        
        $db = \Unit\Mysqli::db();               // 获取一个 mysqli 实例
        $query = $db->query($query_string); 
        $results = $query->fetch_array();
        $is_exist = '1' == $results[0] ? 1 : 0;
        if(1 === $is_exist) {                  // 如果数据存在，就终止，并返回 Json 格式错误提示
            Aa::err(E_CONFLICT, '账号'. $account .'已经存在' );       // 注意：这里错误提示建议使用 Aa::lang() 来兼容多语言版本
        }
    }
}
```

这样上面一个API 就开发完了。由于 Mdl 里面和数据库名、数据库表名都是一一对应的，而且表结构也都一致，MySQL语句也都非常接近原生的，那么未来在优化SQL的时候，就可以直接对照该文件去优化，甚至不用再关心其他代码了。

## Table Structure 更复杂的用法  <a id="tableStruct"></a>

上面只是一个非常简单的用例，比如现在需要对用户名做过滤，对密码做验证，来防止SQL注入，
而且为了避免暴露MySQL 字段名，需要对有些字段名进行别名，

```php
<?php
namespace Mdl\User;
class User extends \AbIf\Db\Mdl {
    public static function isUserNameAvaliable(&$val) {
        return preg_match('/^[a-zA-Z]\w+{5-15}$/', $val);
    }
    public static $tableStruct = [
        'user_tb',                                        // 数据库表名
        'uid'       => [self::T_INT],                     // 字段名，及数据类型
        
        // 设置正则规则，
        // 将passwd设置别名 password，这样从数据库查出来的数据，就会用 password 作为字段名，而不是真实的passwd，而下面的MySQL语句
        // 还是一样用passwd 真实的字段名去写
        'passwd'    => [self::T_STRING, '/^[a-f\d]{32}$/', 'password']   
        
        
        // 设置用户名规则，判断依据是 self::isUserNameAvaliable()
        'username'  => [self::T_STRING, 'static::isUserNameAvaliable'],
        
        // 这里使用PHP 自带的 Email 验证规则去效验
        'email' => [self::T_STRING, FILTER_VALIDATE_EMAIL]
    ];
    
    
    
    // 判断账号是否存在
    const IS_ACCOUNT_VALIABLE = '
        SELECT EXISTS(
          SELECT 1 FROM $table WHERE username=? AND passwd=? LIMIT 1
        )
    ';
    
    // 这里引入了两个非 tableStruct 的参数  :offset  :limit，同样是从 Mdl->set('offset', 10) 设置的
    const LIST_USERS = '
        SELECT * FROM $table LIMIT :offset, :limit
    ';
}
```

## 参数结构 Parameters' Structure   <a id="paramStruct"></a>
而如果要查询列表，此时会有页数等不属于表结构的参数，我们可以建立一个  $paramStruct 来过滤这些参数，也可以不用
```php
<?php
namespace Mdl\User;
class User extends \AbIf\Db\Mdl {
    public static function isUserNameAvaliable(&$val) {
        return preg_match('/^[a-zA-Z]\w+{5-15}$/', $val);
    }
    public static $tableStruct = [
        'user_tb',                                        // 数据库表名
        'uid'       => [self::T_INT],                     // 字段名，及数据类型
        
        // 设置正则规则，
        // 将passwd设置别名 password，这样从数据库查出来的数据，就会用 password 作为字段名，而不是真实的passwd，而下面的MySQL语句
        // 还是一样用passwd 真实的字段名去写
        'passwd'    => [self::T_STRING, '/^[a-f\d]{32}$/', 'password']   
        
        
        // 设置用户名规则，判断依据是 self::isUserNameAvaliable()
        'username'  => [self::T_STRING, 'self::isUserNameAvaliable'],
        
        // 这里使用PHP 自带的 Email 验证规则去效验
        'email' => [self::T_STRING, FILTER_VALIDATE_EMAIL]
    ];
    
    public static $paramStruct = [
        'offset' => [self::T_INT]           // 这里限定 :offset 参数必须为 INT 类型
    ];
    
    // 判断账号是否存在
    const IS_ACCOUNT_VALIABLE = '
        SELECT EXISTS(
          SELECT 1 FROM $table WHERE username=? AND passwd=? LIMIT 1
        )
    ';
    
    // 这里引入了两个非 tableStruct 的参数  :offset  :limit，同样是从 Mdl->set('offset', 10) 设置的
    // 上面会对 :offset 强制修改类型，但是不会对 :limit 做任何操作
    const LIST_USERS = '
        SELECT * FROM $table LIMIT :offset, :limit
    ';
}

```


为了兼容多种数据库，这里就没有兼容 MySQL Enum，但是里面实现了新的 enum，比如性别，让客户端可以传递  female  male unknown，
```php
    public static $tableStruct = [
        'user_tb',
        
        /**
         * 该gender字段是self::T_ENUM 类型，运行使用下面的三个参数，而数据库会保存为 int类型
         * 这里设置了别名为  'sex'， 也就是 客户端可以传递参数 ?sex=female  过来
         */
        'gender' => [self::T_ENUM, 'sex',
            ['female' => 2, 'male' => 1, 'unknown' => 0]
   ]

```

有时候有些设计会有大量“是否”选项的字段，比如：是否吸烟、是否喝酒、是否烫头…… 而一般都是每个参数都用一个tinyint 来存，而Mdl 对此进行了简单的优化，
就是设计了 booleans 字段，用一个字段，来存这些数据
```php
<?php
    public static $tableStruct = [
        'user_tb',
        /**
         * 字段 bools 里面保存了很多 boolean 数据，而在 Model 层，管理这些数据只需要 
         *  $mdl->set('isSmoker', 1); $mdl->set('isDrinker', 0)  来做修改
         */
        'bools' => [[0 => 'isSmoker', 1 => 'isDrinker', 2 => 'likeRead', 10 => 'likeSwim']],
        
        ...
    ];
    
    // 这里对 bools 进行修改
    const THIRD_PARTY_AVALIABLE_TOKEN = '
        UPDATE sso SET :#bools WHERE id=? LIMIT 1
    ';
```

当然booleans 这个操作比较复杂，在使用SQL 语句的时候需要注意下面方法的区别：

     *  :#boolsPatch       
     *  :|boolsCheck
     *  :&boolsFullChecking

需要特别熟悉上面的修改和查询区别，才去使用，不熟悉的情况下不建议使用。


### 通过 mdl绑定 batchStructs 来批量插入数据
```php

$mdl->batchStructs = [
    [
        'id' => $_SERVER['REQUEST_TIME'], 
        'token' => '10f',
    ], 
    [
        'id' => $_SERVER['REQUEST_TIME'], 
        'token' => '11m',
    ]
]


// 然后在相应的 mdl 里面的insert 语句
// 如果是一般的数据绑定，那么就只插入一条数据
// 如果是batchStructs，就可以插入多条数据

const ADD = '
    INSERT INTO $tb (id, token) VALUES ? 
';
```


### 数据库分表   <a id="tableShard"></a>

对于数据量大的表，需要对数据库进行横向分表，
```php
    <?php
    namespace Mdl\AaTest;
    class ShardA extends \AbIf\Db\Mdl {
    
        // 分表字段名
        const TABLE_SHARD_FIELD = 'id';

        // 分表方法
        public static function tableShardIdx($id) {
            return $id % 2;                 // 按照 TABLE_SHARD_FIELD 字段 % 2 来分表
        }
        public static $tableStruct = [
            'shard_a_?',                        // 表名，使用 ? 代表拆分后的值，如这里只能是 0, 1
            'bools'  => [[0 => 'isA', 1 => 'isB', 2 => 'isC', 10 => 'isX']],
            'gender' => [ self::T_ENUM, [
                    0 => 0, 1 => 1, 2 => 2, 'f' => 2, 'm' => 1, 'u' => 0, 'female' => 2, 'male' => 1, 'unknown' => 0
                ], 'sex'
            ],
            'id' => [self::T_INT], 
        ];     
    
        const GET_VALUE = '
            SELECT * FROM WHERE id = ? LIMIT 1
        ';
```

### 数据库连表   <a id="tableJoin"></a>
```php
<?php

namespace Mdl\AaTest;

class ShardA_ShardB extends \AbIf\Db\MdlJoin {
    protected static $joinedTables = [              // 连的表
        '\Mdl\AaTest\ShardA', '\Mdl\AaTest\ShardB'
    ];

    public static $tableStruct = [        // 对连表重复的字段名，进行重新别名
        '$tbShardA.id' => ['aid'],
        /*    '$tbShardB.id' => ['bid'],*/
    ];

    public static $paramStruct = [
        'offset' => [self::T_INT],
    ];

    /**
     * 连表后的查询
     *  :offset 是通过 $mdl->set() 设置的变量，但是不属于表结构
     *  $table/$tb 都是单表的表名，$tableShardA  --> $table + $joinedTables 的表名，表示该表
     */
    const USER_LIST = '                 
        SELECT * FROM $tbShardA
          LEFT JOIN $tbShardB
          ON $tbShardA.id = $tbShardB.id
          ORDER BY $tbShardA.id DESC
          LIMIT :offset, 20
    ';
}
```

## Model 层控制 fields   <a id="fields"></a>
有时候数据库的字段无法满足API需求，或者需要对字段重新计算，那么可以在Model层自行修改。
如下面 `$db->fetchOneRow() / $db ->fetchRows()` ，如果没有指定，mapping_fields数组，那么就会把数据库查询出来的数据全部输出；如果指定了，那么只会输出指定的字段，而且在后面的 `function(&$qo){}` 里面可以对这些字段进行重新修改；

```php
<?php
namespace Model;
use Aa;
class User extends \AbIf\Db\Model {
    function api() {
        $token = $this->get('token');
        $redis = new \Predis\Client([
            'scheme' => 'tcp', 'host' => 'aa_redis', 'port' => 6379
        ]);
        $redis->set('token', $token);
        $db = \Unit\Mysqli::db();
        $mdl = new \Mdl\AaTest\ShardA_ShardB($this);
        $qs = $mdl->queryString($mdl::USER_LIST);
        
        return $db->fetchOneRow($qs, $mdl, 
            ['age', 'sex', 'SBP', 'DBP', 'BPM', 'time'],  // 选择保留的字段         
            function(&$qo){                                 // 对保留的字段进行修饰
                $age = $qo['age'];
                $sex = $qo['sex'];
                unset($qo['age']);          // 在这里又移除了字段 age, sex
                unset($qo['sex']);
                $sbp = $qo['SBP'];
                $dbp = $qo['DBP'];
                $determinations = self::determinations($sbp, $dbp, $qo['BPM'], $age, $sex);
                $qo = array_merge($qo, $determinations);        // 这里又进一步修饰了返回数据
        });
    }
    
    function api2() {
        ...
        $hello = ['name' => 'Aario', 'say' => 'Hello, Aario'];
        return $db->fetchOneRow($qs, $mdl, 
            ['age', 'sex', 'SBP', 'DBP', 'BPM', 'time'],  // 选择保留的字段         
            function(&$qo, $params){                                 // 对保留的字段进行修饰
                $age = $qo['age'];
                $sex = $qo['sex'];
                unset($qo['age']);          // 在这里又移除了字段 age, sex
                unset($qo['sex']);
                $sbp = $qo['SBP'];
                $dbp = $qo['DBP'];
                $determinations = self::determinations($sbp, $dbp, $qo['BPM'], $age, $sex);
                $qo = array_merge($qo, $determinations);        // 这里又进一步修饰了返回数据
                
                $qo['name'] = $params['name'];          // 这里对返回数据新增了
                $qo['say'] = $params['say'] . '!!!';
            },
            ['hello' => $hello]
        );
    }
}

```
 
## 设置多语言版本   <a id="language"></a>

可以在 aa_base.php 里面设置客户端获取多语言版本的方式，比如通过客户端传递参数 locale 来设置语言版本，
之后只需要把文件位置 append 到语言包数组就可以了

语言包文件案例：
```php
<?php

//     /AaPHP/vendor/aa/resources/lang/zh-cn.php
return [
    E_INTERNAL_SERVER => '服务器错误',

    /*
     AbIf\Db
     */
    'Field $0 = $1 is blocked by regexp or filter method' => '字段 $0 = $1 不符合规则', // Aa::req
    '$0 parameter is required' => '请传递参数$0', ' by HTTP method: $0' => '（以$0方式传递）',
    '$0 parameter is filtered by the regulation: $1' => '参数$0不符合过滤规则: $1',
    '$0 parameter should be in $1' => '参数$0必须在enum $1 中', '$0 field should be in $1' => '字段$0必须在enum $1 中',
];

```

语言包中 $0 - $9 ... 都是变量，通过 ::lang($fmt, $params...)， 使用方法案例如：



```php
<?php
// example/resources/lang/zh-cn.php
<?php
return [
    'account $0 exists..' => '账户$0已经存在',
];


<?php
Aa::err(E_CONFLICT, Aa::lang('account $0 exists..', $this->account));
```

如上面已经设置了中文版的语言包，如果已经设置好了使用中文版的语言包，那么假如传递来的账号Aario已经被注册了，那么就会返回错误，错误信息为：“账户`Aario`已经存在”；
而如果没有设置语言包，那么就输出英文“account `Aario` exists..'，也可以通过英文语言包对该句话替换。

```php
/**
 * $locale = 'zh-cn';
 * Setting locale, default is 'en'
 */
$locale = isset($_GET['locale']) && isset($locales[$_GET['locale']]) ? $_GET['locale'] : $locales[0];

Aa::appendLangMap(include $aa_root . '/resources/lang/' . $locale . '.php');
```

```php
<?php
class Aa extends \AbIf\Aa\Aa {
  
  // 可以在任意位置新增和覆盖语言包
  Aa::appendLangMap(include self::$appRoot . '/resources/lang/zh-cn.php';  
```


语言包的使用主要给  ::err() 或 ::exception()，

## 设置参数是否必传  <a id="filter"></a>

### 在Controller层设置参数过滤
```php
<?php
$p = Aa::request('spinal'); // 获取客户的传递来的 spinal，必传项，不传终止并报错

$p = Aa::request('spinal', false); // 可选传的变量，可以不传

$p = Aa::request(['GET' => 'spinal']);  // 必须要通过 GET 方式传递 spinal参数

$p = Aa::request('spinal', '/^\d+$/');  //  必传，必须符合数字型

$p = Aa::request('spinal', T_INT);     // 必传，无论传任何形式，都会被强转为整数

$p = Aa::request(['PUT' => 'spinal'], false);   // 可选，通过PUT传递

$p = Aa::request('spinal', /^[a-zA-Z]\w{5,15}$/, false); // 可选传，如果传了就必须符合正则规则

...

```
### 字段是否允许NULL
```php
<?php
    public static $tableStruct = [
        // 由于后面设置里面有个 true，如果使用到包含该字段的MySQL语句了（如果不包含，就不做判断） 那么该字段就是允许null值存在的
        // 可以就是客户端(access_token 参数）不传，到这里也不会有问题
        // 但是如果客户端传了，那么就必须匹配规则
        'token' => ['access_token', self::T_STRING, '/^\w{32}$/', true]
        
        // 这个就是不允许为 null ，也就是客户端没有传递 app_key 作为参数，或者Model层没有传递该值，那么就会终止，并报错告知前端
        'appkey' => ['app_key', self::T_STRING]  

    ];
```


## 设置API版本及代码   <a id="versioning"></a>

AaPHP 识别版本号的方式一般为两种，一种是直接Nginx伪静态URL路由识别version，另外一种就是HTTP header 里面请求版本号。

restful API 提倡添加API版本号，来兼容新旧版本的代码。而AaPHP在对版本号设置上面更为开放，可以根据项目的大小的不同来设置。

比如将一个版本号对应一个APP代码库，这以后可以方便将不同版本的代码直接放到不同服务器上，这样设置就很简单，如上面设置 example API 一样，来设定为版本号对应的目录就行了，这样以后直接共享框架，多个APP可以放到不同的服务器上……

如果项目较小，不太考虑分服务器放置不同版本号代码，那么直接把模块Module当作版本来使用，那么只需要在 Module/ 里面放上一个模块名做目录，在里面放上完整的 Prenter Model 就可以了，至于其他资源都可以共享外面的……

## 对路由和 view 的建议  <a id="routingAndView"></a>

建议使用 React.js + Redux ，或者 Angular II 来配合AaPHP使用，用以开发Web界面，这也是为什么AaPHP 没有搭建view层的原因。


Restful API 是我一直在学习和使用的API模式，类似这类 `/resource/service/$version/$param/$value/$param/$value ... ` 之类的美化URL的路由规则，毫无疑问用Web Server （Nginx/Apache）来处理路由，性能更优秀，而PHP来处理路由本身性能就很差（正则比较耗CPU）。而且Nginx可以支持 `nginx -t` 测试配置是否正确，以及`nginx -s reload` 来实时更新配置文件，这样为独立路由服务提供了更佳的体验。使用PHP做Web，肯定离不开Web Server这一层，而Web Server 这一层处理路由又是极其友好、性能卓越的。而之所以大部分都是通过应用层来做路由，其实也就是把 Nginx 归属运维管，应用层不方面经常改动。而 Nginx 的 include 独立 server 配置功能，以及 `nginx -t` 检查配置是否正确、`nginx -s reload` 运行中更新配置…… 这些优秀的功能为基础，只需要写一些简单的脚本做推送配置到所有服务器和Nginx server 子文件夹的权限归属应用层管理，以及开放一部分路由类的修改权给应用层，那么使用Nginx做路由并不比PHP做路由麻烦，反而能够大大的提升路由解析性能。

…… 


# AaPHP 的核心理念和未来规划  <a id="idea"></a>

## PHP 代码规范的差异

我刚开做程序员的时候，是没有什么代码规范的，代码注释频繁。后来代码越来越熟练，注释就越来越少，而且也查阅过Google、Facebook等规范，也曾大量问过不同公司的PHP程序员，都没有统一的规范。

* 谷歌Shell规范约定，Tab 是2个空格
* Facebook 底层代码规范，Tab 有1个空格的案例
* 我个人是属于大括号不换行习惯的

之后我就综合了一些规范，尝过过一种方案：

* class、namespace、abstract class 都采用大写字母开头
* 任何大写字母开头的，大括号都是换行
* 任何局部变量和参数，都是小写字母和下划线
* 常量只能用大写字母和下划线
* 由于空2个空格，更适合shell和HTML编程，所以我就统一采用了2个空格

```php

namespace \To\Be
class ToBeMySelf extends \Ethic::Reciprocity,
                         \TreatOthers::AsYouLike,
                         \No\Pain::NoGain,
                         \LoveYou::LoveMe
{
  const DO_YOU_LOVE_ME = true;
  private static $avgSalaries = [
    "CEO"       => 6000000
    "Cleaner"   => 4000
  ];
  public function __construct($gender, array $salary_arr, callable $fn) {
    if (parent::loveYou) {
        self::$avgSalaries = array_merge(self::avgSalaries, $salary_arr)
    }
  }
}

```


其实就好像上面，大括号不换行，是我的习惯。而由于类、接口、抽象类具有多继承的特点，所以就采用大括号换行，而且这些都是大写字母开头。而为什么采用驼峰式、下划线式，其实局部变量本质上都非常接近C语言的写法了，最重要的是，在C++这类可以省略self、this指针的语言，采用这种可以更清晰知道变量来源，特别适合我这种记性差的人。

比如下面：

```Swift

let salaryArr: [Int] = [
    "CEO"       : 6000000,
    "Cleaner"   : 4000
];

class ToBeMySelf : EthicReciprocity, TreatOthersAsYouLike, NoPainNoGain, LoveYouLoveMe {
    var salaryArr : [Int]()
    function init(_ salaryArr: [Int]) {
        ...
        print(salaryArr)
    }
}
```

如果一个函数内，写了一大串代码，而且Swift 和 C++ 是可以省略 this/self 指针的，最后会发现上面 salaryArr 会出现阅读歧义…… 当然上面代码简单，我们可以记得是参数，一旦代码复杂起来，记忆量需求就会大很多。

当然这些都不是重点，所以后来我越来越懒得折腾，就尽力采用主流的做法……

## AaPHP 的代码理念 —— 模块化、组件化、分工合作

主流的PHP框架已经数不胜数，而且很多公司又自己开发了各自的框架。以Yii为代表的繁复型框架，会将PHP原生语法整体封装一遍，至于又将Javascript/HTML 直接耦合入PHP代码，这种思路恰恰不是我所向往的。至于Gii，倒更像是对不懂MySQL的人，开发了一套代码自动生成程序…… 至于这类框架的性能也是可想而知的。

PHP 本质上就是一款C语言的Web框架了，我实在搞不懂为什么还有那么多人乐此不疲地去对一款本来就是“框架”的语言，再开发一套繁琐的框架。不过其实很明显，

而我是比较喜欢Phalcon、Yaf这类精简的框架的，因为我欣赏这类为了项目而开发的框架。这类框架的本质是为了实现一个项目，而不是为了去开发一套万能工具箱。

当然我不是很喜欢Yii的繁琐，不过我依旧大量的去学习Yii框架源代码，因为真的很优美，很值得一个初学者去拜读。而且在工作中，也碰到过很多公司自己内部的框架，对比一下，Yii框架的源码就实在是太优美了。

由于时间急促，当时我在设计AaPHP的时候，在源代码上，任何方法我都会先放到 Aa 类上面，当某些代码一旦形成一定的规模，那么我就会独立这些代码为一个类，所以源码在Aa 类上面会显得乱七八糟，也正是如此，什么最开始都加在这里，在形成一定规模之后才会被移植开来。

而且我以前形成的：分权分责思维方式，已经决定了我无法在代码上面接受OOP大一统的编码风格，不过我也在学习OOP图示化代码结构的分工思维，而且我也已经在 api.yaml 的设想中，已经能实现一定程度的代码抽象化分工。

即由上层技术人员去可视化抽象技术，然后由底层技术人员去实现技术细节。简而言之，就是未来 api.yaml （抽象的API描述文件） 将有富有经验的程序员或者技术经理来写，之后自动生成前后端代码，让其他程序员去实现细节。

我的编程思维理念是：模块化、组件化、微服务化； 同理管理思维理念就是：权责分明；我这里的组件可能和一些代码里面的组件接近，但是其实不太一致。包括我认可的组件化的公司架构，其实都是权责分明的一种诠释。

OOP大一统的风格，在人员流动的公司会存在风险。所有人都需要花很长时间深刻理解项目的OOP思维，之后才能开发出质量较好的代码，而这其中大部分员工知识获取的耗费的时间都是重复的，这样的体系下，所有员工的技术成长都会是全方位水平的，然后再有深度。自然这种体系下，如果项目成功了，能形成优秀程序员的只能是职位高的。

而组件化、微服务化的技术架构，可以让不同的员工负责不同的部分，减少了重复度，通过底层架构和共用组件、服务，又可以减少不同组件间的重复工作。这样一个团队，每个组件都会是垂直往下，也就会产生，同个项目中，可能某个组件开发的大牛，在另外一个组件上一窍不知，形同小白。这样的好处是，项目成功了，形成的优秀程序员会很多。最重要的是，对于公司而言，不必再像OOP那样要弄懂整个项目，特别是公用接口的使用，之后才能慢慢进入开发、慢慢写出优秀的代码…… 也就是所有人都需要一个重复的、甚至有些地方是无效的学习过程。而由于组件的划分相对独立，微服务的维度相对小，那么在技术招聘的时候，可以直接按不同的组件组来招人，学习成本更低、重复度也就更低，而且更垂直的工作，公司的技术深度也就会更深。


## 展望 AaPHP

其实很感谢以前的同事，他在开发过程中不断推陈出新的过程，在和我交流的时候，也都会被我一一吸收。下面是我对AaPHP 的一些未来发展的一些规划：
* api.yaml 由技术管理去写的抽象代码文件，自动生成前后端代码模板，自动生成API文档、自动做代码测试
* AutoView 自动根据HTTP 头 ACCEPT，来自动挂载 HTML/json/protobuf/xml 等数据格式
* Mdl层的性能调优，如果Opcache可以自动存储解析后的 tableStruct ，就不必太在意性能。如果不能，那么就尝试对 tableStruct 存入 Redis 来提升解析性能。
* 在代码风格上，不和Swift官方推荐的语法冲突，尽量模仿
* 学习好SOA，学深Restful，能做到Rest级别的API开发
* 有时间再玩，没时间就放着吧……未来可能更多的会整合PHP7 底层扩展到里面，或者其他语言中。






