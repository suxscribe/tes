<?php
/**
 * Клас для реализации подписки, рассылки и отписки пользователей
 */

namespace Only\Form;

use Bitrix\Highloadblock as HL;
use Bitrix\Iblock\Component\Tools;
use Bitrix\Main\Loader;

class Subscribe
{

    public static function toSubscribe()
    {
        $request = self::getReqest();
        $entity_data_class = self::createEntityDataClass();
        $rsData = $entity_data_class::getCount(array(
                array(
                    'UF_MAIL' => $request['email'],
                )
            )
        );
        if ($rsData == 0) {
            /*
             * Добавляем пользователя в HLBlock
             */
            $arItems = $entity_data_class::add(
                array(
                    'UF_MAIL' => $request['email'],
                    'UF_HASH' => self::generateHash($request['email']),
                )
            );
            self::sendResponse('ok', 'Вы успешно подписанный на рассылку');
            return $arItems;
        } else {
            self::sendResponse('error', 'Вы уже подписанны на рассылку');
            return false;
        }
    }

    public static function unSubscribe()
    {
        $request = self::getReqest();
        $entity_data_class = self::createEntityDataClass();
        $rsData = $entity_data_class::getList(
            array(
                'select' => array('*'),
                'order' => array('UF_MAIL' => 'ASC'),
                'limit' => '1',
                'filter' => array(
                    'UF_MAIL' => $request['email'],
                    'UF_HASH' => $request['hash']
                )
            )
        )->fetch();

        if (!empty($rsData)) {
            /*
             * Удаляем почту из HlBlock
             */

            $entity_data_class::delete($rsData['ID']);

            //self::sendResponse('ok','Вы успешно отписались от рассылки');
            $message = 'Вы успешно отписались от рассылки';
        } else {
            $message = 'Такой e-mail у нас не зареган или не верный ключь для отписки';
            //self::sendResponse('error','Такой e-mail у нас не зареган или не верный ключь для отписки');
        }
        return $message;
    }

    public static function doMailing()
    {
        if (!Loader::includeModule('iblock')) {
            return false;
        }
        $start_date = date('d.m.Y', strtotime('yesterday')) . ' ' . date('H:i:s');
        $sIBlock = \COption::GetOptionString('only.form', 'iblock_id', false, false);
        $arIBlocksId = explode(',', $sIBlock);
        foreach ($arIBlocksId as $iBlockId) {
            $rsItems = \CIBlockElement::GetList(
                array('SORT' => 'ASC'),
                [
                    'IBLOCK_ID' => $iBlockId,
                    'ACTIVE' => 'Y',
                    //'DATE_CREATE_UNIX'=> $start_date,
                    '>DATE_CREATE' => $start_date
                ],
                false,
                false
            );

            while ($obItem = $rsItems->GetNextElement(true, false)) {
                $arItem = $obItem->GetFields();
                Tools::getFieldImageData(
                    $arItem,
                    ['PREVIEW_PICTURE'],
                    Tools::IPROPERTY_ENTITY_ELEMENT
                );
                $arItems[] = $arItem;
            }
        }
        if (!empty($arItems)) {
            $entity_data_class = self::createEntityDataClass();
            $rsData = $entity_data_class::getList(
                array(
                    'select' => array('*'),
                    'order' => array('UF_MAIL' => 'ASC'),
                )
            );
            $sHtmlMail = self::getHtmlMail($arItems);
            while ($arData = $rsData->fetch()) {
                self::sendMail($arData, $sHtmlMail);
            }

        }

        return "\Only\Form\Subscribe::doMailing();";
    }

    private function sendMail($userMail, $sHtml)
    {

        $arParams['MAIL_TEMPLATE_ID'] = \COption::GetOptionString('only.form', 'mail_template_id', false, false);
        $arParams['SITE_ID'] = 's1';
        $arParams['EVENT_NAME'] = \COption::GetOptionString('only.form', 'event_name', false, false);

        $arEventFields = array(
            "MAIL_BODY" => $sHtml,
            "EMAIL_TO" => $userMail['UF_MAIL'],
            "UNSUBSCRIBE_HASH" => $userMail['UF_HASH']
        );
        \CEvent::Send($arParams['EVENT_NAME'], $arParams['SITE_ID'], $arEventFields, "N",
            $arParams['MAIL_TEMPLATE_ID']);
    }

    private static function getHtmlMail($arItems)
    {
        $siteHost = 'http://tes.ru';
        $html = '';
        foreach ($arItems as $arItem) {
            $html .= '<h2>' . $arItem['NAME'] . '</h2>';
            $html .= '<img src="' . $siteHost . $arItem['PREVIEW_PICTURE']['SRC'] . '" width="250px"><br>';
            $html .= '<span>' . $arItem['DATE_CREATE'] . '</span><br>';
            $html .= '<p>' . $arItem['PREVIEW_TEXT'] . '</p><br>';
            $html .= '<a href="' . $siteHost . $arItem['DETAIL_PAGE_URL'] . '">Читать полностью</a>';
            $html .= '<hr>';
        }
        return $html;
    }

    private static function createEntityDataClass()
    {
        $hlBlockName = \COption::GetOptionString('only.form', 'hlBlockName');
        Loader::includeModule("highloadblock");
        $hlBlockId = self::getHlBlockIdByName($hlBlockName);
        $hlblock = HL\HighloadBlockTable::getById($hlBlockId)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        return $entity->getDataClass();
    }

    private static function getHlBlockByName($name)
    {
        $rsData = HL\HighloadBlockTable::getList(array('filter' => array('NAME' => $name)))->Fetch();
        if (!empty($rsData)) {
            return $rsData;
        } else {
            return false;
        }

    }

    private static function getHlBlockIdByName($name)
    {
        $rsData = self::getHlBlockByName($name);
        if (!empty($rsData)) {
            return $rsData['ID'];
        } else {
            return false;
        }

    }

    private function isAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) === 'XMLHTTPREQUEST';
    }

    private function getReqest()
    {
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        $arRequest = $request->toArray();
        if (!empty($arRequest['email'])) {
            if (check_email($arRequest['email'])) {
                return $arRequest;
            } else {
                self::sendResponse('error', 'invalid e-mail');
            }
        } else {
            self::sendResponse('error', 'empty e-mail');
        }
    }

    private function sendResponse($status, $message)
    {
        $arResponse = [
            'status' => $status,
            'message' => $message
        ];
        echo json_encode($arResponse);
        exit();
    }

    private function generateHash($userMail)
    {
        $ctx = hash_init('sha1');
        hash_update($ctx, $userMail . 'hash to cancel subscription');
        return hash_final($ctx);
    }
}

