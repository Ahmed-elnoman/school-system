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
                    النتايخ </span>
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
                <div class="card-header pb-0 mb-3">
                    <p class="text-warning">اختار المادة</p>
                    @foreach ($exams as $exam)
                        <a data-effect="effect-scale" href="{{ route('result.addResultSubject', $exam->id) }}"
                            class="modal-effect btn btn-sm btn-primary mb-3" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp;
                            {{ $exam->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <a data-effect="effect-scale" data-toggle="modal" href="#addsubject"
                        class="modal-effect btn btn-sm btn-primary" style="color:white"><i class="fas fa-plus"></i>&nbsp;
                        اضافة </a>
                    <a data-effect="effect-scale" href="" class="modal-effect btn btn-sm btn-danger"
                        style="color:white"><i class="mdi mdi-printer ml-1"></i>&nbsp;
                        طباعة الجدول </a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم المادة</th>
                                    <th class="border-bottom-0">اسم الاستاذ</th>
                                    <th class="border-bottom-0">اليوم</th>
                                    <th class="border-bottom-0">الزمن</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($results as $time)
                                    <?php $i++; ?>
                                    <tr>
                                        {{-- <td>{{ $i }}</td>
                                        <td>{{ $time->subject->name }}</td>
                                        <td>{{ $time->teacher->full_name }}</td>
                                        <td>{{ $time->classRoom->name }}</td>
                                        <td>{{ $time->day }}</td>
                                        <td>{{ $time->time }}</td> --}}
                                        <td>
                                            {{-- @if ($time->id > 0)
                                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                    data-id="{{ $time->id }}"
                                                    data-time_subject_name="{{ $time->subject->name }}"
                                                    data-time_teacher_name="{{ $time->teacher->full_name }}"
                                                    data-time_class_room_name="{{ $time->classRoom->name }}"
                                                    data-time_teacher_day="{{ $time->day }}"
                                                    data-time_teacher_time="{{ $time->time }}" data-toggle="modal"
                                                    href="#editsubject" title="تعديل"><i class="las la-pen"></i></a>
                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-id="{{ $time->id }}" data-toggle="modal" href="#modaldemo9"
                                                    title="حذف"><i class="las la-trash"></i></a>
                                            @endif --}}
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
    <div class="modal" id="addResult">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة نتيجة</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('result.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">نوع النتيجة </label>
                            <input type="test" class="form-control" id="type_result" name="type_result">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">السنة الدراسية </label>
                            <input type="date" class="form-control" id="year" name="year">
                        </div>

                        <div class="form-group" hidden>
                            <label for="exampleInputEmail1">اسم المادة </label>
                            <input type="test" readonly class="form-control" id="exam_id"
                                value="{{ $exam->name }}" name="year">
                        </div>
                        <hr class="m-3">
                        @foreach ($students as $student)
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">اسم الطالب</label>
                                        <input type="test" class="form-control"
                                            value="{{ $student->name }} {{ $student->parent->name }}" id="student_name"
                                            name="{{ $student->id }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">درجة مادة</label>
                                        <input type="number" class="form-control" id="marks" name="mark">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <hr class="m-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">المعدل التراكمي</label>
                            <input type="test" class="form-control" id="GAP" name="gap">
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
        $('#addResult').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var exam_id = button.data('exam_id')
            var modal = $(this)
            modal.find('.modal-body #exam_id').val(exam_id);
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
