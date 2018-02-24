<?php
/**
 * Created by PhpStorm.
 * User: yilun
 * Date: 2018/2/20
 * Time: 18:13
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\OrderPlace;

class Order extends BaseController
{
    // 用户在选择商品后, 向 API 提交包含它所包含所选择商品的相关信息
    // API 在接收到信息后, 需要检查订单相关商品的库存量
    // 有库存, 吧订单数据存入数据库中, 下单成功, 返回客户端信息, 告诉客户端可以了
    // 还需要再次进行库存检测
    // 服务器这边就可以调用微信的支付接口进行支付
    // 微信会返回给我们一个支付的结果
    // 成功: 也需要进行库存量检测
    // 成功: 进行库存量的扣除

    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder']
    ];

    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
    }
}