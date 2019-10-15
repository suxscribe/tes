<?php

namespace Sprint\Migration;


class IB_ADD_TYPES_OF_BLOCKS_20190405100001 extends Version
{

    protected $description = "Добавляет ИБ Типы блоков ОРУ";

    public function up()
    {
        $helper = new HelperManager();

        $arIBlockType = array(
            'ID' => 'SOLUTIONS',
            'SECTIONS' => 'Y',
            'IN_RSS' => 'Y',
            'SORT' => 100,
            'LANG' => array(
                'ru' => array(
                    'NAME' => 'Решения',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Элементы'
                ),
                'en' => array(
                    'NAME' => 'Solutions',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'Elements'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'SOLUTIONS',
            'CODE' => 'TYPES_OF_BLOCKS',
            'NAME' => 'Типы блоков ОРУ',
            'FIELDS' => [
                'SECTION_CODE' => [
                    'IS_REQUIRED' => 'Y',
                    'DEFAULT_VALUE' => [
                        'UNIQUE' => 'Y',
                        'TRANSLITERATION' => 'Y',
                        'TRANS_CASE' => 'L'
                    ]
                ]
            ]
        ));
        if ($iIBlockID) {
            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Элемент конструкции' => [
                    'ACTIVE',
                    'SORT',
                    'NAME',
                    'PREVIEW_TEXT' => 'Описание',
                    'PREVIEW_PICTURE' => 'Изображение',
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('TYPES_OF_BLOCKS', 'SOLUTIONS');

    }

}
