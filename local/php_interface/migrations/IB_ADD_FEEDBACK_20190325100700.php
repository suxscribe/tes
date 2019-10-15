<?php

namespace Sprint\Migration;


class IB_ADD_FEEDBACK_20190325100700 extends Version
{

    protected $description = "Добавляет ИБ Обратная связь";

    public function up()
    {
        $helper = new HelperManager();

        $arIBlockType = array(
            'ID' => 'FEEDBACK',
            'SECTIONS' => 'N',
            'IN_RSS' => 'N',
            'SORT' => 100,
            'LANG' => array(
                'ru' => array(
                    'NAME' => 'Обратная связь',
                    'SECTION_NAME' => 'Разделы',
                    'ELEMENT_NAME' => 'Элементы'
                ),
                'en' => array(
                    'NAME' => 'Feedback',
                    'SECTION_NAME' => 'Sections',
                    'ELEMENT_NAME' => 'Elements'
                ),
            )
        );

        $helper->Iblock()->addIblockTypeIfNotExists($arIBlockType);

        $iIBlockID = $helper->Iblock()->addIblockIfNotExists(array(
            'LID' => 's1',
            'IBLOCK_TYPE_ID' => 'FEEDBACK',
            'CODE' => 'FEEDBACK',
            'NAME' => 'Обратная связь',
        ));

        $arProps = array(
            array(
                'NAME' => 'E-mail',
                'CODE' => 'EMAIL',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Название компании',
                'CODE' => 'COMPANY_NAME',
                'PROPERTY_TYPE' => 'S'
            ),
            array(
                'NAME' => 'Контактный номер',
                'CODE' => 'PHONE',
                'PROPERTY_TYPE' => 'S'
            )
        );

        if ($iIBlockID) {
            foreach ($arProps as $arProp) {
                $helper->Iblock()->addPropertyIfNotExists($iIBlockID, $arProp);
            }

            $helper->AdminIblock()->buildElementForm($iIBlockID, [
                'Элемент конструкции' => [
                    'ACTIVE',
                    'SORT',
                    'NAME' => 'Имя',
                    'PROPERTY_EMAIL',
                    'PROPERTY_COMPANY_NAME',
                    'PROPERTY_PHONE',
                    'PREVIEW_TEXT' => 'Сообщение',
                ]
            ]);
        }
    }

    public function down()
    {
        $helper = new HelperManager();

        $helper->Iblock()->deleteIblockIfExists('FEEDBACK', 'FEEDBACK');

    }

}
