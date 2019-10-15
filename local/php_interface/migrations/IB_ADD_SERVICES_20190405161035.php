<?php

namespace Sprint\Migration;


class IB_ADD_SERVICES_20190405161035 extends Version
{

    protected $description = "Добавляет ИБ Услуги";

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
            'CODE' => 'SERVICES',
            'NAME' => 'Услуги',
            'FIELDS' => [
                'CODE' => [
                    'IS_REQUIRED' => 'Y',
                    'DEFAULT_VALUE' => [
                        'UNIQUE' => 'Y',
                        'TRANSLITERATION' => 'Y',
                        'TRANS_CASE' => 'L'
                    ]
                ]
            ],
            'LIST_PAGE_URL' => '/services/',
            'DETAIL_PAGE_URL' => '/services/#ELEMENT_CODE#/',
        ));

        $arProps = array(
            array(
                'NAME' => 'Фотографии',
                'CODE' => 'PHOTOS',
                'PROPERTY_TYPE' => 'F',
                'MULTIPLE' => 'Y',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'Лицензии и сертификаты',
                'CODE' => 'DOCUMENTS',
                'PROPERTY_TYPE' => 'F',
                'WITH_DESCRIPTION' => 'Y',
                'MULTIPLE' => 'Y',
                'FILE_TYPE' => 'pdf, doc, docx, xls, xlsx',
                'HINT' => 'Используйте описание, для задания отображаемого имяни файла'
            ),
            array(
                'NAME' => 'Текст после слайдера (крупный)',
                'CODE' => 'STAGES_TEXT_LARGE',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Текст после слайдера (мелкий)',
                'CODE' => 'STAGES_TEXT_SMALL',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
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
                'NAME' => '"Элементы области"',
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
            )
        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }

            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Услуга' => [
                    'ACTIVE',
                    'SORT',
                    'NAME',
                    'CODE',
                    'PREVIEW_PICTURE' => 'Изображение на превью',
                    'DETAIL_PICTURE' => 'Изображение услуги',
                    'PREVIEW_TEXT' => 'Описание (крупный текст)',
                    'DETAIL_TEXT' => 'Описание (мелкий текст)',
                    'PROPERTY_PHOTOS',
                    'PROPERTY_STAGES_TEXT_LARGE',
                    'PROPERTY_STAGES_TEXT_SMALL',
                    'PROPERTY_DOCUMENTS',
                ],
                'Преимущества' =>[
                    'PROPERTY_ADVANTAGE',

                ],
                'Область компетенций' =>[
                    'PROPERTY_STAGES_NAME',
                    'PROPERTY_STAGES_DESC',
                    'PROPERTY_STAGES',
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('SOLUTIONS', 'SOLUTIONS');

    }

}
