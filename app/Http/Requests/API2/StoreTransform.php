<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                          ThinkSNS Plus                               |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2017 Chengdu ZhiYiChuangXiang Technology Co., Ltd.     |
 * +----------------------------------------------------------------------+
 * | This source file is subject to version 2.0 of the Apache license,    |
 * | that is bundled with this package in the file LICENSE, and is        |
 * | available through the world-wide-web at the following url:           |
 * | http://www.apache.org/licenses/LICENSE-2.0.html                      |
 * +----------------------------------------------------------------------+
 * | Author: Slim Kit Group <master@zhiyicx.com>                          |
 * | Homepage: www.thinksns.com                                           |
 * +----------------------------------------------------------------------+
 */

namespace Zhiyi\Plus\Http\Requests\API2;

use Zhiyi\Plus\Repository\CurrencyConfig;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransform extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param \Zhiyi\Plus\Repository\WalletRechargeType $repository
     * @return array
     * @author BS <414606094@qq.com>
     */
    public function rules(CurrencyConfig $config)
    {
        $currency = $this->user()->newWallet()->firstOrCreate([], ['balance' => 0]);

        return [
            'amount' => 'required|int|min:100|max:'.$currency->balance,
        ];
    }

    /**
     * Get the valodation error message that apply to the request.
     *
     * @return array
     * @author BS <414606094@qq.com>
     */
    public function messages()
    {
        return [
            'amount.required' => '请选择需要转换的余额',
            'amount.min' => '余额参数不合法',
            'amount.max' => '账户余额不足',
        ];
    }
}
