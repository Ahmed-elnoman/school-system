@extends('layouts.master')
@section('title')
    التقارير
@stop
@section('css')
    <!-- Internal Nice-select css  -->
    <link href="{{ URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    نشاطات</span>
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
    <div class="row row-sm">
        <div class="col-xl-9 col-lg-9 col-md-12">
            <div class="main-content-label mg-b-5 mb-3">
                <a data-effect="effect-scale" data-toggle="modal" href="#addaccount"
                    class="modal-effect btn btn-sm btn-primary" style="color:white"><i class="fas fa-plus"></i>&nbsp;
                    اضافة نشاط</a>
            </div>
        </div>
        <div class="row row-sm">
            @foreach ($activites as $activity)
                <div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="pro-img-box">
                                <div class="d-flex product-sale">
                                </div>
                                <img class="w-100" src="{{ $activity->file }}" alt="product-image">
                                <a data-toggle="modal" href="#delete" data-activity_id="{{ $activity->id }}"
                                    class="adtocart"><i class="las la-trash"></i></a>

                            </div>
                            <div class="text-center pt-3">
                                <h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase"> {{ $activity->name }}</h3>
                                <p> {{ $activity->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    {{-- start add modal  --}}
    <div class="modal" id="addaccount">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة نشاط</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('activity.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم نشاط</label>
                            <input type="text" class="form-control" id="activity_name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الوصف</label>
                            <textarea name="description" class="form-control" style="height:130px" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <p class="text-warning">ختيار *</p>
                            <div class="form-group">
                                <label for="exampleInputEmail1">صورة</label>
                                <input type="file" name="file" class="dropify"
                                    accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                            </div>
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

    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف نشاط</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('activity.delete') }}" method="post">
                        @method('DELETE')
                        @csrf
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="hidden" name="id" id="activity_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Nice-select js-->
    <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js') }}"></script>
    <script>
        $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var activity_id = button.data('activity_id')
            var modal = $(this)
            modal.find('.modal-body #activity_id').val(activity_id);
        })
    </script>
@endsection
