<?php

namespace Sprint\Migration;


class IB_ADD_COMPANY_PARTNERS_20190419105959 extends Version
{

    protected $description = "Добавляет ИБ Партнеры";

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
            'CODE' => 'PARTNERS',
            'NAME' => 'Партнеры',
            'FIELDS' => [
                'CODE' => [
                    'IS_REQUIRED' => 'Y',
                    'DEFAULT_VALUE' => [
                        'UNIQUE' => 'Y',
                        'TRANSLITERATION' => 'Y',
                        'TRANS_CASE' => 'L'
                    ]
                ],
            ]
        ));


        if ($iIBlockID) {
                       $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Новость' => [
                    'ACTIVE',
                    'NAME',
                    'CODE',
                    'PREVIEW_TEXT' => 'Описание',
                    'PREVIEW_PICTURE' => 'Логотип',
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        $helper->Iblock()->deleteIblockIfExists('PARTNERS', 'COMPANY');

    }

}
