<?php
 namespace UmiCms\System\Data\Object\Property\Value;use UmiCms\System\Data\Object\Property\Value\Table\iSchema;abstract class Migration implements iMigration {private $schema;private $connection;public function __construct(iSchema $vc9550d5fad73447fc24ba47f95d1c6b7, \IConnection $v4717d53ebfdfea8477f780ec66151dcb) {$this->schema = $vc9550d5fad73447fc24ba47f95d1c6b7;$this->connection = $v4717d53ebfdfea8477f780ec66151dcb;}abstract protected function moveValues(\iUmiObjectProperty $v1a8db4c996d8ed8289da5f957879ab94, $vc78df1026a28909113fcc1b186b06635, $vba54548af18809208473a13abffc7d78);protected function moveRowsToTarget(   \iUmiObjectProperty $v1a8db4c996d8ed8289da5f957879ab94, $va3ea25e2c9b7f4638e04e3495ec2aa7b, $v3dff5790af2c99b97b4b297f2f9d3bba, $v5ca4a04647f4f60bb3e88f2fe4bce1b3, $v2c09040764eb08bb79cd85132469c697  ) {$v16b2b26000987faccb260b9d39df1269 = $v1a8db4c996d8ed8289da5f957879ab94->getObjectId();$v945100186b119048837b9859c2c46410 = $v1a8db4c996d8ed8289da5f957879ab94->getFieldId();$v8bc4403642c02217dc1341694acb244d = <<<SQL
INSERT INTO {$v5ca4a04647f4f60bb3e88f2fe4bce1b3}
(`obj_id`, `field_id`, `$v2c09040764eb08bb79cd85132469c697`)
	SELECT `obj_id`, `field_id`, `$v3dff5790af2c99b97b4b297f2f9d3bba`
		FROM {$va3ea25e2c9b7f4638e04e3495ec2aa7b}
			WHERE `obj_id` = $v16b2b26000987faccb260b9d39df1269 AND `field_id` = $v945100186b119048837b9859c2c46410
SQL;   $this->getConnection()    ->query($v8bc4403642c02217dc1341694acb244d);return $this;}protected function deleteSourceRows(\iUmiObjectProperty $v1a8db4c996d8ed8289da5f957879ab94, $va3ea25e2c9b7f4638e04e3495ec2aa7b) {$v16b2b26000987faccb260b9d39df1269 = $v1a8db4c996d8ed8289da5f957879ab94->getObjectId();$v945100186b119048837b9859c2c46410 = $v1a8db4c996d8ed8289da5f957879ab94->getFieldId();$v26549ba3ca6f190ace0b2fa7c9b6b049 = <<<SQL
DELETE FROM `$va3ea25e2c9b7f4638e04e3495ec2aa7b` WHERE `obj_id` = $v16b2b26000987faccb260b9d39df1269 AND `field_id` = $v945100186b119048837b9859c2c46410 
SQL;   $this->getConnection()    ->query($v26549ba3ca6f190ace0b2fa7c9b6b049);return $this;}protected function getColumnByDataType($v870b60148237c1452dfb337fdd19c314) {switch ($v870b60148237c1452dfb337fdd19c314) {case 'lang_id' : {return 'lang_id';}case 'domain_id' : {return 'domain_id';}case 'string' : {return 'varchar_val';}case 'int' : {return 'int_val';}case 'text_val' : {return 'text_val';}case 'file' :    case 'img_file' : {return 'src';}default : {throw new \RuntimeException('Incorrect data type given: ' . var_export($v870b60148237c1452dfb337fdd19c314, true));}}}protected function getSchema() {return $this->schema;}protected function getConnection() {return $this->connection;}}