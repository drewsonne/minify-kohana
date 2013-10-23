<?php
/**
 * User: "Drew J. Sonne" <drews@symbiosislabs.com>
 * Date: 20/10/13
 * Time: 10:51 AM
 * Package: net.symbiosislabs.tech
 */

class Minify_Helper
{

    public static function js($group)
    {
        return self::_output('script', $group);
    }

    public static function css($group)
    {
        return self::_output('style', $group);
    }

    protected static function _output($type, $group)
    {
        extract(Kohana::$config->load('minify')->as_array(), EXTR_SKIP);

        $debug = array_key_exists('debug', $_GET) && $allowDebugFlag;

        if ($debug) {
            $group = $groupsConfig[$group];
            return array_reduce($group, function ($result, $object) use ($type) {
                $result .= Kohana_Html::$type($object) . "\n";
                echo($result);
            }, '');
        } else {
            return Kohana_Html::$type("min/{$group}");
        }
    }

}