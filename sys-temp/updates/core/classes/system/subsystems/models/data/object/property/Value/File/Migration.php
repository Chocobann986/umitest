<?php
 namespace UmiCms\System\Data\Object\Property\Value\File;use UmiCms\System\Data\Object\Property\Value\iMigration;use UmiCms\System\Data\Object\Property\Value\Table\iSchema;use UmiCms\System\Data\Object\Property\Value\ImgFile\Migration as ImgFileMigration;class Migration extends ImgFileMigration implements iMigration {protected function getTable(iSchema $vc9550d5fad73447fc24ba47f95d1c6b7) {return $vc9550d5fad73447fc24ba47f95d1c6b7->getFilesTable();}}