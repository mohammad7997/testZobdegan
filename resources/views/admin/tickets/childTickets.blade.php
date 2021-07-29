@extends('admin.index')
@section('content')
    @include('admin.layout.message')
    <div class="col-lg-6 grid-margin stretch-card" style="margin: 125px auto">
        <a href="{{route('Admin.createChildTicket',$ticket->id)}}" class="btn btn-success" style="position: absolute;top: 159px;right: 254px;">
            ایجاد آگهی زیر مجموعه جدید
        </a>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> آگهی های زیر مجموعه ({{ $ticket->title }})</h4>
                <p class="card-description">
                    Add class <code>.table</code>
                </p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>نام آگهی</th>
                            <th>تاریخ ایجاد آگهی</th>
                            <th>ویرایش آگهی</th>
                            <th>
                                <button class="btn btn-danger"> حذف آگهی</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($childTicketInfo as $ticketChild)
                            <tr>
                                <td>{{ $ticketChild->title }}</td>
                                <td>{{ $ticket->created_at }}</td>
                                <td>
                                    <a href="{{ route('Admin.editChildTicket',$ticketChild->id) }}">
                                        <i class="mdi mdi-grease-pencil" style="margin-left: 17%"></i>
                                    </a>
                                </td>
                                <td>
                                    <form method="post" onclick="deleteTicket(this)" class="btn btn-danger"
                                          action="{{ route('Admin.delete',$ticketChild->id) }}">
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
