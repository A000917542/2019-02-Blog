<?php

abstract class Model {

    protected $db;

    private static $staticCount = 0;

    public static function getCount() {
        return Model::$staticCount;
    }

    public static function add($a, $b) {
        return $a + $b;
    }

    const HEIGHT = 6;

    public $insCount = 0;

    function __construct() {

        global $app;

        $this->db = $app->db;

        Model::$staticCount = Model::$staticCount + 1;

        $this->insCount = $this->insCount + 1;

    }

}

?>