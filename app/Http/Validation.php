<?php


namespace App\Http;

use Illuminate\Support\Facades\Validator;

class Validation
{
    const CUSTOMER = 'customer';
    const PARTNER = 'partner';
    const STATUS = 'status';

    /**
     * Возвращает валидатор для проверки перед записью
     *
     * @param string $parameter новые значения для заказа
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function beforeStore(array $parameters)
    {
        $customer = htmlspecialchars(
            $parameters[self::CUSTOMER] ?? '');
        $partner = (int)($parameters[self::PARTNER] ?? 0);
        $status = (int)($parameters[self::STATUS] ?? 0);

        return Validator::make(
            [
                self::CUSTOMER => $customer,
                self::PARTNER => $partner,
                self::STATUS => $status],
            [
                self::CUSTOMER => 'required',
                self::PARTNER => 'required',
                self::STATUS => 'required',],
            [
                self::CUSTOMER . '.required' => 'Адрес клиента не задан',
                self::PARTNER . '.required' => 'Партнёр не выбран',
                self::STATUS . '.required' => 'Статус не выбран']);
    }

}
