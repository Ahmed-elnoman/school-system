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
                    <a data-effect="effect-scale" data-toggle="modal" href="#addResult"
                        class="modal-effect btn btn-sm btn-primary" style="color:white"><i class="fas fa-plus"></i>&nbsp;
                        اضافة نتيجة</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap"
                            data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم التلميذ</th>
                                    <th class="border-bottom-0">اسم المادة</th>
                                    <th class="border-bottom-0">تاريخ الامتحان</th>
                                    <th class="border-bottom-0">المستوي</th>
                                    <th class="border-bottom-0">اسم الصف</th>
                                    <th class="border-bottom-0">الدرجة النهاية</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($results as $result)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $result->student->full_name}} </td>
                                        <td>{{ $result->subject->name }}</td>
                                        <td>{{ $result->exam->date }}</td>
                                        <td>{{ $result->student->classRoom->level }}</td>
                                        <td>{{ $result->student->classRoom->name }}</td>
                                        <td>{{ $result->marks }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item" data-effect="effect-scale"
                                                        data-id="{{ $result->id }}"
                                                        data-result_student_name="{{ $result->student->full_name }}"
                                                        data-result_subject_name="{{ $result->subject->name }}"
                                                        data-result_exam_date="{{ $result->exam->date }}"
                                                        data-result_marks="{{ $result->marks }}"
                                                        data-result_student_class_level="{{ $result->student->classRoom->level }}"
                                                        data-result_student_class_name="{{ $result->student->classRoom->name }}"
                                                        data-toggle="modal" href="#editresult"><i
                                                            class="text-info fas fa-edit"></i>&nbsp;&nbsp;تعديل
                                                        النتيجة </a>
                                                    <a class="dropdown-item" href="#problme"
                                                        data-result_id="{{ $result->id }}" data-toggle="modal"
                                                        data-target="#problme"><i
                                                            class="text-danger fas fa-trash"></i>&nbsp;&nbsp;حذف
                                                        النتيجة</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('result.print', $result->student_id) }}"><i
                                                            class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                        النتيجة
                                                    </a>
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
    <div class="modal" id="addResult">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة نتيجة</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('result.store') }}" method="post" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم التلميذ</label>
                            <select name="student" id="student" class="form-control" required>
                                <option value="" selected disabled> --حدد التلميذ--</option>
                                @foreach ($students as $student)
                                    <option value={{ $student->id }}>{{ $student->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم المادة</label>
                            <select name="subject" id="subject" class="form-control" required>
                                <option value="" selected disabled> --حدد المادة--</option>
                                @foreach ($subjects as $subject)
                                    <option value={{ $subject->id }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">تاريخ الجلوس للامتحان</label>
                            <select name="exam" id="exam" class="form-control" required>
                                <option value="" selected disabled> --حدد تاريخ --</option>
                                @foreach ($exams as $exam)
                                    <option value={{ $exam->id }}>{{ $exam->date }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الدرجة النهاية</label>
                            <input type="test" class="form-control" id="section_name" name="marks">
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
    <div class="modal" id="editresult">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل النتيجة</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('result.update') }}" method="post" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="id" value="">
                        {{-- <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم التلميذ</label>
                            <input type="test" class="form-control" id="result_student_name" readonly
                                name="result_student_name">
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم المادة</label>
                            <input type="test" class="form-control" id="result_subject_name" readonly
                                name="result_subject_name">
                        </div>

                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">تاريخ الجلوس للامتحان</label>
                            <input type="test" class="form-control" id="result_exam_date" readonly
                                name="result_exam_date">
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">الدرجة النهاية</label>
                            <input type="test" class="form-control" id="result_marks" name="result_marks">
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
        $('#editresult').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            // var result_student_name = button.data('result_student_name')
            // var result_subject_name = button.data('result_subject_name')
            // var result_exam_date = button.data('result_exam_date')
            var result_marks = button.data('result_marks')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            // modal.find('.modal-body #result_student_name').val(result_student_name);
            // modal.find('.modal-body #result_subject_name').val(result_subject_name);
            // modal.find('.modal-body #result_exam_date').val(result_exam_date);
            modal.find('.modal-body #result_marks').val(result_marks);
        })
    </script>







@endsection
