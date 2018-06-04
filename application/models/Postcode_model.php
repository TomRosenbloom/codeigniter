<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postcode_model extends CI_Model
{

    private $_postcode_pattern = '^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ([0-9][ABD-HJLNP-UW-Z]{2})?)$';
    private $_area_code_pattern = '^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]))$';

    public function __construct()
    {
        parent::__construct();
    }

    public function valid_postcode($str) {
        if (1 !== preg_match("/" . $this->_postcode_pattern . "/", $str))
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function valid_area_code($str){
        if (1 !== preg_match("/" . $this->_area_code_pattern . "/", $str))
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
