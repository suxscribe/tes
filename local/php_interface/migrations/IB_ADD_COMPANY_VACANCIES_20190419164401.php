<?php

namespace Sprint\Migration;


class IB_ADD_COMPANY_VACANCIES_20190419164401 extends Version
{

    protected $description = "Добавляет ИБ Вакансии";

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
            'CODE' => 'VACANCIES',
            'NAME' => 'Вакансии',
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

        $arProps = array(

            array(
                'NAME' => 'Условия работы',
                'CODE' => 'CONDITIONS',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 2,
                'COL_COUNT' => 60,
                'MULTIPLE' => 'Y',
            ),
            array(
                'NAME' => 'Должностные обязанности',
                'CODE' => 'DUTIES',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 2,
                'COL_COUNT' => 60,
                'MULTIPLE' => 'Y',
            ),
            array(
                'NAME' => 'Требования',
                'CODE' => 'REQUIREMENTS',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 2,
                'COL_COUNT' => 60,
                'MULTIPLE' => 'Y',
            ),
            array(
                'NAME' => 'Резюме принимаются',
                'CODE' => 'RESUME_CONTACTS',
                'USER_TYPE' => 'HTML',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 60,
            ),
        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }

            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Новость' => [
                    'NAME' => 'Название вакансии',
                    'CODE',
                    'PREVIEW_TEXT' => 'Условия работы (Описание)',
                    'PROPERTY_CONDITIONS',
                    'PROPERTY_DUTIES',
                    'PROPERTY_REQUIREMENTS',
                    'PROPERTY_RESUME_CONTACTS'
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('VACANCIES', 'COMPANY');

    }

}
