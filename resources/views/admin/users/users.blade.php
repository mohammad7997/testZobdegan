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
<div class="col-lg-6 grid-margin stretch-card" style="margin: 125px auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">کاربر ها</h4>
            <p class="card-description">
                Add class <code>.table</code>
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>نام کاربر</th>
                        <th>ایمیل</th>
                        <th>تاریخ ثبت نام</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>{{ $user->created_at }}</td>

                            @if($user->status == 1)
                                <td>
                                    <a class="btn btn-success" href="{{ route('Admin.userStatus',$user->id) }}">
                                        فعال
                                    </a>
                                </td>
                            @elseif($user->status == 0)
                                <td>
                                    <a class="btn btn-danger" href="{{ route('Admin.userStatus',$user->id) }}">
                                        غیر فعال
                                    </a>
                                </td>
                            @endif
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
