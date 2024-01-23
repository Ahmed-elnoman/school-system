<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card-header pb-3">
            <p class="text-warning">عرض النتيجة</p>
            <div class="row">
                <div class="col-2 col-sm-2 col-md-2 mb-2 mt-3">
                    <div class="form-group">
                        <!-- student collapse  !-->
                        <label class="ckbox"><input type="checkbox" aria-expanded="true" data-toggle="collapse"
                                href="#multiCollapseExample1"><span>طالب معين</span>
                        </label>
                    </div>
                </div>
                <div class="col-2 col-sm-2 col-md-2 mb-2 mt-3">
                    <div class="form-group">
                        <!-- all class collapse  !-->
                        <label class="ckbox"><input type="checkbox" aria-expanded="true" data-toggle="collapse"
                                href="#collapseOne2"><span>الفصل كامل</span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- start student collapse  !-->
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <form class="coupon-form" action="{{ route('result.student.result') }}" method="GET">
                    <select name="student_id" class="form-control" required>
                        <option value="" selected disabled> --اختار اسم الطالب--</option>
                        @foreach ($students as $student)
                            <option value={{ $student->id }}>{{ $student->name }} {{ $student->parent->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-primary" style="padding: 13px" type="submit"><i
                            class="fas fa-search d-none d-md-block"></i></button>
                </form>
            </div>
            <!-- end student collapse  !-->
            <!-- start all class collapse  !-->
            <div aria-multiselectable="false" class="accordion accordion-dark" id="accordion2" role="tablist">
                <div class="card mb-0">
                    <div aria-labelledby="headingOne2" class="collapse" data-parent="#accordion2" id="collapseOne2"
                        role="tabpanel">
                        <form class="coupon-form" action="{{ route('result.showAllResult') }}" method="GET">
                            <select name="type_result" class="form-control" required>
                                <option value="" selected disabled> --حدد نوع النتيجة--</option>
                                <option value="نتيجة شهرية"> نتيجة شهرية</option>
                                <option value="نتيجة الفصل الاول"> نتيجة الفصل الاول</option>
                                <option value="نتيجة النهاية"> نتيجة النهاية</option>
                            </select>
                            <select name="year" class="form-control" required>
                                <option value="" selected disabled> --حدد السنة الدراسية--</option>
                                <option value="2024-01-01"> 2018</option>
                                <option value="2024-02-01"> 2019</option>
                                <option value="2024-01-25"> 2020</option>
                            </select>
                            <button class="btn btn-outline-primary" style="padding: 12px" type="submit"><i
                                    class="fas fa-search d-none d-md-block"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end all class collapse  !-->

        </div>
    </div>
    <!--/div-->
</div>
