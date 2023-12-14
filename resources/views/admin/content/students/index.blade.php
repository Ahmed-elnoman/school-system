@extends('layouts.master')
@section('title')
    الطلاب
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الطلاب</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    القائمة الطلاب</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('problem'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('problem') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-3">
                    <form class="coupon-form" action="{{ route('student.getStudentByClass') }}" method="GET">
                        {{-- @csrf --}}
                        <select name="class_name" class="form-control" required>
                            <option value="" selected disabled> --حدد الصف--</option>
                            @foreach ($classRoom as $room)
                                <option value={{ $room->id }}>{{ $room->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-primary" style="padding: 12px" type="submit"><i
                                class="fas fa-search d-none d-md-block"></i></button>
                    </form>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (isset($students))
                                <table id="example1" class="table key-buttons text-md-nowrap"
                                    data-page-length='50'style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">#</th>
                                            <th class="border-bottom-0">اسم التلميذ</th>
                                            <th class="border-bottom-0">اسم الصف</th>
                                            <th class="border-bottom-0">العنوان</th>
                                            <th class="border-bottom-0">الجنس</th>
                                            <th class="border-bottom-0">هاتف ولي الامر</th>
                                            <th class="border-bottom-0">السلوك</th>
                                            <th class="border-bottom-0">تاريخ الانضمام</th>
                                            <th class="border-bottom-0">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp

                                        @foreach ($students as $student)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $student->name }} {{ $student->parent->name }} </td>
                                                <td>{{ $student->classRoom->name }}</td>
                                                <td>{{ $student->address }}</td>
                                                <td>{{ $student->gender }}</td>
                                                <td>{{ $student->parent->phone }}</td>
                                                <td>
                                                    @if ($student->status == 0)
                                                        <span class="text-success">ممتاز</span>
                                                    @elseif ($student->status == 1)
                                                        <span class="text-warning">غير جيد</span>
                                                    @else
                                                        <span class="text-danger">صحب فصل</span>
                                                    @endif
                                                </td>
                                                {{-- <td>{{  }}</td> --}}
                                                <td>{{ $student->created_at }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button aria-expanded="false" aria-haspopup="true"
                                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                            type="button">العمليات<i
                                                                class="fas fa-caret-down ml-1"></i></button>
                                                        <div class="dropdown-menu tx-13">
                                                            <a class="dropdown-item"
                                                            href="{{route('student.edit', $student->id)}}"><i
                                                                    class="text-info fas fa-edit"></i>&nbsp;&nbsp;تعديل
                                                                بيانات الطلاب</a>
                                                            <a class="dropdown-item" href="#"
                                                                data-student_id="{{ $student->id }}" data-toggle="modal"
                                                                data-target="#soft"><i
                                                                    class="text-danger fas fa-arrow-left"></i>&nbsp;&nbsp;فصل
                                                                الطلاب</a>
                                                            <a class="dropdown-item" href="#problme"
                                                                data-student_id="{{ $student->id }}" data-toggle="modal"
                                                                data-target="#problme"><i
                                                                    class="text-danger fas fa-exclamation"></i>&nbsp;&nbsp;انزار
                                                                الطلاب</a>
                                                            <a class="dropdown-item" href="#problme"
                                                                data-student_id="{{ $student->id }}"
                                                                data-student_name="{{ $student->name }} {{ $student->parent->name }}"
                                                                data-student_total="{{$student->chargeFar->total_fees}}"
                                                                data-first_payment="{{$student->chargeFar->first_payment}}"
                                                                data-second_payment="{{$student->chargeFar->second_payment}}"
                                                                data-total_fees="{{$student->payment_status->total_fees}}"
                                                                data-payment_status="{{$student->payment_status->payment_status}}"
                                                                data-toggle="modal"
                                                                data-target="#fees"><i
                                                                    class="text-warning fas fa-folder"></i>&nbsp;&nbsp;الملف
                                                                المالي</a>
                                                            <a class="dropdown-item" href="#"
                                                                data-student_id="{{ $student->id }}"
                                                                data-parent_name="{{ $student->parent->name }}"
                                                                data-parent_email="{{ $student->parent->email }}"
                                                                data-parent_address="{{ $student->parent->address }}"
                                                                data-parent_job="{{ $student->parent->job }}"
                                                                data-toggle="modal" data-target="#parent"><i
                                                                    class="text-success fas fa-address-card"></i>&nbsp;&nbsp;تفاصيل
                                                                ولي الامر </a>
                                                            <a class="dropdown-item" href="#"
                                                                data-student_id="{{ $student->id }}"
                                                                data-student_name="{{ $student->name }} {{ $student->parent->name }}"
                                                                data-medical_situation="{{ $student->medical_situation }}"
                                                                data-medical_situation_file="{{ $student->medical_situation_file }}"
                                                                data-toggle="modal" data-target="#medicalSituation"><i
                                                                    class="text-danger fas fa-heartbeat"></i>&nbsp;&nbsp;الملف
                                                                الطبي
                                                            </a>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                            @endif
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->
        </div>



        {{-- start parents modal  --}}
        <div class="modal fade" id="soft" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">فصل التلميذ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form action="{{ route('student.softDelete') }}" method="post">
                            @method('DELETE')
                            @csrf
                    </div>
                    <div class="modal-body">
                        هل انت متاكد من عملية الفصل ؟
                        <input type="hidden" name="id" id="student_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- start parents modal  --}}

        <div class="modal fade" id="parent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تفاصيل ولي الامر</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="student_id" value="">
                        <p class="invoice-info-row"><span>اسم ولي الامر</span>
                            <span id="parent_name"></span>
                        </p>
                        <p class="invoice-info-row"><span>البريد الالكتروني</span>
                            <span id="parent_email"></span>
                        </p>
                        <p class="invoice-info-row"><span>العنوان</span>
                            <span id="parent_address"></span>
                        </p>
                        <p class="invoice-info-row"><span>الوظيفة</span>
                            <span id="parent_job"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- start freeze modal --}}
        <div class="modal fade" id="problme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">انزار التلميذ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('student.problem') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" id="student_id" value="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">سبب الانزار</label>
                                <input type="test" class="form-control" id="problem_name" name="problem_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">وصف الانزار</label>
                                <input type="test" class="form-control" id="problem_description"
                                    name="problem_description">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">تاريخ الانزار</label>
                                <input type="date" class="form-control" id="problem_date" name="problem_date">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end freeze modal --}}

        {{-- start fees modal  --}}
        <div class="modal fade" id="fees" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document" id="print">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">الملف المالي للتلميذ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="student_id" value="">
                        <p class="invoice-info-row"><span>اسم الطالب</span>
                            <span id="student_name"></span>
                        </p>
                        <p class="invoice-info-row"><span>الدفعة الاولي</span>
                            <span id="first_payment"></span>
                        </p>
                        <p class="invoice-info-row"><span>الدفعة الثانية</span>
                            <span id="second_payment"></span>
                        </p>
                        <p class="invoice-info-row"><span>اجمالي الرسوم</span>
                            <span id="chargeFor_total" class="tx-info"></span>
                        </p>
                        <p class="invoice-info-row"><span>ما تم دفعة</span>
                            <span id="total_fees"></span>
                        </p>
                        <p class="invoice-info-row"><span>حالة دفعة</span>
                            <span id="payment_status"></span>
                        </p>
                        <p class="invoice-info-row"><span>المتبقي</span>
                            <span id="residual"></span>
                        </p>
                        <p class="invoice-info-row mb-3"><span></span>
                        </p>
                        <button class="btn btn-danger  float-left mt-1 mr-2" id="print_Button" onclick="printDiv()"> <i
                            class="mdi mdi-printer ml-1"></i>طباعة</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end fees modal  --}}

        {{-- start medical_situation modal  --}}
        <div class="modal fade" id="medicalSituation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">الحالة الصحية لتلميذ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="student_id" value="">
                        <p class="invoice-info-row"><span>اسم الطالب</span>
                            <span id="student_name"></span>
                        </p>
                        <p class="invoice-info-row"><span>الحالة الصحية</span>
                            <span id="medical_situation"></span>
                        </p>
                        <p class="invoice-info-row"><span>الملف الطبي</span>
                            <span id="medical_situation_file"></span>
                            {{-- <img src="" alt="" srcset=""> --}}
                        </p>
                        <p class="invoice-info-row mb-3"><span></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- end medical_situation modal  --}}
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#soft').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var student_id = button.data('student_id')
            var modal = $(this)
            modal.find('.modal-body #student_id').val(student_id);
        })
    </script>
    <script>
        $('#problme').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var student_id = button.data('student_id')
            var modal = $(this)
            modal.find('.modal-body #student_id').val(student_id);
        })
    </script>
    <script>
        $('#parent').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var student_id = button.data('student_id')
            var parent_name = button.data('parent_name')
            var parent_email = button.data('parent_email')
            var parent_address = button.data('parent_address')
            var parent_job = button.data('parent_job')
            var modal = $(this)
            modal.find('.modal-body #student_id').val(student_id);
            modal.find('.modal-body #parent_name').html(parent_name);
            modal.find('.modal-body #parent_email').html(parent_email);
            modal.find('.modal-body #parent_address').html(parent_address);
            modal.find('.modal-body #parent_job').html(parent_job);
        })
    </script>
    <script>
        $('#fees').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var student_id = button.data('student_id')
            var student_name    = button.data('student_name')
            var student_total   = button.data('student_total')
            var first_payment   = button.data('first_payment')
            var second_payment  = button.data('second_payment')
            var total_fees      = button.data('total_fees')
            var payment_status  = button.data('payment_status')
            var modal = $(this)
            modal.find('.modal-body #student_id').val(student_id);
            modal.find('.modal-body #student_name').html(student_name);
            modal.find('.modal-body #chargeFor_total').html(student_total);
            modal.find('.modal-body #first_payment').html(first_payment);
            modal.find('.modal-body #second_payment').html(second_payment);
            modal.find('.modal-body #total_fees').html(total_fees);
            modal.find('.modal-body #payment_status').html(payment_status);

            //
            // var residual  = document.getElementById('');
            var total_resresidual = first_payment - total_fees;
           if(total_resresidual == 0) {
            // modal.find('.modal-body #residual').innerHTML
            residual.innerHTML = 'تم دفعة كل الرسوم الدفعة الاول'
           }
           else {
            residual.innerHTML = total_resresidual +'المتبقي من الرسو م الدفعة الاول'
           }
        })

        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
    <script>
        $('#medicalSituation').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var student_id = button.data('student_id')
            var student_name = button.data('student_name')
            var medical_situation = button.data('medical_situation')
            var medical_situation_file = button.data('medical_situation_file')
            var modal = $(this)

            console.log(medical_situation_file);
            modal.find('.modal-body #student_id').val(student_id);
            modal.find('.modal-body #student_name').html(student_name);
            modal.find('.modal-body #medical_situation').html(medical_situation);
            /////////////////////////////////////////////////////////////////////
            if(medical_situation_file === null){
                modal.find('.modal-body #medical_situation_file').html('<p class="text-success" > لا يوجد ملف طبي للتلميذ</p>');
            }
            else{
                modal.find('.modal-body #medical_situation_file').html('<img src="' + medical_situation_file +'" width="50px" />');
            }
        })
    </script>
    <script>
        $('#class_room').on('change', function() {
            var idState = this.value;
            $('#charge_for').html('');
            $.ajax({
                url: 'class_room/get_charge/' + idState,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    // $('#charge_for').html('<option value="">--حدد الرسوم--</option>');
                    $.each(res.charge, function(key, value) {
                        $('#charge_for').append('<option value="' + value.id + '">' + value
                            .price + '</option>');
                    });
                }
            });
        });
        $('#room').on('change', function() {
            var idState = this.value;
            $('#charge').html('');
            $.ajax({
                url: 'class_room/get_charge/' + idState,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    // $('#charge_for').html('<option value="">--حدد الرسوم--</option>');
                    $.each(res.charge, function(key, value) {
                        $('#charge').append('<option value="' + value.id + '">' + value
                            .price + '</option>');
                    });
                }
            });
        });
    </script>







@endsection
