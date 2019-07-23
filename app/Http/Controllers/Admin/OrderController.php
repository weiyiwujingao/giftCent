<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Services\OrderService;
use PhpOffice\PhpSpreadsheet\Exception;


class OrderController extends BaseController
{
    protected $request;
    protected $orderService;


    /**
     * AdminsController constructor.
     * @param AdminsService $adminsService
     * @param RolesRepository $rolesRepository
     */
    public function __construct(Request $request, OrderService $orderService)
    {
        $this->request = $request;
        $this->orderService = $orderService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orderList = $this->orderService->getOrderList();
        $allStatus = $this->orderService->getAllStatus();
        $search = \Request::all();
        return view('admin.order.index', compact('orderList', 'allStatus', 'search'));
    }

    /**
     * 订单状态修改
     * @author: colin
     * @date: 2018/12/18 10:57
     * @param $status
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($status, $id)
    {
        $orderInfo = $this->orderService->ById($id);
        if (empty($orderInfo)) {
            flash('操作失败')->error()->important();

            return redirect()->route('order.index');
        }

        $orderInfo->update(['status' => $status]);

        flash('更新状态成功')->success()->important();

        return redirect()->route('order.index');
    }

    /**
     * 订单状态操作
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus()
    {
        $params = $this->request->all();
        \DB::beginTransaction();
        try {
            $orderId = isset($params['order_id']) ? intval($params['order_id']) : 0;
            if (empty($orderId)) {
                throw new Exception('订单id不能为空！');
            }
            $status = isset($params['status']) ? intval($params['status']) : 0;
            $val = isset($params['val']) ? intval($params['val']) : 0;
            $orderInfo = $this->orderService->ById($orderId);
            if (empty($orderInfo)) {
                throw new Exception('该订单不存在或已删除！');
            }
            if ($orderInfo->status != $status) {
                throw new Exception('该订单状态已改变，请刷新后操作！');
            }
            $orderInfo->update(['status' => $val]);
            \DB::commit();
            $res = [
                'status' => 1,
            ];
        } catch (Exception $e) {
            \DB::rollBack();
            $res = [
                'status'  => 0,
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($res);
    }
}
