<?php
// Clear cookies
setcookie('user', '', time() - 3600, "/");
exit;
