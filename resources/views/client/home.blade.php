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


<div class="accordion accordion-flush" id="accordionFlushExample">
    @foreach($tickets as $ticket)
        @if($ticket->parent == 0 && $ticket->type == 1)
            <div class="accordion-item">
                <h3>
                    (گروهی)
                    {{ $ticket->title }}
                </h3>
                <div class="accordion-header" id="{{ $ticket->id }}">
                    <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                         data-bs-target="#flush-{{ $ticket->id }}" aria-expanded="false"
                         aria-controls="flush-{{ $ticket->id }}">
                        <div class="col-4 left">
                            <img style="width: 70%;height: 100px"
                                 src="{{ $ticket->image }}">
                        </div>
                        <div class="col-8 right">
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

                        </div>
                    </div>
                </div>
                @foreach($tickets as $childTicket)
                    @if($childTicket->parent == $ticket->id)
                        <div id="flush-{{ $ticket->id }}" class="accordion-collapse collapse"
                             aria-labelledby="{{ $childTicket->id }}"
                             data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body" style="width: 100%; float: left">
                                <div class="col-4 left" style="float: left">
                                    <img style="width: 70%;height: 100px"
                                         src="{{ $childTicket->image }}">
                                </div>
                                <div class="col-8 right" style="float: right">
                                    <div style="float: left;margin: 5px 10px">
                                        <span style="float: left ;margin: 0 5px "> ویزگی ها : </span>
                                        @foreach(unserialize($childTicket->property) as $property)
                                            {{ $property }},
                                        @endforeach
                                    </div>

                                    <div style="float: left;margin: 5px 10px">
                                        <span style="float: left ;margin: 0 5px "> توضیح : </span>
                                        {{ $childTicket->description }}
                                    </div>

                                    <div style="float: left;margin: 5px 10px">
                                        <span style="float: left ;margin: 0 5px "> قیمت نقدی : </span>
                                        {{ $childTicket->priceCash }}
                                    </div>

                                    <h4 style="float: left;width: 100%">شرایط اقساطی</h4>

                                    <div style="float: left;margin: 5px 10px">
                                        <span style="float: left ;margin: 0 5px "> قیمت اقساطی : </span>
                                        {{ $childTicket->priceInstallment }}
                                    </div>

                                    <div style="float: left;margin: 5px 10px">
                                        <span style="float: left ;margin: 0 5px "> پیش پرداخت : </span>
                                        {{ $childTicket->prepayment }}
                                    </div>

                                    <div style="float: left;margin: 5px 10px">
                                        <span style="float: left ;margin: 0 5px "> مدت زمان اقساط : </span>
                                        {{ $childTicket->installmentTime }}
                                    </div>

                                    <div style="float: left;margin: 5px 10px">
                                        <span style="float: left ;margin: 0 5px "> تعداد اقساط : </span>
                                        {{ $childTicket->installmentNum }}
                                    </div>

                                    @guest()
                                        <div style="float: left;margin: 5px 10px">
                                            <a class="btn btn-primary" href="{{ route('login') }}"> برای خرید محصول
                                                ابتدا لاگین کنید</a>
                                        </div>
                                    @endguest()
                                    @auth()
                                        <div style="float: left;margin: 5px 10px">
                                            <a class="btn btn-success"> خرید محصول </a>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                            <div style="width: 100%;height: 1px;background: #000;margin: 5px 0;float: left"></div>
                        </div>
                    @endif
                @endforeach
            </div>
        @elseif($ticket->parent==0 && $ticket->type == 0)
            <div class="accordion-item">
                <h3>
                    (مشاع)
                    {{ $ticket->title }}
                </h3>
                <div class="accordion-header" id=" {{ $ticket->id }} ">
                    <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                         data-bs-target="#flush-{{ $ticket->id }}" aria-expanded="false"
                         aria-controls="flush-{{ $ticket->id }}">
                        <div class="col-4 left">
                            <img style="width: 70%;height: 100px"
                                 src="{{ $ticket->image }}">
                        </div>
                        <div class="col-8 right" style="float: right">
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

                            @guest()
                                <div style="float: left;margin: 5px 10px">
                                    <a class="btn btn-primary" href="{{ route('login') }}"> برای خرید محصول
                                        ابتدا لاگین کنید</a>
                                </div>
                            @endguest()
                            @auth()
                                <div style="float: left;margin: 5px 10px">
                                    <a class="btn btn-success"> خرید محصول </a>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
                {{--<div id="flush-{{ $ticket->id }}" class="accordion-collapse collapse"
                     aria-labelledby="{{ $ticket->id }}"
                     data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body" style="width: 100%; float: left">
                        <div class="col-4 left" style="float: left">
                            <img style="width: 70%;height: 100px"
                                 src="https://via.placeholder.com/640x480.png/00ffcc?text=debitis">
                        </div>
                        <div class="col-8 right" style="float: right">
                        </div>
                    </div>
                </div>--}}
            </div>
        @endif
    @endforeach
</div>
</body>
</html>
