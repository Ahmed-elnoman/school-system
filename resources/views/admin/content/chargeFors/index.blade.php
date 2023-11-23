@extends('layouts.master')
@section('title')
    الرسوم
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
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الرسوم</span>
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

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- start charge for (الرسوم) table  --}}
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <a data-effect="effect-scale" data-toggle="modal" href="#addCharge"
                        class="modal-effect btn btn-sm btn-primary" style="color:white"><i class="fas fa-plus"></i>&nbsp;
                        اضافة رسوم</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap"
                            data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">المستوي</th>
                                    <th class="border-bottom-0">اجمالي المبلغ</th>
                                    <th class="border-bottom-0">الدفعه الاولي</th>
                                    <th class="border-bottom-0">الدفعه الثانية</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($chargeFors as $class)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $class->classRoom->level }} </td>
                                        <td>{{ $class->total_fees }}</td>
                                        <td>{{ $class->first_payment }}</td>
                                        <td>{{ $class->second_payment }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item" data-effect="effect-scale"
                                                        data-id="{{ $class->id }}"
                                                        data-charge_level="{{ $class->id }}"
                                                        data-charge_total_fees="{{ $class->total_fees }}"
                                                        data-charge_first_payment="{{ $class->first_payment }}"
                                                        data-charge_second_payment="{{ $class->second_payment }}"
                                                        data-toggle="modal" href="#editCharge"><i
                                                            class="text-info fas fa-edit"></i>&nbsp;&nbsp;تعديل
                                                        الرسوم</a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    {{-- end charge for (الرسوم) table  --}}
    <hr class="m-2">
    <h5>الاستثناء</h5>
    <hr class="m-2">
    {{-- start an_exception table  --}}
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <a data-effect="effect-scale" data-toggle="modal" href="#addAnException"
                        class="modal-effect btn btn-sm btn-primary mg-b-20" style="color:white"><i
                            class="fas fa-plus"></i>&nbsp;
                        اضافة الاستثناء</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table id="example2" class="table text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">نوع الاستثناء</th>
                                <th class="border-bottom-0">وصف الاستثناء</th>
                                <th class="border-bottom-0">نسبة الخصم</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($an_exceptions as $an_exception)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $an_exception->type }} </td>
                                    <td>{{ $an_exception->description }}</td>
                                    <td>{{ $an_exception->discount_rate }}%</td>
                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" data-effect="effect-scale"
                                                    data-id="{{ $an_exception->id }}"
                                                    data-an_exception_type="{{ $an_exception->type }}"
                                                    data-an_exception_description="{{ $an_exception->description }}"
                                                    data-an_exception_discount_rate="{{ $an_exception->discount_rate }}"
                                                    data-toggle="modal" href="#editAnException"><i
                                                        class="text-info fas fa-edit"></i>&nbsp;&nbsp;تعديل
                                                    الاستثناء</a>
                                                <a class="dropdown-item" data-effect="effect-scale"
                                                    data-id="{{ $an_exception->id }}" data-toggle="modal"
                                                    href="#deleteAnException"><i
                                                        class="text-danger fas fa-trash"></i>&nbsp;&nbsp;حذف
                                                    الاستثناء</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- end an_exception table  --}}

    {{-- start add fees (الرسوم) modal  --}}
    <div class="modal" id="addCharge">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة رسوم</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('charge.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">المستوي </label>
                            <select class="form-control" id="charge_level" name="charge_level">
                                @foreach ($classRoom as $room)
                                    <option value={{ $room->id }}>{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">اجمالي المبلغ </label>
                            <input type="number" class="form-control" id="total_fees" name="total_fees">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الدفعه الاولي </label>
                            <input type="number" class="form-control" id="first_payment" name="first_payment">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الدفع الثانية </label>
                            <input type="number" class="form-control" id="second_payment" name="second_payment">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end add fees modal  --}}


    {{-- start add an_exception modal  --}}
    <div class="modal" id="addAnException">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة استثناء</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('an_exception.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">نوع الاستثناء </label>
                            <input type="text" class="form-control" id="type" name="type_an_exception">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">وصف الاستثناء </label>
                            <textarea name="description_an_exception" id="description_an_exception" class="form-control" cols="30"
                                rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">نسبة الخصم</label>
                            <input type="number" class="form-control" id="discount_rate" name="discount_rate">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end add an_exception modal  --}}

    {{-- statr edit Charge modal  --}}
    <div class="modal" id="editCharge">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل الرسوم</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('charge.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">المستوي </label>
                            <select class="form-control"name="charge_level">
                                @foreach ($classRoom as $room)
                                    <option value={{ $room->id }} id="charge_level">{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">اجمالي المبلغ </label>
                            <input type="number" class="form-control" id="charge_total_fees" name="total_fees">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الدفعه الاولي </label>
                            <input type="number" class="form-control" id="charge_first_payment" name="first_payment">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الدفع الثانية </label>
                            <input type="number" class="form-control" id="charge_second_payment" name="second_payment">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تحديث</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end edit Charge modal --}}

    {{-- statr edit an_exception modal  --}}
    <div class="modal" id="editAnException">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل الاستثناء</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('an_exception.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">نوع الاستثناء </label>
                            <input type="text" class="form-control" id="type" name="type">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">وصف الاستثناء </label>
                            <textarea name="description_an_exception" id="description" class="form-control" cols="30" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">نسبة الخصم</label>
                            <input type="number" class="form-control" id="discount_rate" name="discount_rate">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end edit an_exception modal --}}

    {{-- start delete an_exception  modal  --}}
    <div class="modal fade" id="deleteAnException" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف الاستثناء</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('an_exception.delete') }}" method="post">
                        @method('DELETE')
                        @csrf
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="hidden" name="id" id="an_exception_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    {{-- end delete  an_exception  modal --}}
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
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#editCharge').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var charge_level = button.data('charge_level')
            var charge_total_fees = button.data('charge_total_fees')
            var charge_first_payment = button.data('charge_first_payment')
            var charge_second_payment = button.data('charge_second_payment')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #charge_level').val(charge_level);
            modal.find('.modal-body #charge_total_fees').val(charge_total_fees);
            modal.find('.modal-body #charge_first_payment').val(charge_first_payment);
            modal.find('.modal-body #charge_second_payment').val(charge_second_payment);
        })
        //   add new an_exception
        $('#editAnException').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var type = button.data('an_exception_type')
            var description = button.data('an_exception_description')
            var discount_rate = button.data('an_exception_discount_rate')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #type').val(type);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #discount_rate').val(discount_rate);
        })
    </script>

    <script>
        //  add new total_fees
        $('#total_fees').on('change', function(event) {
            var total = document.getElementById('total_fees').value;
            var payment = total / 2;

            $total = document.getElementById('first_payment').value = payment;
            $total = document.getElementById('second_payment').value = payment;
        })

        // edti total_fees
        $('#charge_total_fees').on('change', function(e) {
            var total = document.getElementById('charge_total_fees').value;
            var payment = total / 2;

            $total = document.getElementById('charge_first_payment').value = payment;
            $total = document.getElementById('charge_second_payment').value = payment;
        });
    </script>

    <script>
        $('#deleteAnException').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #an_exception_id').val(id);
        })
    </script>






@endsection
