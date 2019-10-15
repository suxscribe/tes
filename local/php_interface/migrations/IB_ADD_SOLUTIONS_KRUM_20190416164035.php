<?php

namespace Sprint\Migration;


class IB_ADD_SOLUTIONS_KRUM_20190416164035 extends Version
{

    protected $description = "Добавляет ИБ Решения КРУМ";

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
            'CODE' => 'SOLUTIONS_KRUM',
            'NAME' => 'Решения КРУМ',
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
            'LIST_PAGE_URL' => '/solutions_krum/',
            'SECTION_PAGE_URL' => '/solutions_krum/#SECTION_CODE_PATH#/',
            'DETAIL_PAGE_URL' => '/solutions_krum/#ELEMENT_CODE#/',
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
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Применение (мелкий текст)',
                'CODE' => 'APPLICATION_SMALL_TEXT',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Комплект поставки',
                'CODE' => 'CONTENTS',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'MULTIPLE' => 'Y'
            ),
            array(
                'NAME' => 'Дополнительные особенности',
                'CODE' => 'FEATURES',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'MULTIPLE' => 'Y'
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
                'NAME' => 'Фотографии',
                'CODE' => 'PHOTOS',
                'PROPERTY_TYPE' => 'F',
                'MULTIPLE' => 'Y',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
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
                    'PROPERTY_PHOTOS',
                ],
                'Комплект поставки' => [
                    'PROPERTY_CONTENTS'
                ],
                'Особенности' => [
                    'PROPERTY_FEATURES'
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

        //$helper->Iblock()->deleteIblockIfExists('SOLUTIONS_KRUM', 'SOLUTIONS');

    }

}
