<?php
require('./files/essentials.php'
);
session_start();
session_destroy();

redirect('a_login.php');

?>