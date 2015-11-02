<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('API')) {

    /**
     * 调用api
     * @param string $url "user@get:example/users_get/id/1"
     * @param array $post
     * @return array
     */
    function API($url = 'user@get:', $post = array())
    {
        global $adb_handle, $api_host;

        $api = array('url' => $url, 'app' => 'local', 'method' => 'get', 'api' => '');
        $url_arr = explode('@', $url);
        if (count($url_arr) > 1) {
            $api['app'] = array_shift($url_arr);
        }
        $url = join('@', $url_arr);
        $url_arr = explode(':', $url);
        if (count($url_arr) > 1) {
            $api['method'] = array_shift($url_arr);
        }
        $api['api'] = join(':', $url_arr);

        if (!$post) {
            $post = array();
        }

        if (!isset($adb_handle)) $adb_handle = curl_init();
        if (!isset($api_host)) {
            $CI = &get_instance();
            $CI->config->load('api/api');
            $api_host = $CI->config->item('host');
        }

        if (in_array($api['app'], array_keys($api_host))) {
            $api_url = $api_host[$api['app']]['api'];
        } elseif ($api['app'] == 'local') {
            $api_url = site_url('/api') . '/';
        } else {
            return json_encode(array('error' => 'app not find'));
        }
        //var_dump($api_url);

        $options = array(
            CURLOPT_URL => $api_url . $api['api'],
//            CURLOPT_CUSTOMREQUEST => $api['method'], // GET POST PUT PATCH DELETE HEAD OPTIONS
            CURLOPT_HTTPHEADER => array('X-HTTP-Method-Override: ' . $api['method']),
            CURLOPT_POSTFIELDS => http_build_query($post),
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 2,
        );
        curl_setopt_array($adb_handle, $options);

        //$api['httpcode'] = curl_getinfo($adb_handle, CURLINFO_HTTP_CODE);
        //$api['contenttype'] = curl_getinfo($adb_handle, CURLINFO_CONTENT_TYPE);

        $api['result'] = $result = curl_exec($adb_handle);
        $response = curl_getinfo( $adb_handle );

//        print_r($response);

        return json_decode($result,true);
//        return $api;
    }


}