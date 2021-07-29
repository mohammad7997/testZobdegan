@extends('admin.index')
@section('content')
    @include('admin.layout.message')
    <div class="col-lg-6 grid-margin stretch-card" style="margin: 125px auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">آگهی ها</h4>
                <p class="card-description">
                    Add class <code>.table</code>
                </p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>نام آگهی</th>
                            <th>نوع آگهی</th>
                            <th>تاریخ ایجاد آگهی</th>
                            <th>ویرایش آگهی</th>
                            <th>
                                <button class="btn btn-danger"> حذف آگهی</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ticketInfo as $ticket)
                            <tr>
                                <td>{{ $ticket->title }}</td>
                                @if($ticket->type == 0)
                                    <td>مشاع</td>
                                @elseif($ticket->type == 1)
                                    <td>
                                        <a href="{{ route('Admin.childTicket',$ticket->id) }}">
                                            تفکیکی
                                        </a>
                                    </td>
                                @endif
                                <td>{{ $ticket->created_at }}</td>
                                <td>
                                    <a href="{{ route('Admin.edit',$ticket->id) }}">
                                        <i class="mdi mdi-grease-pencil" style="margin-left: 17%"></i>
                                    </a>
                                </td>
                                <td>
                                    <form method="post" onclick="deleteTicket(this)" class="btn btn-danger"
                                          action="{{ route('Admin.delete',$ticket->id) }}">
                                        @csrf
                                        @method('delete')
                                        <i class="mdi mdi-delete "></i>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteTicket(x) {
            let tag = $(x);
            tag.submit();
        }
    </script>
@endsection
