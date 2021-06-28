<?php


use UmiCms\Service;

/** Класс пользовательских методов административной панели */
class UsersCustomAdmin
{

	/** @var users $module */
	public $module;

	/**
	 * Возвращает список пользователей с учетом фильтров
	 * @throws coreException
	 * @throws expectObjectException
	 * @throws selectorException
	 */
/* 	public function repair_tickets()
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

		$sel = Service::SelectorFactory()->createObjectTypeName('users', 'repair_tickets');
		$sel->limit($offset, $limit);
		selectorHelper::detectFilters($sel);

		$this->module->setDataRange($limit, $offset);
		$data = $this->module->prepareData($sel->result(), 'objects');

		$this->module->setData($data, $sel->length());
		$this->module->doData();
	} */

	public function repair_tickets() {
      $this->module->setDataType('list');
      $this->module->setActionType('view');

      if ($this->module->ifNotXmlMode()) {
        $this->module->setDirectCallError();
        $this->module->doData();
        return true;
      }

      $limit = getRequest('per_page_limit');
      $curr_page = (int) getRequest('p');
      $offset = $limit * $curr_page;

      $limit = getRequest('per_page_limit');
      $pageNumber = Service::Request()->pageNumber();
      $offset = $limit * $pageNumber;

      $sel = new selector('objects');
      $sel->types('object-type')->guid('repair-ticket');
      $sel->limit($offset, $limit);
	  
      selectorHelper::detectFilters($sel);
      $result = $sel->result();
      $total = $sel->length();

      $this->module->setDataRange($limit, $offset);
      $data = $this->module->prepareData($result, 'objects');

      $this->module->setData($data, $total);
      $this->module->doData();
    }

	public function printText(){
		print_r('Hello world');
	}
}
