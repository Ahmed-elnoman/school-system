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
                    اضافة معلم</span>
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

    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <h3 data-effect="effect-scale" class="tx-gray-600">اضافة معلم</h3>

                </div>
                <div class="card-body">

                    <form action="{{ route('teacher.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">اسم معلم</label>
                                    <input type="text" class="form-control" id="teacher_name" value="{{old('name')}}" name="name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">البريد الالكتروني</label>
                                    <input type="email" class="form-control" id="teacher_name" value="{{old('email')}}" name="email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">صورة</label>
                                    <input type="file" name="file" class="dropify"
                                        accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الجنس</label>
                                    <select name="gender" id="gander" class="form-control" required>
                                        <option value="" selected disabled> --حدد الجنس--</option>
                                        <option value="ذكر">ذكر</option>
                                        <option value="انثي">انثي</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">العنوان </label>
                                    <input type="test" class="form-control" id="section_name" value="{{old('address')}}" name="address">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">رقم الهاتف</label>
                                    <input type="test" class="form-control" id="section_name" name="phone">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">تاريخ الانضمام</label>
                                    <input type="date" class="form-control" id="section_name" value="{{old('join_date')}}" name="join_date">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                                <select name="department" id="department" class="form-control" required>
                                    <option value="" selected disabled> --حدد القسم--</option>
                                    @foreach ($departments as $department)
                                        <option value={{ $department->id }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">الراتب</label>
                                    <input type="number" class="form-control" id="section_name" value="{{old('salary')}}" name="salary">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">تاكيد</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/div-->
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

    <script>
        $('#edit_teacher').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var teacher_name = button.data('teachers_name')
            var teacher_email = button.data('teachers_email')
            var teacher_image = button.data('teachers_image')
            var teacher_gender = button.data('teachers_gender')
            var teacher_address = button.data('teachers_address')
            var teacher_phone = button.data('teachers_phone')
            var teacher_department_id = button.data('teachers_department_id')
            var teacher_salary = button.data('teachers_salary')
            var teacher_join_date = button.data('teachers_join_date')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #teachers_name').val(teacher_name);
            modal.find('.modal-body #teachers_email').val(teacher_email);
            modal.find('.modal-body #teachers_gender').val(teacher_gender);
            modal.find('.modal-body #teachers_address').val(teacher_address);
            modal.find('.modal-body #teachers_phone').val(teacher_phone);
            modal.find('.modal-body #teachers_department_id').val(teacher_department_id);
            modal.find('.modal-body #teachers_salary').val(teacher_salary);
            modal.find('.modal-body #teachers_join_date').val(teacher_join_date);
            // modal.find('.modal-body #teachers_image').val(teacher_image);
        })
    </script>







@endsection
