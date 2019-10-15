<?php

namespace Sprint\Migration;


class IB_ADD_SOLUTIONS_ORU_20190405100135 extends Version
{

    protected $description = "Добавляет ИБ Решения ОРУ";

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
            'CODE' => 'SOLUTIONS_ORU',
            'NAME' => 'Решения ОРУ',
            'FIELDS' => [
                'CODE' => [
                    'IS_REQUIRED' => 'Y',
                    'DEFAULT_VALUE' => [
                        'UNIQUE' => 'Y',
                        'TRANSLITERATION' => 'Y',
                        'TRANS_CASE' => 'L'
                    ]
                ],
                'DETAIL_TEXT_TYPE'=>[
                    'DEFAULT_VALUE' => 'html'
                ]
            ],
            'LIST_PAGE_URL' => '/solutions/',
            'SECTION_PAGE_URL' => '/solutions/#SECTION_CODE_PATH#/',
            'DETAIL_PAGE_URL' => '/solutions/#ELEMENT_CODE#/',
        ));

        $arProps = array(
            array(
                'NAME' => 'Мошьность',
                'CODE' => 'POWER',
                'PROPERTY_TYPE' => 'S',
            ),
            array(
                'NAME' => 'Применение (крупный текст)',
                'CODE' => 'APPLICATION_LARGE_TEXT',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Применение (мелкий текст)',
                'CODE' => 'APPLICATION_SMALL_TEXT',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Документы',
                'CODE' => 'DOCUMENTS',
                'PROPERTY_TYPE' => 'F',
                'WITH_DESCRIPTION' => 'Y',
                'MULTIPLE' => 'Y',
                'FILE_TYPE' => 'pdf, doc, docx, xls, xlsx',
                'HINT' => 'Используйте описание, для задания отображаемого имяни файла'
            ),
            array(
                'NAME' => 'Типовой комплект поставки',
                'CODE' => 'CONTENTS',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'MULTIPLE' => 'Y'
            ),

            array(
                'NAME' => 'Фотографии',
                'CODE' => 'PHOTOS',
                'PROPERTY_TYPE' => 'F',
                'MULTIPLE' => 'Y',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'Решение в справочнике (Фильтр по решениям)',
                'CODE' => 'SOLUTIONS_FILTER',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'directory',
                'USER_TYPE_SETTINGS' => array(
                    'TABLE_NAME' => $helper->Hlblock()->getHlblockIfExists('SolutionsFilter')['TABLE_NAME']
                ),
                'HINT' => 'Служит для вывода объектов связанных с решением'
            ),

            array(
                'NAME' => 'Типы блоков (Описание до блока)',
                'CODE' => 'TYPES_OF_BLOCKS_DESC_BEFORE',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30
            ),
            array(
                'NAME' => 'Типы блоков (Описание после блока)',
                'CODE' => 'TYPES_OF_BLOCKS_DESC_AFTER',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30
            ),
            array(
                'NAME' => 'Типы блоков',
                'CODE' => 'TYPES_OF_BLOCKS_LINK',
                'PROPERTY_TYPE' => 'G',
                'LINK_IBLOCK_ID' => $helper->Iblock()->getIblockId('TYPES_OF_BLOCKS', 'SOLUTIONS'),
                'HINT' => 'Связь с разделом инфоблока "Типы блоков"'
            ),
            array(
                'NAME' => 'Конструкция',
                'CODE' => 'STRUCTURE',
                'PROPERTY_TYPE' => 'G',
                'LINK_IBLOCK_ID' => $helper->Iblock()->getIblockId('STRUCTURE', 'SOLUTIONS'),
                'HINT' => 'Связь с разделом инфоблока - конструкция решения'
            ),
        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }

            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Решение' => [
                    'ACTIVE',
                    'SORT',
                    'NAME',
                    'CODE',
                    'PROPERTY_POWER',
                    'PREVIEW_PICTURE' => 'Изображение на превью',
                    'DETAIL_PICTURE' => 'Детальное изображение',
                    'PREVIEW_TEXT' => 'Расшифровка',
                    'DETAIL_TEXT' => 'Описание',
                    'PROPERTY_APPLICATION_LARGE_TEXT',
                    'PROPERTY_APPLICATION_SMALL_TEXT',
                    'PROPERTY_DOCUMENTS',
                    'PROPERTY_PHOTOS',
                ],
                'Комплект поставки' =>[
                    'PROPERTY_CONTENTS'
                 ],
                'Проекты' =>[
                    'PROPERTY_SOLUTIONS_FILTER'
                ],
                'Типы блоков' =>[
                    'PROPERTY_TYPES_OF_BLOCKS_DESC_BEFORE',
                    'PROPERTY_TYPES_OF_BLOCKS_DESC_AFTER',
                    'PROPERTY_TYPES_OF_BLOCKS_LINK',
                 ],
                'Конструкция' => [
                    'PROPERTY_STRUCTURE',
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('SOLUTIONS_ORU', 'SOLUTIONS');

    }

}
