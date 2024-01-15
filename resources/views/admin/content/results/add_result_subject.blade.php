@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
    <link href="{{ URL::asset('assets/plugins/accordion/accordion.css') }}" rel="stylesheet" />
@endsection
@section('title')
    النتائج
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">

                <h4 class="content-title mb-0 my-auto"><a href="{{ route('result.index') }}" class="text-dark">النتائج</a>
                </h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة نتيجة مادة</span>
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

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('result.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">نوع النتيجة</label>
                                    <input type="text" class="form-control" id="type_result" name="type_result"
                                        value="{{ old('type_result') }}" />
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">السنة الدراسية</label>
                                    <input type="date" class="form-control" id="year" name="year"
                                        value="{{ old('year') }}" />
                                </div>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم الطالب</label>
                                    <select name="student_id" id="student" class="form-control" required>
                                        <option value="" selected disabled> --حدد الطالب--</option>
                                        @foreach ($students as $student)
                                            <option value={{ $student->id }}>{{ $student->name }}
                                                {{ $student->parent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-4" hidden>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">المادة</label>
                                    <input type="text" readonly class="form-control" id="parent_name"
                                        placeholder="{{ $name_subject->name }}" value="{{ $name_subject->id }}"
                                        name=exam_id value="{{ old('parent_name') }}" />
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">الدرجة</label>
                                    <input type="number" class="form-control" id="mark" name="marks"
                                        value="{{ old('mark') }}" />
                                    <p class="text-danger" id="length"></p>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">اضافة البيانات</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--- Internal Accordion Js -->
    <script src="{{ URL::asset('assets/plugins/accordion/accordion.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/accordion.js') }}"></script>



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
                        const i = value.total_fees;
                        console.log(i)
                        $('#charge_for').append('<option id="fees" value="' + value.id + '">' +
                            value
                            .total_fees + '</option>');
                    });
                    $.each(res.charge, function(key, value) {
                        $('#first_payment').append('<option id="firstPayment" value="' + value
                            .id + '">' + value
                            .first_payment + '</option>');
                    });
                    $.each(res.charge, function(key, value) {
                        $('#second_payment').append('<option value="' + value.id + '">' + value
                            .second_payment + '</option>');
                    });
                }
            });
        });
        $('#an_exception').on('change', function() {
            var idState = this.value;
            $('#discount_rate_id').html('');
            $.ajax({
                url: 'an_exception/get_an_exception/' + idState,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $.each(res.charge, function(key, value) {
                        const j = value.discount_rate
                        console.log(j)
                        $('#discount_rate_id').append('<option id="class" value="' + value.id +
                            '">' +
                            value
                            .discount_rate + '</option>');
                    });
                }
            });
        });

        $('#total').on('focus', function() {
            const total_fees = document.getElementById('fees');
            var discount = document.getElementById('class');
            if (discount != null) {
                const result = total_fees.text * discount.text / 100;
                document.getElementById('result').innerText = result;
            }
        });
        $('#total').on('change', function() {
            const thisValue = this.value;
            var discount = document.getElementById('class');
            const result = document.getElementById('result');
            var residual = document.getElementById('residual');
            const firstPayment = document.getElementById('firstPayment');
            var statusOfPsyment = document.getElementById('statusOfPsyment');
            var fees = document.getElementById('fees');

            const total_fees = fees.text - result.innerText;
            if (discount != null) {
                statusOfPsyment.value = 'تم دفعة ' + thisValue + 'من اجمالي الرسوم';
                residual.value = total_fees - thisValue;
            } else {
                statusOfPsyment.value = 'تم دفعة ' + thisValue + 'من اجمالي الرسوم';
                residual.value = firstPayment.text - thisValue;
            }
        });

        $('#phone_parent').on('change', function() {
            if (this.value.length != 10) {
                document.getElementById('length').innerText = 'الرقم ناقص يجب ان يكون 10 ارقام'
            } else {
                document.getElementById('length').innerText = '  '
            }
        })
    </script>


@endsection
