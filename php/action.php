<?php

// сюда пишем Access и Refresh токены, а также отдаем Access токен и данные для обновления Access токена
class Token 
{

    private $access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjY0YjY1OWJmYzUyYjRmMjk4YmJiYzQyNWZjMTE1N2QwMWY0MjA3OGYwYTY2N2M4NWEyOWMzZWUxYjg0MGE3OTc4NGE3ZTc5YTFjNDAwZjMwIn0.eyJhdWQiOiI1ZGFlOTYyMS1iNTA3LTQ5Y2UtYmUyMy0xYzgxNzA2ODJjZjkiLCJqdGkiOiI2NGI2NTliZmM1MmI0ZjI5OGJiYmM0MjVmYzExNTdkMDFmNDIwNzhmMGE2NjdjODVhMjljM2VlMWI4NDBhNzk3ODRhN2U3OWExYzQwMGYzMCIsImlhdCI6MTYzNTE0MTQ4NSwibmJmIjoxNjM1MTQxNDg1LCJleHAiOjE2MzUyMjc4ODUsInN1YiI6Ijc1NDkzMTUiLCJhY2NvdW50X2lkIjoyOTc2NjIyMywic2NvcGVzIjpbInB1c2hfbm90aWZpY2F0aW9ucyIsImNybSIsIm5vdGlmaWNhdGlvbnMiXX0.F_hdLujX5xqseN9ZaN_rD3Tivm6uao6ifFB2_t8RTPjUNqld-XRsVCz2RYVliqxf7dVfPnsh3mk8pDUSht-OkwlA8wJ2hUa4jvGkSIzHVuHdW5duf3qx_J6tQNvia6ddFqWeo34q_2kAruf9m9dMVqe46lURA4GxTvnZXFjIj4tkTekQ0Y8R4Z-l2InPqD7Igr96fCFN7VVJwHNd6AINFSdpAyOmxRUeM5jfPjkKKeMzhVjpp0cLrLNJ1kfIsOMQl9SiYH3LKHl3lnXSIz1HKKS2_kfAAHN-cK2s_P2YXpWpo5eevTw2RGgvpQFOcVXtYHsPQKaFjUO0hEU6ZTg22A';

    private $refresh_token = 'def50200b611af8c59af40364431cea85add90227d3ca92e95f89757a12eced5f424230044600ff5991e0bd611a29dfc6489d998133051014a92d0002eee6f7ae32b857869382dff6644a8b03e58ef9f980969cbfe61e2761343da48e589564aa727604c3b0d3e3e73e27a59585e2b1ae17dbd243a390ee847f7248ea7b0c7d97c465e93738874b5389fe8d774c72d20d24953dc7b09dff647f3126382d7e098d1c0e3f5994413903a4477ef652f5d473afde7a4cd7d9a98b07ed7e982da075a1299b49ee41c914bb6f1dec4272a0026adc19451cf501923d857b707686d49f1eeeef739ace3df14125725102d947acf4334163f238ffb69c7af6fabc4994d8361ba47b74fb000bf0760ceae979fc0a5715b822b764c9d191fec5d00bbfec4970f01f4039ebcac232e6cf46ff693bc7cbb022072e57ba9bae7c68ddebe2de29b7b67b489221081b666aecef50f0b5343a4b58be3f1be0e78a13eeb34fd006b7e64edf600dc143f05e1bb633fc56b5de327c4e3b5c37c6ad9d4727dca63153048fefadfc5352f62951ce877e3a597d46a860698f7dd641f75288fdfa08d6ce001061b591f84efbd8bd02cb9a923a5fb20d48eef1600e7941d39dc799f85a4e733a9b74295cee9d0692503';

    public function __construct()
    { 

    }

    public function setAccessToken(string $access_token = null)
    {
        $this->access_token = $access_token;
    }

    public function setRefreshToken(string $refresh_token = null)
    {
        $this->refresh_token = $refresh_token;
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function getRefreshData()
    {
        $result = [
            'client_id' => '52327eb6-06b7-428e-93af-84fde324d801',
            'client_secret' => 'sqehr0zoDdGc7Y6PM2MAxYiNUZ6RwjLqMs1akFuS8VIUPMMDOk3lF6Vjo2aQmHaG',
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->refresh_token,
            'redirect_uri' => 'http://heretic234.temp.swtest.ru',
        ];

        return $result;
    }
}

/**
 * Проверяем номер на соответствие маске +7 (ххх) ххх-хх-хх
 *
 * @param string $number Строка с номером телефона.
 * @return string Возвращает либо строку с номером телефона, либо сообщение что номер телефона заполнен неверно.
 */
function validatePhone( $number ) 
{   
    $test = "/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/";
    return (preg_match($test, $number) != 0) ? $number : 'номер заполнен неверно';
}

/**
 * Отправляем на почту лид
 *
 * @param string $phone Строка с номером телефона лида.
 * @param string $email Почта лида.
 */
function sendMail( string $phone = 'номер не заполнен', string $email = 'почта не заполнена' ) 
{
    $to = 'order@salesgenerator.pro';
    $subject = 'заявка Прянников';
    $message = "Новая заявка Прянников. \nПочта - $email \nТелефон - $phone ";

    mail($to, $subject, $message, 'From: shocer1991@gmail.com');
}

/**
 * Используем API amoCRM
 *
 * @param string $access_token Access токен.
 * @param string $method Строка с путем до нужного метода, что идет после amocrm.ru/ .
 * @param bool $POST Указываем true если нам нужен POST запрос.
 * @param array $new_lead Наш новый оформленный лид со всеми данными.
 * @param array $refresh_data Подготовленные данные для обновления Access токена.
 */
function useAPIAmoCRM(string $access_token = null, string $method = null, bool $POST = false, array $new_lead = null, array $refresh_data = null)
{
    $subdomain = 'mmrjacondastrider'; //Поддомен нужного аккаунта
    $link = 'https://' . $subdomain . '.amocrm.ru/' . $method; //Формируем URL для запроса  // 76853 id or 78269 

    // Если нет данных для обновления access token, то формируем заголовки с текущим access token
    if (!isset($refresh_data)) {
        $headers = [
            'Authorization: Bearer ' . $access_token
        ];
    }

    /**
     * Нам необходимо инициировать запрос к серверу.
     * Воспользуемся библиотекой cURL (поставляется в составе PHP).
     * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
     */
    $curl = curl_init(); //Сохраняем дескриптор сеанса cURL
    /** Устанавливаем необходимые опции для сеанса cURL  */
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
    curl_setopt($curl,CURLOPT_URL, $link);
    curl_setopt($curl,CURLOPT_HEADER, false);

    // Если POST запрос, то добавляем это
    if ($POST) {
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');      
    }

    // Если есть новый лид, то добавляем его и заголовки
    if (isset($new_lead)) {
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($new_lead));
    }
    curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);

    // Если есть данные для обновления access token, то добавляем их и заголовок
    if (isset($refresh_data)) {
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($refresh_data));
        curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
    }
    
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);

    $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $code = (int)$code;
    $errors = [
        400 => 'Bad request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not found',
        500 => 'Internal server error',
        502 => 'Bad gateway',
        503 => 'Service unavailable',
    ];

    if ($method == 'api/v4/leads') {
        try {
            /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
            if ($code < 200 || $code > 204) {
                throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
            }
        }
        catch(\Exception $e) {
            die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
        }

        return true;
    } else if ($method == 'api/v4/account') {
        if ($code !== 200) {
            return false;
        } else {
            return true;
        }
    } 

    if ($method == 'oauth2/access_token') {
        $response = json_decode($out, true);
        return $response;
    }
}

/**
 * Проверяем, работает ли все еще Access токен.
 *
 * @param string $access_token Access токен.
 * @return bool Возвращает true если токен еще работает или false если уже не работает.
 */
function checkAccessTokenIsAlive(string $access_token = null)
{
    return useAPIAmoCRM($access_token, 'api/v4/account', false);
}

/**
 * Обновляем Access токен.
 *
 * @param array $refresh_data Подготовленный массив с данными для обновления Access токена.
 * @return array Массив с Access и Refresh токенами.
 */
function refreshAccessToken(array $refresh_data = null)
{
    return useAPIAmoCRM(null, 'oauth2/access_token', true, null, $refresh_data);
}

$phone = validatePhone($_POST['phone']);
$email = empty($_POST['email']) ? 'поле не заполнено' : $_POST['email'];

$token = new Token;

sendMail($phone, $email);

$new_lead = [
    array(
        'name' => 'заявка Прянников',
        'custom_fields_values' => [
            array(
                'field_id' => 84133,
                'values' => [
                    array(
                        'value' => $email
                    )
                ]
            ),
            array(
                'field_id' => 84135,
                'values' => [
                    array(
                        'value' => $phone
                    )
                ]
            )
        ]
    ),
];


if (checkAccessTokenIsAlive($token->getAccessToken())) {
    useAPIAmoCRM($token->getAccessToken(), 'api/v4/leads', true, $new_lead);
} else {
    $data = refreshAccessToken($token->getRefreshData());

    $token->setAccessToken($data['access_token']);
    $token->setRefreshToken($data['refresh_token']);

    useAPIAmoCRM($token->getAccessToken(), 'api/v4/leads', true, $new_lead);
}

?>
