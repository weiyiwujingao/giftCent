<?php

namespace Helper;

use Enum\EnumKeys;
use Illuminate\Http\Request;

final class CFunctionHelper
{

    /**
     * 获取环境变量
     *
     * @param string $key
     * @return string
     */
    public static function getEnv($key)
    {
        if (isset($_ENV[$key]) && !empty($_ENV[$key])) {
            return $_ENV[$key];
        } elseif (isset($_SERVER[$key]) && !empty($_SERVER[$key])) {
            return $_SERVER[$key];
        }
        return '';
    }

    /**
     * 获取环境变量
     * @return type
     */
    public static function getEnvConst()
    {
        return self::getEnv('APP_ENV');
    }

    /**
     * 获取环境变量
     * @return type
     */
    public static function getEnvLocal()
    {
        return self::getEnv('APP_ENV');
    }

    /**
     * 获取是否运营环境的方法
     * @return type
     */
    public static function isLocal()
    {
        $env = self::getEnvLocal();
        return $env == "local" ? true : false;
    }

    /**
     * 获取真实的ip地址
     *
     * @return string
     */
    public final static function getRealIP()
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                foreach ($arr AS $ip) {
                    $ip = trim($ip);
                    if ($ip != 'unknown') {
                        $realip = $ip;
                        break;
                    }
                }
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                if (isset($_SERVER['REMOTE_ADDR'])) {
                    $realip = $_SERVER['REMOTE_ADDR'];
                } else {
                    $realip = '0.0.0.0';
                }
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }
        $onlineip = array();
        preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
        $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
        return $realip;
    }

    /**
     * 获取请求的URL
     * @return type
     */
    public static function getRequestUrl()
    {
        return isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";
    }

    /**
     * 获取完整的请求URL
     * @return type
     */
    public static function getFullRequestUrl()
    {
        if (self::getPort() != 80) {
            return "http://" . self::getHost() . ":" . self::getPort() . self::getRequestUrl();
        } else {
            return "http://" . self::getHost() . self::getRequestUrl();
        }
    }

    /**
     * 对数组进行非法值过滤
     *
     * @param array $arr
     */
    public final static function addslashes($arr)
    {
        if (!get_magic_quotes_gpc()) {
            $rtn = array();
            foreach ($arr as $key => $value) {
                // csrf js
                $val = str_replace(array('<', '>'), array('', ''), $value);
                // sql insert
                if (is_array($val)) {
                    $rtn[$key] = self::addslashes($val);
                } else {
                    $rtn[$key] = addslashes($val);
                }
            }
            return $rtn;
        }
        return $arr;
    }

    //创建目录
    public static function createFolder($path, $recursive = false)
    {
        if (!file_exists($path)) {
            self::createFolder(dirname($path));

            mkdir($path, 0755, $recursive); //0755可以不写
        }
    }

    //创建目录
    public static function createDir($dir)
    {
        $dir_arr = explode('/', $dir);
        $path = '';
        foreach ($dir_arr as $v) {
            $path .= $v . '/';
            if (is_dir($path)) {
                continue;
            } else {
                if (@mkdir($path) == false) {
                    return false;
                } else { //创建文件夹时继承父目录的属组，0表示8进制，不加有可能会出错，2表示setgid，该目录下创建的文件继承父目录的属组
                    if (@chmod($path, 02775) == false) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    /**
     * GET请求
     * @param type $url
     * @param type $second
     * @param type $ip
     * @param type $cookie
     * @return boolean
     */
    public static function curlGetContents($url, $second = 10, $ip = '', $cookie = '', $gzip = false)
    {
        $url_arr = parse_url($url);
        $header[] = "Referer: " . $url_arr['scheme'] . "://" . $url_arr['host'] . "/";
        $header[] = "Host: " . $url_arr['host'];
        $header[] = "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; zh-CN; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8 (.NET CLR 3.5.30729)";
        $header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
        $header[] = "Accept-Language: zh-cn,zh;q=0.5";
        $header[] = "Accept-Charset: utf-8";
        $header[] = "Connection: close";
        $header[] = $cookie;

        $ch = curl_init();
        if ($ch !== false) {
            if ($ip != '') {
                $count = null;
                $url = str_replace($url_arr['scheme'] . "://" . $url_arr['host'] . "/", $url_arr['scheme'] . "://" . $ip . "/", $url, $count);
                if ($count != 1) {
                    curl_close($ch);
                    return false;
                }
            }
            if ($url_arr['scheme'] == 'https') {
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, $second);
            curl_setopt($ch, CURLOPT_VERBOSE, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //支持重定向
            curl_setopt($ch, CURLOPT_MAXREDIRS, 2); //最大重定向两次
            if ($gzip === true) {
                curl_setopt($ch, CURLOPT_ENCODING, "gzip");
            }

            $content = curl_exec($ch);
            $last_retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($last_retcode != 200) { //返回错误
                $content = false;
            }
            curl_close($ch);
            unset($ch);
        } else {
            $content = false;
        }
        return $content;
    }

    /**
     * CURL 获取远程图片内容
     * @param $url
     * @param int $timeout
     * @return bool|mixed
     */
    public static function curlGetPicContent($url, $timeout = 10)
    {
        $url_arr = parse_url($url);
        $ch = curl_init();
        if ($ch !== false) {
            if ($url_arr['scheme'] == 'https') {
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            }
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $img = curl_exec($ch);
        $last_retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($last_retcode != 200) { //返回错误
            $img = false;
        }
        curl_close($ch);
        unset($ch);
        return $img;
    }

    /**
     * POST请求
     * @param type $url
     * @param type $postData
     * @param type $cookie
     * @param type $second
     * @param type $content_type
     * @return boolean
     */
    public static function curlPostContents($url, $postData, $cookie = '', $second = 10, $content_type = 'application/x-www-form-urlencoded')
    {
        if (!is_string($postData)) {
            $data = http_build_query($postData);
        } else {
            $data = $postData;
        }
        $url_arr = parse_url($url);
        $header[] = "Referer: " . $url_arr['scheme'] . "://" . $url_arr['host'] . "/";
        $header[] = "Host: " . $url_arr['host'];
        $header[] = "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; zh-CN; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8 (.NET CLR 3.5.30729)";
        $header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
        $header[] = "Accept-Language: zh-cn,zh;q=0.5";
        $header[] = "Accept-Charset: utf-8";
        $header[] = "Cache-Control: no-cache";
        $header[] = "Content-type: {$content_type}";
        $header[] = "Content-length: " . strlen($data);
        $header[] = "Connection: close";
        $header[] = $cookie;

        $ch = curl_init();
        if ($ch !== false) {
            if ($url_arr['scheme'] == 'https') {
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, $second);
            curl_setopt($ch, CURLOPT_VERBOSE, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //支持重定向
            curl_setopt($ch, CURLOPT_MAXREDIRS, 2); //最大重定向两次

            $content = curl_exec($ch);
            $last_retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($last_retcode != 200) { //返回错误
                $content = false;
            }
            curl_close($ch);
            unset($ch);
        } else {
            $content = false;
        }
        return $content;
    }

    /**
     * 按字符统计长度
     * @param type $str
     * @param type $charset
     * @return int
     */
    public static function sstrlen($str, $charset = "utf-8")
    {
        $n = 0;
        $p = 0;
        $c = '';
        $len = strlen($str);
        if ($charset == 'utf-8') {
            for ($i = 0; $i < $len; $i++) {
                $c = ord($str{$i});
                if ($c > 252) {
                    $p = 5;
                } elseif ($c > 248) {
                    $p = 4;
                } elseif ($c > 240) {
                    $p = 3;
                } elseif ($c > 224) {
                    $p = 2;
                } elseif ($c > 192) {
                    $p = 1;
                } else {
                    $p = 0;
                }
                $i += $p;
                $n++;
            }
        } else {
            for ($i = 0; $i < $len; $i++) {
                $c = ord($str{$i});
                if ($c > 127) {
                    $p = 1;
                } else {
                    $p = 0;
                }
                $i += $p;
                $n++;
            }
        }
        return $n;
    }

    /**
     * 中文字符串分割
     * @param type $string
     * @param type $len
     * @return type
     */
    public static function mbStrSplit($string, $len = 1)
    {
        $start = 0;
        $strlen = mb_strlen($string);
        while ($strlen) {
            $array[] = mb_substr($string, $start, $len, "utf8");
            $string = mb_substr($string, $len, $strlen, "utf8");
            $strlen = mb_strlen($string);
        }
        return $array;
    }

    /**
     * (保持单词完整性)英文字符串分割
     * @param type $string
     * @param type $len
     * @return string
     */
    public function enStrSplit($string, $len = 60)
    {
        $chipsArr = explode(' ', $string);
        $str = '';
        foreach ($chipsArr as $chips) {
            $str .= $chips . ' ';
            $strLen = strlen($str);
            if ($strLen > $len) {
                $strArr[] = rtrim($str, $chips . ' ');
                $str = '';
                $str .= $chips . ' ';
            }
        }
        $strArr[] = $str;
        return $strArr;
    }

    /**
     * 获取唯一key
     * @return string
     */
    public static function getUniqId()
    {
        return str_replace(".", "", uniqid(getmypid(), true));
    }

    /**
     * 验证身份证号
     * @param $vStr
     * @return bool
     */
    public static function validateIdentity($vStr)
    {
        $vCity = array(
            '11', '12', '13', '14', '15', '21', '22',
            '23', '31', '32', '33', '34', '35', '36',
            '37', '41', '42', '43', '44', '45', '46',
            '50', '51', '52', '53', '54', '61', '62',
            '63', '64', '65', '71', '81', '82', '91',
        );

        if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;

        if (!in_array(substr($vStr, 0, 2), $vCity)) return false;

        $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
        $vLength = strlen($vStr);

        if ($vLength == 18) {
            $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
        } else {
            $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
        }

        if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
        if ($vLength == 18) {
            $vSum = 0;

            for ($i = 17; $i >= 0; $i--) {
                $vSubStr = substr($vStr, 17 - $i, 1);
                $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr, 11));
            }

            if ($vSum % 11 != 1) return false;
        }

        return true;
    }

    /**
     * 判断一个身份证号持有人是否未成年
     */
    public static function isMinor($vStr)
    {
        $vLength = strlen($vStr);
        if ($vLength == 18) {
            $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
        } else {
            $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
        }
        if ((time() - strtotime($vBirthday)) > 18 * 365 * 24 * 60 * 60) {
            //成年
            return false;
        } else {
            //未成年
            return true;
        }
    }

    /**
     * 通过身份证号码获取出生年月日
     */
    public static function getBirthByIdCard($idCard)
    {
        $birthday = strlen($idCard) == 15 ? ('19' . substr($idCard, 6, 6)) : substr($idCard, 6, 8);

        return $birthday;
    }

    /**
     * 通过身份证号码判断性别
     * 15位身份证的最后一位，18位身份证的第17位代表性别，奇数代表男性，偶数代表女性
     */
    public static function getSexByIdCard($idCard)
    {
        $sex = substr($idCard, (strlen($idCard) == 15 ? -1 : -2), 1) % 2;

        return $sex; //1:男， 0：女
    }

    /**
     * 判断是否是正确的邮箱
     */
    public static function isEmail($email)
    {
        return preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email) ? true : false;
    }

    /**
     * 获取毫秒级别时间戳
     */
    public static function getMillisecond()
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    /**
     * 检查url是否存在
     */
    public static function urlExists($url)
    {
        $hdrs = @get_headers($url);
        return is_array($hdrs) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/', $hdrs[0]) : false;
    }

    /**
     * 下载远程图片到本地服务器
     * @param $url  图片地址
     * @param $saveDir  保存在本地目录
     * @param $recursive 是否设置递归模式
     * @return array|bool
     */
    public static function getImg($url, $saveDir, $recursive = false)
    {
        if (trim($url) == '' || trim($saveDir) == '') {
            return false;
        }

        //检查图片后缀名是否合法
        $ext = strrchr($url, '.');
        if ($ext != '.gif' && $ext != '.jpg' && $ext != '.png' && $ext != '.jpeg' && $ext != '.bmp') {
            return false;
        }
        $fileName = date('YmdHis') . rand(1000, 9999) . $ext;
        $img = self::curl_get_pic_content($url);
        if (!is_dir($saveDir)) {
            \Helper\CFunctionHelper::createFolder($saveDir, $recursive);
        }
        if ($img !== false) {
            //文件大小
            $fp2 = @fopen($saveDir . $fileName, 'a');
            if ($fp2) {
                fwrite($fp2, $img);
                fclose($fp2);
                unset($img, $url);
            }

            return array('fileName' => $fileName, 'localFilePath' => $saveDir . $fileName);
        }
        return false;
    }

    public static function GenerateSaveUser2Scripts($userName, $password)
    {
        $lowerName = strtolower($userName);
        $script = "<script type='text/javascript'>\n" .
            "$(document).ready(function(){\n" .
            "	var ua = window.navigator.userAgent.toLowerCase(); \n" .
            "	if(ua.match(/jiabeiAppAndroid/i) == 'jiabeiappandroid' && window.AndroidWebView.saveUser2){\n" .
            "		window.AndroidWebView.saveUser2('$userName','$password');}\n" .
            "	else if(ua.match(/jiabeiAppIOS/i) == 'jiabeiappios' && typeof(iosWeixinPay) != 'undefined' && iosWeixinPay.saveUser2){\n" .
            "		iosWeixinPay.saveUser2('{\"name\":\"$lowerName\",\"pwd\":\"$password\"}');}\n" .
            "});\n" .
            '</script>';
        return $script;
    }

    /**
     * 格式化商品价格
     *
     * @access  public
     * @param   float $price 商品价格
     * @return  string
     */
    public static function priceFormat($price, $changePrice = true)
    {
        if ($price === '') {
            $price = 0;
        }
        $price = number_format($price, 2, '.', '');
        if ($changePrice === false) {
            return $price;
        }
        return sprintf('￥%s', $price);
    }

    //判断是否为APP
    public static function getDeviceType()
    {
        $agent = 'aa' . (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
        $type = false;
        if (strpos($agent, 'jiabeiApp') > 0) {
            $type = true;
        }
        return $type;
    }

    //判断是否为移动端
    public static function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA'])) {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile',
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }

    /**
     * 过滤和排序所有分类，返回一个带有缩进级别的数组
     *
     * @access  private
     * @param   int $cat_id 上级分类ID
     * @param   array $arr 含有所有分类的数组
     * @param   int $level 级别
     * @return  void
     */
    public static function catOptions($spec_cat_id, $arr)
    {
        static $cat_options = array();

        if (isset($cat_options[$spec_cat_id])) {
            return $cat_options[$spec_cat_id];
        }

        if (!isset($cat_options[0])) {
            $level = $last_cat_id = 0;
            $options = $cat_id_array = $level_array = array();
            $data = false;
            if ($data === false) {
                while (!empty($arr)) {
                    foreach ($arr AS $key => $value) {
                        $cat_id = $value['cat_id'];
                        if ($level == 0 && $last_cat_id == 0) {
                            if ($value['parent_id'] > 0) {
                                break;
                            }

                            $options[$cat_id] = $value;
                            $options[$cat_id]['level'] = $level;
                            $options[$cat_id]['id'] = $cat_id;
                            $options[$cat_id]['name'] = $value['cat_name'];
                            unset($arr[$key]);

                            if ($value['has_children'] == 0) {
                                continue;
                            }
                            $last_cat_id = $cat_id;
                            $cat_id_array = array($cat_id);
                            $level_array[$last_cat_id] = ++$level;
                            continue;
                        }

                        if ($value['parent_id'] == $last_cat_id) {
                            $options[$cat_id] = $value;
                            $options[$cat_id]['level'] = $level;
                            $options[$cat_id]['id'] = $cat_id;
                            $options[$cat_id]['name'] = $value['cat_name'];
                            unset($arr[$key]);

                            if ($value['has_children'] > 0) {
                                if (end($cat_id_array) != $last_cat_id) {
                                    $cat_id_array[] = $last_cat_id;
                                }
                                $last_cat_id = $cat_id;
                                $cat_id_array[] = $cat_id;
                                $level_array[$last_cat_id] = ++$level;
                            }
                        } elseif ($value['parent_id'] > $last_cat_id) {
                            break;
                        }
                    }

                    $count = count($cat_id_array);
                    if ($count > 1) {
                        $last_cat_id = array_pop($cat_id_array);
                    } elseif ($count == 1) {
                        if ($last_cat_id != end($cat_id_array)) {
                            $last_cat_id = end($cat_id_array);
                        } else {
                            $level = 0;
                            $last_cat_id = 0;
                            $cat_id_array = array();
                            continue;
                        }
                    }

                    if ($last_cat_id && isset($level_array[$last_cat_id])) {
                        $level = $level_array[$last_cat_id];
                    } else {
                        $level = 0;
                    }
                }
                //如果数组过大，不采用静态缓存方式
                if (count($options) <= 2000) {
                    //  write_static_cache('cat_option_static', $options);
                }
            } else {
                $options = $data;
            }
            $cat_options[0] = $options;
        } else {
            $options = $cat_options[0];
        }

        if (!$spec_cat_id) {
            return $options;
        } else {
            if (empty($options[$spec_cat_id])) {
                return array();
            }

            $spec_cat_id_level = $options[$spec_cat_id]['level'];

            foreach ($options AS $key => $value) {
                if ($key != $spec_cat_id) {
                    unset($options[$key]);
                } else {
                    break;
                }
            }

            $spec_cat_id_array = array();
            foreach ($options AS $key => $value) {
                if (($spec_cat_id_level == $value['level'] && $value['cat_id'] != $spec_cat_id) ||
                    ($spec_cat_id_level > $value['level'])
                ) {
                    break;
                } else {
                    $spec_cat_id_array[$key] = $value;
                }
            }
            $cat_options[$spec_cat_id] = $spec_cat_id_array;

            return $spec_cat_id_array;
        }
    }

    /**
     * 判断某个商品是否正在特价促销期
     *
     * @access  public
     * @param   float $price 促销价格
     * @param   string $start 促销开始日期
     * @param   string $end 促销结束日期
     * @return  float   如果还在促销期则返回促销价，否则返回0
     */
    public static function bargainPrice($price, $start, $end)
    {
        if ($price == 0) {
            return 0;
        } else {
            $time = time();
            if ($time >= $start && $time <= $end) {
                return $price;
            } else {
                return 0;
            }
        }
    }

    /**
     * 添加商品名样式
     * @param   string $goods_name 商品名称
     * @param   string $style 样式参数
     * @return  string
     */
    public static function addStyle($goods_name, $style)
    {
        $goods_style_name = $goods_name;

        $arr = explode('+', $style);

        $font_color = !empty($arr[0]) ? $arr[0] : '';
        $font_style = !empty($arr[1]) ? $arr[1] : '';

        if ($font_color != '') {
            $goods_style_name = '<font color=' . $font_color . '>' . $goods_style_name . '</font>';
        }
        if ($font_style != '') {
            $goods_style_name = '<' . $font_style . '>' . $goods_style_name . '</' . $font_style . '>';
        }
        return $goods_style_name;
    }

    /**
     * 重新获得商品图片与商品相册的地址
     *
     * @param string $image 原商品相册图片地址
     * @return string   $url
     */
    public static function getImagePath($image = '')
    {
        $_CFG = \Enum\EnumLang::loadConfig();
        $url = empty($image) ? $_CFG['no_picture'] : $image;
        return $url;
    }

    /***
     * 组装数据 获取指定键的数组
     * @author: colin
     * @date: 2018/12/5 10:11
     * @param $keys
     * @param $arr
     * @return array
     */
    public static function setParamData($keys, $arr)
    {
        if (!is_array($keys) || !is_array($arr)) {
            return [];
        }
        $data = [];
        foreach ($arr as $k => $v) {
            if (in_array($k, $keys)) {
                $data[$k] = $v;
            }
        }
        return $data;
    }

    /**
     * 判断某个商品是否正在特价促销期
     *
     * @access  public
     * @param   float $price 促销价格
     * @param   string $start 促销开始日期
     * @param   string $end 促销结束日期
     * @return  float   如果还在促销期则返回促销价，否则返回0
     */
    public static function isPromote($price, $start, $end)
    {
        if ($price == 0)
            return 0;
        $time = time();
        if ($time >= $start && $time <= $end) {
            return $price;
        }
        return 0;
    }

    /***
     * 获取数组最小值
     * @author: colin
     * @date: 2018/12/5 14:50
     * @param $data  数据列表
     * @param int $min 最小值排除
     * @return mixed
     */
    public static function getMinAll($data, $min = 0)
    {
        if (!is_array($data))
            return $data;
        foreach ($data as $key => $val) {
            if ($val <= $min)
                unset($data[$key]);
        }
        if (empty($data)) {
            return 0;
        }
        $minData = min($data);
        return $minData;
    }

    public static function curlHttp($url, $data = '', $method = 'GET')
    {

        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        }
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        if ($method == 'POST') {
            curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
            if ($data != '') {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
            }
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        curl_close($curl); // 关闭CURL会话
        return $tmpInfo;
    }

    /**
     * 生成卡号12位数
     * @return  string
     */
    public static function getCardSn()
    {
        /* 选择一个随机的方案 */
        mt_srand((double)microtime() * 1000000);
        $cardSn = date('ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        return $cardSn;
    }

    /**
     * 生成订单编号
     * @return  string
     */
    public static function getOrderSn()
    {
        /* 选择一个随机的方案 */
        mt_srand((double)microtime() * 1000000);
        $orderSn = date('YmdH') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        return $orderSn;
    }

    /**
     * 快递查询
     * @param string $gsType 物流公司代码
     * @param string $number 快递单号
     */
    public static function kuaidicx($gsType = '', $number = '')
    {
        try {
            if (empty($gsType)) {
                throw new \Exception('快递公司为空');
            }
            if (empty($number)) {
                throw new \Exception('快递单号为空');
            }
            $cacheKey = md5($gsType . '|' . $number);
            $exData = cache()->get($cacheKey);
            if (empty($exData)) {
                $postData = array();
                $postData["customer"] = '3DC558DE49E9F55F578F3800C200DFD8';
                $key = 'jBvFiMUo6011';
                $params = array(
                    'com' => $gsType,//快递公司编码
                    'num' => $number,//快递单号
                );
                $postData["param"] = json_encode($params);

                $apiUrl = 'http://poll.kuaidi100.com/poll/query.do';
                $postData["sign"] = md5($postData["param"] . $key . $postData["customer"]);
                $postData["sign"] = strtoupper($postData["sign"]);
                $oStr = "";
                foreach ($postData as $k => $v) {
                    $oStr .= "$k=" . urlencode($v) . "&";        //默认UTF-8编码格式
                }
                $postData = substr($oStr, 0, -1);
                $result = \Helper\CFunctionHelper::curlHttp($apiUrl, $postData, 'POST');
                $resArr = json_decode($result, true);
                if (isset($resArr['status']) && $resArr['status'] == 200) {
                    $res = [
                        'status' => 1,
                        'data'   => [
                            'state'   => $resArr['state'],
                            'ischeck' => $resArr['ischeck'],
                            'list'    => $resArr['data'],
                        ],
                    ];
                    cache()->set($cacheKey, json_encode($res), 60 * 60 * 2);//缓存两小时
                } else {
                    $msg = isset($resArr['message']) ? $resArr['message'] : '查询失败，请隔段时间再查';
                    throw new \Exception($msg);
                }
            } else {
                $res = json_decode($exData, true);
            }
        } catch (\Exception $e) {
            $res = array(
                'status'  => 0,
                'message' => $e->getMessage(),
            );
        }
        return $res;
    }

    /**
     * 商户支付手机验证码
     * @author: colin
     * @date: 2018/12/3 10:19
     * @param $mobile
     * @param $mobileCode
     * @param $userId
     * @return bool
     */
    public static function sendMobileSmsCode($mobile, $mobileCode, $userId)
    {
        try {
            $isTest = self::isLocal();
            if (!$isTest) {
                if (is_array($mobile)) {
                    $mobile = implode(',', $mobile);
                }
                $params = array(
                    'code' => $mobileCode,
                );
                $tplcode = config('sms.captcha.tplCode');
                $result = \Library\sendMobileSmsAliyun::getInstance()->sendSms($mobile, $params, $tplcode);
                if ($result && $result->Code == 'OK') {
                    $res = true;
                } else {
                    $res = false;
                }
            } else {
                $res = true;
            }
            $logArr = array(
                'user_id'       => intval($userId),
                'mobile_number' => $mobile,
                'content'       => $mobileCode,
                'result'        => ($res == true) ? 1 : 0,
            );
            if ($res == false && $result && isset($result->Message)) {
                $logArr['remark'] = $result->Message;
            }
            \App\Models\SmsSendLog::create($logArr);
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
            return false;
        }
        return $res;
    }

    /**
     * 获取gd信息
     * @author: colin
     * @date: 2018/12/28 15:04
     */
    public static function gdVersion()
    {
        $gdInfo = gd_info();
        preg_match('/\d/', $gdInfo['GD Version'], $match);
        $version = $match[0];
        $suport = [];
        if (imagetypes() & IMG_PNG) {
            $suport[] = 'PNG';
        }
        if (imagetypes() & IMG_JPEG) {
            $suport[] = 'JPEG';
        }
        if (imagetypes() & IMG_GIF) {
            $suport[] = 'GIF';
        }
        return 'GD' . $version . '( ' . implode(' ', $suport) . ' )';
    }
}
