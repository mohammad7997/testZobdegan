@extends('admin.index')
@section('content')

    <style>
        .propertyOwn {
            border: 1px solid #736e77;
            border-radius: 8px;
            width: 6%;
            height: 40px;
            line-height: 30px;
            float: left;
            margin-left: 8px
        }

        .propertyOwn i {
            cursor: pointer;
        }
    </style>
    @include('admin.layout.message')
    <div class="col-9 grid-margin stretch-card" style="margin: 70px auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ثبت آگهی مشاع و تفکیکی</h4>
                <p class="card-description">
                    Basic form elements
                </p>


               @include('admin.layout.message')

                <form class="forms-sample" action="{{ route('Admin.store') }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">نام آگهی</label>
                        <input type="text" class="form-control" name="title" placeholder="title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">ویژگی های آگهی</label>
                        <input id="propertyInfo" type="text" class="form-control" placeholder="property">
                        <span class="btn btn-primary" onclick="addProperty(this)">افزودن</span>
                    </div>

                    <div class="form-group" id="property" style="float: left;width: 100%">
                        <label for="exampleInputName1" style="width: 100%">ویژگی های آگهی</label>
                    </div>


                    <div class="form-group">
                        <label for="exampleSelectGender">نوع آگهی</label>
                        <select class="form-control" id="exampleSelectGender" name="type"
                                onchange="displayForPrice(this)">
                            <option value="1">انتخاب کنید</option>
                            <option value="0">مشاع</option>
                            <option value="1"> تفکیکی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">توضیح آگهی</label>
                        <textarea type="text" class="form-control" name="description"></textarea>
                    </div>


                    <div id="price" style="display: none">  {{--display for price--}}

                        <div class="form-group">
                            <label for="exampleInputPassword4">قیمت نقدی</label>
                            <input type="text" class="form-control" id="exampleInputPassword4" name="priceCash">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">قیمت کل روش اقساطی</label>
                            <input type="text" class="form-control" id="exampleInputPassword4" name="priceInstallment">
                        </div>

                        <div>
                            <h3 for="exampleInputPassword4">شرایط اقساط</h3>
                            <div class="form-group col-2">
                                <label for="exampleInputPassword4">مبلغ پیش قسط </label>
                                <input type="text" class="form-control" name="prepayment">
                            </div>

                            <div class="form-group col-2 ">
                                <label for="exampleInputPassword4"> مدت قسط </label>
                                <select class="form-control" id="exampleSelectGender" name="installmentTime"
                                        onchange="displayForPrice(this)">
                                    <option>انتخاب کنید</option>
                                    @for($i=2;$i <= 48;$i=$i+2)

                                        <option value="{{ $i }}">{{ $i }} ماه</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="exampleInputPassword4"> تعداد قسط </label>
                                <input type="text" class="form-control" name="installmentNum">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="display: block">آپلود عکس</label>
                        <input type="file" name="image">
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function displayForPrice(x) {

            //val=0 => مشاع
            //val=1 => تفکیکی
            let tag = $(x).val();
            if (tag == 0) {
                $('#price').css('display', 'block')
            }
            if (tag == 1) {
                $('#price').css('display', 'none')
            }
        }

        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            language: 'fa'
        });

        function addProperty(x) {
            let property = $(x).parent('div').find('input').val();
            if (property != '' && property != undefined) {
                let tag = '<div class="propertyOwn"><i onclick="deleteProperty(this)" class="mdi mdi-delete "></i><span> ' + property + ' </span><input type="hidden" class="form-control" name="property[]" value="' + property + '"></div>';
                $('#property').append(tag);
            }
        }

        function deleteProperty(x) {
            $(x).parent('div').remove();
        }

    </script>
@endsection
