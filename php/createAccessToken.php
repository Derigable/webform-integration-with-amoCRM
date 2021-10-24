<?php
$subdomain = 'mmrjacondastrider'; //Поддомен нужного аккаунта
$link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса

/** Соберем данные для запроса */
$data = [
	'client_id' => '52327eb6-06b7-428e-93af-84fde324d801',
	'client_secret' => 'sqehr0zoDdGc7Y6PM2MAxYiNUZ6RwjLqMs1akFuS8VIUPMMDOk3lF6Vjo2aQmHaG',
	'grant_type' => 'authorization_code',
	'code' => 'def50200d6bce3d970f132c82be0662a87aa23bb933e974195bc473ab8b884310f87f7f42a4c55adfa55adf1473e109dc086cb2d240822a0c4ab56347365afb434d5c6e7fabb57fa248bdb8c7747017932ebe8c04a461ce0a8465dc61b3f568af96e03682417cac4ea81f66d3b0b52dcbba6ac098fd177134807ad01a9160eecd0fcdecb84ae56350f5824a5dd29d4820ff25c1f5cccd4011f9bb9b7242912f6148182a5f0ab5ea56f0181d80a64d6b597440ebdf1dc8695fcdf4ded330c5fe4f5307978b28a1af999829cabe7f3e4368b9bc79e46f6ebd7c6bf68ef9d974f683c863b6157c6463dd8ddbb8e97f8bda32db0641ce843f08bd793ba233a31a8b2cec999d4d9d37145a55501cfe364aa77fb7dd8476190e9112f41b11ec5d44719cbd35146f4c53e8e8d4956b2792af413d03be8517ad6488cc9136fc24f001bdf0e0d2da1aff69316f3fbb940dc24968aa299ed79ca9eadcd0ff2418de493894ca7e2f1eeb0b5b3208ddcb651f963fd2ce7b9327756296a4992733442bc02927689788131336b543ece9745ab354b585904b2755d833b13e278935998a24ff7f9a47461e5190f0911429b1589ceea5e0e42fbd07c3aead0d4a98fad5748ea901d24f805b3fc875a3cfb4d',
	'redirect_uri' => 'http://heretic234.temp.swtest.ru',
];

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
curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
curl_setopt($curl,CURLOPT_HEADER, false);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
$out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
/** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
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

try
{
	/** Если код ответа не успешный - возвращаем сообщение об ошибке  */
	if ($code < 200 || $code > 204) {
		throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
	}
}
catch(\Exception $e)
{
    var_dump($e);
	die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
}

/**
 * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
 * нам придётся перевести ответ в формат, понятный PHP
 */
$response = json_decode($out, true);

$access_token = $response['access_token']; //Access токен
$refresh_token = $response['refresh_token']; //Refresh токен
$token_type = $response['token_type']; //Тип токена
$expires_in = $response['expires_in']; //Через сколько действие токена истекает

var_dump($response);