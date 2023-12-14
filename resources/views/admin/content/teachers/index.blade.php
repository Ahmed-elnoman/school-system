@extends('layouts.master')
@section('title')
    المعلمين
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
                <h4 class="content-title mb-0 my-auto">المعملين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    القائمة الملعمين</span>
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

    @if (session()->has('freeze'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('freeze') }}</strong>
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
                        اضافة استاذ</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap"
                            data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم المعلم</th>
                                    <th class="border-bottom-0">البريد الالكتروني</th>
                                    <th class="border-bottom-0">الصوؤة</th>
                                    <th class="border-bottom-0">الجنس</th>
                                    <th class="border-bottom-0">العنوان</th>
                                    <th class="border-bottom-0">الهاتف</th>
                                    <th class="border-bottom-0">القسم</th>
                                    <th class="border-bottom-0">الراتب</th>
                                    <th class="border-bottom-0">تاريخ الانضمام</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($teachers as $teachers)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $teachers->full_name }} </td>
                                        <td>{{ $teachers->email }}</td>
                                        <td><img src="{{ $teachers->image }}" width="20px"></td>
                                        <td>{{ $teachers->gender }}</td>
                                        <td>{{ $teachers->address }}</td>
                                        <td>{{ $teachers->phone }}</td>
                                        <td class="text-info">{{ $teachers->department->name }}</td>
                                        <td>
                                            @if ($teachers->salary > 100)
                                                <span class="text-success">{{ $teachers->salary }}</span>
                                            @else
                                                <span class="text-warning">{{ $teachers->salary }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $teachers->join_date }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item" data-effect="effect-scale"
                                                        href="{{ route('teacher.edit', $teachers->id) }}"><i
                                                            class="text-info fas fa-edit"></i>&nbsp;&nbsp;تعديل
                                                        البيانات</a>
                                                    <a class="dropdown-item" href="#"
                                                        data-teacher_id="{{ $teachers->id }}" data-toggle="modal"
                                                        data-target="#soft"><i
                                                            class="text-danger fas fa-sign-out"></i>&nbsp;&nbsp;فصل
                                                        المعلم</a>
                                                    <a class="dropdown-item" href="#freeze"
                                                        data-teacher_id="{{ $teachers->id }}" data-toggle="modal"
                                                        data-target="#freeze"><i
                                                            class="text-warning fas fa-balance-scale"></i>&nbsp;&nbsp;تجميد
                                                        المعلم</a>
                                                    {{-- <a class="dropdown-item"
                                                        href="{{ route('account.print', $teachers->id) }}"><i
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
                    <h6 class="modal-title">اضافة معلم</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم معلم</label>
                            <input type="text" class="form-control" id="teacher_name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">البريد الالكتروني</label>
                            <input type="email" class="form-control" id="teacher_name" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">صورة</label>
                            <input type="file" name="file" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
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
                            <label for="exampleInputEmail1">رقم الهاتف</label>
                            <input type="test" class="form-control" id="section_name" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">تاريخ الانضمام</label>
                            <input type="date" class="form-control" id="section_name" name="join_date">
                        </div>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                        <select name="department" id="department" class="form-control" required>
                            <option value="" selected disabled> --حدد القسم--</option>
                            @foreach ($departments as $department)
                                <option value={{ $department->id }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الراتب</label>
                            <input type="number" class="form-control" id="section_name" name="salary">
                        </div>
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
    {{-- <div class="modal" id="edit_teacher">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل بيانات المعلم</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher.update') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم معلم</label>
                            <input type="text" class="form-control" id="teachers_name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">البريد الالكتروني</label>
                            <input type="email" class="form-control" id="teachers_email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">صورة</label>
                            <input type="file" name="file" class="dropify" id="teachers_image"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                        </div>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الجنس</label>
                        <select name="gender" id="teachers_gender" class="form-control" required>
                            <option value="" selected disabled> --حدد الجنس--</option>
                            <option value="ذكر">ذكر</option>
                            <option value="انثي">انثي</option>
                        </select>
                        <div class="form-group">
                            <label for="exampleInputEmail1">العنوان </label>
                            <input type="test" class="form-control" id="teachers_address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم الهاتف</label>
                            <input type="test" class="form-control" id="teachers_phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">تاريخ الانضمام</label>
                            <input type="date" class="form-control" id="teachers_join_date" name="join_date">
                        </div>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                        <select name="department" id="teachers_department_id" class="form-control" required>
                            <option value="" selected disabled> --حدد القسم--</option>
                            @foreach ($departments as $department)
                                <option value={{ $department->id }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الراتب</label>
                            <input type="number" class="form-control" id="teachers_salary" name="salary">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->


    </div> --}}

    {{-- end edit modal --}}

    <div class="modal fade" id="soft" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">فصل المعلم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('teacher.soft') }}" method="post">
                        @method('DELETE')
                        @csrf
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الفصل ؟
                    <input type="hidden" name="id" id="teacher_id" value="">
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
    <div class="modal fade" id="freeze" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تجميد المعلم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('teacher.freeze') }}" method="post">
                        @csrf
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="teacher_id" value="">
                    <div class="form-group">
                        <label for="exampleInputEmail1">سبب التجميد</label>
                        <input type="test" class="form-control" id="teachers_phone" name="freeze_reason">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">تاريخ التجميد</label>
                        <input type="date" class="form-control" id="teachers_phone" name="date">
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
    <!-- ارشيف الفاتورة -->
    <div class="modal fade" id="Transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارشفة الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الارشفة ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                    <input type="hidden" name="id_page" id="id_page" value="2">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-success">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>

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
            var teacher_id = button.data('teacher_id')
            var modal = $(this)
            modal.find('.modal-body #teacher_id').val(teacher_id);
        })
    </script>
    <script>
        $('#freeze').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var teacher_id = button.data('teacher_id')
            var modal = $(this)
            modal.find('.modal-body #teacher_id').val(teacher_id);
        })
    </script>
    <script>
        $('#Transfer_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>


@endsection
