<?php
 namespace UmiCms\Classes\System\Controllers;class UpdaterController extends AbstractController implements iUpdaterController {public function execute() {require __DIR__ . '/../installer/installer.php';}}