<?php

/**
 * 修改配置文件信息
 * 按照给定的参照数组键值修改更新数组键值,参照数组键值在配置文件中位置必须在修改数组键值之前
 * @param $refer_array  参照数组，一维关联数组。array(refer_key  => refer_value)
 * @param $update_array 更新数组，一维关联数组。array(update_key => update_value)
 * @param $config_path    原配置文件路径
 * @return 成功时返回写入文件的字节数，失败返回false
 */
function update_config($refer_array, $update_array, $config_path = '') {
    $config_before_content = $config_before_content = file_get_contents($config_path);
    $array = array();

    $reg = '/';
    foreach ($refer_array as $refer_key => $refer_value) {
        $reg .= ($refer_key . '.*?=>.*?'. $refer_value .'[\s\S]*?');
    }
    $update_keys = array_keys($update_array);
    $reg .= $update_keys[0] . '.*?=>(.*?),[\s\S]*?';
    $reg .= '/i';

    preg_match_all($reg, $config_before_content, $array);
    $match_str = $array[0];
    $update_match_str = str_ireplace($array[1], $update_array[$update_keys[0]], $array[0]);
    $config_update_content = str_ireplace($match_str, $update_match_str, $config_before_content);

    return file_put_contents($config_path, $config_update_content);
}