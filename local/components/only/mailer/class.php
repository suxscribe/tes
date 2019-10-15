<?
use Bitrix\Main\Loader;

class OnlyMailerComponent extends \CBitrixComponent
{
    private $VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';
    private $siteKey = '6LdIZqQUAAAAAHSKDKK04nRFptft7gpPQ9O0Pj63';
    private $secretKey = '6LdIZqQUAAAAAPjs6sH7zsuKPQ8v4oIqMCutWWZJ';

    public function onPrepareComponentParams($arParams)
    {
        $arDefaultComponentParameters = array(
            'IBLOCK_ID' => Only\Site\Helpers\IBlock::getIblockID('FEEDBACK','FEEDBACK'),
            'USE_CAPTCHA' => 'Y',
            'EMAIL_TO' => COption::GetOptionString('main', 'email_from'),
            'FIELDS' => array(
                'NAME' => 'name',
                'EMAIL' => 'email',
                'COMPANY_NAME' =>'company',
                'PHONE' => 'phone',
                'MESSAGE' => 'textarea'
            ),
            'EVENT_NAME' => 'FEEDBACK_FORM',
            'SITE_ID' => 's1',
            'MAIL_TEMPLATE' => '7',
        );
        foreach ($arDefaultComponentParameters as $key => $value){
            if (!is_set($arParams, $key)) $arParams[$key] = $value;
        }
        return $arParams;
    }

    public function executeComponent()
    {

        $arRequest = $this->getRequest();
        if ($arRequest!==false){
            if (($this->arParams['USE_CAPTCHA']=='Y') && (!$this->checkRecaptchaV2($arRequest))){
                $this->sendResponse('false','Вы не прошли проверку капчи');
            }
            $this->filterRequest($arRequest);
            $this->sendMail($arRequest);
            $this->addRecord($arRequest);
            $this->sendResponse('true','Форма успешно отправлена');
        }else{
            if ($this->arParams['USE_CAPTCHA']=='Y'){
                $this->arResult['CAPTCHA_HTML'] = $this->getRecaptchaHTML();
            }

            $this->includeComponentTemplate();
        }
    }

    private function filterRequest(&$arRequest){
        $args = array(
            'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_EMAIL,
            'company' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'phone' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'textarea' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
        $arFilteringRequest = filter_input_array(INPUT_POST, $args);
        $arRequest = $arFilteringRequest;
    }
    public function sendMail($arRequest){
        if (empty($this->arParams['EMAIL_TO'])){
            exit();
        }
        $arEventFields = array(
            "NAME" => $arRequest["name"],
            "EMAIL" => $arRequest['email'],
            "COMPANY" => $arRequest['company'],
            "PHONE" => $arRequest['phone'],
            "MESSAGE" => $arRequest['textarea'],
            "EMAIL_TO" => $this->arParams['EMAIL_TO'],
        );
        CEvent::Send($this->arParams['EVENT_NAME'], $this->arParams['SITE_ID'], $arEventFields, "N", $this->arParams['MAIL_TEMPLATE']);
    }

    public function addRecord($arRequest){
        if (!Loader::includeModule('iblock')){
            echo 'Модуль инфоблоки не установлен';
            exit();
        }
        if (empty($this->arParams['IBLOCK_ID'])){
            echo 'Инфоблок не найден';
            exit();
        }
        $el = new CIBlockElement;
        $PROP = array(); //Массив со свойствами
        foreach($this->arParams['FIELDS'] as $sField=>$sPostName){
            if ($sField!='NAME' && $sField!='MESSAGE'){
                $PROP[$sField] = $arRequest[$sPostName];
            }
        }

        $arReviews = Array(
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"      => $this->arParams['IBLOCK_ID'],
            "PROPERTY_VALUES"=> $PROP,
            "NAME"           => $arRequest['name'],
            "ACTIVE"         => "Y",
            "PREVIEW_TEXT"   => $arRequest['textarea']
        );

        $el->Add($arReviews);
    }
    public function getRequest(){
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        if ($request->isPost() && $request->isAjaxRequest()){
            $values = $request->getPostList()->toArray();
            return $values;
        }else{
            return false;
        }
    }
    private function sendResponse($sStatus, $sMessage){
        $arResponse = array('status' => $sStatus , 'message'=>$sMessage);
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        echo json_encode($arResponse);
        exit;
    }
    public function getRecaptchaHTML(){
        $data = array('hl' => 'ru');
        if (!empty($this->siteKey))
        {
            $dataHTML = 'data-sitekey="'.$this->siteKey.'"';
        }
        return '<div class="g-recaptcha" '.$dataHTML.'></div>';
    }
    private function checkRecaptchaV2($response){

        if (is_null($this->secretKey))
            throw new \Exception('You must set your secret key');
        if (empty($response)) {
            return false;
        }
        $params = array(
            'secret'   => $this->secretKey,
            'response' => $response['g-recaptcha-response'],
            'remoteip' => $_SERVER['REMOTE_ADDR'],
        );
        $url = $this->VERIFY_URL.'?'.http_build_query($params);

        if (function_exists('curl_version'))
        {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, '1');
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
        }
        else
        {
            $response = file_get_contents($url);
        }
        if (empty($response) || is_null($response) || !$response)
        {
            return false;
        }
        $json = json_decode($response, true);
        if (isset($json['error-codes']))
        {
            return false;
        }
        return true;
    }

}
