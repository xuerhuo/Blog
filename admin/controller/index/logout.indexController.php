<?php

namespace Cms\admin;
$C['Admin'] = new Admin();
unset($_SESSION['uid']);
direct('admin/index/login');

?>