<?php

namespace Sprint\Migration;


class IB_ADD_CONTACTS_20190422124916 extends Version
{

    protected $description = "Добавляет ИБ Контакты";

    public function up()
    {
        $helper = new HelperManager();

        $arIBlockType = array(
            'ID' => 'CONTACTS',
            'SECTIONS' => 'Y',
            'IN_RSS' => 'Y',
            'SORT' => 100,
            'LANG' => array(
                'ru' => array(
                    'NAME' => 'Контакты',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Элемент'
                ),
                'en' => array(
                    'NAME' => 'Contacts',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'News'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'CONTACTS',
            'CODE' => 'CONTACTS',
            'NAME' => 'Контакты',
        ));

        $arProps = array(
            array(
                'NAME' => 'ФИО',
                'CODE' => 'PERSON_NAME',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Должность',
                'CODE' => 'PERSON_POSITION',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Расположение на карте',
                'CODE' => 'MAP_POINT',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'map_yandex'
            ),
        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }
            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Контакт' => [
                    'NAME',
                    'PREVIEW_TEXT' => 'Адрес',
                    'DETAIL_TEXT' => 'Контакты',
                    'PROPERTY_MAP_POINT'
                ],
                'Персона' => [
                    'PREVIEW_PICTURE' => 'Фотография',
                    'PROPERTY_PERSON_NAME',
                    'PROPERTY_PERSON_POSITION',
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('COMPANY', 'COMPANY');

    }

}
