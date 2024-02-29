<?php

namespace Modules\Order\src\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Modules\Order\src\Repositories\OrderRepositoryInterface;

class OrderController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $page_title = 'Quản lý đơn hàng';
        return view('order::list', compact('page_title'));
    }

    public function data()
    {
        $orders = $this->orderRepository->getData();
        return DataTables::of($orders)
            ->addColumn('delete', function ($order) {
                return '<a href="' . route('admin.orders.delete', $order) . '" class="btn btn-danger delete_action">Xóa</a>';
            })
            ->addColumn('name', function ($order) {
                return $order->students->name;
            })
            ->addColumn('course', function ($order) {
                return $order->courses->name;
            })
            ->editColumn('status', function ($order) {
                return $order->status == 1 ? '<button class="btn btn-success">Đã hoàn thành</button>' : '<button class="btn btn-warning">Chưa hoàn thành</button>';
            })
            ->editColumn('created_at', function ($order) {
                return Carbon::parse($order->created_at)->format('d/m/Y H:i:s');
            })
            ->rawColumns(['delete', 'status'])
            ->toJson();
    }

    public function delete($order)
    {
        $this->orderRepository->delete($order);
        return redirect(route('admin.orders.index'))->with('msg', 'Xóa đơn hàng thành công');
    }
}
