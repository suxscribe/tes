<?php

namespace Sprint\Migration;


class IB_ADD_NEWS_20190412145601 extends Version
{

    protected $description = "Добавляет ИБ Новости";

    public function up()
    {
        $helper = new HelperManager();

        $arIBlockType = array(
            'ID' => 'NEWS',
            'SECTIONS' => 'Y',
            'IN_RSS' => 'Y',
            'SORT' => 100,
            'LANG' => array(
                'ru' => array(
                    'NAME' => 'Новости',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Новости'
                ),
                'en' => array(
                    'NAME' => 'News',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'News'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'NEWS',
            'CODE' => 'NEWS',
            'NAME' => 'Новости',
            'FIELDS' => [
                'CODE' => [
                    'IS_REQUIRED' => 'Y',
                    'DEFAULT_VALUE' => [
                        'UNIQUE' => 'Y',
                        'TRANSLITERATION' => 'Y',
                        'TRANS_CASE' => 'L'
                    ]
                ],
                'ACTIVE_FROM' => [
                    'IS_REQUIRED' => 'Y',
                    'DEFAULT_VALUE' => '=today'
                ]
            ],
            'LIST_PAGE_URL' => '/news/',
            'DETAIL_PAGE_URL' => '/news/#ELEMENT_CODE#/',
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
            )
        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }

            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Новость' => [
                    'ACTIVE',
                    'ACTIVE_FROM' => 'Дата публикации',
                    'NAME',
                    'CODE',
                    'PROPERTY_PUBLISH_MAIN',
                    'PROPERTY_PUBLISH_SLIDER',
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
                'Мультимедия материалы' =>[
                    'PROPERTY_PHOTOS',
                    'PROPERTY_VIDEO_LINK'

                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        $helper->Iblock()->deleteIblockIfExists('NEWS', 'NEWS');

    }

}
