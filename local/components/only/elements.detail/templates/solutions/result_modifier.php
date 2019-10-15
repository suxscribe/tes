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
 * Выборка данных для макета состава решения
 */
if (!empty($arResult['PROPERTIES']['COMPOSITIONS']['VALUE'])){
    /*
     * Выбираем секцию
     */
    $rsSection = CIBlockSection::GetByID($arResult['PROPERTIES']['COMPOSITIONS']['VALUE']);
    $arResult['COMPOSITION_SECTION'] = $rsSection->Fetch();
    if (!empty($arResult['COMPOSITION_SECTION']['PICTURE'])) {
        $arResult['COMPOSITION_SECTION']['PICTURE'] = CFile::GetFileArray($arResult['COMPOSITION_SECTION']['PICTURE']);
    }
    /*
     * Выбираем элементы
     */
    $rsItems = CIBlockElement::GetList(
        [
            "SORT"=>"ASC"
        ],
        [
            'IBLOCK_ID' => $arResult['PROPERTIES']['COMPOSITIONS']['LINK_IBLOCK_ID'],
            'SECTION_ID' => $arResult['PROPERTIES']['COMPOSITIONS']['VALUE'],
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
        if (!empty($arItem['DETAIL_PICTURE'])) {
            $arItem['DETAIL_PICTURE'] = CFile::GetFileArray($arItem['DETAIL_PICTURE']);
        }
        $arResult['COMPOSITIONS'][] = $arItem;
    }
}

/*
 * Выборка Конструкции решения
 */
if (!empty($arResult['PROPERTIES']['STRUCTURE']['VALUE'])){
    $rsSection = CIBlockSection::GetByID($arResult['PROPERTIES']['STRUCTURE']['VALUE']);
    /*
     * Выбираем сейкцию
     */
    $arResult['STRUCTURE_SECTION'] = $rsSection->Fetch();
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
        if (!empty($arItem['DETAIL_PICTURE'])) {
            $arItem['DETAIL_PICTURE'] = CFile::GetFileArray($arItem['DETAIL_PICTURE']);
        }
        if (!empty($arItem['PROPERTIES']['PHOTOS']['VALUE'])) {
            foreach ($arItem['PROPERTIES']['PHOTOS']['VALUE'] as &$iPhoto){
                $iPhoto = CFile::GetFileArray($iPhoto);
            }
        }
        $arResult['STRUCTURE'][$arItem['ID']] = $arItem;
    }

    /*
     * Корректриуем массив для вложенных элементов
     */
    foreach ($arResult['STRUCTURE'] as $iID => &$arItemStructure){
        if (!empty($arItemStructure['PROPERTIES']['ELEMENTS']['VALUE'])){
            foreach ($arItemStructure['PROPERTIES']['ELEMENTS']['VALUE'] as $iKey => $iIdElement){
                $arItemStructure['PROPERTIES']['ELEMENTS']['VALUE'][$iIdElement] = $arResult['STRUCTURE'][$iIdElement];
                unset($arItemStructure['PROPERTIES']['ELEMENTS']['VALUE'][$iKey]);
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
/* Применяемые исполнения */

if (!empty($arResult['PROPERTIES']['EXECUTION']['VALUE'])){
    /*
     * Выбираем элементы
     */
    $rsItems = CIBlockElement::GetList(
        [
            "SORT"=>"ASC"
        ],
        [
            'IBLOCK_ID' => $arResult['PROPERTIES']['EXECUTION']['LINK_IBLOCK_ID'],
            'SECTION_ID' => $arResult['PROPERTIES']['EXECUTION']['VALUE'],
            'ACTIVE' => 'Y',
        ],
        false,
        false,
        []
    );

    while ($obItem = $rsItems->GetNextElement(true, false)) {
        $arItemExec = $obItem->GetFields();
        $arItemExec['PROPERTIES'] = $obItem->GetProperties();
        $arResult['EXECUTIONS'][$arItemExec['ID']] = $arItemExec;
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
