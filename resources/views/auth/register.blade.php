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
@include('admin.layout.message')
<div class="col-md-6 grid-margin stretch-card" style="margin: 40px auto">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Default form</h4>
            <p class="card-description">
                Basic form layout
            </p>
            <form class="forms-sample" method="post" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputUsername1">نام</label>
                    <input type="text" class="form-control" id="exampleInputUsername1" name="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputUsername1">نام خانوادگی</label>
                    <input type="text" class="form-control" id="exampleInputUsername1" name="family">
                    @error('family')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputUsername1">کد ملی</label>
                    <input type="number" class="form-control" id="exampleInputUsername1" name="nationalId">
                    @error('nationalId')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputUsername1">شماره تلفن</label>
                    <input type="number" class="form-control" id="exampleInputUsername1" name="phone">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">جنسیت</label>
                    <select class="form-control" id="exampleSelectGender" name="gender">
                        <option value="0">مرد</option>
                        <option value="1">زن</option>
                    </select>
                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputUsername1">آدرس</label>
                    <textarea type="text" class="form-control" id="exampleInputUsername1" name="address"></textarea>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">نام کاربری</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="userName">
                    @error('userName')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">آدرس ایمل</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                    @error('userName')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">رمز</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputConfirmPassword1">تکرار رمز</label>
                    <input type="password" class="form-control" id="exampleInputConfirmPassword1"
                           name="password_confirmation">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        Remember me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
