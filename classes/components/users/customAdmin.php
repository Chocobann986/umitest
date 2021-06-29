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

	public function repair_tickets() {
      $this->module->setDataType('list');
      $this->module->setActionType('view');

      if ($this->module->ifNotXmlMode()) {
        $this->module->setDirectCallError();
        $this->module->doData();
        return true;
      }

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
}
