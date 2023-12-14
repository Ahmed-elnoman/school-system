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
    الطلاب
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الطلاب</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة طالب</span>
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
                    <form action="{{ route('student.store') }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">اسم التلميذ</label>
                                    <input type="text" class="form-control" id="student_name" name="name" value="{{old('name')}}" />
                                </div>
                            </div>

                            <div class="col-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">اسم ولي الامر</label>
                                    <input type="text" class="form-control" id="parent_name" name="parent_name" value="{{old('parent_name')}}" />
                                </div>
                            </div>

                            <div class="col-3">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الجنس</label>
                                <select name="gender" id="gander" class="form-control" required>
                                    <option value="" selected disabled> --حدد الجنس--</option>
                                    <option value="ذكر">ذكر</option>
                                    <option value="انثي">انثي</option>
                                </select>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mt-1">
                                    <label for="exampleInputEmail1">العنوان التلميذ</label>
                                    <input type="test" class="form-control" id="section_name" name="address" value="{{old('address')}}" />
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">رقم هاتف ولي الامر</label>
                                    <input type="number" class="form-control" id="phone_parent" name="phone_parent" value="{{old('phone_parent')}}" />
                                    <p class="text-danger" id="length"></p>
                                </div>
                            </div>
                            <p class="text-info mr-3 mt-3">الحالة الصحية لتلميذ</p>
                            <div class="col-2 col-sm-2 col-md-2 mb-2 mt-3">
                                <div class="form-group">
                                    <input type="checkbox" name="good" value="سليم" class="from-control"
                                        id="">
                                    <label for="exampleInputEmail1">سليم</label>
                                </div>
                            </div>
                            <div class="col-7 col-sm-7 col-md-7 mb-2 mt-3">
                                <div class="form-group">
                                    <input type="checkbox" class="from-control" aria-controls="collapseOne2"
                                        aria-expanded="true" data-toggle="collapse" href="#collapseOne2" class="collapsed">
                                    <label for="exampleInputEmail1">صاحب مرض</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div aria-multiselectable="false" class="accordion accordion-dark" id="accordion2"
                                    role="tablist">
                                    <div class="card mb-0">
                                        <div aria-labelledby="headingOne2" class="collapse" data-parent="#accordion2"
                                            id="collapseOne2" role="tabpanel">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">اسم المرض</label>
                                                    <input type="test" class="form-control" id="section_name"
                                                        name="medical_situation">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 mb-3">
                                                <label for="exampleInputEmail1">الملف الطبي</label>
                                                <input type="file" name="medical_situation_file"
                                                    id="medical_situation_file" class="dropify"
                                                    accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                            </div><br>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        {{-- 3 --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">البريد الالكتروني ولي الامر</label>
                                    <input type="email" class="form-control" id="student_email" name="parent_email" value="{{old('parent_email')}}" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mt-1">
                                    <label for="exampleInputEmail1">العنوان ولي الامر</label>
                                    <input type="test" class="form-control" id="parent_address"
                                        name="parent_address" value="{{old('parent_address')}}" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">وظيفة ولي الامر</label>
                                    <input type="test" class="form-control" id="parent_job" name="parent_job" value="{{old('parent_job')}}" />
                                </div>
                            </div>
                        </div>
                        {{-- 4 --}}
                        <div class="row mb-2 mb-3">
                            <div class="col-6">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اسم الصف</label>
                                <select name="class_room" id="class_room" class="form-control" required>
                                    <option value="" selected disabled> --حدد الصف--</option>
                                    @foreach ($classRoom as $room)
                                        <option value={{ $room->id }}>{{ $room->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الرسوم</label>
                                <select name="charge_for" id="charge_for" @readonly(true) class="form-control"
                                    required>

                                </select>
                            </div>

                            <div class="col-6">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الدفعة الاولي</label>
                                <select name="first_payment" id="first_payment" class="form-control" @readonly(true)
                                    required>

                                </select>
                            </div>

                            <div class="col-6">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الدفعة الثانية</label>
                                <select name="second_payment" id="second_payment" @readonly(true) class="form-control"
                                    required>

                                </select>
                            </div>
                        </div>
                        <p class="text-warning m-2">* اذا كان يوجد حالة استثناء</p>
                        <div class="row mb-2 mb-3">
                            <div class="col-6">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">نوع الاستثناء</label>
                                <select name="an_exception" id="an_exception" class="form-control">
                                    <option value="0" selected disabled> --حدد الاستثناء--</option>
                                    @foreach ($an_exceptions as $an)
                                        <option value={{ $an->id }}>{{ $an->type }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-6">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">نسية الخصمة</label>
                                <select name="discount_rate" id="discount_rate_id" class="form-control"
                                    @readonly(true)>

                                </select>
                            </div>
                            <div class="col-6">
                                <tr>
                                    <td class="tx-right tx-uppercase tx-bold tx-inverse">ما تم خصمه</td>
                                    <td class="tx-right" colspan="2">
                                        <h4 class="tx-primary tx-bold" id="result"></h4>
                                    </td>
                                </tr>
                            </div>
                            <div class="col-6">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الرسوم النهاية</label>
                                <input type="number" name="total_fees" class="form-control" id="total" value="{{old('total_fees')}}" />
                            </div>
                            <div class="col-6">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">حالة الدفعة</label>
                                <input type="text" name="payment_status" class="form-control" readonly
                                    id="statusOfPsyment">
                            </div>
                            <div class="col-6">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">المتبقي</label>
                                <input type="text" name="residual" style="color:red" readonly class="form-control"
                                    id="residual">
                            </div>
                            <div class="col-12 m-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">السبب <span class="text-danger tx-sm">اذا كان
                                            الدفع
                                            غير مكتمل</span></label>
                                    <textarea class="form-control" id="section_name" name="description" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>


                    </form>
                </div>
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
            if(this.value.length != 10) {
                document.getElementById('length').innerText = 'الرقم ناقص يجب ان يكون 10 ارقام'
            }else{
                document.getElementById('length').innerText = '  '
            }
        })

    </script>


@endsection
