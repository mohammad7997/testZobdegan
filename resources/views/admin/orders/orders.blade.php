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


<div class="col-lg-9 grid-margin stretch-card" style="margin: 125px auto">
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
                        <th>نام کاربر</th>
                        <th>ایمیل کاربر</th>
                        <th>تاریخ پرداخت</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if($ordersCash!='')
                        @foreach($ordersCash as $orderCash)
                            @php $ticketInfo=unserialize($orderCash->ticketInfo) @endphp
                            <tr>
                                <td>{{ $ticketInfo->title }}</td>

                                <td>{{ $orderCash->user()->first()->name }}</td>

                                <td>{{ $orderCash->user()->first()->email }}</td>

                                <td>{{ $orderCash->totalAmount }}</td>

                                <td>{{ $orderCash->created_at }}</td>
                            </tr>
                        @endforeach
                    @endif
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
                        <th>نام کاربر</th>
                        <th>ایمیل کاربر</th>
                        <th>قیمت کل کالا</th>
                        <th>مبلغ هر قسط</th>
                        <th>تعداد اقساط باقی مانده</th>
                        <th>تاریخ قسط بعدی</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if($installments!='')
                        @foreach($installments as $installment)

                            @php $ticketInfo=unserialize($installment->ticketInfo) @endphp
                            <tr>
                                <td>{{ $ticketInfo->title }}</td>

                                <td>{{ $installment->user()->first()->name }}</td>

                                <td>{{ $installment->user()->first()->email }}</td>

                                <td>{{ $installment->totalAmount }}</td>

                                <td>{{ $installment->installmentPay }}</td>

                                <td>{{ $installment->installmentNum }}</td>

                                <td>{{ $installment->timeOfInstallment }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


</body>
</html>
