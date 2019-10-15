<?php
/** @var CBitrixComponent $component */
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */

/*
 * Выборка данных типов блоков ОРУ
 */

if (!empty($arResult['PROPERTIES']['TYPES_OF_BLOCKS_LINK']['VALUE'])){

    $rsItems = CIBlockElement::GetList(
        [
            "SORT"=>"ASC"
        ],
        [
            'IBLOCK_ID' => $arResult['PROPERTIES']['TYPES_OF_BLOCKS_LINK']['LINK_IBLOCK_ID'],
            'SECTION_ID' => $arResult['PROPERTIES']['TYPES_OF_BLOCKS_LINK']['VALUE'],
            'ACTIVE' => 'Y',
        ],
        false,
        false,
        []
    );
    while ($obItem = $rsItems->GetNextElement(true, false)) {
        $arItem = $obItem->GetFields();
        $arItem['PROPERTIES'] = $obItem->GetProperties();
        if (!empty($arItem['PREVIEW_PICTURE'])) {
            $arItem['PREVIEW_PICTURE'] = CFile::GetFileArray($arItem['PREVIEW_PICTURE']);
        }
        $arResult['TYPES_OF_BLOCKS'][] = $arItem;
    }
}
/*
 * Выборка данных по конструкции ОРУ
 */
if (!empty($arResult['PROPERTIES']['STRUCTURE']['VALUE'])){
    /*
     * Выбираем элементы
     */
    $rsItems = CIBlockElement::GetList(
        [
            "SORT"=>"ASC"
        ],
        [
            'IBLOCK_ID' => $arResult['PROPERTIES']['STRUCTURE']['LINK_IBLOCK_ID'],
            'SECTION_ID' => $arResult['PROPERTIES']['STRUCTURE']['VALUE'],
            'ACTIVE' => 'Y',
        ],
        false,
        false,
        []
    );
    while ($obItem = $rsItems->GetNextElement(true, false)) {
        $arItem = $obItem->GetFields();
        $arItem['PROPERTIES'] = $obItem->GetProperties();
        if (!empty($arItem['PREVIEW_PICTURE'])) {
            $arItem['PREVIEW_PICTURE'] = CFile::GetFileArray($arItem['PREVIEW_PICTURE']);
        }
        if (!empty($arItem['PROPERTIES']['PHOTOS']['VALUE'])) {
            foreach ($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $iPhoto){
                $arItem['PHOTO'] = CFile::GetFileArray($iPhoto);
            }
        }
        $arResult['STRUCTURE'][$arItem['ID']] = $arItem;
    }

    /*
     * Корректриуем массив для вложенных элементов
     */
    foreach ($arResult['STRUCTURE'] as $iID => &$arItem){
        if (!empty($arItem['PROPERTIES']['ELEMENTS']['VALUE'])){
            foreach ($arItem['PROPERTIES']['ELEMENTS']['VALUE'] as $iKey => $iIdElement){
                $arItem['PROPERTIES']['ELEMENTS']['VALUE'][$iIdElement] = $arResult['STRUCTURE'][$iIdElement];
                unset($arItem['PROPERTIES']['ELEMENTS']['VALUE'][$iKey]);
                unset($arResult['STRUCTURE'][$iIdElement]);
            }
        }
    }

}
/* Готовим документы */
if (!empty($arResult['PROPERTIES']['DOCUMENTS']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as &$iDocument){
        $iDocument = CFile::GetFileArray($iDocument);
        $iDocument['FILE_SIZE'] = CFile::FormatSize($iDocument['FILE_SIZE']);
        /*
         * Если не задано описание файла то берем его имя без расширения.
         */
        if (empty($iDocument['DESCRIPTION'])){
            $iDocument['DESCRIPTION'] =  substr($iDocument['ORIGINAL_NAME'], 0, strripos($iDocument['ORIGINAL_NAME'], '.'));

        }
        $iDocument['EXT'] =  substr($iDocument['ORIGINAL_NAME'],  strripos($iDocument['ORIGINAL_NAME'], '.')+1);
    }
}
/* Готовим ссылки на фотографии */
if (!empty($arResult['PROPERTIES']['PHOTOS']['VALUE'])){
    foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as &$iPhoto){
        $iPhoto = CFile::GetFileArray($iPhoto);
    }
}

/*
 * Объекты
 */
if (!empty($arResult['PROPERTIES']['SOLUTIONS_FILTER']['VALUE'])){
    /*
     * Выбираем элементы
     */
    $rsItems = CIBlockElement::GetList(
        [
            "SORT"=>"ASC"
        ],
        [
            'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('OBJECTS','OBJECTS'),
            'ACTIVE' => 'Y',
            'PROPERTY_SOLUTIONS' => $arResult['PROPERTIES']['SOLUTIONS_FILTER']['VALUE']
        ],
        false,
        false,
        ['ID', 'NAME', 'PROPERTY_SOLUTIONS','PROPERTY_NAME_SLIDER','PROPERTY_PICTURE_SLIDER', 'DETAIL_PAGE_URL']
    );
    while ($obItem = $rsItems->GetNextElement(true, false)) {
        $arItemObject = $obItem->GetFields();
        $arResult['OBJECTS'][$arItemObject['ID']] = $arItemObject;
        if (empty($arItemObject['PROPERTY_NAME_SLIDER_VALUE']) || empty($arItemObject['PROPERTY_PICTURE_SLIDER_VALUE'])){
            unset($arResult['OBJECTS'][$arItemObject['ID']]);
        }
        if (!empty($arResult['OBJECTS'][$arItemObject['ID']]['PROPERTY_PICTURE_SLIDER_VALUE'])){
            $arResult['OBJECTS'][$arItemObject['ID']]['PICTURE_SLIDER'] = CFile::GetFileArray($arResult['OBJECTS'][$arItemObject['ID']]['PROPERTY_PICTURE_SLIDER_VALUE']);
        }
    }
}
