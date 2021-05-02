<?php


class xssChecker {
    public function xssCheck($input) {
        $result = preg_match('/[<>]/', $input);
        
        return $result;
    }
}
?>
