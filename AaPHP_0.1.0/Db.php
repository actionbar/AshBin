<?php
/*
 +----------------------------------------------------------------------+
 | Database Abstract classes and Interfaces                             |
 +----------------------------------------------------------------------+
 | It's Aario Ai<AarioAi@gmail.com>'s original works. It's free and     |
 | under the terms of the Apache 2.0 License.                           |
 +----------------------------------------------------------------------+
 | Author: Aario Ai <AarioAi@gmail.com> https://github.com/AarioAi       |
 +----------------------------------------------------------------------+
 */

namespace AbIf\Db;

use Aa;

/**
 * Cache
 *  Server Storage:
 *    session (a simplest way for early days)
 *    redis (progressive)
 *  Client Storage:
 *    cookie (not support, an old and simplest way for early days)
 *    HTML5 localStorage / APP storage
 * @note Communication method
 *  cookie            ---[session id]---> cache in session
 *  HTML5/APP storage ---[token]---> cache in redis
 *    Login status:
 *      token  --> save cache to server only at the login status
 *      token is helpful to CSRF
 * @note Client Storage should be handle by client directly.
 */
abstract class Cache implements \AbIf\Data\DataAccess {

}

abstract class ClientCache extends Cache {
    const STATUS_ACTIVE = 0;
    const STATUS_CLOSED = 1;
    const STATUS_ERR = 5;   // there's something wrong with server. e.g.
    public static $status;     // default active

    /**
     * access token may change very often. So there should be a stable key name
     *  same as PHPSESSID /JSPSESSIONID ...
     */
    public static $cacheName = 'aacacheid';
    /**
     * @var string $cacheId
     *  null on closed
     */
    public $cacheId = null;

    public abstract function genCacheId();

    function reqCacheId() {
        $c = static::$cacheName;
        /**
         * $_REQUEST = $_SERVER['HTTP_' ?] + $_GET + $_POST
         */
        return isset($_REQUEST[$c]) ? $_REQUEST[$c] : null;
    }

    /**
     * notice client to store these data automatically
     */
    public abstract function notifyClient();

    function __construct($status = null) {
        if (null === $status || self::STATUS_ACTIVE === $status) {
            $this->cacheId = $this->reqCacheId();
            if (null === $this->cacheId)
                $this->genCacheId();
            self::$status = self::STATUS_ACTIVE;
        }
    }
}

/**
 * @note The difference between $db->con->query and $db->query
 *  $db->query() will stop when occurs any kind of error
 *  $db->con->query() is same as mysqli->query(), you need to capture error
 *    by yourself.
 *  similarly, $db->con->inserted_rows ...
 */
abstract class Sql {
    const FETCH_ASSOC = 1;
    const FETCH_NUM = 2;
    const FETCH_BOTH = 3;

    public $con;      // connection with configurations
    protected $queryResult;
    protected static $errHandler; // \AbIf\Aa\errHandle

    public abstract function transaction($cmd, $val = null);

    public abstract function query($queryString);

    /**
     * @param string $query_string
     *
     * @param \AbIf\Db\Mdl $mdl using $mdl->fetch() to convert to strong type
     * @param array|string $mapping_fields
     * @param array $params_of_fn both params for callable fn
     *      e.g. [Mysqli -> MYSQLI_ASSOC]
     * @param int $type
     *      e.g. Mysqli -> MYSQLI_ASSOC is default
     * @return mixed
     *      if is_array($mapping_fields)  return type array
     *      else return type string|int|float|double...
     */
    public abstract function fetchOneRow($queryString, \AbIf\Db\Mdl $mdl, $mappingFields = null, callable $fn = null, array $paramsOfFn = [], $mode = 0);

    public abstract function fetchRows($queryString, \AbIf\Db\Mdl $mdl, $mappingFields = null, callable $fn = null, array $paramsOfFn = [], $mode = 0);

    function __construct($connectedDb, \AbIf\Aa\errHandle $errHandler) {
        $this->con = $connectedDb;
        self::$errHandler = $errHandler;
    }

}


/**
 * It's a temporary plan
 */
abstract class Model extends \AbIf\Data\Struct {
    function __construct(\AbIf\Data\Struct $struct = null) {
        parent::__construct($struct);
    }
}

/**
 * Model Designing Layout
 * @supported
 *  SELECT flds FROM $tb WHERE id=? AND bools = (bools | ?) LIMIT :offset, :limit
 *  SELECT flds FROM $tb WHERE id=:id AND bools = (bools | :bools) LIMIT :offset, :limit
 *  SELECT $tb0.fld, $tb1.* FROM $tb0 LEFT JOIN tb1 ON id ...
 * @todo make it more clearly
 *    SELECT * FROM (
 *      SELECT id AS ID, age AS ageRange FROM $tb ORDER BY id DESC
 *    ) GROUP BY ageRange ORDER BY ID desc LIMIT :offset, :limit
 */
abstract class Mdl extends Model {

    /*  const T_8 = 8;      // tinyint
      const T_U8 = 100;   // unsigned tinyint   0-255
      const T_16 = 16;    // smallint
      const T_U16 = 116;  // unsigned short/smallint
      const T_24 = 24;    // mediumint
      const T_U24 = 124;  // unsigned medium int
      const T_32 = 32;    // int
      const T_U32 = 132;  // unsigned int
      const T_64 = 64;    // bigint
      const T_U64 = 164;  // unsigned bigint*/

    /**
     * Even though Mdl is design for DBA, and all DBAs know tinyint/unsigned tinyint.
     *  The type detail is not so important in Mdl, keep the int type only for the
     *  principle `keep it simple and stupid`.
     */
    const T_INT = 0.32;
    const T_SMALLINT = 0.32;
    const T_BIGINT = 0.32;
    const T_MEDIUMINT = 0.32;



    const T_ENUM = 0.33;   // simulate enum, convert from string to int
    const T_BIN_BOOLS = 0.2;    // a combined binary boolean values

    /*  const T_TINYINT = 8;
      const T_SMALLINT = 16;
      const T_MEDIUMINT = 24;
      const T_BIGINT = 64;*/

    const T_FLOAT = 0.14;
    const T_DOUBLE = 0.14;
    const T_DECIMAL = 0.14;

    const T_CHAR = 0.90;
    const T_VARCHAR = 0.90;


    const T_BINARY = 0.98;

    const T_JSON = 0.107;      // e.g. json
    const T_PROTOBUF = 0.108;


    /**
     * @var array table structure
     *  int type,
     *  string
     *    \w+  mapping name,
     *    [\w\\]+  callable filter, extends from \AbIf\Validator
     *    ^/.+/ig$      regexp
     *  bool allow null
     *  array only for enum and bools
     *    'field name' =>[
     *      enum      int ::T_ENUM, [array], [string]
     *      bools     [int ::T_BIN_BOOLS], array
     *      normal    int, string, bool
     *    ]
     *  Details
     *    [
     *        'table_name',
     *        'simulate enum field' => [
     *          self::T_ENUM
     *          ['weibo'=>1, 'qq'=>2, 'weixin'=>3],
     *          mapping_field_name,
     *          '/regexp/',
     *          '\Validator\validator',
     *        ],
     *                 //   binary exponent , 2^0 2^1 2^2 ...
     *         'field name' => [[
     *                      exponent => 'mapping name',
     *                      exponent => 'mapping name',
     *                      ]],
     *         'field name 2' => [[
     *                      exponent => 'mapping name',
     *                      exponent => 'mapping name',
     *                      ]]
     *
     *
     *         real_field => [     // sequence is not necessary
     *                  mapping_field,      //
     *                  int type,               //
     *                  bool allow null,        // [optional] true | false(default)
     *        ]
     *
     *  e.g. [
     *        'tb',
     *        'sex' => [self::T_ENUM, [
     *                          'f'=>1, 'm'=>2, 'u'=>0,
     *                          0=>0, 1=>1, 2=>2,
     *                          'female'=>1, 'male'=>2, 'unknown'=>0,
     *                        ], 'gender'],
     *        'xname2' => [self::T_ENUM, ['weibo'=>1, 'qq'=>2, 'weixin'=>3], 'ClientName'],
     *        'bools_fld' => [[0=>'isA', 1=>'isB', 2=>'isC', 3=>'isD']],
     *        'bools_fld2' => [self::T_BIN_BOOLS, [0=>'isDrinker', 1=>'isSmoker']],
     *        'id' => ['ShowId', self::T_INT, 'static::genId'],
     *        'email' => [self::T_VARCHAR, '\Validator::Email'],
     *        'mobile' => [self::T_VARCHAR, '/^1[5-9]\d{9}$/'],
     *      ]
     * @warning ::getOrderedTableStruct will add some elements to ::$tableStruct
     *  please keep in mind to avoid any kind of 'k' => 'string' element in
     *    ::$tableStruct
     *  TABLE_NAME_     the table name
     *  TABLE_NAME_0_ / TABLE_NAME_1_ ...
     *  TABLE_NAME_Cls0_ / TABLE_NAME_Cls1_
     *  IS_PREPARED_
     *
     */
    //public static $tableStruct;

    // public static $paramStruct;
    /**
     * @note paramStruct is just a suggestion for parameters assignment. e.g., to
     *  assign `SELECT * FROM tb LIMIT offset, limit` offset and limit are both not
     *  structure of the table, they are all parameters. So you have to use:
     *  `SELECT * FROM tb LIMIT :offset, :limit` to indicate.
     *  public static $paramStruct = [        // it's not necessary
     *    'offset' => [self::T_INT],
     *    'limit' =>  [self::T_INT],
     *  ];
     *  Using a $paramStruct to make sure the type and the default value, e.g.
     *  if there is no offset assigned in Model, which means :offset is null. You'll
     *  get a SQL sentence `SELECT * FROM tb LIMIT ,20`. It'll make mistakes.
     *  With a $paramStruct as above, the :offset will be casted to (int)NULL, equals 0,
     *  even without assigning.
     */
    private static function preparedParamStruct() {
        $paramStruct = static::$paramStruct;
        if (!empty($paramStruct) && empty($paramStruct['IS_PREPARED_'])) {
            foreach ($paramStruct as $param => &$paramAttrs) {
                foreach ($paramAttrs as $paramAttr) {
                    $preparedParamAttrs = [];
                    if (is_float($paramAttr)) {
                        $preparedParamAttrs['TYPE_'] = $paramAttr;
                    } else if (is_bool($paramAttr)) {
                        $preparedParamAttrs['ALLOW_NULL_'] = $paramAttr;
                    }
                }
                if (!isset($prepared_param_attrs['ALLOW_NULL_'])) {
                    $preparedParamAttrs['ALLOW_NULL_'] = false;
                }
                $paramAttrs = $preparedParamAttrs;
            }
            $paramStruct['IS_PREPARED_'] = true;
            static::$paramStruct = $paramStruct;
        }
        return $paramStruct;
    }

    protected static function arrangeFieldAttrs($fld, array $fieldAttrs, array &$preparedFieldAttrs) {
        //    if(is_string($fld) && is_array($fieldAttrs)){
        foreach ($fieldAttrs as $i => $fieldAttr) {
            if (is_float($fieldAttr)) {
                $preparedFieldAttrs['TYPE_'] = $fieldAttr; /**
             * http://php.net/manual/zh/filter.filters.validate.php
             * FILTER_VALIDATE_BOOLEAN
             * FILTER_VALIDATE_EMAIL
             * FILTER_VALIDATE_FLOAT
             * FILTER_VALIDATE_INT
             * FILTER_VALIDATE_IP
             * FILTER_VALIDATE_MAC
             * FILTER_VALIDATE_REGEXP
             * FILTER_VALIDATE_URL
             */
            } else if (is_int($fieldAttr)) {
                $preparedFieldAttrs['FILTER_VAR_'] = $fieldAttr;
            } else if (is_bool($fieldAttr)) {
                $preparedFieldAttrs['ALLOW_NULL_'] = $fieldAttr;
            } else if (is_array($fieldAttr)) {
                $preparedFieldAttrs['SUB_VALUES_'] = $fieldAttr;
            } else if (is_string($fieldAttr)) {
                if ('/' == $fieldAttr{0}) {    // regexp    /Lef/i
                    $preparedFieldAttrs['REGEXP_'] = $fieldAttr;
                } else if (strpos($fieldAttr, '::')/*&& is_callable($fieldAttr)*/) {   // in order to make the parameters much more simple to identify, any callable validators should be static functions in a class
                    $preparedFieldAttrs['VALIDATOR_'] = $fieldAttr;
                } else {
                    $preparedFieldAttrs['NAME_TO_CLIENT_'] = $fieldAttr;
                }
            } else
                $preparedFieldAttrs[$i] = $fieldAttr;     // unknown
        }
        if (!isset($preparedFieldAttrs['TYPE_']) && isset($preparedFieldAttrs['SUB_VALUES_'])) {
            $preparedFieldAttrs['TYPE_'] = self::T_BIN_BOOLS;
        }
        if (!isset($preparedFieldAttrs['SUB_VALUES_']) && !isset($preparedFieldAttrs['ALLOW_NULL_'])) {
            $preparedFieldAttrs['ALLOW_NULL_'] = false;
        }
        if (self::T_BIN_BOOLS !== $preparedFieldAttrs['TYPE_'] && empty($preparedFieldAttrs['NAME_TO_CLIENT_'])) {
            $preparedFieldAttrs['NAME_TO_CLIENT_'] = $fld;
        }
        //    }
    }

    protected static function preparedTableStruct($tableStruct = null) {
        $fromStatic = empty($tableStruct);
        if ($fromStatic) {
            $tableStruct = static::$tableStruct;
        }
        if (empty($tableStruct['IS_PREPARED_'])) {
            foreach ($tableStruct as $field => &$fieldAttrs) {
                if (is_int($field) && is_string($fieldAttrs)) {
                    $tableStruct['TABLE_NAME_'] = $fieldAttrs;
                    unset($tableStruct[$field]);
                    continue;
                }
                if (is_string($field) && is_array($fieldAttrs)) {
                    $preparedFieldAttrs = [];
                    self::arrangeFieldAttrs($field, $fieldAttrs, $preparedFieldAttrs);
                    $fieldAttrs = $preparedFieldAttrs;
                }
            }
            $tableStruct['IS_PREPARED_'] = true;
            if ($fromStatic) {
                static::$tableStruct = $tableStruct;
            }
        }
        return $tableStruct;
    }


    private $valsWithRealFields;

    function __construct(\AbIf\Data\Struct $struct = null) {
        parent::__construct($struct);
    }

    /*  function rebuildTable(){

      }*/
    /**
     * @param mixed $fetchedArray by mysqli fetch_array(MYSQLI_ASSOC|MYSQLI|BOTH|MYSQLI_NUM) or fetch_assoc()
     *  e.g. ['id'=>100, 'name'=>'Aario Ai']
     * @param array $mappingFields null on return $fetched_array
     *  e.g. ['mappingId', 'name']
     * @return mixed $fetched_array
     *    e.g. ['mappingId'=>100, 'name'=>'Aario Ai']
     */
    function fetch(array $fetchedArray, array $mappingFields = null) {

        $ref_tb_struct = self::preparedTableStruct();
        //var_dump($ref_tb_struct);

        //var_dump($fetched_array);

        foreach ($ref_tb_struct as $fld => $fieldAttrs) {
            if (!is_array($fieldAttrs))
                continue;

            // bools
            if (self::T_BIN_BOOLS === $fieldAttrs['TYPE_']) {

                $hashed_fld_name = str_replace('.', '_Aa_BOOLS_', $fld);
                // var_dump($hashed_fld_name);
                if (array_key_exists($hashed_fld_name, $fetchedArray)) {
                    $num = (int)$fetchedArray[$hashed_fld_name];
                    $bools_names = $fieldAttrs['SUB_VALUES_'];
                    $ref_sz = count($bools_names);
                    for ($exponent = 0; $exponent < $ref_sz; ++$exponent) {
                        if (empty($mappingFields) || in_array($bools_names[$exponent], $mappingFields)) {
                            $fetchedArray[$bools_names[$exponent]] = ~($num + 1) & 1;
                        }
                        $num = $num >> 1;
                    }
                    unset($fetchedArray[$hashed_fld_name]);
                }
                unset($ref_tb_struct[$fld]);
            } else {     // enum included
                $name_to_client = $fieldAttrs['NAME_TO_CLIENT_'];
                if ($name_to_client != $fld) {
                    $ref_tb_struct[$name_to_client] = $fieldAttrs;
                    unset($ref_tb_struct[$fld]);
                }
            }
        }

        if (empty($mappingFields))
            $mappingFields = $fetchedArray;

        foreach ($mappingFields as $fld => $val) {
            if (is_int($fld)) {
                unset($mappingFields[$fld]);
                $fld = $val;
                $val = $fetchedArray[$val];
            }

            if (isset($ref_tb_struct[$fld])) {
                $fieldAttrs = $ref_tb_struct[$fld];

                if (null === $val && $fieldAttrs['ALLOW_NULL_']) {
                    break;
                }
                switch ($fieldAttrs['TYPE_']) {
                    //          case self::T_BINARY:
                    //
                    //            break;
                    //          case self::T_BIN_BOOLS:
                    //
                    //            break;
                    case self::T_ENUM:
                        $val = array_search($val, $fieldAttrs['SUB_VALUES_']);
                        break;
                    case self::T_INT:
                        $val = (int)$val;
                        break;
                    case self::T_FLOAT:
                        $val = (float)$val;
                        break;
                    case self::T_VARCHAR:
                        // $val = str_replace('\"', '"', $val);
                        // $rtn[$val] = $val;
                        break;
                    default:
                        //$rtn[$val] = $val;
                }
            }

            $mappingFields[$fld] = $val;

        }
        return $mappingFields;
    }

    private $tmpVars = [];

    private function castToType(array $attr, $val = null) {
        if (null === $val && !empty($attr['ALLOW_NULL_'])) {
            return null;
        }
        switch ($attr['TYPE_']) {
            case self::T_INT:
            case self::T_BIN_BOOLS:
            case self::T_BINARY:
                return (int)$val;     // (int)null
                break;
            case self::T_FLOAT:
                return (float)$val;
                break;
            case self::T_VARCHAR:
                return (string)$val;      // (string)null
                break;
            default:
                return $val;
        }
    }

    private function parseValsToRealFields() {
        /**
         *  1. Data::dataStruct
         *  2. $tmpVars, e.g.  page
         *  3. array_diff_key($mapping_vals, ::$tmpVars)
         * @note be careful about the same name
         *  tb1 'id' => [self::T_INT, 'uid']
         *  tb2 'uid' => [self::T_INT]
         *  In this case $this->get('uid') should be kept instead of unset()
         */
        $mappingVals = $refValsTmp = $this->get();

        //var_dump($mapping_vals);
        $realFldVals = $this->valsWithRealFields;

        /*************** Setting values with real fields start *********/
        if (empty($realFldVals) || !empty(array_diff_key($mappingVals, $this->tmpVars))) {

            $realFldVals = [];
            $tbStruct = self::preparedTableStruct();

            //var_dump($tb_struct);

            foreach ($tbStruct as $fld => $fieldAttrs) {
                if (!is_array($fieldAttrs)) {
                    continue;
                }
                if (self::T_BIN_BOOLS === $fieldAttrs['TYPE_']) {
                    $mappingNames = $fieldAttrs['SUB_VALUES_'];
                    $num = 0;
                    $eachValueInBools = [];

                    foreach ($mappingNames as $exponent => $refName) {
                        if (isset($mappingVals[$refName])) {
                            $eachValueInBools[$exponent] = $mappingVals[$refName];
                            if (1 === $mappingVals[$refName]) {
                                $num += 1 << $exponent;
                            }
                            unset($refValsTmp[$refName]);
                        }
                    }
                    $eachValueInBools['SUM_'] = $num;
                    $realFldVals[$fld] = $eachValueInBools;
                    //$real_fld_vals[$fld] = $num;
                } else if (self::T_ENUM === $fieldAttrs['TYPE_']) {

                    if (isset($mappingVals[$fieldAttrs['NAME_TO_CLIENT_']])) {
                        $enums = $fieldAttrs['SUB_VALUES_'];
                        $enum = $mappingVals[$fieldAttrs['NAME_TO_CLIENT_']];
                        // @todo remove \Aa::error()
                        if (!isset($enums[$enum])) {
                            //trigger_error('`'.$fld.'` should be in '. json_encode(array_keys($enums)), E_USER_ERROR);
                            if (isset($tbStruct[$fld]) && isset($tbStruct[$fld]['NAME_TO_CLIENT_'])) {
                                Aa::error(E_NOT_ACCEPTABLE, Aa::lang('$0 parameter should be in $1', $tbStruct[$fld]['NAME_TO_CLIENT_'], json_encode(array_keys($enums))));
                            } else {
                                Aa::error(E_INTERNAL_SERVER, Aa::lang('$0 field should be in $1', $fld, json_encode(array_keys($enums))));
                            }
                        }
                        $realFldVals[$fld] = $enums[$enum];
                        unset($refValsTmp[$fieldAttrs['NAME_TO_CLIENT_']]);
                    }

                } else {
                    $fldSplitPos = strpos($fld, '.');
                    $mappingName = empty($fieldAttrs['NAME_TO_CLIENT_']) ? ((false != $fldSplitPos) ? substr($fld, $fldSplitPos + 1) : $fld) : $fieldAttrs['NAME_TO_CLIENT_'];
                    /**
                     * @warning  null value may exist
                     */
                    if (array_key_exists($mappingName, $mappingVals)) {
                        $val = $mappingVals[$mappingName];
                        unset($refValsTmp[$mappingName]);
                        /*   if(null === $val && $fieldAttrs['ALLOW_NULL_']) {
                             $real_fld_vals[$fld] = null;
                             continue;
                           }*/
                        $val = $this->castToType($fieldAttrs, $val);
                        if ($val !== null && ((isset($fieldAttrs['FILTER_VAR_']) && !filter_var($val, $fieldAttrs['FILTER_VAR_'])) || (isset($fieldAttrs['REGEXP_']) && !preg_match($fieldAttrs['REGEXP_'], $val)) || (isset($fieldAttrs['VALIDATOR_']) && !call_user_func_array($fieldAttrs['VALIDATOR_'], [&$val]))  /* Note that the parameters for call_user_func() are not passed by reference.. Using call_user_func_array() instead */)) {
                            //trigger_error('Field `'. $fld .'` = `'. $val .'` is blocked by regexp or filter method', E_USER_ERROR);
                            Aa::error(E_BAD_REQEUST, Aa::lang('$0 parameter is filtered by the regulation: $1', $val, $fld), __FILE__ . ':' . __LINE__ . '  Field `' . $fld . '` = `' . $val . '` is blocked by regexp or filter method');
                        }
                        $realFldVals[$fld] = $val;
                    }
                }
            }

            /**
             * Status 1. not be listed in $table, e.g. page
             * Status 2.
             */
            //  if(!empty($vals_with_ref_flds))
            //    $vals_with_real_flds = array_merge($vals_with_real_flds, $vals_with_ref_flds);

            $this->reset($refValsTmp);
            $this->tmpVars = $refValsTmp;

            if (!empty($this->valsWithRealFields) && is_array($this->valsWithRealFields)) {
                /**
                 * @warning $vals_with_real_flds must be the last parameter to array_merge().
                 *  Becuase it needs overwrite the same key in ::valsWithRealFields
                 */
                $realFldVals = array_merge($this->valsWithRealFields, $realFldVals);
            }
            $this->valsWithRealFields = $realFldVals;
        }

        //var_dump($real_fld_vals);
        return $realFldVals;
        /*************** Setting values with real fields end *********/
    }


    /**
     * @param $fields
     *  that be splited by comma,
     *        'tb.fl1, tb.fl2'
     *        'tb.*'
     *        '*'
     *        'tb1.*,tb2.*'
     * @return string e.g. 'tb.fl1 as MappingName1, tb.fl2 as Ref2'
     */
    protected function selectAs($fields) {
        $fields = str_replace(['`', ' ', "\n", "\r", "\r\n"], '', $fields);
        $fields = explode(',', $fields);
        $asFields = '';
        $tbStruct = self::preparedTableStruct();
        /**
         * @warning
         *  notice 'tb1.fld1, *, tb2.*, tb3.fld3 from tb2'
         */
        foreach ($fields as $field) {
            $asteriskPos = strpos($field, '*');
            if (false !== $asteriskPos) {      // notice 0 on '*', false on not found
                $specificTb = 0 == $asteriskPos ? null : substr($field, 0, -2);    // from 'tb2.*' to 'tb2'
                foreach ($tbStruct as $fld => $fieldAttr) {
                    if (!is_array($fieldAttr) || (!empty($specificTb) && 0 !== strpos($fld, $specificTb))) {
                        continue;
                    }
                    $tbFldSepPos = strpos($fld, '.');

                    //if(!isset($fieldAttr[0]))
                    //  continue;
                    //bools
                    if (self::T_BIN_BOOLS === $fieldAttr['TYPE_']) {
                        if (false == $tbFldSepPos) {    // 0 or false
                            $boolFldSafe = '`' . $fld . '`';
                        } else {
                            if (!empty($this->tableShardMapping)) {
                                $tb = substr($fld, 0, $tbFldSepPos);
                                $fldWithoutTbName = substr($fld, $tbFldSepPos);
                                if (isset($this->tableShardMapping[$tb])) {
                                    $fld = $this->tableShardMapping[$tb] . $fldWithoutTbName;
                                }
                            }
                            $boolFldSafe = $fld;
                        }
                        $asFldNameSafe = str_replace('.', '_Aa_BOOLS_', $fld);
                        $asFields .= ',' . $boolFldSafe;
                        if ($fld != $asFldNameSafe) {
                            $asFields .= ' AS `' . $asFldNameSafe . '`';
                        }
                    } else {
                        if (false == $tbFldSepPos) {
                            $fldSafe = '`' . $fld . '`';
                        } else {
                            if (!empty($this->tableShardMapping)) {
                                $tb = substr($fld, 0, $tbFldSepPos);
                                $fldWithoutTbName = substr($fld, $tbFldSepPos);
                                if (isset($this->tableShardMapping[$tb])) {
                                    $fldSafe = $this->tableShardMapping[$tb] . $fldWithoutTbName;
                                }
                            } else {
                                $fldSafe = $fld;
                            }
                        }
                        $asFields .= ',' . $fldSafe;   // unmatched is also included
                        if ($fld != $fieldAttr['NAME_TO_CLIENT_']) {  // enum is included
                            $asFields .= ' AS `' . $fieldAttr['NAME_TO_CLIENT_'] . '`';
                        }
                    }
                }
            } else {
                $fldPos = strpos($field, '.');
                $fieldSafe = false == $fldPos ? '`' . $field . '`' : $field;
                // maybe $tb.id, check $tb_struct['id']
                if ($fldPos && !isset($tbStruct[$field])) {
                    $tmpFld = substr($field, strpos($field, '.') + 1);
                    if (isset($tbStruct[$tmpFld])) {
                        $field = $tmpFld;
                    }
                }
                //bools
                if (isset($tbStruct[$field]) && self::T_BIN_BOOLS === $tbStruct[$field]['TYPE_']) {
                    $asFldName = str_replace('.', '_Aa_BOOLS_', $field);

                    $asFields .= ',' . $fieldSafe;
                    if ($field != $asFldName) {
                        $asFields .= ' AS `' . $asFldName . '`';
                    }
                } else if (isset($tbStruct[$field])) {
                    if ($field != $tbStruct[$field]['NAME_TO_CLIENT_']) {
                        $asFields .= ',' . $fieldSafe . ' AS `' . $tbStruct[$field]['NAME_TO_CLIENT_'] . '`';
                    } else {        // e.g. SELECT `id` FROM
                        $asFields .= ',' . $fieldSafe;
                    }
                } else {        // e.g. SELECT COUNT(*) FROM... SELECT 1 FROM ...
                    $asFields .= ',' . $field;      // unmatched or matched
                }
            }
        }

        $asFields = substr($asFields, 1);
        $asFields = ' ' . $asFields . ' ';

        return $asFields;
    }

    /**
     * @example
     *  const TABLE_SHARD_FIELD = 'uuid';
     *  static function tableShardIdx($uuid){
     *    return substr($uuid, 0, 2);
     *  }
     * @result int table id
     */
    //
    static function tableShardIdx($uid) {
        return $uid % 10;
    }

    private $tableShardMapping;

    /**
     * @param string $tbName
     *  $tb  or  $table   --> static::tableStruct['TABLE_NAME_']
     *  $tbTest  $tb0
     *  test
     */
    function tableName($tbName = null) {
        $tbStruct = $this->preparedTableStruct();

        if (null === $tbName || '$tb' == $tbName || '$table' == $tbName) {
            $table = $tbStruct['TABLE_NAME_'];
            if (false !== strpos($table, '?')) {      // 0 is matching
                $vals = $this->parseValsToRealFields();
                $shardFld = static::TABLE_SHARD_FIELD;
                $idx = static::tableShardIdx($vals[$shardFld]);
                $tmpTableName = $table;
                /**
                 * static::$tableStruct['TABLE_NAME_'] should not be re-assign the table name with index; Otherwise,
                 *  it'll create the number of index static variables.
                 */
                $table = str_replace('?', $idx, $table);
                $this->tableShardMapping[$tmpTableName] = $table;
            }
            return $table;
        }

        if (0 === strpos($tbName, '$')) {
            /**
             * 3 equals strlen('$tb')
             * 6 equals strlen('$table')
             */
            $prefix_len = 0 === strpos($tbName, '$tb') ? 3 : 6;
            //if(isset($tb{$prefix_len + 1}))       // TABLE_NAME_0_   TABLE_NAME_Test_
            $parsed_tb_name = 'TABLE_NAME_' . substr($tbName, $prefix_len) . '_';
            $table = $tbStruct[$parsed_tb_name];
            if (strpos($table, '?')) {
                $vals = $this->parseValsToRealFields();
                $shardFld = $tbStruct[$table . '_TABLE_SHARD_FIELD_'];
                $static = isset($tbStruct[$table . '_CALLABLE_TABLE_SHARD_IDX_']) ? $tbStruct[$table . '_CALLABLE_TABLE_SHARD_IDX_'] : self;
                $idx = $static::tableShardIdx($vals[$shardFld]);
                $tmpTableName = $table;
                /**
                 * static::$tableStruct['TABLE_NAME_'] should not be re-assign the table name with index; Otherwise,
                 *  it'll create the number of index static variables.
                 */
                $table = str_replace('?', $idx, $table);
                $this->tableShardMapping[$tmpTableName] = $table;
            }
            return $table;
        } else {
            return $tbName;
        }
    }

    /**
     * Inline parameters: table name
     *  SELECT $tb.id, $table.name, test.age FROM $tb ...
     *  SELECT * FROM $table ...
     *  SELECT $tb0.id FROm $table0 ...
     *  SELECT $tbTest.id FROM $tableTest ...
     */
    function queryString($pdoQs) {
        /**
         * DO NOT filter blanks near [=()], e.g.
         *  SELECT * FROM tb WHERE a='100= 100';
         */
        $pdoQs = str_replace(["\r\n", "\r", "\n"], '', $pdoQs);
        /**
         * @example
         *  `SELECT $tb.id, $tb.name FROM $tb`
         */
        preg_match_all('/(\$t(b|able)\w*)([\s\.]?)/', $pdoQs, $tbMatches);
        $replacements = $tbMatches[0];
        $tbs = $tbMatches[1];
        $suffixes = $tbMatches[3];
        foreach ($replacements as $i => $replacement) {
            $replaceTo = $this->tableName($tbs[$i]) . $suffixes[$i];
            $pdoQs = str_replace($replacement, $replaceTo, $pdoQs);
        }
        // SELECT fld1, tb2.fld1 FROM   ====> $this->selectAs('fld1, tb2.fld1')
        /**
         * \s is necessary      SELECT id, name FROM ...
         */
        preg_match_all('/SELECT\s([`\w\.\,\*\s]+?)\sFROM\s+(\w+)\s/i', $pdoQs, $selectAs);
        $saReplacements = $selectAs[0];
        $saFlds = $selectAs[1];
        $saTbs = $selectAs[2];
        foreach ($saReplacements as $i => $replacement) {
            $replaceTo = 'SELECT ' . $this->selectAs($saFlds[$i]) . ' FROM ' . $saTbs[$i] . ' ';
            $pdoQs = str_replace($replacement, $replaceTo, $pdoQs);
        }

        /**
         *  :fld1&:fld2
         *  :offset, :limit
         *  :|bools
         *  :&bools
         *  :#bools
         * @warn
         *  2016:10:10
         *  (uid) VALUES (:uid), (:uid2)
         */
        preg_match_all('/([^\w\:])(\:[^\s][\w\.]+)([^\w]?)/', $pdoQs, $paramMatches);
        if (!empty($paramMatches)) {
            $replacements = $paramMatches[0];
            $param_prepends = $paramMatches[1];
            $paramAppends = $paramMatches[3];
            $params = $paramMatches[2];
            //$params = array_unique($params);
            foreach ($replacements as $i => $replacement) {
                $replaceTo = $this->handleParam($params[$i]);
                if (null !== $replaceTo) {
                    $replaceTo = $param_prepends[$i] . $replaceTo . $paramAppends[$i];
                    $pdoQs = str_replace($replacement, $replaceTo, $pdoQs);
                }
            }
        }


        //var_dump($pdo_qs);

        // tb.fld=?, fld=?   =====>  $this->stmt(',' 'tbfld,fld')

        /**
         * tb.bools=?|tb.bools AND ...
         *   tb.bools=(tb.bools | ?)  ===> bools = ? | bools
         *  bool=fld | ?
         * avoid  converting from tb.bools=?|tb.bools   to  ?=tb.bools|tb.bools
         * @warning don't forget add a blank to the end
         */
        //$pdo_qs = preg_replace('/([\w\.]+)\s*=\s*\(?\s*([\w\.]+)\s*([^\w\s\.\,=])\s*\?\s*\)?/', '$1=?$3$2 ', $pdo_qs);
        //$pdo_qs = preg_replace('/([\w\.]+)\s*=\s*\(?\s*\?\s*([^\w\s\.\,=])\s*([\w\.]+)\s*\)?/', '$1=?$2$3 ', $pdo_qs);
        /**
         * The blanks near the operator have been removed already.
         * @warning the different conditions
         *   WHERE (tb.x=?)
         *   WHERE tb.a=? AND b=? AND c=?
         *   tb.a=?,b=?
         *   SET a=? ,b=?, tb.bools=? & tb.bools
         *
         * @warning avoid replace `uid`=100 which makes `guid` to g `uid`=100
         */

        preg_match_all('/[^\w]([\w\.]+)\s*([^\s\w]+)\s*\?/', $pdoQs, $constraints);
        $replacements = $constraints[0];
        $fields = $constraints[1];
        $operators = $constraints[2];
        foreach ($replacements as $i => $replacement) {
            // notice: $constraint_flds will prepend with [,\s]
            // stmt will remove redundant character, esp. [^\w], $prepend
            $replaceTo = $replacement{0} . $this->stmt($operators[$i] . $fields[$i]);
            $pdoQs = str_replace($replacement, $replaceTo, $pdoQs);
        }

        /**
         * db> INSERT INTO $tb (fld0, fld1) VALUES ?
         */
        preg_match_all('/\(\s*(([\w\.]+\s*,?\s*)+)\)\s*VALUES\s*\?/', $pdoQs, $matches);
        $replacements = $matches[0];
        foreach ($replacements as $i => $replacement) {
            $sequentFlds = str_replace(' ', '', $matches[1][$i]);
            $replaceTo = '(' . $sequentFlds . ') VALUES ' . $this->insertingValues($sequentFlds);
            $pdoQs = str_replace($replacement, $replaceTo, $pdoQs);
        }

        return $pdoQs;
    }

    /**
     * @param array $values
     *  db> INSERT INTO $tb (fld0, fld1) VALUES (1,2), (3,4) ....
     * @example
     *  $mdl_log_ope->batchStructs = [
     * [
     * 'uid' => $uid,
     * 'type' => 'email',
     * 'val' => 'dd',
     * 'verify_by' => 'email',
     * 'ctime' => $_SERVER['REQUEST_TIME']
     * ], [
     * 'uid' => 1,
     * 'type' => 'password',
     * 'val' => '2222222',
     * 'verify_by' => 'email',
     * 'ctime' => $_SERVER['REQUEST_TIME']
     * ]
     * ];
     */
    public $batchStructs;

    private function insertingValues($flds) {
        $rtn = '';
        $values = $this->batchStructs;
        if (empty($values)) {
            return '(' . $this->stmt(',', $flds, true) . ')';
        } else {
            foreach ($values as $vals) {
                $this->set($vals);
                $rtn .= ',(' . $this->stmt(',', $flds, true) . ')';
            }
            return substr($rtn, 1);
        }
    }


    private function quoteOrNot($type, $val = null) {
        switch ($type) {
        case self::T_VARCHAR:      // esp. be careful about json
            if (null === $val) {
                return '""';
            }
            $val = str_replace('"', '\"', $val);
            $val = str_replace("'", "\'", $val);
            return '"' . $val . '"';
            break;
        default:      // T_BINARY T_BIN_BOOLS T_INT T_FLOAT ...
            return $val;
        }
    }

    function boolsPatch($fld) {
        $fSafe = false == strpos($fld, '.') ? '`' . $fld . '`' : $fld;  // 0 is false too
        $realFldVals = $this->parseValsToRealFields();
        $tb_struct = $this->preparedTableStruct();
        $vals = $realFldVals[$fld];
        $bits = $tb_struct[$fld]['SUB_VALUES_'];
        $highestBit = max(array_keys($bits));
        $max = (1 << ($highestBit + 1)) - 1;
        $rtn = '';
        for ($i = $highestBit; $i >= 0; --$i) {
            if (isset($vals[$i])) {
                $val = $vals[$i];
                if ($val > 0) {
                    $rtn .= ',' . $fSafe . '=(' . $fSafe . '|' . (1 << $i) . ')';
                } else {
                    /**
                     * make position $i 0 and others all 1 .
                     *  e.g. if $max = `1111`
                     *    $i=0;    ==> $vacancy = `1110`
                     *    $i=1;    ==> $vacancy = `1101` ...
                     */
                    $vacancy = ($max & ($max << ($i + 1))) | ($max >> ($highestBit - $i + 1));
                    $rtn .= ',' . $fSafe . '=(' . $fSafe . '&' . $vacancy . ')';
                }
            }
        }
        return empty($rtn) ? null : substr($rtn, 1);
    }

    function boolsCheck($fld) {
        $realFldVals = $this->parseValsToRealFields();
        $val = $realFldVals[$fld]['SUM_'];
        return ' ' . $val . '=(' . (strpos($fld, '.') ? $fld : ('`' . $fld . '`')) . '&' . $val . ') ';
    }

    function boolsCheckExists($fld) {
        $realFldVals = $this->parseValsToRealFields();
        $val = $realFldVals[$fld]['SUM_'];
        return ' (' . (strpos($fld, '.') ? $fld : ('`' . $fld . '`')) . '&' . $val . ') >0 ';
    }

    /**
     * @param $f
     *  param         ==> :param
     *  |bools        ==> :|bools
     *  &bools        ==> :&bools
     *  #bools        ==> :#bools
     */
    function handleParam($f) {
        $hasColon = 0 === strpos($f, ':');
        $ascii = $hasColon ? ord($f{1}) : ord($f{0});

        if (124 == $ascii || 38 == $ascii || 35 == $ascii) {
            $f = $hasColon ? substr($f, 2) : substr($f, 1);
            switch ($ascii) {
            case 124:     // :|
                return $this->boolsCheckExists($f);
                break;
            case 38:     // :&
                return $this->boolsCheck($f);
                break;
            case 35:     // :#
                return $this->boolsPatch($f);
                break;
            default:
                return null;
                break;
            }
        } else {
            if ($hasColon) {
                $f = substr($f, 1);
            }
            $realFldVals = $this->parseValsToRealFields();

            $paramStruct = $this->preparedParamStruct();
            $param = $this->get($f);
            if (isset($paramStruct[$f])) {
                $paramAttr = $paramStruct[$f];
                $paramType = $paramAttr['TYPE_'];
                $param = $this->castToType($paramAttr, $param);
            } else if (isset($realFldVals[$f])) {
                $param = $realFldVals[$f];
                $tbStruct = $this->preparedTableStruct();
                $paramType = $tbStruct[$f]['TYPE_'];
            } else {
                $paramType = is_string($param) ? self::T_VARCHAR : (is_int($param) ? self::T_INT : ((is_float($param) || is_double($param)) ? self::T_FLOAT : 'UNKNOWN'));
            }
            return $this->quoteOrNot($paramType, $param);
        }

    }

    /**
     * Statement is something like Mysql stmt
     *  =param  = is default
     *  >param  <param !=param ....
     *  :param
     *  :#boolsPatch
     *  :|boolsCheck
     *  :&boolsFullChecking
     * @param string $hyphen ',' | ' AND '
     * @param array|multiple params|string_split_with_comma ...$required_fields
     *    'name,uid,regtime'
     * @return string
     *    e.g.  'name="Aario Ai", age=88, say="I\'m Aario Ai."';
     *    e.g.  'name="Aario Ai" AND age=88 AND say="I\'m Aario Ai."
     * @note MDL is not a place for filtering, it's just for basic type casting.
     */
    protected function stmt($hyphen, $requiredFields = null, $valueOnly = false) {

        $realFldVals = $this->parseValsToRealFields();
        $tbStruct = self::preparedTableStruct();

        if (empty($requiredFields)) {
            $requiredFields = $hyphen;
        }
        $hyphen = ' ' . $hyphen . ' ';

        if (is_string($requiredFields)) {
            // e.g.    tb.token,tb.name,fld,Fld,&bools,+bools,|bools,*bools,
            $requiredFields = preg_replace('/(^,)|(\s)|(,$)/', '', $requiredFields);
            $requiredFields = explode(',', $requiredFields);
        }


        $rtn = '';
        //var_dump($required_fields);

        foreach ($requiredFields as $f) {
            if (empty($f))       // for `fld, ,fld3` the empty field
                continue;
            $ascii = ord($f{0});
            //  parameters   e.g.  ::stmt(':bools')
            if (58 == $ascii) {     // :
                $secAscii = ord($f{1});
                if (124 == $secAscii || 38 == $secAscii || 35 == $secAscii) {
                    $f = substr($f, 2);
                    $rtn .= $hyphen;
                    switch ($secAscii) {
                    case 124:     // :|
                        $rtn .= $hyphen . $this->boolsCheckExists($f);
                        break;
                    case 38:     // :&
                        $rtn .= $hyphen . $this->boolsCheck($f);
                        break;
                    case 35:     // :#
                        $rtn .= $hyphen . $this->boolsPatch($f);
                        break;
                    default:
                        break;
                    }
                } else {
                    $f = substr($f, 1);
                    $paramStruct = $this->preparedParamStruct();
                    $param = $this->get($f);
                    if (isset($paramStruct[$f])) {
                        $paramAttr = $paramStruct[$f];
                        $paramType = $paramAttr['TYPE_'];
                        $param = $this->castToType($paramAttr, $param);
                    } else if (isset($tbStruct[$f])) {
                        $param = isset($realFldVals[$f]) ? $realFldVals[$f] : null;
                        $paramType = $tbStruct[$f]['TYPE_'];
                    } else {
                        $paramType = is_string($param) ? self::T_VARCHAR : (is_int($param) ? self::T_INT : ((is_float($param) || is_double($param)) ? self::T_FLOAT : 'UNKNOWN'));
                    }
                    $rtn .= $hyphen . $this->quoteOrNot($paramType, $param);
                }
            } else {
                /**
                 * field name [\w\-]
                 *  0-9     [48, 57]
                 *  A-Z     [65, 90]
                 *  _       [95]
                 *  '      96
                 *  a-z     [97, 122]
                 *
                 * @example
                 *  a>:a   b!=:b    a|:a
                 */
                $operator = '=';
                if ($ascii < 48 || ($ascii > 57 && $ascii < 65) || ($ascii > 90 && $ascii < 95) || $ascii > 122) {
                    $i = 1;
                    while (true) {
                        $charAscii = ord($f{$i});
                        if ($charAscii < 48 || ($charAscii > 57 && $charAscii < 65) || ($charAscii > 90 && $charAscii < 95) || $charAscii > 122) {
                            $i++;
                        } else {
                            $operator = substr($f, 0, $i);
                            $f = substr($f, $i);
                            break;
                        }
                    }
                }

                $fAttrs = $tbStruct[$f];
                $fType = $fAttrs['TYPE_'];
                if ($valueOnly) {
                    $prependFldname = '';
                } else {
                    $prependFldname = false == strpos($f, '.') ? '`' . $f . '`' : $f;  // 0 is false too
                    $prependFldname .= $operator;
                }

                /**
                 * after ::castToType()
                 * @warning be careful about null value
                 */
                if (isset($tbStruct[$f])) {
                    $fAttrs = $tbStruct[$f];
                    $valWithType = isset($realFldVals[$f]) ? $realFldVals[$f] : $this->castToType($fAttrs, null);

                    //$val_with_type = $real_fld_vals[$f];
                    if (self::T_BIN_BOOLS === $fType) {      // $val_with_type is an array
                        $rtn .= $hyphen . $prependFldname . $valWithType['SUM_'];
                    } else {
                        $rtn .= $hyphen . $prependFldname . (null === $valWithType ? 'NULL' : $this->quoteOrNot($fType, $valWithType));
                    }
                } else {
                    $rtn .= $hyphen . $prependFldname . '?';
                }
            }
        }
        $hyphenLen = strlen($hyphen);
        $rtn = substr($rtn, $hyphenLen);
        $rtn = ' ' . $rtn . ' ';
        return $rtn;
    }
}


abstract class MdlJoin extends Mdl {
    /**
     * @var T_DERIVED type is derived from base classes
     *  It's used only in class MdlJoin, and it'll be replaced to the type of
     *    its maping in base class in MdlJoin;
     */
    ///const T_DERIVED = 0;

    /**
     * @var array joinedClassess
     * @example ['\Mdl\TableA', '\Mdl\TableB']
     */
    protected static $joinedClasses = [];
    //protected static $fieldsMapping = [];
    /**
     * @example
     *  'tb1.username' => ['NewUserName', T_VARCHAR, true]
     *  'tb1.username'=> ['NewUserName']
     *  'tb1.username' => 'NewUserName'
     */
    //public static $tableStruct = [];


    /**
     * @
     *  add prefix (its table name) to ::$tableStructs in ::$joinedTables
     *  combine _BOOLS_
     *  combine ::$tableStruct, keep static::$tableStruct highest priority-first
     */
    function __construct(\AbIf\Data\Struct $struct = null) {
        parent::__construct($struct);

        $joined_classes = static::$joinedTables;
        $overwriteTbStruct = is_array(static::$tableStruct) ? static::$tableStruct : [];
        $tbStruct = [];

        foreach ($joined_classes as $i => $joinedCls) {
            $joinedTbStruct = $joinedCls::$tableStruct;
            /**
             * @notice the ::tableStruct s are all static, so it may be called by
             *  ::getPreparedTableStruct before.
             */

            if (empty($joinedTbStruct['IS_PREPARED_'])) {
                $joinedCls::$tableStruct = $joinedTbStruct = parent::preparedTableStruct($joinedTbStruct);
            }

            if (isset($joinedTbStruct['TABLE_NAME_'])) {
                $joinedTbName = $joinedTbStruct['TABLE_NAME_'];
                unset($joinedTbStruct['TABLE_NAME_']);
                foreach ($joinedTbStruct as $fld => $preparedFieldAttrs) {
                    if (!is_array($preparedFieldAttrs)) {
                        continue;
                    }
                    $fullFldName = $joinedTbName . '.' . $fld;

                    $joinedTbFile = substr($joinedCls, strrpos($joinedCls, '\\') + 1) . '.' . $fld;

                    if (!empty($overwriteTbStruct['$tb' . $joinedTbFile]) || !empty($overwriteTbStruct['$table' . $joinedTbFile])) {
                        $overwriteFldName = (!empty($overwriteTbStruct['$tb' . $joinedTbFile]) ? '$tb' : '$table') . $joinedTbFile;
                        $overwrite_attr = $overwriteTbStruct[$overwriteFldName];
                        unset($overwriteTbStruct[$overwriteFldName]);
                        unset(static::$tableStruct[$overwriteFldName]);
                        static::$tableStruct[$fullFldName] = $overwriteTbStruct[$fullFldName] = $overwrite_attr;
                    }

                    if (!empty($overwriteTbStruct[$fullFldName]) || !empty($overwriteTbStruct[$fld])) {
                        $overwriteAttrs = !empty($overwriteTbStruct[$fullFldName]) ? $overwriteTbStruct[$fullFldName] : $overwriteTbStruct[$fld];
                        $overwriteAttrs = (array)$overwriteAttrs;
                        self::arrangeFieldAttrs($fld, $overwriteAttrs, $preparedFieldAttrs);
                    }

                    $joinedTbStruct[$fullFldName] = $preparedFieldAttrs;
                    if (!empty($joinedCls::TABLE_SHARD_FIELD)) {
                        $joinedTbStruct[$joinedTbName . '_TABLE_SHARD_FIELD_'] = strpos($joinedCls::TABLE_SHARD_FIELD, '.') ? $joinedCls::TABLE_SHARD_FIELD : ($joinedTbName . '.' . $joinedCls::TABLE_SHARD_FIELD);
                    }
                    if (method_exists($joinedCls, 'tableShardIdx')) {
                        $joinedTbStruct[$joinedTbName . '_CALLABLE_TABLE_SHARD_IDX_'] = $joinedCls;
                    }
                    unset($joinedTbStruct[$fld]);
                }
                /**
                 * table name
                 * @note make it at the end of foreach()
                 */
                $lastBackSlash = strrpos($joinedCls, '\\');
                $tbKey = false === $lastBackSlash ? $joinedCls : substr($joinedCls, $lastBackSlash + 1);
                //var_dump($tb_key);
                $joinedTbStruct['TABLE_NAME_' . $i . '_'] = $joinedTbStruct['TABLE_NAME_' . $tbKey . '_'] = $joinedTbName;
            } else {
                foreach ($joinedTbStruct as $fld => &$preparedFieldAttrs) {
                    if (!empty($overwriteTbStruct[$fld])) {
                        $overwriteAttrs = (array)$overwriteTbStruct[$fld];
                        self::arrangeFieldAttrs($fld, $overwriteAttrs, $preparedFieldAttrs);
                    }
                }
            }

            $tbStruct = array_merge($tbStruct, $joinedTbStruct);
        }
        static::$tableStruct = $tbStruct;
    }
}