<?php

namespace Sprint\Migration;


class IB_ADD_SOLUTIONS_KSO_20190418112035 extends Version
{

    protected $description = "Добавляет ИБ Решения КСО";

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
            'CODE' => 'SOLUTIONS_KSO',
            'NAME' => 'Решения КСО',
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
            'LIST_PAGE_URL' => '/solutions_kso/',
            'SECTION_PAGE_URL' => '/solutions_kso/#SECTION_CODE_PATH#/',
            'DETAIL_PAGE_URL' => '/solutions_kso/#ELEMENT_CODE#/',
        ));

        $arProps = array(
            array(
                'NAME' => 'Дополнительное название',
                'CODE' => 'SECOND_NAME',
                'PROPERTY_TYPE' => 'S',
            ),
            array(
                'NAME' => 'Мошьность',
                'CODE' => 'POWER',
                'PROPERTY_TYPE' => 'S',
            ),
            array(
                'NAME' => 'Применение (крупный текст)',
                'CODE' => 'APPLICATION_LARGE_TEXT',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Применение (мелкий текст)',
                'CODE' => 'APPLICATION_SMALL_TEXT',
                'USER_TYPE' => 'HTML',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Заголовок документы',
                'CODE' => 'DOCUMENTS_TITLE',
                'PROPERTY_TYPE' => 'S'
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
                'NAME' => 'Технические характеристики (Заголовок)',
                'CODE' => 'SPECIFICATION_NAME',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Технические характеристики (Описание)',
                'CODE' => 'SPECIFICATION_TEXT',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Технические характеристики (Таблица)',
                'CODE' => 'SPECIFICATION',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Классификация (Заголовок)',
                'CODE' => 'CLASSIFICATION_NAME',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Классификация (Таблица)',
                'CODE' => 'CLASSIFICATION',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Типы применяемого оборудования (Заголовок)',
                'CODE' => 'TYPES_EQU_NAME',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Типы применяемого оборудования (Таблица)',
                'CODE' => 'TYPES_EQU',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Фотографии',
                'CODE' => 'PHOTOS',
                'PROPERTY_TYPE' => 'F',
                'MULTIPLE' => 'Y',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'Объекты',
                'CODE' => 'OBJECTS',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'MULTIPLE' => 'Y'
            ),
            array(
                'NAME' => 'Приемущества',
                'CODE' => 'ADVANTAGES',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'MULTIPLE' => 'Y',
                'WITH_DESCRIPTION' => 'Y',
                'HINT' => 'В качестве описания указываейте НАЗВАНИЕ приемущества'
            ),
            array(
                'NAME' => 'Применение на различных этапах',
                'CODE' => 'APPLICATION_PHOTO',
                'PROPERTY_TYPE' => 'F',
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
                    'PROPERTY_SECOND_NAME',
                    'PROPERTY_POWER',
                    'PREVIEW_PICTURE' => 'Изображение на превью',
                    'DETAIL_PICTURE' => 'Детальное изображение',
                    'PREVIEW_TEXT' => 'Расшифровка',
                    'DETAIL_TEXT' => 'Описание',
                    'PROPERTY_APPLICATION_LARGE_TEXT',
                    'PROPERTY_APPLICATION_SMALL_TEXT',
                    'PROPERTY_APPLICATION_PHOTO',
                    'PROPERTY_OBJECTS',
                    'PROPERTY_DOCUMENTS_TITLE',
                    'PROPERTY_DOCUMENTS',
                    'PROPERTY_PHOTOS',
                    'PROPERTY_DOCUMENTS',
                    'PROPERTY_ADVANTAGES',
                ],
                'Таблицы' =>[
                    'PROPERTY_SPECIFICATION_NAME',
                    'PROPERTY_SPECIFICATION_TEXT',
                    'PROPERTY_SPECIFICATION',
                    'PROPERTY_CLASSIFICATION_NAME',
                    'PROPERTY_CLASSIFICATION',
                    'PROPERTY_TYPES_EQU_NAME',
                    'PROPERTY_TYPES_EQU'
                 ],
                'Проекты' =>[
                    'PROPERTY_SOLUTIONS_FILTER'
                ],
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('SOLUTIONS_KSO', 'SOLUTIONS');

    }

}
