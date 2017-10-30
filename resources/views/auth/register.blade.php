@extends('layouts.app')
@section('content')
    <section class="autorization" style="background-image: url(/img/png/avtorization.png);">
        <div class="container">
            <div class="row">
                <div class="registrat">
                    <h2>Регистрация</h2>
                    <form action="{{ url('auth/register') }}" method="POST">
                        {!! csrf_field() !!}
	                    <?php $roles = \App\Role::all()?>
                        <input type="radio" class="hidden" name="role_id" value="{{ $roles->where('name', 'user')->first()->id }}" @if(!old('role_id') || old('role_id') == $roles->where('name', 'user')->first()->id) checked @endif>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="" placeholder="Введите ваше имя">
                            @if($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input name="email" value="{{ old('email') }}" type="email" class="form-control" id="" placeholder="E-mail">
                            @if($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input name="password" type="password" class="form-control" id="" placeholder="Придумайте пароль">
                            @if($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <input name="password_confirmation" type="password" class="form-control" id="" placeholder="Пароль еще раз">
                            @if($errors->has('password_confirmation'))
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <div class="checkboxes">
                            <input id="a" type="checkbox"/>
                            <label class="green-background" for="a"></label>
		                    <span>Принимаю согласие с <a href="">пользовательским соглашением</a></span>
                        </div>
                        <button type="submit" class="btn btn-default">Зарегестрироваться</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection