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
                <div class="card-header pb-0">
                    <a data-effect="effect-scale" data-toggle="modal" href="#addteacher"
                        class="modal-effect btn btn-sm btn-primary" style="color:white"><i class="fas fa-plus"></i>&nbsp;
                        اضافة تلميذ</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap"
                            data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم التلميذ</th>
                                    <th class="border-bottom-0">البريد الالكتروني</th>
                                    <th class="border-bottom-0">اسم الصف</th>
                                    <th class="border-bottom-0">العنوان</th>
                                    <th class="border-bottom-0">الجنس</th>
                                    <th class="border-bottom-0">هاتف ولي الامر</th>
                                    <th class="border-bottom-0">السلوك</th>
                                    <th class="border-bottom-0">الرسوم</th>
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
                                        <td>{{ $student->full_name }} </td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->classRoom->name }}</td>
                                        <td>{{ $student->address }}</td>
                                        <td>{{ $student->gender }}</td>
                                        <td>{{ $student->phone_parent }}</td>
                                        <td>
                                            @if ($student->status == 0)
                                                <span class="text-success">ممتاز</span>
                                            @elseif ($student->status == 1)
                                                <span class="text-warning">غير جيد</span>
                                            @else
                                                <span class="text-danger">صحب فصل</span>
                                            @endif
                                        </td>
                                        <td>{{ $student->chargeFar->price }}</td>
                                        <td>{{ $student->join_date }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item" data-effect="effect-scale"
                                                        data-id="{{ $student->id }}"
                                                        data-student_name="{{ $student->full_name }}"
                                                        data-student_email="{{ $student->email }}"
                                                        data-student_address="{{ $student->address }}"
                                                        data-student_gender="{{ $student->gender }}"
                                                        data-student_phone_parent="{{ $student->phone_parent }}"
                                                        data-student_join_date="{{ $student->join_date }}"
                                                        data-toggle="modal" href="#editStudent"><i
                                                            class="text-info fas fa-edit"></i>&nbsp;&nbsp;تعديل
                                                        بيانات الطلاب</a>
                                                    <a class="dropdown-item" href="#"
                                                        data-student_id="{{ $student->id }}" data-toggle="modal"
                                                        data-target="#soft"><i
                                                            class="text-danger fas fa-sign-out"></i>&nbsp;&nbsp;فصل
                                                        الطلاب</a>
                                                    <a class="dropdown-item" href="#problme"
                                                        data-student_id="{{ $student->id }}" data-toggle="modal"
                                                        data-target="#problme"><i
                                                            class="text-warning fas fa-balance-scale"></i>&nbsp;&nbsp;انزار
                                                        الطلاب</a>
                                                    {{-- <a class="dropdown-item"
                                                        href="{{ route('account.print', $student->id) }}"><i
                                                            class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                        البيانات
                                                    </a> --}}
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

    {{-- start add modal  --}}
    <div class="modal" id="addteacher">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة تلميذ</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('student.store') }}" method="post" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم التلميذ</label>
                            <input type="text" class="form-control" id="student_name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">البريد الالكتروني</label>
                            <input type="email" class="form-control" id="student_email" name="email">
                        </div>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الجنس</label>
                        <select name="gender" id="gander" class="form-control" required>
                            <option value="" selected disabled> --حدد الجنس--</option>
                            <option value="ذكر">ذكر</option>
                            <option value="انثي">انثي</option>
                        </select>
                        <div class="form-group">
                            <label for="exampleInputEmail1">العنوان </label>
                            <input type="test" class="form-control" id="section_name" name="address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم هاتف ولي الامر</label>
                            <input type="test" class="form-control" id="section_name" name="phone_parent">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">تاريخ الانضمام</label>
                            <input type="date" class="form-control" id="section_name" name="join_date">
                        </div>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم الصف</label>
                        <select name="class_room" id="class_room" class="form-control" required>
                            <option value="" selected disabled> --حدد الصف--</option>
                            @foreach ($classRoom as $room)
                                <option value={{ $room->id }}>{{ $room->name }}</option>
                            @endforeach

                        </select>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الرسم</label>
                        <select name="charge_for" id="charge_for" class="form-control" required>

                        </select>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->


    </div>
    {{-- end add modal  --}}

    {{-- statr edit account modal  --}}
    <div class="modal" id="editStudent">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل بيانات التلميذ</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('student.update') }}" method="post" autocomplete="off">
                        @csrf
                        @method('put')

                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم التلميذ</label>
                            <input type="text" class="form-control" readonly id="student_name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">البريد الالكتروني</label>
                            <input type="email" class="form-control" id="student_email" name="email">
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الجنس</label>
                            <select name="gender" id="gander" class="form-control" required>
                                <option value="" selected disabled> --حدد الجنس--</option>
                                <option value="ذكر">ذكر</option>
                                <option value="انثي">انثي</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">العنوان </label>
                            <input type="test" class="form-control" id="student_address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم هاتف ولي الامر</label>
                            <input type="test" class="form-control" id="student_phone_parent" name="phone_parent">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">تاريخ الانضمام</label>
                            <input type="date" class="form-control" readonly id="student_join_date" name="join_date">
                        </div>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم الصف</label>
                        <select name="room" id="room" class="form-control" required>
                            <option value="" selected disabled> --حدد الصف--</option>
                            @foreach ($classRoom as $room)
                                <option value={{ $room->id }}>{{ $room->name }}</option>
                            @endforeach

                        </select>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الرسم</label>
                        <select name="charge" id="charge" class="form-control" required>

                        </select>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->


    </div>

    {{-- end edit modal --}}

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

    <script>
        $('#editStudent').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var student_name = button.data('student_name')
            var student_email = button.data('student_email')
            // var class_room = button.data('class_room')
            var student_address = button.data('student_address')
            var student_gender = button.data('student_gender')
            var student_phone_parent = button.data('student_phone_parent')
            // var charge_for = button.data('charge_for')
            var student_join_date = button.data('student_join_date')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #student_name').val(student_name);
            modal.find('.modal-body #student_email').val(student_email);
            // modal.find('.modal-body #class_room').val(class_room);
            modal.find('.modal-body #student_address').val(student_address);
            modal.find('.modal-body #student_gender').val(student_gender);
            modal.find('.modal-body #student_phone_parent').val(student_phone_parent);
            // modal.find('.modal-body #charge_for').val(charge_for);
            modal.find('.modal-body #student_join_date').val(student_join_date);
        })
    </script>







@endsection
