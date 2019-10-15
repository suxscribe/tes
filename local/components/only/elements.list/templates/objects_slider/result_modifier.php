<?foreach ($arResult['ITEMS'] as &$arItem){
    if (!empty($arItem['PROPERTIES']['PICTURE_SLIDER']['VALUE'])){
        $iPicture = CFile::GetFileArray($arItem['PROPERTIES']['PICTURE_SLIDER']['VALUE']);
        $arItem['PROPERTIES']['PICTURE_SLIDER'] = $iPicture;
    }
}
