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
                    جدول</span>
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
                            data-toggle="modal" href="#addsubject">اضافة</a>
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
                                    <th class="border-bottom-0">اسم الاستاذ</th>
                                    <th class="border-bottom-0">اسم الصف</th>
                                    <th class="border-bottom-0">اليوم</th>
                                    <th class="border-bottom-0">الزمن</th>
                                    {{-- <th class="border-bottom-0">العمليات</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($times as $time)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $time->subject->name }}</td>
                                        <td>{{ $time->teacher->full_name }}</td>
                                        <td>{{ $time->classRoom->name }}</td>
                                        <td>{{ $time->day }}</td>
                                        <td>{{ $time->time }}</td>
                                        {{-- <td>
                                            @if ($time->id > 0)
                                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                    data-id="{{ $time->id }}"
                                                    data-time_subject_name="{{ $time->subject->name }}"
                                                    data-time_teacher_name="{{ $time->teacher->full_name }}"
                                                    data-time_class_room_name="{{  $time->classRoom->name }}"
                                                    data-time_teacher_day="{{ $time->day}}"
                                                    data-time_teacher_time="{{ $time->time}}"
                                                     data-toggle="modal"
                                                    href="#editsubject" title="تعديل"><i class="las la-pen"></i></a>
                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-id="{{ $time->id }}" data-toggle="modal"
                                                    href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>
                                            @endif
                                        </td> --}}
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
                    <h6 class="modal-title">اضافة</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('time.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم المادة</label>
                            <select name="subject_name" id="subject_name" class="form-control" required>
                                <option value="" selected disabled> --حدد المادة--</option>
                                @foreach ($subjects as $subject)
                                    <option value={{ $subject->id }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم الاستاذ</label>
                            <select name="teacher_name" id="teacher_name" class="form-control" required>
                                <option value="" selected disabled> --حدد الاستاذ--</option>
                                @foreach ($teachers as $teacher)
                                    <option value={{ $teacher->id }}>{{ $teacher->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم الصف</label>
                            <select name="class_room_name" id="class_room_name" class="form-control" required>
                                <option value="" selected disabled> --حدد الصف--</option>
                                @foreach ($classRooms as $room)
                                    <option value={{ $room->id }}>{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">اليوم</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الزمن</label>
                            <input type="time" class="form-control" id="time" name="time">
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
                    <form action="{{ route('time.store') }}" method="post" autocomplete="off">
                        @csrf
                        @method('put')

                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم المادة</label>
                            <select name="subject_name" id="time_subject_name" class="form-control" required>
                                <option value="" selected disabled> --حدد المادة--</option>
                                @foreach ($subjects as $subject)
                                    <option value={{ $subject->id }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم الاستاذ</label>
                            <select name="teacher_name" id="time_teacher_name" class="form-control" required>
                                <option value="" selected disabled> --حدد الاستاذ--</option>
                                @foreach ($teachers as $teacher)
                                    <option value={{ $teacher->id }}>{{ $teacher->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم الصف</label>
                            <select name="class_room_name" id="time_class_room_name" class="form-control" required>
                                <option value="" id="time_class_room_name" selected disabled> --حدد الصف--</option>
                                @foreach ($classRooms as $room)
                                    <option value={{ $room->id }}>{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">اليوم</label>
                            <input type="date" class="form-control" id="time_teacher_day" name="date">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الزمن</label>
                            <input type="time" class="form-control" id="time_teacher_time" name="time">
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

        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('department.delete') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="section_name" id="section_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                </div>
                </form>
            </div>
        </div>

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
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
        })
    </script>
{{--
    <script>
        $('#editsubject').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var time_subject_name = button.data('time_subject_name')
            var time_teacher_name = button.data('time_teacher_name')
            var time_class_room_name = button.data('time_class_room_name')
            var time_teacher_day = button.data('time_teacher_day')
            var time_teacher_time = button.data('time_teacher_time')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #time_subject_name').val(time_subject_name);
            modal.find('.modal-body #time_teacher_name').val(time_teacher_name);
            modal.find('.modal-body #time_class_room_name').val(time_class_room_name);
            modal.find('.modal-body #time_teacher_day').val(time_teacher_day);
            modal.find('.modal-body #time_teacher_time').val(time_teacher_time);
        })
    </script> --}}







@endsection
