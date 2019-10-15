<?php

namespace Sprint\Migration;


class IB_ADD_COMPANY_STRUKTURE_20190419134010 extends Version
{

    protected $description = "Добавляет ИБ Структура";

    public function up()
    {
        $helper = new HelperManager();

        $arIBlockType = array(
            'ID' => 'COMPANY',
            'SECTIONS' => 'Y',
            'IN_RSS' => 'Y',
            'SORT' => 100,
            'LANG' => array(
                'ru' => array(
                    'NAME' => 'О компании',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Элемент'
                ),
                'en' => array(
                    'NAME' => 'about company',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'News'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'COMPANY',
            'CODE' => 'STRUCTURE',
            'NAME' => 'Структура'
        ));


        if ($iIBlockID) {
                       $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Новость' => [
                    'ACTIVE',
                    'NAME',
                    'PREVIEW_TEXT' => 'Контакты'
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        $helper->Iblock()->deleteIblockIfExists('STRUCTURE', 'COMPANY');

    }

}
