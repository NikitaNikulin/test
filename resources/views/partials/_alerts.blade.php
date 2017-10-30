<div class="container">
    <div class="row">
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                <p>{!! session('error') !!}</p>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <p>{!! session('success') !!}</p>
            </div>
        @endif
        @if(env('APP_DEBUG'))
            @if(count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif
    </div>
</div>