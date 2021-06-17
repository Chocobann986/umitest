<?php
 namespace UmiCms\Classes\System\Utils\SiteMap\Image;use \iUmiImageFile as iImage;use mainConfiguration as iConfig;use UmiCms\Classes\System\Utils\Html\iParser;use UmiCms\Classes\System\Utils\SiteMap\iLocation;use UmiCms\System\Utils\Url\iFactory as iUrlFactory;use UmiCms\Classes\System\Utils\Api\Http\Lite\iClient;use \GuzzleHttp\Exception\ConnectException as iTimeoutException;use UmiCms\Classes\System\Entities\Image\iFactory as iImageFactory;use UmiCms\Classes\System\Utils\Api\Http\Lite\Client\iFactory as iHttpClientFactory;class Extractor implements iExtractor {const DEFAULT_TIMEOUT = 4;private $urlFactory;private $imageFactory;private $parser;private $httpClient;public function __construct(   iUrlFactory $v44febe2beadd1d4b691811c127575d70,   iImageFactory $vc76618e39a97c7e3d6d7ab8973932e05,   iParser $v3643b86326b2ffcc0a085b4dd3a4309b,   iHttpClientFactory $vc98ff76d78c970916ecf2d8ba313a710,   iConfig $v2245023265ae4cf87d02c8b6ba991139  ) {$this->urlFactory = $v44febe2beadd1d4b691811c127575d70;$this->imageFactory = $vc76618e39a97c7e3d6d7ab8973932e05;$this->parser = $v3643b86326b2ffcc0a085b4dd3a4309b;$this->httpClient = $vc98ff76d78c970916ecf2d8ba313a710->create([    'timeout' => (int) $v2245023265ae4cf87d02c8b6ba991139->get(     'site-map', 'update-site-map-image-request-timeout' , self::DEFAULT_TIMEOUT    )   ]);}public function extract(iLocation $vd5189de027922f81005951e6efe0efd5) : array {$vfc35fdc70d5fc69d269883a822c7a53e = $this->loadHtml($vd5189de027922f81005951e6efe0efd5);$v4b9c230a80d1ef5c0241a86cdea5d436 = $this->parseImageAttributeList($vfc35fdc70d5fc69d269883a822c7a53e);return $this->createImageList($v4b9c230a80d1ef5c0241a86cdea5d436);}private function loadHtml(iLocation $vd5189de027922f81005951e6efe0efd5) : string {try {return $this->httpClient->get($vd5189de027922f81005951e6efe0efd5->getLink());}catch (iTimeoutException $v42552b1f133f9f8eb406d4f306ea9fd1) {\umiExceptionHandler::report($v42552b1f133f9f8eb406d4f306ea9fd1);return '';}}private function parseImageAttributeList(string $vfc35fdc70d5fc69d269883a822c7a53e) : array {if (!$vfc35fdc70d5fc69d269883a822c7a53e) {return [];}$v4b9c230a80d1ef5c0241a86cdea5d436 = $this->parser->getImages($vfc35fdc70d5fc69d269883a822c7a53e);$v4b9c230a80d1ef5c0241a86cdea5d436 = $this->filterImageListWithEmptySrc($v4b9c230a80d1ef5c0241a86cdea5d436);$v39d1c2bba96782dd826485983a6fe436 = $this->parser->getTagAttributes('base', $vfc35fdc70d5fc69d269883a822c7a53e);$v2b70fca2f3f70af04fff5ab2163f0a38 = (is_array($v39d1c2bba96782dd826485983a6fe436) && isset($v39d1c2bba96782dd826485983a6fe436['href'])) ? (string) $v39d1c2bba96782dd826485983a6fe436['href'] : '';return $this->convertImageListSrcFromUrlToFilePath($v4b9c230a80d1ef5c0241a86cdea5d436, $v2b70fca2f3f70af04fff5ab2163f0a38);}private function filterImageListWithEmptySrc(array $v4b9c230a80d1ef5c0241a86cdea5d436) : array {return array_filter($v4b9c230a80d1ef5c0241a86cdea5d436, function(array $v35dbaccc02d8c3375ebf6fa6940ef4ff) {return isset($v35dbaccc02d8c3375ebf6fa6940ef4ff['src']);});}private function convertImageListSrcFromUrlToFilePath(array $v4b9c230a80d1ef5c0241a86cdea5d436, string $v2b70fca2f3f70af04fff5ab2163f0a38) : array {return array_map(function(array $v35dbaccc02d8c3375ebf6fa6940ef4ff) use ($v2b70fca2f3f70af04fff5ab2163f0a38) {$v25d902c24283ab8cfbac54dfa101ad31 = $v35dbaccc02d8c3375ebf6fa6940ef4ff['src'];if (!startsWith($v25d902c24283ab8cfbac54dfa101ad31, '/') && !startsWith($v25d902c24283ab8cfbac54dfa101ad31, 'http') && !startsWith($v25d902c24283ab8cfbac54dfa101ad31, '://')) {$v25d902c24283ab8cfbac54dfa101ad31 = $v2b70fca2f3f70af04fff5ab2163f0a38 . $v25d902c24283ab8cfbac54dfa101ad31;}$v35dbaccc02d8c3375ebf6fa6940ef4ff['src'] = $this->urlFactory     ->create($v25d902c24283ab8cfbac54dfa101ad31)     ->getPath();return $v35dbaccc02d8c3375ebf6fa6940ef4ff;}, $v4b9c230a80d1ef5c0241a86cdea5d436);}private function createImageList(array $v4b9c230a80d1ef5c0241a86cdea5d436) : array {$v72bc6e7707131edcbe44c867e3bc83e1 = [];foreach ($v4b9c230a80d1ef5c0241a86cdea5d436 as $v2029ea456fac5e537c84fac28ef0fa04) {$v78805a221a988e79ef3f42d7c5bfd418 = $this->imageFactory     ->createWithAttributes($v2029ea456fac5e537c84fac28ef0fa04['src'], $v2029ea456fac5e537c84fac28ef0fa04);if ($v78805a221a988e79ef3f42d7c5bfd418->getIsBroken()) {continue;}$v72bc6e7707131edcbe44c867e3bc83e1[$v78805a221a988e79ef3f42d7c5bfd418->getFilePath(true)] = $v78805a221a988e79ef3f42d7c5bfd418;}return $v72bc6e7707131edcbe44c867e3bc83e1;}}