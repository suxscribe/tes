<?foreach ($arResult['ITEMS'] as &$arItem){
    if (!empty($arItem['PROPERTIES']['MAIN_PICTURE']['VALUE'])){
        $iPicture = CFile::GetFileArray($arItem['PROPERTIES']['MAIN_PICTURE']['VALUE']);
        $arItem['PROPERTIES']['MAIN_PICTURE'] = $iPicture;
    }
}
