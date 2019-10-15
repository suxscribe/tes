<?php

namespace Sprint\Migration;


class IB_ADD_TRUST_REVIEWS_SLIDER_20190422162234 extends Version
{

    protected $description = "Добавляет ИБ Доверие и компетенции (Отзывы слайдер)";

    public function up()
    {
        $helper = new HelperManager();

        $arIBlockType = array(
            'ID' => 'TRUST',
            'SECTIONS' => 'Y',
            'IN_RSS' => 'Y',
            'SORT' => 100,
            'LANG' => array(
                'ru' => array(
                    'NAME' => 'Доверие и компетенции',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Элемент'
                ),
                'en' => array(
                    'NAME' => 'Trust',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'News'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'TRUST',
            'CODE' => 'REVIEWS_SLIDER',
            'NAME' => 'Отзывы (Слайдер)',
        ));
        if ($iIBlockID) {
            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Документ' => [
                    'NAME' => 'Автор отзыва',
                    'PREVIEW_PICTURE' => 'Изображение',
                    'PREVIEW_TEXT' => 'Компания',
                    'DETAIL_TEXT' => 'Отзыв'
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        $helper->Iblock()->deleteIblockIfExists('REVIEWS_SLIDER', 'TRUST');

    }

}
