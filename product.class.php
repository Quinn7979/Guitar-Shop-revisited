<?php
require_once('initialize.php');

class Product extends DatabaseObject {
    protected static $table_name = 'products';
    protected static $db_columns = ['id', 'categoryID', 'productCode', 'productName', 'listPrice'];

    public $id;
    public $categoryID;
    public $productCode;
    public $productName;
    public $listPrice;

public function __construct($args=[]) {
    //$this->id = $args['id'] ?? '';
    $this->categoryID = $args['categoryID'] ?? '';
    $this->productCode = $args['productCode'] ?? '';
    $this->productName = $args['productName'] ?? '';
    $this->listPrice = $args['listPrice'] ?? 0.00;
    }
public function save() {
        if (isset($this->id)) {
            return $this->update();  // If ID exists, it's an update
        } else {
            return $this->create();  // If no ID, it's a new product (insert)
        }
    }

// public function create() {
//         $sql = "INSERT INTO " . static::$table_name . " (";
//         $sql .= join(", ", static::$db_columns);
//         $sql .= ") VALUES ('";
//         $sql .= join("', '", $this->sanitized_attributes());
//         $sql .= "')";
//         var_dump($sql);
//         $result = self::$database->query($sql);
//         if ($result) {
//             $this->id = self::$database->insert_id;  // After insert, set the id
//         }
//         return $result;
//     }

public function update() {
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $this->attribute_pairs());
        $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        
        $result = self::$database->query($sql);
        return $result;
    }

private function attribute_pairs() {
        $pairs = [];
        foreach ($this->sanitized_attributes() as $key => $value) {
            $pairs[] = "{$key}='{$value}'";
        }
        return $pairs;
    }

protected function sanitized_attributes() {
        $sanitized = [];
        foreach ($this->attributes() as $key => $value) {
            $sanitized[$key] = self::$database->escape_string($value);
        }
        return $sanitized;
    }

public function attributes() {
        $attributes = [];
        foreach (static::$db_columns as $column) {
            if ($column == 'id') continue;  // Skip ID column
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

static function find_by_category($categoryID){
    $query_products = "SELECT id, categoryID, productCode, productName, listPrice FROM products WHERE categoryID = $categoryID";
    return static::find_by_sql($query_products);
}



//     $query_products = "SELECT productID, categoryID, productCode, productName, listPrice 
//                    FROM products WHERE categoryID = ?";
// $stmt = mysqli_prepare($conn, $query_products);
// mysqli_stmt_bind_param($stmt, "i", $category_id);
// mysqli_stmt_execute($stmt);
// $result_products = mysqli_stmt_get_result($stmt);

}

?>