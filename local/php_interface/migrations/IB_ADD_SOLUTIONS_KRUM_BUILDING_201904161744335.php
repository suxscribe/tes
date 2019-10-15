<?php

namespace Sprint\Migration;


class IB_ADD_SOLUTIONS_KRUM_BUILDING_201904161744335 extends Version
{

    protected $description = "Добавляет ИБ Решения КРУМ (Здания)";

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
            'CODE' => 'SOLUTIONS_KRUM_BUILDING',
            'NAME' => 'Решения КРУМ (Здания)'
        ));
        if ($iIBlockID) {
            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Решение' => [
                    'ACTIVE',
                    'SORT',
                    'NAME',
                    'PREVIEW_PICTURE' => 'Изображение',
                    'PREVIEW_TEXT' => 'Текст 1',
                    'DETAIL_TEXT' => 'Текст 2',
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('SOLUTIONS_KRUM_BUILDING', 'SOLUTIONS');

    }

}
