<?php
 namespace UmiCms\Classes\System\Utils\Mail\Settings\Smtp;use UmiCms\Classes\System\Utils\Settings\iSettings as iMainSettings;interface iSettings extends iMainSettings {public function getTimeout();public function setTimeout($v90272dda245ae1fb3cf197e91a8689dc);public function getHost();public function setHost($v67b3dba8bc6778101892eb77249db32e);public function getPort();public function setPort($v901555fb06e346cb065ceb9808dcfc25);public function getEncryption();public function setEncryption($v5bdf74912a51c34815f11e9a3d20b609);public function isAuth();public function setAuth($v3618c6fed01308d841996608cdd3f297);public function getUserName();public function setUserName($v14c4b06b824ec593239362517f538b29);public function getPassword();public function setPassword($v5f4dcc3b5aa765d61d8327deb882cf99);public function isDebug();public function setDebug($v481ef6dbcc3f87fb143b77c2109eceac);public function isUseVerp();public function setUseVerp($v1503b5a231dfc58f75b421d8ed7e024d);}