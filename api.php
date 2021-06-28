<?php
include "standalone.php";

header('Content-type: application/json');
echo json_encode(apiInit());
exit();


function apiInit()
{
    $method = $_REQUEST && $_REQUEST['method']
        ? $_REQUEST['method']
        : null;
        
    switch ($method) {
        case 'test':
            return test();
            break;

        case 'getTickets':
            return getTickets(getRequest('page'));
        default:
            header("Status: 400 Bad Request");
            return ['error' => 'Unknown method'];
            break;
    }
}

function test()
{
    return [
        'data' => getRequest('page'),
    ];
}

function getPhotoURL($photoURL){
    $domainsCollection = domainsCollection::getInstance()->getDefaultDomain();
    $domain = $domainsCollection->getHost();
    $protocol = $domainsCollection->getProtocol();

    return $protocol . "://" . $domain . $photoURL;
}

function getTickets($page = 1){
    $limit = 2;
    $sel = new selector('objects');
    $sel->types('object-type')->guid('repair-ticket');
    $offset = $limit * ($page - 1);
    $sel->limit($offset, $limit);
    $result = [];
    foreach ($sel->result() as $ticket){
        $photo = $ticket->getValue('photo');
        $result[] = [
            'name' => $ticket->getName(),
            'malfunction' =>$ticket->getValue('malfunction'),
            'description' => $ticket->getValue('description'),
            'photo' => $photo ? getPhotoURL($photo->getFilePath(true)) : null,
            'acceptanceDate' => $ticket->getValue('acceptance_date'),
            'status' => $ticket->getValue('status')
        ];
    }
    return $result;
}