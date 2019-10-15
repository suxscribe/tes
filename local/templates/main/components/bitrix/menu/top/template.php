<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="menu header__menu">
    <?foreach ($arResult as $arItem):?>
    <a class="menu__item <?=($arItem['SELECTED'])? 'menu__item_active':''?>" href="<?=$arItem['LINK']?>" ><?=$arItem['TEXT']?></a>
    <?endforeach;?>
</div>
