<?php
 interface iUmiLogger {public function __construct($v06f0066e65410a0a1c9f39991a3f3b01 = './logs/');public function setFileName($v5b063e275d506f65ebf1b02d926f19a4);public function push($v78e731027d8fd50ed642340b7c9a63b3, $va25bec4d6ac4fe3657375253cc832019 = true);public function save();public function resetLog();public function get();public function getRaw();public function separateByIp($v327a6c4304ad5938eaf0efb6cc3e53dc = true);public function pushGlobalEnvironment();public function log($v78e731027d8fd50ed642340b7c9a63b3, $va25bec4d6ac4fe3657375253cc832019 = true);}