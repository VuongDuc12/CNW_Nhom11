<?php

class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=news_website', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
