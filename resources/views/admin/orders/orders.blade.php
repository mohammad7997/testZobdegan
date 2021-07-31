<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</head>
<body>
@include('admin.layout.message')



<div class="accordion accordion-flush" id="accordionFlushExample">
    <h2 style="text-align: center">اطلاعات سفارش</h2>
    <div class="row" style="border: 1px solid #888f91">
        <div class="col-4 left" style="float: left">
            <img style="width: 70%;height: 100px"
                 src="{{ $ticket->image }}">
        </div>
        <div class="col-8 right" style="float: right">
            <h2> نام آگهی :{{ $ticket->title }} </h2>
            <div style="float: left;margin: 5px 10px">
                <span style="float: left ;margin: 0 5px "> ویزگی ها : </span>
                @foreach(unserialize($ticket->property) as $property)
                    {{ $property }},
                @endforeach
            </div>

            <div style="float: left;margin: 5px 10px">
                <span style="float: left ;margin: 0 5px "> توضیح : </span>
                {{ $ticket->description }}
            </div>

            <div style="float: left;margin: 5px 10px">
                <span style="float: left ;margin: 0 5px "> قیمت نقدی : </span>
                {{ $ticket->priceCash }}
            </div>

            <h4 style="float: left;width: 100%">شرایط اقساطی</h4>

            <div style="float: left;margin: 5px 10px">
                <span style="float: left ;margin: 0 5px "> قیمت اقساطی : </span>
                {{ $ticket->priceInstallment }}
            </div>

            <div style="float: left;margin: 5px 10px">
                <span style="float: left ;margin: 0 5px "> پیش پرداخت : </span>
                {{ $ticket->prepayment }}
            </div>

            <div style="float: left;margin: 5px 10px">
                <span style="float: left ;margin: 0 5px "> مدت زمان اقساط : </span>
                {{ $ticket->installmentTime }}
            </div>

            <div style="float: left;margin: 5px 10px">
                <span style="float: left ;margin: 0 5px "> تعداد اقساط : </span>
                {{ $ticket->installmentNum }}
            </div>
        </div>
    </div>
</div>


<div class="col-md-10 grid-margin stretch-card" style="margin: 40px auto;">
    <div class="card">
        <div class="card-body">
            <form class="forms-sample" method="post" action="{{ route('Order.store',$ticket->id) }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputUsername1">نوع پرداخت</label>
                    <select class="form-control" id="exampleSelectGender" name="payMethod">
                        <option value="0">اقساطی</option>
                        <option value="1">نقدی</option>
                    </select>
                </div>
                <br>
                <br>
                <br>
                <br>
                <h3>اطلاعات شخص دیگر برای سفارش (اختیاری)</h3>
                <div class="form-group">
                    <label for="exampleInputUsername1">نام</label>
                    <input type="text" class="form-control" id="exampleInputUsername1" name="name">
                </div>


                <div class="form-group">
                    <label for="exampleInputUsername1">نام خانوادگی</label>
                    <input type="text" class="form-control" id="exampleInputUsername1" name="family">
                </div>


                <div class="form-group">
                    <label for="exampleInputUsername1">کد ملی</label>
                    <input type="number" class="form-control" id="exampleInputUsername1" name="nationalId">
                </div>


                <div class="form-group">
                    <label for="exampleInputUsername1">شماره تلفن</label>
                    <input type="number" class="form-control" id="exampleInputUsername1" name="phone">
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">جنسیت</label>
                    <select class="form-control" id="exampleSelectGender" name="gender">
                        <option value="0">مرد</option>
                        <option value="1">زن</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="exampleInputUsername1">آدرس</label>
                    <textarea type="text" class="form-control" id="exampleInputUsername1" name="address"></textarea>
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">آدرس ایمل</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>



</body>
</html>
