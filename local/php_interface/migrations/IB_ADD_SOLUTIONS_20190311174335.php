<?php

namespace Sprint\Migration;


class IB_ADD_SOLUTIONS_20190311174335 extends Version
{

    protected $description = "Добавляет ИБ Решения";

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
            'CODE' => 'SOLUTIONS',
            'NAME' => 'Решения',
            'FIELDS' => [
                'CODE' => [
                    'IS_REQUIRED' => 'Y',
                    'DEFAULT_VALUE' => [
                        'UNIQUE' => 'Y',
                        'TRANSLITERATION' => 'Y',
                        'TRANS_CASE' => 'L'
                    ]
                ],
                'SECTION_CODE' => [
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
                'NAME' => 'Применение (СТО)',
                'CODE' => 'APPLICATION_STO_TEXT',
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
                'NAME' => 'Преимущества',
                'CODE' => 'ADVANTAGE',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'WITH_DESCRIPTION' => 'Y',
                'MULTIPLE' => 'Y',
                'HINT' => 'Используйте описание, для задания названия приемущества'
            ),
            array(
                'NAME' => 'Фотографии',
                'CODE' => 'PHOTOS',
                'PROPERTY_TYPE' => 'F',
                'MULTIPLE' => 'Y',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'Изображение слайдере (главная страница)',
                'CODE' => 'MAIN_PICTURE',
                'PROPERTY_TYPE' => 'F',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'Технические характеристики (Заголовок)',
                'CODE' => 'SPECIFICATIONS_TITLE',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Технические характеристики',
                'CODE' => 'SPECIFICATIONS',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'HINT' => 'Используйте таблицу HTML'
            ),
            array(
                'NAME' => 'Варианты технических решений (Заголовок)',
                'CODE' => 'TEH_SOLUTION_TITLE',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Варианты технических решений',
                'CODE' => 'TEH_SOLUTION',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'HINT' => 'Используйте таблицу HTML'
            ),

            array(
                'NAME' => 'Структура обозначения',
                'CODE' => 'DESIGNATIONS',
                'WITH_DESCRIPTION' => 'Y',
                'PROPERTY_TYPE' => 'S',
                'MULTIPLE' => 'Y',
                'HINT' => 'По порядку, части обозначения с описаниями'
            ),
            array(
                'NAME' => 'Примеры обозначений',
                'CODE' => 'DESIGNATIONS_EXAMPLE',
                'PROPERTY_TYPE' => 'S',
                'MULTIPLE' => 'Y',
            ),
            array(
                'NAME' => 'Расшифровка',
                'CODE' => 'DESIGNATIONS_DESCRIPTION',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
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
                'NAME' => 'Состав решения',
                'CODE' => 'COMPOSITIONS',
                'PROPERTY_TYPE' => 'G',
                'LINK_IBLOCK_ID' => $helper->Iblock()->getIblockId('COMPOSITIONS', 'SOLUTIONS'),
                'HINT' => 'Связь с разделом инфоблока - элементы решения'
            ),
            array(
                'NAME' => 'Применяемые исполнения',
                'CODE' => 'EXECUTION',
                'PROPERTY_TYPE' => 'G',
                'LINK_IBLOCK_ID' => $helper->Iblock()->getIblockId('EXECUTION', 'SOLUTIONS'),
                'HINT' => 'Связь с разделом инфоблока - Применяемые исполнения'
            ),
            array(
                'NAME' => 'Название Применения 1',
                'CODE' => 'EXECUTION_NAME_1',
                'PROPERTY_TYPE' => 'S',
            ),
            array(
                'NAME' => 'Применение подходят в качестве',
                'CODE' => 'EXECUTION_DESC_1',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Название Применения 2',
                'CODE' => 'EXECUTION_NAME_2',
                'PROPERTY_TYPE' => 'S',
            ),
            array(
                'NAME' => 'Применение подходят в качестве',
                'CODE' => 'EXECUTION_DESC_2',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Описание состава решения',
                'CODE' => 'COMPOSITION_DESC',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Типы выключателей (таблица)',
                'CODE' => 'COMPOSITION_TABLE',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),

            array(
                'NAME' => 'Конструкция',
                'CODE' => 'STRUCTURE',
                'PROPERTY_TYPE' => 'G',
                'LINK_IBLOCK_ID' => $helper->Iblock()->getIblockId('STRUCTURE', 'SOLUTIONS'),
                'HINT' => 'Связь с разделом инфоблока - конструкция решения'
            )
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
                    'PROPERTY_MAIN_PICTURE',
                    'PREVIEW_TEXT' => 'Расшифровка',
                    'DETAIL_TEXT' => 'Описание',
                    'PROPERTY_APPLICATION_LARGE_TEXT',
                    'PROPERTY_APPLICATION_STO_TEXT',
                    'PROPERTY_APPLICATION_SMALL_TEXT',
                    'PROPERTY_DOCUMENTS',
                    'PROPERTY_PHOTOS',
                    'PROPERTY_TEH_SOLUTION_TITLE',
                    'PROPERTY_TEH_SOLUTION',
                    'PROPERTY_SPECIFICATIONS_TITLE',
                    'PROPERTY_SPECIFICATIONS'
                ],
                'Приемущества' =>[
                    'PROPERTY_ADVANTAGE'
                 ],
                'Применяемые исполнения' =>[
                    'PROPERTY_EXECUTION',
                    'PROPERTY_EXECUTION_NAME_1',
                    'PROPERTY_EXECUTION_DESC_1',
                    'PROPERTY_EXECUTION_NAME_2',
                    'PROPERTY_EXECUTION_DESC_2',
                 ],
                'Структура обозначения' => [
                    'PROPERTY_DESIGNATIONS',
                    'PROPERTY_DESIGNATIONS_EXAMPLE',
                    'PROPERTY_DESIGNATIONS_DESCRIPTION',
                ],
                'Проекты' =>[
                    'PROPERTY_SOLUTIONS_FILTER'
                ],
                'Состав решения' =>[
                    'PROPERTY_COMPOSITION_DESC',
                    'PROPERTY_COMPOSITION_TABLE',
                    'PROPERTY_COMPOSITIONS'
                ],
                'Конструкция' =>[
                    'PROPERTY_STRUCTURE'
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
