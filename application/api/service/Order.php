<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

namespace app\api\service;

use app\api\model\OrderProduct;
use app\api\model\Product;
use app\api\model\UserAddress;
use app\api\model\Order as OrderModel;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;
use think\Db;
use think\Exception;

/**
 * Order Service 业务层
 * @package app\api\service
 */
class Order
{
    //用户提交 订单信息
    protected $oProducts;

    //数据库 真实商品信息
    protected $products;

    //用户ID
    protected $uid;


    /**
     * 用户下单主方法
     * @param $uid 用户ID
     * @param $oProducts 订单数据
     * @return array 用户订单号及订单ID
     */
    public function place($uid, $oProducts)
    {
        //oProducts 与 products对比
        $this->oProducts = $oProducts;
        $this->products  = $this->getProductsByOrder($oProducts);
        $this->uid       = $uid;

        //获取商品库存及组合状态
        $status = $this->getOrderStatus();

        if(!$status['pass'])
        {
            $status['order_id'] = -1;

            return $status;
        }

        //组合快照数据
        $orderSnap = $this->snapOrder($status);

        //创建订单
        $order     = $this->createOrder($orderSnap);

        //设置订单状态
        $order['pass'] = true;

        return $order;
    }


    /**
     * 创建订单
     * @param $snap 快照数据
     * @return array 订单号与订单ID
     * @throws Exception 全局异常
     */
    private function createOrder($snap)
    {
        //事务开始
        Db::startTrans();

        try
        {
            $orderNo = $this->makeOrderNo();

            $order = new OrderModel();

            //设置保存的信息
            $order->user_id     = $this->uid;
            $order->order_no    = $orderNo;
            $order->snap_img    = $snap['snapImg'];
            $order->snap_name   = $snap['snapName'];
            $order->total_price = $snap['orderPrice'];
            $order->total_count = $snap['totalCount'];
            $order->snap_address= $snap['snapAddress'];
            $order->snap_items  = json_encode($snap['pStatus']);

            $order->save();

            //获取保存后的ID与创建时间
            $orderID     = $order->id;
            $create_time = $order->create_time;

            //组合中间表所需新数据
            foreach($this->oProducts as &$p)
            {
                $p['order_id'] = $orderID;
            }

            //保存多组数据
            $orderProduct = new OrderProduct();
            $orderProduct->saveAll($this->oProducts);

            //事务结束
            Db::commit();

            return [
                'order_no'    => $orderNo,
                'order_id'    => $orderID,
                'create_time' => $create_time,
            ];
        }
        catch(Exception $exception)
        {
            //事务回滚
            Db::rollback();

            throw $exception;
        }
    }


    /**
     * 生成低耦合的订单号
     * @return string 生成后的订单号
     */
    public static function makeOrderNo()
    {
        //订单号开始标识
        $yCode = array(
                        'A','B','C','D','E','F','G','H','I','J','K','L','M',
                        'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                 );

                    //当前年-2017获取$yCode数组的下标内容
        $orderSn =  $yCode[intval(date('Y')) - 2017].

                    //获取当前月份转换为十六进制然后全部转换为大写
                    strtoupper(dechex(date('m'))).

                    //获取当前日 截取当前时间后5位 然后连接一起
                    date('d').substr(time(), -5).

                    //获取当前微秒时间戳取 从第2位开始到第5位
                    substr(microtime(),2,5).

                    //获取随机生成0-99的数字 转换为十进制正整数取2位
                    sprintf('%02d',rand(0, 99));

        return $orderSn;
    }


    /**
     * 组合订单快照数据
     * @param $status 订单组合后的数据
     * @return array 组合后的订单快照数据
     */
    private function snapOrder($status)
    {
        $snap = [
            'orderPirce' => 0,
            'totalCount' => 0,
            'pStatus'    => [],
            'snapAddress'=> null,
            'snapName'   => '',
            'snapImg'    => '',
        ];

        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus']    = $status['pStatusArray'];
        $snap['snapAddress']= json_encode($this->getUserAddress());
        $snap['snapName']   = $this->products[0]['name'];
        $snap['snapImg']    = $this->products[0]['main_img_url'];

        if(count($this->products) > 1)
        {
            $snap['snapName'] .= '等';
        }

        return $snap;
    }

    /**
     * 获取用户收获地址
     * @return array 收获地址
     * @throws UserException 用户异常
     */
    private function getUserAddress()
    {
        $userAddress = UserAddress::where('user_id','=', $this->uid)->find();

        if(!$userAddress)
        {
            //抛出用户异常
            throw new UserException([
                'msg' => '用户收获地址不存在，下单失败',
                'errorCode' => 70001,
            ]);
        }

        return $userAddress->toArray();
    }


    /**
     * 支付独立库存检测
     * @param $orderID 订单ID
     * @return array 订单库存等信息
     */
    public function checkOrderStock($orderID)
    {
        $oProducts = OrderProduct::where('order_id','=', $orderID)
                     ->select();

        //订单数据
        $this->oProducts = $oProducts;

        //商品数据
        $this->products = $this->getProductsByOrder($oProducts);

        //组合订单状态
        $status = $this->getOrderStatus();

        return $status;
    }


    /**
     * 组合订单状态
     * @return array
     */
    private function getOrderStatus()
    {
        $status = [
            'pass'         => true,
            'orderPrice'   => 0,
            'totalCount'   => 0,
            'pStatusArray' => [],
        ];

        foreach($this->oProducts as $oProduct)
        {
            $pStatus = $this->getProductStatus(
                $oProduct['product_id'], $oProduct['count'], $this->products
            );

            if(!$pStatus['haveStock'])
            {
                $status['pass'] = false;
            }

            $status['totalCount'] += $pStatus['count'];
            $status['orderPrice'] += $pStatus['totalPrice'];

            array_push($status['pStatusArray'], $pStatus);
        }

        return $status;
    }


    /**
     * 获取商品状态与库存检测
     * @param $oPID     商品ID
     * @param $oCount   商品数量
     * @param $products 数据库商品数据
     * @return array    订单数据及商品状态
     * @throws OrderException 订单异常类
     */
    private function getProductStatus($oPID, $oCount, $products)
    {
        //预设变量 存储商品ID
        $pIndex = -1;

        $pStatus = [
            'id'        => null,
            'haveStock' => false,
            'count'     => 0,
            'name'      => '',
            'totalPrice'=> 0,
        ];

        for($i=0; $i<count($products); $i++)
        {
            if($oPID == $products[$i]['id'])
            {
                $pIndex = $i;
            }
        }

        if($pIndex == -1)
        {
            //客户端 传递的product_id的商品有可能根本不存在
            //抛出订单异常
            throw new OrderException([
                'msg' => 'id为'.$oPID.'的商品不存在，创建订单失败',
            ]);
        }
        else
        {
            //获取单个商品数据
            $product = $products[$pIndex];

            $pStatus['id']    = $product['id'];
            $pStatus['name']  = $product['name'];
            $pStatus['count'] = $oCount;

            //同商品价格*购买数量==单个商品总价
            $pStatus['totalPrice'] = $product['price'] * $oCount;

            //检测商品库存
            if($product['stock'] - $oCount >= 0)
            {
                $pStatus['haveStock']  = true;
            }
        }

        return $pStatus;
    }


    /**
     * 根据订单信息 查找真实商品信息
     * @param $oProducts 订单信息
     * @return array 商品真实数据
     */
    private function getProductsByOrder($oProducts)
    {
        $oPIDs = [];

        foreach($oProducts as $item)
        {
            array_push($oPIDs,$item['product_id']);
        }

        $products = Product::all($oPIDs)
                    ->visible(['id','price','stock','name','main_img_url'])
                    ->toArray();

        return $products;
    }
}