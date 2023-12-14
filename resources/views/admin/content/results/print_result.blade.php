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
    النتيجة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <a class="content-title mb-0 my-auto text-dark text-2" href="{{ route('result.index') }}">النتيجة</a><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    طباعة النتيجة</span>
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
                            <h1 class="invoice-title">النتيجة النهاية</h1>
                            <div class="billed-from">
                                <h6>مدرسة المستقبل</h6>
                                <p>2{{ now() }}<br>
                                    Tel No: 0991288161<br>
                                    Email: info@mustaqbal.com</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">

                            <div class="col-md">
                                @foreach ($student_result as $result)
                                @endforeach
                                <label class="tx-gray-600">معلومات التلميذ</label>
                                <p class="invoice-info-row"><span>اسم التلميذ</span>
                                    <span>{{ $result->student->name }} {{ $result->student->parent->name }}</span>
                                </p>
                                <p class="invoice-info-row"><span>المستوي</span>
                                    <span>{{ $result->student->classRoom->level }}</span>
                                </p>
                                <p class="invoice-info-row"><span>اسم الصف</span>
                                    <span>{{ $result->student->classRoom->name }}</span>
                                </p>
                                {{-- <p class="invoice-info-row"><span>القسم</span> --}}
                                {{-- <span>{{ $result->section->section_name }}</span></p> --}}
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">اسم المادة</th>
                                        <th class="tx-center">الدرجة </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($student_result as $student)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td class="tx-12">{{ $student->subject->name }}</td>
                                            <td class="tx-center" id="marks">{{ $student->marks }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">الدرجة النهاية</td>
                                        <td class="tx-right" colspan="2">
                                            <h5 class=" tx-bold" id="total_mark">
                                                <h5>
                                        </td>
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
        var marks = document.querySelectorAll('td#marks.tx-center');
        let global_mark = 0;
        for (i = 0; i <= marks.length; i++) {
            let mark = marks[i].innerHTML;
            global_mark += Number(mark);
            total_mark = global_mark / marks.length;
            var floor_total_marks = Math.floor(total_mark)

            document.getElementById('total_mark').innerHTML = floor_total_marks + '%'
        }

        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection
