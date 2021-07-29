@if($errors->any())

    <div class="alert alert-danger">
        <ul style="text-align: center;list-style: none">
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>

@endif

@if(session('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if(session('failed'))
    <div class="alert alert-danger">
        <p>{{ session('failed') }}</p>
    </div>
@endif
