<?php

namespace Sprint\Migration;


class IB_ADD_STRUCTURE_20190311174301 extends Version
{

    protected $description = "Добавляет ИБ Конструкция";

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
            'CODE' => 'STRUCTURE',
            'NAME' => 'Конструкция',
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

        $arProps = array(
            array(
                'NAME' => 'Фотографии',
                'CODE' => 'PHOTOS',
                'PROPERTY_TYPE' => 'F',
                'WITH_DESCRIPTION' => 'Y',
                'MULTIPLE' => 'Y',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'Вложеные элементы',
                'CODE' => 'ELEMENTS',
                'PROPERTY_TYPE' => 'E',
                'MULTIPLE' => 'Y',
                'LINK_IBLOCK_ID' => $helper->Iblock()->getIblockId('STRUCTURE', 'SOLUTIONS'),
                'HINT' => 'Используется если конструктивный элемент делиться на несколько типов'
            ),
            array(
                'NAME' => 'Ссылка на страницу',
                'CODE' => 'LINK',
                'PROPERTY_TYPE' => 'S',
            ),
        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }

            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Элемент конструкции' => [
                    'ACTIVE',
                    'SORT',
                    'NAME',
                    'PREVIEW_TEXT' => 'Описание',
                    'PROPERTY_LINK',
                    'PROPERTY_PHOTOS',
                ],
                'Вложенные решения' =>[
                    'PROPERTY_ELEMENTS'
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('STRUCTURE', 'SOLUTIONS');

    }

}
