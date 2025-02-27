<?php
require_once('initialize.php');

class category extends DatabaseObject {
    protected static $table_name = 'categories';
    protected static $db_columns = ['id', 'categoryName'];

    public $id;
    public $categoryName;

    public function __construct($args=[]) {
    //$this->id = $args['id'] ?? '';
    $this->categoryID = $args['categoryName'] ?? '';
    }
}
?>