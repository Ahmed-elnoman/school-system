@extends('layouts.master')
@section('title')
    التقارير
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
                <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الامتحانات</span>
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



    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#addsubject">اضافة امتحان</a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم المادة</th>
                                    <th class="border-bottom-0">اسم الصف</th>
                                    <th class="border-bottom-0">التاريخ الامتحان</th>
                                    <th class="border-bottom-0">زمن الامتحان</th>
                                    {{-- <th class="border-bottom-0">العمليات</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($exams as $subject)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->subject->name }}</td>
                                        <td>{{ $subject->date }}</td>
                                        <td>{{ $subject->time }}</td>
                                        {{-- <td> --}}
                                        {{-- @if ($subject->id > 0) --}}
                                        {{-- <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                    data-id="{{ $subject->id }}" data-subject_name="{{ $subject->name }}"
                                                    data-subject_grade="{{ $subject->grade }}" data-toggle="modal"
                                                    href="#editsubject" title="تعديل"><i class="las la-pen"></i></a> --}}
                                        {{-- <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-id="{{ $subject->id }}"
                                                    data-section_name="{{ $subject->section_name }}" data-toggle="modal"
                                                    href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a> --}}
                                        {{-- @endif --}}
                                        {{-- </td> --}}
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
    <div class="modal" id="addsubject">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة امتحان</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('exam.store') }}" method="post" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المادة</label>
                            <select name="subject" id="subject" class="form-control" required>
                                <option value="" selected disabled> --حدد المادة--</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم الصف</label>
                            <select name="class_name" id="class_name" class="form-control" required>
                                <option value="" selected disabled> --حدد الصف--</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">تاريخ الامتحان</label>
                            <input type="date" class="form-control" id="subject_date" name="exam_date">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">زمن الامتحان</label>
                            <input type="time" class="form-control" id="subject_date" name="exam_time">
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
    <div class="modal" id="editsubject">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل المادة</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subject.update') }}" method="post" autocomplete="off">
                        @csrf
                        @method('put')

                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المادة</label>
                            <input type="text" class="form-control" id="subject_name" name="subject_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">المستوي</label>
                            <input type="text" readonly class="form-control" id="subject_grade" name="subject_grade">
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

    {{-- end edit modal --}}

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
        $('#editsubject').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var subject_name = button.data('subject_name')
            var subject_grade = button.data('subject_grade')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #subject_name').val(subject_name);
            modal.find('.modal-body #subject_grade').val(subject_grade);
        })
    </script>







@endsection
