<?php

namespace Sprint\Migration;


class IB_ADD_MAIN_20190423173615 extends Version
{

    protected $description = "Добавляет ИБ Главная";

    public function up()
    {
        $helper = new HelperManager();

        $arIBlockType = array(
            'ID' => 'MAIN',
            'SECTIONS' => 'N',
            'IN_RSS' => 'N',
            'SORT' => 100,
            'LANG' => array(
                'ru' => array(
                    'NAME' => 'Главная',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Новости'
                ),
                'en' => array(
                    'NAME' => 'News',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'News'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'MAIN',
            'CODE' => 'MAIN',
            'NAME' => 'Главная'
        ));

        $arProps = array(
            array(
                'NAME' => 'Буклет',
                'CODE' => 'DOCUMENT',
                'WITH_DESCRIPTION' => 'Y',
                'PROPERTY_TYPE' => 'F',
                'MULTIPLE' => 'Y',

            ),
            array(
                'NAME' => 'E-mail',
                'CODE' => 'EMAIL',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Единый номер',
                'CODE' => 'PHONE',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Единый номер (Поисание)',
                'CODE' => 'PHONE_DESC',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 2,
                'COL_COUNT' => 60,
            ),
            array(
                'NAME' => 'Копирайт',
                'CODE' => 'COPYRIGHT',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Телефон',
                'CODE' => 'OFFICE_PHONE',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Город',
                'CODE' => 'OFFICE_CITY',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Адрес',
                'CODE' => 'OFFICE_ADDRESS',
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
                'Основные настройки сайта' => [
                    'NAME',
                    'CODE',
                    'PREVIEW_TEXT' => 'Описание в подвале',
                    'PROPERTY_DOCUMENT',
                    'PROPERTY_EMAIL',
                    'PROPERTY_PHONE',
                    'PROPERTY_PHONE_DESC',
                    'PROPERTY_COPYRIGHT',

                ],
                'Офис' =>[
                    'PROPERTY_OFFICE_PHONE',
                    'PROPERTY_OFFICE_CITY',
                    'PROPERTY_OFFICE_ADDRESS',
                    'PROPERTY_MAP_POINT'
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('MAIN', 'MAIN');

    }

}
