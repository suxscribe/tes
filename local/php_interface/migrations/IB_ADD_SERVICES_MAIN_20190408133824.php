<?php

namespace Sprint\Migration;


class IB_ADD_SERVICES_MAIN_20190408133824 extends Version
{

    protected $description = "Добавляет ИБ Услуги (разводящая страница)";

    public function up()
    {
        $helper = new HelperManager();

        $arIBlockType = array(
            'ID' => 'SERVICES',
            'SECTIONS' => 'Y',
            'IN_RSS' => 'Y',
            'SORT' => 100,
            'LANG' => array(
                'ru' => array(
                    'NAME' => 'Услуги',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Элементы'
                ),
                'en' => array(
                    'NAME' => 'Services',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'Elements'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'SERVICES',
            'CODE' => 'SERVICE_MAIN',
            'NAME' => 'Услуги (разводящая страница)',
            'FIELDS' => [
                'CODE' => [
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
                'NAME' => 'Название области',
                'CODE' => 'STAGES_NAME',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Описание области',
                'CODE' => 'STAGES_DESC',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Элементы области',
                'CODE' => 'STAGES',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'MULTIPLE' => 'Y',
            ),
            array(
                'NAME' => 'Преимущества',
                'CODE' => 'ADVANTAGE',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'WITH_DESCRIPTION' => 'Y',
                'MULTIPLE' => 'Y',
                'HINT' => 'Используйте описание, для задания НАЗВАНИЯ приемущества'
            ),
        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }

            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Разводящая страница услуг' => [
                    'NAME',
                    'CODE',
                    'PREVIEW_TEXT' => 'Описание',
                ],
                'Область компетенций' =>[
                    'PROPERTY_STAGES_NAME',
                    'PROPERTY_STAGES_DESC',
                    'PROPERTY_STAGES',
                ],
                'Преимущества' =>[
                    'PROPERTY_ADVANTAGE',
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('SERVICE_MAIN', 'SERVICES');

    }

}
