<?php

require __DIR__ . '/vendor/predis/predis/autoload.php';
Predis\Autoloader::register();

class AeAuth {
  function __construct($config) {

      $this->config = $config;
      $this->redis = new Predis\Client($config['redis']);
      $this->token = $config['token'];
      $this->session_timeout = $config['session_timeout'];
  }

  function check_auth($key) {
      $data = $this->redis->get(trim($key));
      if ($data) {
          $data = json_decode($data, true);

          if ($this->security_check($data)) {
              $this->redis->expire(trim($key), $this->session_timeout);
              return $data;
          }
      }
      return false;
  }

  function authorize() {
    if (is_null($_SESSION['ae_key']))
        return false;
    return $this->check_auth($_SESSION['ae_key']);
  }

  function authorize_with_key($key) {
    $data = $this->check_auth($key);
    if($data) {
      $_SESSION['ae_key'] = $key;
      return $data;
    }
    return false;
  }

  function destroy_session() {
      $this->redis->del(trim($_SESSION['ae_key']));
  }

  private function security_check($data) {
      return sha1($this->get_client_ip() . $this->token) == $data['ip'] && sha1($_SERVER['HTTP_USER_AGENT'] . $this->token) == $data['browser'];
  }

  private function get_client_ip() {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if (getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if (getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if (getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if (getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
      else if (getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';
      return $ipaddress;
  }


}
