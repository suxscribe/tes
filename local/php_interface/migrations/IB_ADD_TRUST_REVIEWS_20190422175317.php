<?php

namespace Sprint\Migration;


class IB_ADD_TRUST_REVIEWS_20190422175317 extends Version
{

    protected $description = "Добавляет ИБ Доверие и компетенции (Отзывы)";

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
            'CODE' => 'REVIEWS',
            'NAME' => 'Отзывы',
        ));
        $arProps = array(
            array(
                'NAME' => 'Год',
                'CODE' => 'YEAR',
                'PROPERTY_TYPE' => 'S'
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
                    'TABLE_NAME' => $helper->Hlblock()->getHlblock('SolutionsFilter')
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
            ),
        );
        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }
            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Отзыв' => [
                    'NAME' => 'Название компании',
                    'PREVIEW_PICTURE' => 'Скан отзыва (изображение)',
                    'PROPERTY_YEAR',
                    'PROPERTY_WORK_TYPE',
                    'PROPERTY_SOLUTIONS',
                    'PROPERTY_BRANCH'
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        //$helper->Iblock()->deleteIblockIfExists('REVIEWS', 'TRUST');

    }

}
