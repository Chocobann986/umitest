<?php


use UmiCms\Service;
	/** Класс пользовательских методов административной панели */
	class UsersCustomAdmin {

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

			if ($this->module->ifNotXmlMode()) { /* ?????? */
				$this->module->setDirectCallError();
				$this->module->doData();
				return true;
			}

			// $limit = getRequest('per_page_limit');
			// $curr_page = Service::Request()->pageNumber();
			// $offset = $limit * $curr_page;

			$sel = new selector('objects');
			$sel->types('object-type')->guid('repair-ticket');
			// $sel->limit($offset, $limit);

			// $this->module->setDataRange($limit, $offset);
			$data = $this->module->prepareData($sel->result(), 'objects');

			$this->module->setData($data, $sel->length());
			$this->module->doData();
		}
	}
