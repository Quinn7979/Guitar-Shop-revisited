<?php

// Keep database credentials in a separate file
// 1. Easy to exclude this file from source code managers
// 2. Unique credentials on development and production servers
// 3. Unique credentials if working with multiple developers

define("DB_SERVER", "localhost");
define("DB_USER", "mgs_user");
define("DB_PASS", "pa55word");
define("DB_NAME", "my_guitar_shop2");

?>
