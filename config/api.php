<?php

class Api
{
  public function setup()
  {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PATCH,GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    #- use for patch , when not include in $_GET and $_POST
    parse_str(file_get_contents('php://input'), $params);

    return $params;
  }
}
