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
@include('admin.layout.message')

<div class="col-lg-6 grid-margin stretch-card" style="margin: 125px auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">سفارشات پرداخت شده</h4>
            <p class="card-description">
                Add class <code>.table</code>
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>نام کالا</th>
                        <th>قیمت کالا</th>
                        <th>تاریخ پرداخت</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($ordersCash as $orderCash)
                        @php $ticketInfo=unserialize($orderCash->ticketInfo) @endphp
                        <tr>
                            <td>{{ $ticketInfo->title }}</td>

                            <td>{{ $orderCash->totalAmount }}</td>

                            <td>{{ $orderCash->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


<div class="col-lg-11 grid-margin stretch-card" style="margin: 125px auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">سفارشات اقساطی</h4>
            <p class="card-description">
                Add class <code>.table</code>
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>نام کالا</th>
                        <th>قیمت کل کالا</th>
                        <th>مبلغ هر قسط</th>
                        <th>تعداد اقساط باقی مانده</th>
                        <th>تاریخ قسط بعدی</th>
                        <th>درگاه درین پال</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($installments as $installment)

                        @php $ticketInfo=unserialize($installment->ticketInfo) @endphp
                        <tr>
                            <td>{{ $ticketInfo->title }}</td>

                            <td>{{ $installment->totalAmount }}</td>

                            <td>{{ $installment->installmentPay }}</td>

                            <td>{{ $installment->installmentNum }}</td>

                            <td>{{ $installment->timeOfInstallment }}</td>

                            <td>
                                <a class="btn btn-success"
                                   href="/panel/pay/{{$installment->idInstallment}}">
                                    پرداخت
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</body>
</html>
