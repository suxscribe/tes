<?php

namespace Sprint\Migration;


class IB_ADD_EXECUTION_20190404104513 extends Version
{

    protected $description = "Добавляет ИБ Применяемые исполнения";

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
                    'NAME' => 'Исполнения',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Элементы'
                ),
                'en' => array(
                    'NAME' => 'Execution',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'Elements'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'SOLUTIONS',
            'CODE' => 'EXECUTION',
            'NAME' => 'Применяемые исполнения'
        ));

        $arProps = array(
            array(
                'NAME' => 'Мощность',
                'CODE' => 'POWER',
                'PROPERTY_TYPE' => 'S'
            ),

        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }

            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Элемент решения' => [
                    'ACTIVE',
                    'SORT',
                    'NAME',
                    'PROPERTY_POWER',
                    'PREVIEW_TEXT' => 'Расшифровка',
                    'DETAIL_TEXT' => 'Описание',
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('EXECUTION', 'SOLUTIONS');

    }

}
