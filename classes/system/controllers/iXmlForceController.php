<?php
 namespace UmiCms\Classes\System\Controllers;use \iConfiguration as iConfig;use UmiCms\Classes\System\MiddleWares;use UmiCms\Classes\System\Translators\iFacade as iTranslator;interface iXmlForceController extends iController, MiddleWares\iAuth, MiddleWares\iUmiManager, MiddleWares\iStub,  MiddleWares\iUmapRouter, MiddleWares\iMirrorHandler, MiddleWares\iModuleRouter {public function setConfig(iConfig $v2245023265ae4cf87d02c8b6ba991139);public function setTranslator(iTranslator $v607f2f3099f2a347b327caa70e0be4b2);}