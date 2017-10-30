<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('error'))
                <div style="display: none;" class="alert alert-danger" role="alert" data-type="error">
                    <p>{!! session('error') !!}</p>
                </div>
            @endif
            @if(session('success'))
                <div style="display: none;" class="alert alert-success notify-message" role="alert" data-type="success">
                    <p>{!! session('success') !!}</p>
                </div>
            @endif
            @if(count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>