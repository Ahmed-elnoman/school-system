@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection
@section('title')
    معاينه طباعة معاملة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <a class="content-title mb-0 my-auto text-dark" href="{{ route('account.index') }}">الحسابات</a><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    معاينة طباعة معاملة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">مدرسة المستقبل</h1>
                        </div><!-- invoice-header -->
                        <div style="text-align:center">
                            <img src="{{ asset('assets/img/icons/page-help-center-badge-light.png') }}"
                                style="margin-top:-30px">
                        </div>
                        <div class="row mg-t-20">
                            <div class="col-md-6">
                                <label class="tx-gray-600">معلومات معاملة</label>
                                <p class="invoice-info-row"><span>نوع معاملة</span>
                                    <span>{{ $account->name }}</span>
                                </p>
                                <p class="invoice-info-row"><span>تاريخ الاصدار</span>
                                    <span>{{ $account->created_at }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="border-bottom-0">اسم المعاملة</th>
                                        <th class="border-bottom-0">الوصف</th>
                                        <th class="border-bottom-0">المبلغ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="tx-12">{{ $account->name }}</td>
                                        <td class="tx-center">{{ $account->description }}</td>
                                        <td class="tx-right">{{ $account->price }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            console.log(document.body.innerHTML = printContents)
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection
