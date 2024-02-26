@extends('layouts.frontend')
@section('title','Thông tin đơn hàng')
@section('content')
         
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">


                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="dashboard_container">
                            <div class="dashboard_container_header">
                                <div class="dashboard_fl_1">
                                    <h3>Thông tin đơn hàng</h3>
                                </div>
                            </div>
                            <div class="dashboard_container_body p-4">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <p>Khóa học: <b>Lập trình PHP nâng cao - chuyên sâu để đi làm</b></p>
                                        <p>Giá: 795,000đ</p>
                                        <p><b>Thông tin thanh toán</b></p>
                                        <p>
                                            Ngân hàng VietcomBank – Chi nhánh Thăng Long
                                        </p>
                                        <p>– Số tài khoản: 0491000035576</p>
                                        <p>– Chủ tài khoản: Tạ Hoàng An</p>
                                        <p>– Số tiền: 795,000đ</p>
                                        <p>– Nội dung: 698KH13</p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p class="text-center"><b>Quét mã QR thanh toán</b></p>
                                        <p class="text-center"><img
                                                style="max-width: 100%; height: auto; width: 300px;"
                                                src="https://img.vietqr.io/image/vietcombank-1014343101-compact.jpg?amount=795000&addInfo=698KH13"
                                                alt=""></p>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
                <!-- /Row -->

            </div>
            <!-- Sidebar -->
        </div>
    </div>
</section>

@endsection