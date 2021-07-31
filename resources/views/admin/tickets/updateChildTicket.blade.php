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
                <h4 class="card-title"> ایجاد آگهی زیر مجموعه ({{ $ticket->title }}) </h4>
                <p class="card-description">
                    Basic form elements
                </p>


                @include('admin.layout.message')

                <form class="forms-sample" action="{{ route('Admin.update',$ticket->id) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">نام آگهی</label>
                        <input type="text" class="form-control" name="title" placeholder="title"
                               value="{{ $ticket->title }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">ویژگی های آگهی</label>
                        <input id="propertyInfo" type="text" class="form-control" placeholder="property">
                        <span class="btn btn-primary" onclick="addProperty(this)">افزودن</span>
                    </div>

                    <div class="form-group" id="property" style="float: left;width: 100%">
                        <label for="exampleInputName1" style="width: 100%">ویژگی های آگهی</label>
                        @if($ticket->property!='' && $ticket->property!='N;')
                            @foreach(unserialize($ticket->property) as $property)
                                <div class="propertyOwn"><i onclick="deleteProperty(this)"
                                                            class="mdi mdi-delete "></i><span> {{ $property }} </span><input
                                        type="hidden" class="form-control" name="property[]"
                                        value="{{ $property }}">
                                </div>
                            @endforeach
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="exampleSelectGender"> آگهی تفکیک(آگهی والد) </label>
                        <select class="form-control" id="exampleSelectGender" name="parent"
                                onchange="displayForPrice(this)">
                            @foreach($parentsTicketInfo as $parentTicket)
                                <option value="{{ $parentTicket->id }}"
                                        @if($ticket->id = $parentTicket->id) selected="selected" @endif>
                                    {{ $parentTicket->title }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="type" value="0">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">توضیح آگهی</label>
                        <textarea type="text" class="form-control"
                                  name="description">{{ $ticket->description }}</textarea>
                    </div>


                    <div id="price" style="display: block">  {{--display for price--}}
                        <div class="form-group">
                            <label for="exampleInputName1">توضیح بالای فاکتور آگهی</label>
                            <textarea type="text" class="form-control" name="descriptionTopFactor" placeholder="">{{ $ticket->descriptionTopFactor }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName1">توضیح پایین فاکتور آگهی</label>
                            <textarea type="text" class="form-control" name="descriptionBottomFactor" placeholder="">{{ $ticket->descriptionBottomFactor }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword4">قیمت نقدی</label>
                            <input type="text" class="form-control" id="exampleInputPassword4" name="priceCash"
                                   value="{{ $ticket->priceCash }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">قیمت کل روش اقساطی</label>
                            <input type="text" class="form-control" id="exampleInputPassword4" name="priceInstallment"
                                   value="{{ $ticket->priceInstallment }}">
                        </div>

                        <div>
                            <h3 for="exampleInputPassword4">شرایط اقساط</h3>
                            <div class="form-group col-2">
                                <label for="exampleInputPassword4">مبلغ پیش قسط </label>
                                <input type="text" class="form-control" name="prepayment"
                                       value="{{ $InstallmentFeature->prepayment }}">
                            </div>

                            <div class="form-group col-2 ">
                                <label for="exampleInputPassword4"> مدت قسط </label>
                                <select class="form-control" id="exampleSelectGender" name="installmentTime"
                                        onchange="displayForPrice(this)">
                                    <option>انتخاب کنید</option>
                                    @for($i=2;$i <= 48;$i=$i+2)

                                        <option
                                            value="{{ $i }}"
                                            @if($i==$InstallmentFeature->installmentTime) selected @endif >{{ $i }}
                                            ماه
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="exampleInputPassword4"> تعداد قسط </label>
                                <input type="text" class="form-control" name="installmentNum"
                                       value="{{ $InstallmentFeature->installmentNum }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="display: block">آپلود عکس</label>
                        <input type="file" name="image">
                    </div>

                    <div class="form-group">
                        <img src="{{ asset($ticket->image) }}">
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>

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
