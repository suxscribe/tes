<?php

namespace Sprint\Migration;


class IB_ADD_TRUST_LICENSES_20190422153916 extends Version
{

    protected $description = "Добавляет ИБ Доверие и компетенции (лицензии)";

    public function up()
    {
        $helper = new HelperManager();

        $arIBlockType = array(
            'ID' => 'TRUST',
            'SECTIONS' => 'Y',
            'IN_RSS' => 'Y',
            'SORT' => 100,
            'LANG' => array(
                'ru' => array(
                    'NAME' => 'Доверие и компетенции',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Элемент'
                ),
                'en' => array(
                    'NAME' => 'Trust',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'News'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'TRUST',
            'CODE' => 'LICENSES',
            'NAME' => 'Лицензии и сертификаты',
        ));

        $arProps = array(
            array(
                'NAME' => 'Файл сертификата',
                'CODE' => 'DOCUMENT',
                'PROPERTY_TYPE' => 'F'
            ),
        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }
            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Документ' => [
                    'NAME',
                    'PREVIEW_TEXT' => 'Описание',
                    'PROPERTY_DOCUMENT'
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('LICENSES', 'TRUST');

    }

}
