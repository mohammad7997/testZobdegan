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
<div class="container">
    <div class="row col-6" style="margin: 60px auto">
        <style>

            @font-face {
                font-family: 'BMitra';
                src: url({{ asset('fonts/font-web-optimized-ronakweb/BMitra.ttf') }}) format("truetype"),
                 url({{ asset('fonts/font-web-optimized-ronakweb/BMitra.eot') }}) format("embedded-opentype")

            }

            *{
                font-family: BMitra;
            }

            tr {
                border: 1px solid #000;
                text-align: center;
            }
            td{
                text-align: center;
            }
            td span{
                margin: 2px 6px;
                float: right;
                text-align: center;
                direction: rtl;
            }
        </style>
        <table class="table ">
            <tbody>
            <tr>
                <td>
                    {{ $ticketInfo->descriptionTopFactor }}
                </td>
            </tr>
            <tr>

                <td>

                    <span> نام : {{ $userInfo->name }} </span>
                    <span> نامخانوادگی : {{ $userInfo->family }} </span>
                    <span> کد ملی : {{ $userInfo->nationalId }} </span>
                    <span> شماره تلفن : {{ $userInfo->phone }} </span>
                    <span> آدرس : {{ $userInfo->address }} </span>
                    <span> ایمیل : {{ $userInfo->email }} </span>

                </td>
            </tr>
            <tr>

                <td>
                    <span> نام کالا : {{ $ticketInfo->title }} </span>
                    <span> قیمت کل : {{ $order->totalAmount }} </span>
                    <span> مبلغ پرداختی : {{ $pay }} </span>
                    <span> نوع خرید : {{ $payMethod }} </span>
                </td>
            </tr>
            <tr>
                <td>
                    {{ $ticketInfo->descriptionBottomFactor }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <a class="btn btn-success" href="{{ route('Order.Pdf',$order->id) }}"> PDF </a>
</div>
</body>
</html>
