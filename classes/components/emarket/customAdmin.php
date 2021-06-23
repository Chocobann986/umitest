<?php

use UmiCms\Service;

/** Класс пользовательских методов административной панели */
class EmarketCustomAdmin
{

	/** @var emarket $module */
	public $module;

	public function views()
	{
		$this->module->setDataType('list');
		$this->module->setActionType('view');

		if ($this->module->ifNotXmlMode()) {
			$this->module->setDirectCallError();
			$this->module->doData();
			return true;
		}

		$limit = getRequest('per_page_limit');
		$curr_page = Service::Request()->pageNumber();
		$offset = $limit * $curr_page;

		$sel = new selector('objects');
		$sel->types('object-type')->name('emarket', 'views');
		$sel->limit($offset, $limit);
		selectorHelper::detectFilters($sel);

		$this->module->setDataRange($limit, $offset);
		$data = $this->module->prepareData($sel->result(), 'objects');
		$this->module->setData($data, $sel->length());
		$this->module->doData();
	}
}
