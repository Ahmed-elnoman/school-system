@extends('layouts.master')
@section('title')
    التقارير
@stop
@section('css')
    <!--Internal  Nice-select css  -->
    <link href="{{ URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
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

    <!-- row opened -->
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Shopping Cart-->
                    <form action="{{ route('result.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="product-details table-responsive text-nowrap">
                            <table class="table table-bordered table-hover mb-0 text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">اسم التلميذ</th>
                                        @foreach ($subject_names as $name)
                                            <th class="border-bottom-0">{{ $name->name }}</th>
                                        @endforeach
                                        <th class="border-bottom-0">الدرجة النهاية</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>
                                                <input type="text" name="student_name" class="form-control"
                                                    style="width:200px" readonly
                                                    value="{{ $student->name }} {{ $student->parent->name }}">
                                            </td>
                                            @foreach ($subject_names as $name)
                                                <td><input type="number" name="mark" class="form-control"
                                                        style="border: none; border-bottom: 1px solid red">
                                                </td>
                                            @endforeach
                                            <td><input type="number" class="form-control" name="" readonly></td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="shopping-cart-footer">
                            <div class="column"><button type="submit" class="btn btn-success" href="">اضافة</button>
                            </div>
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
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!-- Internal Nice-select js-->
    <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js') }}"></script>


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
