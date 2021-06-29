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
            break;
        case 'getTicketById':
            return getTicketById(getRequest('id'));
            break;
        case 'deleteTicket':
            return deleteTicket(getRequest('id'));
            break;
        case 'editTicket':
            return editTicket(getRequest('id'), getRequest('name'),getRequest('malfunction'), getRequest('description'), getRequest('photo'), getRequest('acceptance_date'), getRequest('status'));
            break;
        case 'createTicket':
            return createTicket(getRequest('name'), getRequest('malfunction'), getRequest('description'), getRequest('photo'), getRequest('acceptance_date'), getRequest('status'));
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

function getPhotoURL($photoURL)
{
    $domainsCollection = domainsCollection::getInstance()->getDefaultDomain();
    $domain = $domainsCollection->getHost();
    $protocol = $domainsCollection->getProtocol();

    return $protocol . "://" . $domain . $photoURL;
}

function getTickets($page = 1)
{
    $limit = 2;
    $sel = new selector('objects');
    $sel->types('object-type')->guid('repair-ticket');
    $offset = $limit * ($page - 1);
    $sel->limit($offset, $limit);

    return getTicketFromSelector($sel);
}

function getTicketById($id)
{
    if ($id) {
        $sel = new selector('objects');
        $sel->types('object-type')->guid('repair-ticket');
        $sel->where('id')->equals($id);
        return getTicketFromSelector($sel);
    }
    header("Status: 400 Bad Request");
    return [
        'error' => 'Id not specified',
        'id' => $id
    ];
}

function getTicketFromSelector($sel)
{
    if ($sel->length() > 0) {
        $result = [];
        foreach ($sel->result() as $ticket) {
            $photo = $ticket->getValue('photo');
            $result[] = [
                'name' => $ticket->getName(),
                'malfunction' => $ticket->getValue('malfunction'),
                'description' => $ticket->getValue('description'),
                'photo' => $photo ? getPhotoURL($photo->getFilePath(true)) : null,
                'acceptanceDate' => $ticket->getValue('acceptance_date'),
                'status' => $ticket->getValue('status')
            ];
        }
        return $result;
    } else {
        header("Status: 404 Not Found");
        return [
            'error' => 'Not Found'
        ];
    }
}

function deleteTicket($object_id)
{
    $objectsCollection = umiObjectsCollection::getInstance();
    $result = $objectsCollection->delObject($object_id);

    if ($result) {
        header("Status: 200 Ok");
        return [
            'deletedId' => $object_id
        ];
    } else {
        header("Status: 400 Bad Request");
        return [
            'error' => "data with this id don't exists."
        ];
    }
}

function createTicket($name, $malfaction, $description = false, $photo = false, $acceptance_date = false, $status)
{
    $umiObjectsTypes = umiObjectTypesCollection::getInstance();
    $typeId = $umiObjectsTypes->getTypeIdByGUID('repair-ticket');

    $objectsCollection = umiObjectsCollection::getInstance();
    $objectId = $objectsCollection->addObject($name, $typeId);
    $object = $objectsCollection->getObject($objectId);

    $object->setValue('malfunction', $malfaction);
    $object->setValue('description', $description);
    $object->setValue('photo', $photo);
    $object->setValue('acceptance_date', $acceptance_date);
    $object->setValue('status', $status);
    $object->commit();

    return $object->getId();
}

function editTicket($id, $name, $malfunction, $description = false, $photo = false, $acceptance_date = false, $status)
{
    $objectsCollection = umiObjectsCollection::getInstance();
    $object = $objectsCollection->getObject($id);


    $object->setName($name);
    $object->setValue('malfunction', $malfunction);
    $object->setValue('description', $description);
    $object->setValue('photo', $photo);
    $object->setValue('acceptance_date', $acceptance_date);
    $object->setValue('status', $status);
    $object->commit();

    return $object->getId();
}
