<?php

use UmiCms\Service;

class umiEventPoint implements iUmiEventPoint
{
    private $id;
    private $mode;
    private $moduleList = [];
    private $methodList = [];
    private $paramList = [];
    private $refList = [];
    private static $correctModeList = ['before',   'process',   'after'];
    public function __construct($vb80bb7740288fda1f201890375a60c8f)
    {
        $this->setId($vb80bb7740288fda1f201890375a60c8f)->setMode();
    }
    public function getId()
    {
        return $this->id;
    }
    public function setMode($v15d61712450a686a7f365adf4fef581f = 'process')
    {
        if (!is_string($v15d61712450a686a7f365adf4fef581f) || empty($v15d61712450a686a7f365adf4fef581f)) {
            throw new coreException('Incorrect mode given');
        }
        $v15d61712450a686a7f365adf4fef581f = mb_strtolower($v15d61712450a686a7f365adf4fef581f);
        $v15d61712450a686a7f365adf4fef581f = trim($v15d61712450a686a7f365adf4fef581f);
        if (!in_array($v15d61712450a686a7f365adf4fef581f, self::$correctModeList)) {
            throw new coreException("Unknown mode given \"{$v15d61712450a686a7f365adf4fef581f}\"");
        }
        $this->mode = $v15d61712450a686a7f365adf4fef581f;
        return $this;
    }
    public function getMode()
    {
        return $this->mode;
    }
    public function setModules(array $v20cf12be6809c539cfed17c272627718 = []): iUmiEventPoint
    {
        $this->moduleList = $v20cf12be6809c539cfed17c272627718;
        return $this;
    }
    public function getModules()
    {
        return $this->moduleList;
    }
    public function setMethods(array $vb894d2761deb95e2989a1b35d64cf07d = []): iUmiEventPoint
    {
        $this->methodList = $vb894d2761deb95e2989a1b35d64cf07d;
        return $this;
    }
    public function getMethods()
    {
        return $this->methodList;
    }
    public function setParam($vb068931cc450442b63f5b3d276ea4297, $v2063c1608d6e0baf80249c42e2be5804 = null)
    {
        if (!is_string($vb068931cc450442b63f5b3d276ea4297) || empty($vb068931cc450442b63f5b3d276ea4297)) {
            throw new coreException('Incorrect param name given');
        }
        $this->paramList[$vb068931cc450442b63f5b3d276ea4297] = $v2063c1608d6e0baf80249c42e2be5804;
        return $this;
    }
    public function getParam($vb068931cc450442b63f5b3d276ea4297)
    {
        if (!is_string($vb068931cc450442b63f5b3d276ea4297) || empty($vb068931cc450442b63f5b3d276ea4297)) {
            return null;
        }
        if (array_key_exists($vb068931cc450442b63f5b3d276ea4297, $this->paramList)) {
            return $this->paramList[$vb068931cc450442b63f5b3d276ea4297];
        }
        return null;
    }
    public function addRef($vb068931cc450442b63f5b3d276ea4297, &$v2063c1608d6e0baf80249c42e2be5804)
    {
        if (!is_string($vb068931cc450442b63f5b3d276ea4297) || empty($vb068931cc450442b63f5b3d276ea4297)) {
            throw new coreException('Incorrect ref name given');
        }
        $this->refList[$vb068931cc450442b63f5b3d276ea4297] = &$v2063c1608d6e0baf80249c42e2be5804;
        return $this;
    }
    public function &getRef($vb068931cc450442b63f5b3d276ea4297)
    {
        $vb8af13ea9c8fe890c9979a1fa8dbde22 = null;
        if (!is_string($vb068931cc450442b63f5b3d276ea4297) || empty($vb068931cc450442b63f5b3d276ea4297)) {
            return $vb8af13ea9c8fe890c9979a1fa8dbde22;
        }
        if (array_key_exists($vb068931cc450442b63f5b3d276ea4297, $this->refList)) {
            $vb8af13ea9c8fe890c9979a1fa8dbde22 = &$this->refList[$vb068931cc450442b63f5b3d276ea4297];
        }
        return $vb8af13ea9c8fe890c9979a1fa8dbde22;
    }
    private function setId($vb80bb7740288fda1f201890375a60c8f)
    {
        if (!is_string($vb80bb7740288fda1f201890375a60c8f) || empty($vb80bb7740288fda1f201890375a60c8f)) {
            throw new coreException('Incorrect id given');
        }
        $this->id = $vb80bb7740288fda1f201890375a60c8f;
        return $this;
    }
    public function getEventId()
    {
        return $this->getId();
    }
    public function call()
    {
        return Service::EventController()->callEvent($this, $this->moduleList, $this->methodList);
    }
}
