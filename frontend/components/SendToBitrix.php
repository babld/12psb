<?php

namespace app\components;

use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii;

class SendToBitrix
{
    public $client;
    protected $logger;
    const URL = 'https://sibtransasia.bitrix24.ru/rest/8/7bd402iyi0syl0k0/';

    public function __construct()
    {
        $this->client = new Client();
        $this->logger = new DbLogger('B24');
    }

    public function send($b24data)
    {
        $sessionUtm = Helper::getSessionAndCookieUtm('array');
        $string = ArrayHelper::getValue($sessionUtm, 'sbjs_current', '');
        $string = str_replace(')', '', str_replace('(', '', $string));
        $array1 = [];
        $array2 = explode('|||', $string);
        foreach ($array2 as $str) {
            $data = explode('=', $str);

            if (count($data) < 2) {
                continue;
            }

            [$key, $value] = $data;

            $array1[$key] = $value;
        }

        $formName = $this->getFormName($b24data);
        $name = ArrayHelper::getValue($b24data, 'name', 'Не заполнено');
        $firstContact = Yii::$app->request->post('contact');
        $leadData = array(
            'fields' => array(
                'TITLE' => '12psb.ru. ' . $name . ', ' . $formName . ', ' . $firstContact, // Указать имя клиента, название формы с которой был отправлен лид, номер телефона
                'NAME' => $name, // Указать имя из формы
                'LAST_NAME' => '', // Указать фамилию из формы
                'STATUS_ID' => 'NEW',
                'OPENED' => 'Y',
                'ASSIGNED_BY_ID' => 18, // Соболевский
                'SOURCE_ID' => 'WEBFORM', //
                'SOURCE_DESCRIPTION' => Yii::$app->request->absoluteUrl, // Указать текущую страницу с которой была заполнена форма
                'COMMENTS' => Yii::$app->request->post('message'), // Указать комментарий с любыми нестандартными полями лида
                'PHONE' => [
                    [
                        'VALUE' => $firstContact,
                        'VALUE_TYPE' => 'WORK',
                    ],
                ],
                'EMAIL' => [
                    [
                        'VALUE' => Yii::$app->request->post('contact_dop'),
                        'VALUE_TYPE' => 'WORK',
                    ],
                ],
                // UTM-метки
                'UTM_SOURCE' => ArrayHelper::getValue($array1, 'src'), // 'utm_source_value',
                'UTM_MEDIUM' => ArrayHelper::getValue($array1, 'mdm'), // 'utm_medium_value',
                'UTM_CAMPAIGN' => ArrayHelper::getValue($array1, 'cmp'), // 'utm_campaign_value',
                'UTM_CONTENT' => ArrayHelper::getValue($array1, 'cnt'), // 'utm_content_value',
                'UTM_TERM' => ArrayHelper::getValue($array1, 'trm'), // 'utm_term_value',
                // CID Яндекс.Метрики
                'UF_CRM_T_YMCLIENTID' => ArrayHelper::getValue($sessionUtm, '_ym_uid'),
            ),
            'params' => array('REGISTER_SONET_EVENT' => 'Y'),
        );

        try {
            $this->logger->debug('request', ['requestData' => $leadData]);

            if (YII_ENV_PROD) {
                $request = $this->client->post(Yii::$app->params['bitrix24']['webhook'] . 'crm.lead.add', $data);
                $this->logger->debug('send to bitrix ok', ['result' => $request->getBody()->getContents()]);
            }
        } catch (\Exception $exception) {
            $this->logger->error('post error', [
                'url' => Yii::$app->params['bitrix24']['webhook'] . 'crm.deal.add',
                'data' => $data,
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTrace()
            ]);
        }
    }

    protected function getFormName(array $b24data): string
    {
        if (
            ArrayHelper::getValue($b24data, 'from') ||
            ArrayHelper::getValue($b24data, 'to') ||
            ArrayHelper::getValue($b24data, 'weight') ||
            ArrayHelper::getValue($b24data, 'volume')
        ) {
            return 'CaclulatorForm';
        }

        return 'ContactForm';
    }
}