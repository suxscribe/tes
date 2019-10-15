<?php

namespace Sprint\Migration;


class IB_ADD_SOLUTIONS_COMPOSITIONS_20190311174000 extends Version
{

    protected $description = "Добавляет ИБ Состав решения";

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
                    'NAME' => 'Проекты',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Элементы'
                ),
                'en' => array(
                    'NAME' => 'Projects',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'Elements'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'SOLUTIONS',
            'CODE' => 'COMPOSITIONS',
            'NAME' => 'Состав решения'
        ));

        $arProps = array(
            array(
                'NAME' => 'Расположение пина по X в %',
                'CODE' => 'PIN_X',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Расположение пина по Y в %',
                'CODE' => 'PIN_Y',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Мощьность',
                'CODE' => 'POWER',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Наименование на макете',
                'CODE' => 'NAME_ON_MAP',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Ссылка на страницу',
                'CODE' => 'LINK',
                'PROPERTY_TYPE' => 'S'
            )
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
                    'PROPERTY_NAME_ON_MAP',
                    'PROPERTY_POWER',
                    'PREVIEW_TEXT' => 'Описание',
                    'PROPERTY_LINK',
                    'PREVIEW_PICTURE' => 'Изображение на макете',
                    'DETAIL_PICTURE' => 'Детальное изображение',
                    'PROPERTY_PIN_X',
                    'PROPERTY_PIN_Y',
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('COMPOSITIONS', 'SOLUTIONS');

    }

}
