<?php
 namespace UmiCms\Classes\System\Utils\Html;use UmiCms\Classes\System\Utils\DOM\Document\iFactory as iDocumentFactory;interface iParser {const SERVICE_NAME = 'HtmlParser';public function __construct(iDocumentFactory $v126821e2de2dcbc656ef28b6fc1cc6f8);public function getImages(string $vfc35fdc70d5fc69d269883a822c7a53e) : array;public function getTagAttributes(string $ve4d23e841d8e8804190027bce3180fa5, string $vfc35fdc70d5fc69d269883a822c7a53e) : array;public function replaceImages(array $v535d9694e05354e1a24f5ad21a02e1e5, string $vfc35fdc70d5fc69d269883a822c7a53e) : string;}