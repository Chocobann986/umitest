<?php
 namespace UmiCms\Classes\System\PageNum\Agent;use UmiCms\Classes\System\PageNum\iAgent;use \iServiceContainer as iServiceContainer;interface iFactory {public function __construct(iServiceContainer $v06d419f75cbecf6df5a44ea9471105ba);public function createAdmin() : iAgent;public function createSite() : iAgent;public function createStream() : iAgent;public function createCommon() : iAgent;public function createCustom(string $va2f2ed4f8ebc2cbb4c21a29dc40ab61d) : iAgent;}