<?php

namespace Sprint\Migration;


class IB_ADD_OBJECTS_2_20190415095612 extends Version
{

    protected $description = "Добавляет ИБ объекты";

    public function up()
    {
        $helper = new HelperManager();

        $arIBlockType = array(
            'ID' => 'OBJECTS',
            'SECTIONS' => 'Y',
            'IN_RSS' => 'Y',
            'SORT' => 100,
            'LANG' => array(
                'ru' => array(
                    'NAME' => 'Объекты',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Объекты'
                ),
                'en' => array(
                    'NAME' => 'Objects',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'Objects'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'OBJECTS',
            'CODE' => 'OBJECTS_2',
            'NAME' => 'Объекты test',
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
            'LIST_PAGE_URL' => '/objects/',
            'DETAIL_PAGE_URL' => '/objects/#ELEMENT_CODE#/',
        ));

        $arProps = array(
            array(
                'NAME' => 'Фотогалерея',
                'CODE' => 'PHOTOS',
                'PROPERTY_TYPE' => 'F',
                'MULTIPLE' => 'Y',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'Ссылка на видеоролик YouTube',
                'CODE' => 'VIDEO_LINK',
                'PROPERTY_TYPE' => 'S',
            ),
            /*
             * Абзац 1
             */
            array(
                'NAME' => 'Текст Абзац 1',
                'CODE' => 'TEXT_PART_1',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Изображение Абзац 1',
                'CODE' => 'IMAGE_PART_1',
                'PROPERTY_TYPE' => 'F',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            /*
             * Абзац 2
             */
            array(
                'NAME' => 'Текст Абзац 2 (крупный)',
                'CODE' => 'TEXT_PART_2_LARGE',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Изображение Абзац 2',
                'CODE' => 'IMAGE_PART_2',
                'PROPERTY_TYPE' => 'F',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'Текст Абзац 2 (мелкий)',
                'CODE' => 'TEXT_PART_2_SMALL',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            /*
             * Абзац 3
             */
            array(
                'NAME' => 'Текст Абзац 3',
                'CODE' => 'TEXT_PART_3',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Изображение Абзац 3',
                'CODE' => 'IMAGE_PART_3',
                'PROPERTY_TYPE' => 'F',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            /*
             * Абзац 4
             */
            array(
                'NAME' => 'Текст Абзац 4',
                'CODE' => 'TEXT_PART_4',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Изображение Абзац 4',
                'CODE' => 'IMAGE_PART_4',
                'PROPERTY_TYPE' => 'F',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'Дополниельный текст',
                'CODE' => 'TEXT_FULL_PAGE',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'HINT' => 'Текст по всей ширене страницы'
            ),
            array(
                'NAME' => 'Выводить на главной',
                'CODE' => 'PUBLISH_MAIN',
                'PROPERTY_TYPE' => 'L',
                'LIST_TYPE' => 'C',
                'VALUES' => [
                    [
                        'XML_ID' => 'Y',
                        'VALUE' => 'Да'
                    ]
                ]
            ),
            array(
                'NAME' => 'Выводить в слайдере',
                'CODE' => 'PUBLISH_SLIDER',
                'PROPERTY_TYPE' => 'L',
                'LIST_TYPE' => 'C',
                'VALUES' => [
                    [
                        'XML_ID' => 'Y',
                        'VALUE' => 'Да'
                    ]
                ]
            ),
            array(
                'NAME' => 'Год выполнения',
                'CODE' => 'YEAR',
                'PROPERTY_TYPE' => 'S',
            ),
            array(
                'NAME' => 'Вид работ',
                'CODE' => 'WORK_TYPE',
                'PROPERTY_TYPE' => 'E',
                'LINK_IBLOCK_ID' => $helper->Iblock()->getIblockId('SERVICES', 'SERVICES'),
                'MULTIPLE' => 'Y',
            ),
            array(
                'NAME' => 'Применяемые решения',
                'CODE' => 'SOLUTIONS',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'directory',
                'USER_TYPE_SETTINGS' => array(
                    'TABLE_NAME' => $helper->Hlblock()->getHlblockIfExists('SolutionsFilter')['TABLE_NAME']
                ),
                'MULTIPLE' => 'Y',
            ),
            array(
                'NAME' => 'Филиал',
                'CODE' => 'BRANCH',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'directory',
                'USER_TYPE_SETTINGS' => array(
                    'TABLE_NAME' => $helper->Hlblock()->getHlblock('BranchFilter')
                ),
                'MULTIPLE' => 'Y',
            ),
            array(
                'NAME' => 'Название для слайдера',
                'CODE' => 'NAME_SLIDER',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Изображение на слайдере',
                'CODE' => 'PICTURE_SLIDER',
                'PROPERTY_TYPE' => 'F',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }

            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Объект' => [
                    'ACTIVE',
                    'NAME',
                    'CODE',
                    'PREVIEW_PICTURE' => 'Изображение на превью',
                    'DETAIL_PICTURE' => 'Детальное изобраджение',
                    'PREVIEW_TEXT' => 'Описание (крупный текст)',
                    'DETAIL_TEXT' => 'Описание (мелкий текст)',
                    'edit1_csection1' => 'Первый абзац',
                    'PROPERTY_TEXT_PART_1',
                    'PROPERTY_IMAGE_PART_1',
                    'edit1_csection2' => 'Второй абзац',
                    'PROPERTY_TEXT_PART_2_LARGE',
                    'PROPERTY_IMAGE_PART_2',
                    'PROPERTY_TEXT_PART_2_SMALL',
                    'edit1_csection3' => 'Третий абзац',
                    'PROPERTY_TEXT_PART_3',
                    'PROPERTY_IMAGE_PART_3',
                    'edit1_csection4' => 'Четвертый абзац',
                    'PROPERTY_TEXT_PART_4',
                    'PROPERTY_IMAGE_PART_4',
                    'edit1_csection5' => 'Дополнительный абзац',
                    'PROPERTY_TEXT_FULL_PAGE',

                ],
                'Мультимедия материалы' => [
                    'PROPERTY_PHOTOS',
                    'PROPERTY_VIDEO_LINK'

                ],
                'Фильтры' => [
                    'PROPERTY_YEAR',
                    'PROPERTY_WORK_TYPE',
                    'PROPERTY_SOLUTIONS',
                    'PROPERTY_BRANCH'
                ],
                'Слайдер' => [
                    'PROPERTY_NAME_SLIDER',
                    'PROPERTY_PICTURE_SLIDER',
                    'PROPERTY_PUBLISH_MAIN',
                    //'PROPERTY_PUBLISH_SLIDER',
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        $helper->Iblock()->deleteIblockIfExists('OBJECTS_2', 'OBJECTS');

    }

}
