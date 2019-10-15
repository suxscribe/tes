<?php

namespace Sprint\Migration;


class IB_ADD_COMPANY_20190419105721 extends Version
{

    protected $description = "Добавляет ИБ О компании";

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
            'CODE' => 'COMPANY',
            'NAME' => 'О компании',
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
                'NAME' => 'Фотогалерея',
                'CODE' => 'PHOTOS',
                'PROPERTY_TYPE' => 'F',
                'MULTIPLE' => 'Y',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'EPC Текст',
                'CODE' => 'EPC_TEXT',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
            array(
                'NAME' => 'Ссылка на видеоролики YouTube',
                'CODE' => 'VIDEO_LINKS',
                'PROPERTY_TYPE' => 'S',
                'MULTIPLE' => 'Y',
            ),
            array(
                'NAME' => 'Файлы видеороликов',
                'CODE' => 'VIDEOS',
                'PROPERTY_TYPE' => 'F',
                'MULTIPLE' => 'Y',
                'FILE_TYPE' => 'avi, mp4'
            ),
            array(
                'NAME' => 'Состав организации',
                'CODE' => 'COMPOSITION_ORG',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'MULTIPLE' => 'Y',
            ),
            array(
                'NAME' => 'Преимущества',
                'CODE' => 'ADVANTAGES',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
                'MULTIPLE' => 'Y',
                'WITH_DESCRIPTION' => 'Y',
                'HINT' => 'Для указания Заголовка используйте поле Описание'
            ),
            array(
                'NAME' => 'Карта',
                'CODE' => 'MAP_IMAGE',
                'PROPERTY_TYPE' => 'F',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'Карта (Для мобильных)',
                'CODE' => 'MAP_IMAGE_MOBILE',
                'PROPERTY_TYPE' => 'F',
                'FILE_TYPE' => 'jpg, jpeg, png, gif'
            ),
            array(
                'NAME' => 'Описание на карте',
                'CODE' => 'MAP_TEXT',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'ROW_COUNT' => 5,
                'COL_COUNT' => 30,
            ),
        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }

            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Новость' => [
                    'NAME',
                    'CODE',
                    'DETAIL_PICTURE' => 'Главное изобраджение',
                    'PREVIEW_TEXT' => 'О нас (крупный текст)',
                    'DETAIL_TEXT' => 'О нас (мелкий текст)',
                    'PROPERTY_EPC_TEXT',
                    'PROPERTY_VIDEO_LINKS',
                    'PROPERTY_VIDEOS',
                    'PROPERTY_COMPOSITION_ORG',
                    'PROPERTY_ADVANTAGES',
                    'PROPERTY_MAP_IMAGE',
                    'PROPERTY_MAP_IMAGE_MOBILE',
                    'PROPERTY_MAP_TEXT'
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('COMPANY', 'COMPANY');

    }

}
