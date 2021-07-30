<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
</head>
<body>

{{ dd($order) }}
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
</body>
</html>
