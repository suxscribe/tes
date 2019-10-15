<?
/**
 * Компонент для реализации функцианала моделя подписки.
 */
use Bitrix\Main\Loader;
use \Only\Form\Subscribe;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class OnlySubscribeComponent extends \CBitrixComponent
{

    public function executeComponent()
    {
        if ($this->StartResultCache()) {
            if (!Loader::includeModule('only.form')) {
                $this->abortResultCache();
                ShowError('Не установлен модуль only.form');
                return 0;
            }
            if ($_REQUEST['method']=='toSubscribe'){
                $this->abortResultCache();
                global $APPLICATION;
                $APPLICATION->RestartBuffer();
                Subscribe::toSubscribe();
            }elseif ($_REQUEST['method']=='unSubscribe'){
                $this->arResult['MESSAGE'] = Subscribe::unSubscribe();
                $this->includeComponentTemplate('','unsubscribe');
            }elseif(empty($_REQUEST['method'])){
                $this->includeComponentTemplate();
            }
        }
        return true;
    }
}
