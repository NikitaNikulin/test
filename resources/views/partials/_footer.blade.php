<footer>
    <div class="container">
        <div class="row">
	        <a href="{{ route('pages.show', 'contacts') }}">Контакты </a>
        </div>
    </div>
</footer>


<script src="{{ asset('libs/js/jquery.min.js') }}"></script>
<script src="{{ asset('libs/js/bootstrap.js') }}"></script>
<script src="{{ asset('libs/jquery-bbq/jquery.ba-bbq.min.js') }}"></script>
<script src="{{ asset('libs/alertifyjs/js/alertify.min.js') }}"></script>
<script src="{{ asset('js/custom_functions.js') }}"></script>
@yield('assets-js')
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>