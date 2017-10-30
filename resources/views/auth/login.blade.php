@extends('layouts.app')
@section('content')
    <section class="autorization" style="background-image: url(/img/png/avtorization.png);">
        <div class="container">
            <div class="row">
                <div class="autorizat">
                    <h2>Авторизация</h2>
                    <form action="{{ url('auth/login') }}" method="POST">
                        {!! csrf_field() !!}
                        {{--                        {{ dd($errors) }}--}}
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input name="email" value="{{ old('email') }}" type="email" class="form-control" id="" placeholder="E-mail">
                            @if($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input name="password" type="password" class="form-control" id="" placeholder="Пароль">
                        </div>
                        <div class="checkboxes">
                            <input id="a" type="checkbox"/>
                            <label class="green-background" for="a"></label>
                            <span>Запомнить меня</span>
                        </div>
                        <button type="submit" class="btn btn-default">Войти</button>
                    </form>
                    <div class="b-login-forget">
                        <a href="{{ url('password/email') }}">Забыли пароль?</a>
                        <p>Еще нет аккаунта? </p><a href="{{ url('auth/register') }}">Зарегистрироваться</a>
                    </div>
                    <div class="in-social">
                        <p>Быстрый вход через:</p>
                        <ul>
                            <li><a href=""><img src="/img/social_icon/g+.png" alt=""></a></li>
                            <li><a href=""><img src="/img/social_icon/tw.png" alt=""></a></li>
                            <li><a href=""><img src="/img/social_icon/vk.png" alt=""></a></li>
                            <li><a href=""><img src="/img/social_icon/fb.png" alt=""></a></li>
                            <li><a href=""><img src="/img/social_icon/ok.png" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection