<?php
 class UmiZipArchive implements IUmiZipArchive {const ARCHIVE_CLASS_DEFAULT = 'ZipArchive';private $name;private $archive;private $errorPrefix = '';private $lastError = '';protected $archiveClass;protected $codes;public function __construct($v85ecb554f2c318a76faf32639c699b51, $v7e579ad33ca6458b96081803d3723c36 = self::ARCHIVE_CLASS_DEFAULT) {if (!class_exists($v7e579ad33ca6458b96081803d3723c36)) {throw new Exception($this->getFullErrorMessage('Class ' . $v7e579ad33ca6458b96081803d3723c36 . ' not found'));}$this->name = $v85ecb554f2c318a76faf32639c699b51;$this->archiveClass = $v7e579ad33ca6458b96081803d3723c36;$this->archive = new $this->archiveClass;$this->initCodes();}public function create($v45b963397aa40d4a0063e0d85e4fe7a1, $v23bb24afaa4f1ddf28eb2d7b2630fea0 = null, $ve2c04ed8e46e0586adc8a54732bc0072 = null) {$this->setErrorPrefix(getLabel('error-create-zip-archive'));if (file_exists($this->name)) {throw new Exception($this->getFullErrorMessage($this->codes['error_exists']));}$this->openAndAdd($v45b963397aa40d4a0063e0d85e4fe7a1, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072, $this->codes['create']);return $this->listContent();}public function add($v45b963397aa40d4a0063e0d85e4fe7a1, $v23bb24afaa4f1ddf28eb2d7b2630fea0 = null, $ve2c04ed8e46e0586adc8a54732bc0072 = null) {$this->setErrorPrefix(getLabel('error-put-files-to-zip-archive'));$this->openAndAdd($v45b963397aa40d4a0063e0d85e4fe7a1, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072, $this->codes['create']);}public function extract($vd6fe1d0be6347b8ef2427fa629c04485 = '.', $vb805a19619a2349ff08cd8ac2dc05d74 = false, $vdea303ef59b3a106db23393c6aeec41b = null, $vabc4560c447e840538671fa5e3fac3fe = null) {$this->open();if (!is_dir($vd6fe1d0be6347b8ef2427fa629c04485)) {mkdir($vd6fe1d0be6347b8ef2427fa629c04485, 0777, true);}$v87f5ef5bae4528cf44a8bd389dc25a4d = $this->archive->extractTo($vd6fe1d0be6347b8ef2427fa629c04485);if (!$v87f5ef5bae4528cf44a8bd389dc25a4d) {return $v87f5ef5bae4528cf44a8bd389dc25a4d;}if ($vb805a19619a2349ff08cd8ac2dc05d74) {for ($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $this->archive->numFiles;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$v1b580cb0c37da9e35e1832f9399c84c9 = $this->archive->statIndex($v865c0c0b4ab0e063e5caa3387c1a8741);$v47826cacc65c665212b821e6ff80b9b0 = $v1b580cb0c37da9e35e1832f9399c84c9['name'];$v149ba56d0dea9c43ea5120154568a18e = $vd6fe1d0be6347b8ef2427fa629c04485 . DIRECTORY_SEPARATOR . $v47826cacc65c665212b821e6ff80b9b0;if (is_file($v149ba56d0dea9c43ea5120154568a18e)) {$vd833f6a7fa188532a7e5937356764b6d = DIRECTORY_SEPARATOR . $this->getBaseName($v149ba56d0dea9c43ea5120154568a18e);if (!is_file($vd833f6a7fa188532a7e5937356764b6d)) {rename($v149ba56d0dea9c43ea5120154568a18e, $vd6fe1d0be6347b8ef2427fa629c04485 . DIRECTORY_SEPARATOR . $this->getBaseName($v149ba56d0dea9c43ea5120154568a18e));}}}for ($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $this->archive->numFiles;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$v1b580cb0c37da9e35e1832f9399c84c9 = $this->archive->statIndex($v865c0c0b4ab0e063e5caa3387c1a8741);$v47826cacc65c665212b821e6ff80b9b0 = $v1b580cb0c37da9e35e1832f9399c84c9['name'];$v149ba56d0dea9c43ea5120154568a18e = $vd6fe1d0be6347b8ef2427fa629c04485 . DIRECTORY_SEPARATOR . $v47826cacc65c665212b821e6ff80b9b0;if ($this->isFolderPath($v47826cacc65c665212b821e6ff80b9b0) && $this->isDirEmpty($v149ba56d0dea9c43ea5120154568a18e)) {rmdir($v149ba56d0dea9c43ea5120154568a18e);}}}$this->convertFolderNames($vd6fe1d0be6347b8ef2427fa629c04485);$this->close();foreach ($this->listContent() as $vdc048d2cc93839ac21d0ab5685f72816) {$v149ba56d0dea9c43ea5120154568a18e = $vd6fe1d0be6347b8ef2427fa629c04485 . $vdc048d2cc93839ac21d0ab5685f72816['filename'];if (is_file($v149ba56d0dea9c43ea5120154568a18e)) {$this->executeCallback($vabc4560c447e840538671fa5e3fac3fe, $v149ba56d0dea9c43ea5120154568a18e);}}return $this->listContent();}public function listContent() {$this->open();$v10ae9fc7d453b0dd525d0edf2ede7961 = [];for ($v865c0c0b4ab0e063e5caa3387c1a8741 = 0;$v865c0c0b4ab0e063e5caa3387c1a8741 < $this->archive->numFiles;$v865c0c0b4ab0e063e5caa3387c1a8741++) {$v447b7147e84be512208dcc0995d67ebc = [];$v1b580cb0c37da9e35e1832f9399c84c9 = $this->archive->statIndex($v865c0c0b4ab0e063e5caa3387c1a8741);$v47826cacc65c665212b821e6ff80b9b0 = $this->cp437ToUtf8($v1b580cb0c37da9e35e1832f9399c84c9['name']);$v5b063e275d506f65ebf1b02d926f19a4 = $this->getBaseName($v47826cacc65c665212b821e6ff80b9b0);$v447b7147e84be512208dcc0995d67ebc['filename'] = $v447b7147e84be512208dcc0995d67ebc['stored_filename'] = $v5b063e275d506f65ebf1b02d926f19a4;$v447b7147e84be512208dcc0995d67ebc['is_folder'] = $this->isFolderPath($v47826cacc65c665212b821e6ff80b9b0);$v447b7147e84be512208dcc0995d67ebc['size'] = $v1b580cb0c37da9e35e1832f9399c84c9['size'];$v10ae9fc7d453b0dd525d0edf2ede7961[] = $v447b7147e84be512208dcc0995d67ebc;}$this->close();return $v10ae9fc7d453b0dd525d0edf2ede7961;}public function errorInfo() {return $this->lastError;}public function getName() {return $this->name;}protected function openAndAdd($v45b963397aa40d4a0063e0d85e4fe7a1, $v23bb24afaa4f1ddf28eb2d7b2630fea0 = null, $ve2c04ed8e46e0586adc8a54732bc0072 = null, $v68b6be6efa899259df101c6904792556) {$this->open($v68b6be6efa899259df101c6904792556);$this->addFilesList($v45b963397aa40d4a0063e0d85e4fe7a1, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072);$this->close();}protected function open($v4e5868d676cb634aa75b125a0f741abf = null) {$v1fa77007d212594d36e7738bf29597ec = $this->archive->open($this->name, $v4e5868d676cb634aa75b125a0f741abf);if ($v1fa77007d212594d36e7738bf29597ec !== true) {throw new Exception($this->getFullErrorMessage($v1fa77007d212594d36e7738bf29597ec));}return true;}protected function addFilesList($v45b963397aa40d4a0063e0d85e4fe7a1, $v23bb24afaa4f1ddf28eb2d7b2630fea0 = null, $ve2c04ed8e46e0586adc8a54732bc0072 = null) {$vaf926aff8f97bc9f302afc1f713b7cbc = $this->getFilesList($v45b963397aa40d4a0063e0d85e4fe7a1);foreach ($vaf926aff8f97bc9f302afc1f713b7cbc as $v47826cacc65c665212b821e6ff80b9b0) {$this->addFileOrDirectory($v47826cacc65c665212b821e6ff80b9b0, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072);}}protected function addFile($v47826cacc65c665212b821e6ff80b9b0, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072) {$this->archive->addFile($v47826cacc65c665212b821e6ff80b9b0, $this->getFilePathInArchive($v47826cacc65c665212b821e6ff80b9b0, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072));}protected function addDirectory($vd6fe1d0be6347b8ef2427fa629c04485, $v23bb24afaa4f1ddf28eb2d7b2630fea0 = null, $ve2c04ed8e46e0586adc8a54732bc0072 = null) {$this->addEmptyDirectories($vd6fe1d0be6347b8ef2427fa629c04485, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072);foreach ($this->getDirectoryIterator($vd6fe1d0be6347b8ef2427fa629c04485, FilesystemIterator::SKIP_DOTS) as $v1ded0622d3320f26b47f514fabab54f1) {$v47826cacc65c665212b821e6ff80b9b0 = $v1ded0622d3320f26b47f514fabab54f1->getPathName();if (is_file($v47826cacc65c665212b821e6ff80b9b0)) {$this->addFile($v47826cacc65c665212b821e6ff80b9b0, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072);}}}protected function addEmptyDirectories($vd6fe1d0be6347b8ef2427fa629c04485, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072) {if (!is_dir($vd6fe1d0be6347b8ef2427fa629c04485)) {return false;}foreach ($this->getDirectoryIterator($vd6fe1d0be6347b8ef2427fa629c04485) as $v1ded0622d3320f26b47f514fabab54f1) {if ($v1ded0622d3320f26b47f514fabab54f1->getFileName() == '.') {$vd6fe1d0be6347b8ef2427fa629c04485 = $this->getFilePathInArchive($v1ded0622d3320f26b47f514fabab54f1->getPath(), $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072);if ($vd6fe1d0be6347b8ef2427fa629c04485 === trim($v23bb24afaa4f1ddf28eb2d7b2630fea0, '/')) {continue;}$this->archive->addEmptyDir($vd6fe1d0be6347b8ef2427fa629c04485);}}return true;}protected function getDirectoryIterator($vd6fe1d0be6347b8ef2427fa629c04485, $v93da65a9fd0004d9477aeac024e08e15 = null) {$vb1450434c0620714f9440cb03c78ba5a = new RecursiveDirectoryIterator($vd6fe1d0be6347b8ef2427fa629c04485, $v93da65a9fd0004d9477aeac024e08e15);return new RecursiveIteratorIterator($vb1450434c0620714f9440cb03c78ba5a);}protected function addFileOrDirectory($vd6fe1d0be6347b8ef2427fa629c04485, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072) {if (is_file($vd6fe1d0be6347b8ef2427fa629c04485)) {$this->addFile($vd6fe1d0be6347b8ef2427fa629c04485, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072);}elseif (is_dir($vd6fe1d0be6347b8ef2427fa629c04485)) {$this->addDirectory($vd6fe1d0be6347b8ef2427fa629c04485, $v23bb24afaa4f1ddf28eb2d7b2630fea0, $ve2c04ed8e46e0586adc8a54732bc0072);}}protected function getErrorMessage($vcb5e100e5a9a3e7f6d1fd97512215282) {if (is_string($vcb5e100e5a9a3e7f6d1fd97512215282)) {return $vcb5e100e5a9a3e7f6d1fd97512215282;}switch ($vcb5e100e5a9a3e7f6d1fd97512215282) {case $this->codes['error_exists']:     $v78e731027d8fd50ed642340b7c9a63b3 = getLabel('error-zip-archive-already-exits');break;case $this->codes['error_open']:     $v78e731027d8fd50ed642340b7c9a63b3 = getLabel('error-cannot-open-file');break;default:     $v78e731027d8fd50ed642340b7c9a63b3 = getLabel('error-unexpected-exception');}return $v78e731027d8fd50ed642340b7c9a63b3;}protected function close() {$this->archive->close();}protected function getFilePathInArchive($v47826cacc65c665212b821e6ff80b9b0, $v23bb24afaa4f1ddf28eb2d7b2630fea0 = null, $ve2c04ed8e46e0586adc8a54732bc0072 = null) {$ve7f798e51c6673b378f25db75f827bb3 = preg_quote($v23bb24afaa4f1ddf28eb2d7b2630fea0, '/');$v1e61009b2f7953936ffd8a9f569ed695 = preg_replace('/^\.?\/?(.+)\.?\/?$/', '$1', $ve2c04ed8e46e0586adc8a54732bc0072);$v9fb32c1a01b1afc67638764562bc8647 = 1;$v62d9dcf1cfc6deb1e955966b60b2a4a3 = $v47826cacc65c665212b821e6ff80b9b0;if ($v23bb24afaa4f1ddf28eb2d7b2630fea0 !== null) {$v62d9dcf1cfc6deb1e955966b60b2a4a3 = preg_replace('/' . $ve7f798e51c6673b378f25db75f827bb3 . '\/?/', '', $v47826cacc65c665212b821e6ff80b9b0, $v9fb32c1a01b1afc67638764562bc8647);}if ($ve2c04ed8e46e0586adc8a54732bc0072 !== null) {$v62d9dcf1cfc6deb1e955966b60b2a4a3 = preg_replace(     '/\.?\/?(.+)/',     $v1e61009b2f7953936ffd8a9f569ed695 . DIRECTORY_SEPARATOR . '$1',     $v62d9dcf1cfc6deb1e955966b60b2a4a3,     $v9fb32c1a01b1afc67638764562bc8647    );}return $v62d9dcf1cfc6deb1e955966b60b2a4a3;}protected function convertFolderNames($vd6fe1d0be6347b8ef2427fa629c04485) {foreach ($this->getDirectoryIterator($vd6fe1d0be6347b8ef2427fa629c04485) as $v8c7dd922ad47494fc02c388e12c00eac) {if ($v8c7dd922ad47494fc02c388e12c00eac->getFilename() == '.') {$vd833f6a7fa188532a7e5937356764b6d = $this->cp437ToUtf8($v8c7dd922ad47494fc02c388e12c00eac->getPath());if (!is_dir($vd833f6a7fa188532a7e5937356764b6d)) {rename($v8c7dd922ad47494fc02c388e12c00eac->getPath(), $this->cp437ToUtf8($v8c7dd922ad47494fc02c388e12c00eac->getPath()));}}}}protected function executeCallback($v924a8ceeac17f54d3be3f8cdf1c04eb2, $vb8a1eed9044f64c7b3321a88fc4c5dd9) {if (is_callable($v924a8ceeac17f54d3be3f8cdf1c04eb2)) {$v099fb995346f31c749f6e40db0f395e3 = [     'stored_filename' => $vb8a1eed9044f64c7b3321a88fc4c5dd9,     'filename' => $vb8a1eed9044f64c7b3321a88fc4c5dd9    ];return (bool) $v924a8ceeac17f54d3be3f8cdf1c04eb2([], $v099fb995346f31c749f6e40db0f395e3);}return true;}private function cp437ToUtf8($vb45cffe084dd3d20d928bee85e7b0f21) {$v598b19b4df7e1399a5aea40166a60a4e = [    'Ç',    'ü',    'é',    'â',    'ä',    'à',    '≡',    'å',    'ç',    'ê',    'ë',    'è',    'ï',    'î',    'ì',    'Ä',    'Å',    'É',    'æ',    'Æ',    'ô',    'ö',    'û',    'ù',    'ÿ',    'Ö',    'Ü',    '¢',    '£',    '¥',    '₧',    'ƒ',    'á',    'í',    'ó',    'ú',    'ñ',    'Ñ',    '±',    'ª',    'º',    '¿',    '⌐',    '¬',    '½',    '¼',    '¡',    '«',    '»',    'α',    'ß',    'Γ',    'π',    'Σ',    'σ',    'µ',    'τ',    'Φ',    'Θ',    'Ω',    'δ',    '∞',    'φ',    'ε',    '∩'   ];$v7379a15f0c52d407bda33c67289c281f = [    'А',    'Б',    'В',    'Г',    'Д',    'Е',    'Ё',    'Ж',    'З',    'И',    'Й',    'К',    'Л',    'М',    'Н',    'О',    'П',    'Р',    'С',    'Т',    'У',    'Ф',    'Ц',    'Ч',    'Ш',    'Щ',    'Ъ',    'Ы',    'Ь',    'Э',    'Ю',    'Я',    'а',    'б',    'в',    'г',    'д',    'е',    'ё',    'ж',    'з',    'и',    'й',    'к',    'л',    'м',    'н',    'о',    'п',    'р',    'с',    'т',    'у',    'ф',    'x',    'ц',    'ч',    'ш',    'щ',    'ъ',    'ы',    'ь',    'э',    'ю',    'я'   ];return str_replace($v598b19b4df7e1399a5aea40166a60a4e, $v7379a15f0c52d407bda33c67289c281f, $vb45cffe084dd3d20d928bee85e7b0f21);}private function getBaseName($v47826cacc65c665212b821e6ff80b9b0) {preg_match('/\/([a-zA-Zа-яА-Я0-9._\-]+)?$/', $v47826cacc65c665212b821e6ff80b9b0, $v9c28d32df234037773be184dbdafc274);return (isset($v9c28d32df234037773be184dbdafc274[1]) ? $v9c28d32df234037773be184dbdafc274[1] : $v47826cacc65c665212b821e6ff80b9b0);}private function stripMultipleSeparators($vd6fe1d0be6347b8ef2427fa629c04485) {return preg_replace('/[^\:\/](\/{2,})/', DIRECTORY_SEPARATOR, $vd6fe1d0be6347b8ef2427fa629c04485);}private function getFilesList($v45b963397aa40d4a0063e0d85e4fe7a1) {$vaf926aff8f97bc9f302afc1f713b7cbc = $v45b963397aa40d4a0063e0d85e4fe7a1;if (is_string($v45b963397aa40d4a0063e0d85e4fe7a1)) {$vaf926aff8f97bc9f302afc1f713b7cbc = [$v45b963397aa40d4a0063e0d85e4fe7a1];}return $vaf926aff8f97bc9f302afc1f713b7cbc;}private function getFullErrorMessage($vcb5e100e5a9a3e7f6d1fd97512215282) {$vd68123075f2e28adcd8a88891d467bd5 = $this->getErrorPrefix() . $this->getErrorMessage($vcb5e100e5a9a3e7f6d1fd97512215282);$this->lastError = $vd68123075f2e28adcd8a88891d467bd5;return $vd68123075f2e28adcd8a88891d467bd5;}private function getErrorPrefix() {return $this->errorPrefix;}private function setErrorPrefix($v851f5ac9941d720844d143ed9cfcf60a) {$this->errorPrefix = $v851f5ac9941d720844d143ed9cfcf60a;}private function isFolderPath($vd6fe1d0be6347b8ef2427fa629c04485) {return (bool) preg_match('/\/$/', $vd6fe1d0be6347b8ef2427fa629c04485);}private function isDirEmpty($v74c17e3010c33af858d215cfc3552b04) {if (!is_readable($v74c17e3010c33af858d215cfc3552b04) || !is_dir($v74c17e3010c33af858d215cfc3552b04)) {return null;}return (umiCount(scandir($v74c17e3010c33af858d215cfc3552b04)) === 2);}private function initCodes() {$vff2f9f3e25aa15a7a4479581e73e785b = $this->archiveClass;$this->codes['error_exists'] = $vff2f9f3e25aa15a7a4479581e73e785b::ER_EXISTS;$this->codes['error_open'] = $vff2f9f3e25aa15a7a4479581e73e785b::ER_OPEN;$this->codes['create'] = $vff2f9f3e25aa15a7a4479581e73e785b::CREATE;$this->codes['overwrite'] = $vff2f9f3e25aa15a7a4479581e73e785b::OVERWRITE;}}