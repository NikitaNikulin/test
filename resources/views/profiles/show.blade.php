@extends('layouts.app')
@section('content')

    <section class="privat-cab">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-6">
					<i class="fa fa-user-o" aria-hidden="true"></i>
                    <h3>Личный кабинет</h3>
	                @ReplaceBlock('profiles.partials._profileBlock')
                </div>
	            <div class="col-md-7 col-sm-6">
					<i class="fa fa-calendar-o" aria-hidden="true"></i><h3>История заказов</h3>
		            <div class="person-information history-information">
			            <div class="top-pos">
				            <div class="col-md-3 col-sm-2 pos-portion">Дата</div>
				            <div class="col-md-5 col-sm-2 pos-dish">Блюдо</div>
				            <div class="col-md-2 col-sm-5 pos-cost">Цена</div>
				            <div class="col-md-2 col-sm-3">
							<div class="pos_repeat"></div>
				            </div>
							<div class="clearfix"></div>
			            </div>
			            {{--<div class="b-replaced_block_historyBlock">--}}
			                {{--@include('orders.partials._historyBlock')--}}
			            {{--</div>--}}
			            {{--<div class="b-replaced_block_showMoreBlock show_more_hist">--}}
			                {{--@include('partials.mini._showMoreBlock', [$countItems = $orders->total()])--}}
			            {{--</div>--}}
		            </div>
	            </div>
            </div>
        </div>
    </section>

@endsection