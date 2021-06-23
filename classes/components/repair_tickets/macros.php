<?php

	use UmiCms\Service;

	/** Класс макросов, то есть методов, доступных в шаблоне */
	class RepairTicketsMacros {

		/** @var repair_tickets $module */
		public $module;

		/**
		 * Возвращает данные страницы
		 * @param string $template имя шаблона (для tpl)
		 * @param bool|int $pageId идентификатор страниц, если не передан - возьмет текущую страницу.
		 * @return mixed
		 * @throws publicAdminException
		 */
		public function page($template = 'default', $pageId = false) {
			list($templateBlock) = repair_tickets::loadTemplates('repair_tickets/' . $template, 'block');

			if (!is_numeric($pageId)) {
				$pageId = cmsController::getInstance()->getCurrentElementId();
			}

			$umiHierarchy = umiHierarchy::getInstance();
			$page = $umiHierarchy->getElement($pageId);

			if (!$page instanceof iUmiHierarchyElement) {
				throw new publicAdminException(getLabel('error-page-not-found', 'repair_tickets'));
			}

			$pageData = [
				'id' => $pageId,
				'link' => $umiHierarchy->getPathById($pageId)
			];

			repair_tickets::pushEditable('repair_tickets', 'page', $pageId);
			return repair_tickets::parseTemplate($templateBlock, $pageData, $pageId);
		}

		/**
		 * Возвращает список страниц
		 * @param string $template имя шаблона (для tpl)
		 * @param bool|int $limit ограничение на количество, если не передано - возьмет из настроек.
		 * @return mixed
		 * @throws selectorException
		 */
		public function pagesList($template = 'default', $limit = false) {
			list($templateBlock, $templateLine, $templateEmpty) = repair_tickets::loadTemplates(
				'repair_tickets/' . $template,
				'pages_list_block',
				'pages_list_line',
				'pages_list_block_empty'
			);

			if (!is_numeric($limit)) {
				$limit = (int) Service::Registry()->get($this->module->pagesLimitXpath);
			}

			$pageNumber = Service::Request()->pageNumber();
			$offset = $limit * $pageNumber;

			$pages = new selector('pages');
			$pages->types('object-type')->name('repair_tickets', 'page');
			$pages->limit($offset, $limit);

			$result = $pages->result();
			$total = $pages->length();

			if ($total == 0) {
				return repair_tickets::parseTemplate($templateEmpty, []);
			}

			$items = [];
			$data = [];

			/** @var iUmiHierarchyElement $page */
			foreach ($result as $page) {
				$item = [];
				$item['attribute:id'] = $page->getId();
				$item['attribute:name'] = $page->getName();
				$items[] = repair_tickets::parseTemplate($templateLine, $item);
			}

			$data['subnodes:items'] = $items;
			$data['total'] = $total;

			return repair_tickets::parseTemplate($templateBlock, $data);
		}

		/**
		 * Возвращает список объектов
		 * @param string $template имя шаблона (для tpl)
		 * @param bool $limit ограничение на количество, если не передано - возьмет из настроек.
		 * @return mixed
		 * @throws selectorException
		 */
		public function objectsList($template = 'default', $limit = false) {
			list($templateBlock, $templateLine, $templateEmpty) = repair_tickets::loadTemplates(
				'repair_tickets/' . $template,
				'objects_list_block',
				'objects_list_line',
				'objects_list_block_empty'
			);

			if (!is_numeric($limit)) {
				$limit = (int) Service::Registry()->get($this->module->objectsLimitXpath);
			}

			$pageNumber = Service::Request()->pageNumber();
			$offset = $limit * $pageNumber;

			$objects = new selector('objects');
			$objects->types('object-type')->name('repair_tickets', 'object');
			$objects->limit($offset, $limit);

			$result = $objects->result();
			$total = $objects->length();

			if ($total == 0) {
				return repair_tickets::parseTemplate($templateEmpty, []);
			}

			$items = [];
			$data = [];

			/** @var iUmiObject $object */
			foreach ($result as $object) {
				$item = [];
				$item['attribute:id'] = $object->getId();
				$item['attribute:name'] = $object->getName();
				$items[] = repair_tickets::parseTemplate($templateLine, $item);
			}

			$data['subnodes:items'] = $items;
			$data['total'] = $total;

			return repair_tickets::parseTemplate($templateBlock, $data);
		}
	}
