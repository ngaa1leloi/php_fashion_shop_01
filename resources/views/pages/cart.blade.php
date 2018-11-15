@extends('layout.master')
@section('class', 'category-page')
@section('content')
<div class="columns-container">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="home" title="Return to Home">{{ __('text.home')}}</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">{{ __('text.cart') }}</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- page heading-->
        <h2 class="page-heading no-line">
            <span class="page-heading-title2">{{ __('text.cart') }}</span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content page-order">
            <div class="heading-counter warning">{{ __('text.cart') }}:
                <span>{{ Cart::getTotalQuantity() }} {{ __('text.product') }}</span>
            </div>
            <div class="order-detail-content">
                <table class="table table-bordered table-responsive cart_summary">
                    <thead>
                        <tr>
                            <th class="cart_product">{{ __('text.product') }}</th>
                            <th>{{ __('text.description') }}</th>
                            <th>{{ __('text.unit_price') }}</th>
                            <th>{{ __('text.sale_price') }}</th>
                            <th>{{ __('text.color') }}</th>
                            <th>{{ __('text.size') }}</th>
                            <th>{{ __('text.quantity') }}</th>
                            <th>{{ __('text.total') }}</th>
                            <th  class="action"><i class="fa fa-trash-o"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                        <tr>
                            <td class="cart_product">
                                <a href="product/{{ $item->attributes->product_id }}"><img src="{{ config('image.paths.resource') }}/{{ $item->attributes->image }}" alt="Product"></a>
                            </td>
                            <td class="cart_description">
                                <p class="product-name"><a href="product/{{ $item->attributes->product_id }}">{{ $item->name }} </a></p>
                            </td>
                            <td class="price"><span>{{ number_format($item->attributes->unit_price) }} <span style="text-decoration:underline;">đ</span></span></td>
                            <td class="price"><span>{{ number_format($item->price) }} <span style="text-decoration:underline;">đ</span></span></td>
                            <td><li style="background:{{ $item->attributes->color }}"></li>
                            </td>

                            <td><span>{{ $item->attributes->size }}</span></td>
                            <td class="qty">
                                <input class="form-control input-sm" type="text" value="{{ $item->quantity }}">
                                <a href="up_item/{{ $item->id }}"><i class="fa fa-caret-up"></i></a>
                                <a href="down_item/{{ $item->id }}"><i class="fa fa-caret-down"></i></a>
                            </td>
                            <td class="price">
                                <span>{{ number_format(($item->quantity) * ($item->price)) }} <span style="text-decoration:underline;">đ</span></span>
                            </td>
                            <td class="action">
                                <a href="remove_cart/{{ $item->id }}">{{ __('text.delete') }}</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" rowspan="2"></td>
                            <td colspan="3">{{ __('text.total_product') }}</td>
                            <td colspan="2">{{ number_format(Cart::getSubTotal()) }} <span style="text-decoration:underline;">đ</span></td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>{{ __('text.total') }}</strong></td>
                            <td colspan="2"><strong>{{ number_format(Cart::getSubTotal()) }} <span style="text-decoration:underline;">đ</span></strong></td>
                        </tr>
                    </tfoot>    
                </table>
                <div class="cart_navigation">
                    <a class="prev-btn" href="home">{{ __('text.home') }}</a>
                    <a class="next-btn" href="checkout">{{ __('text.checkout') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('a.up_item').click(function(event) {
            var id = $(this).attr('id');
            var quantity = $(this).parent().find(".input-sm").val();
            $.get('up_item/' + id + '/' + quantity, function(data) {
                $(this).parent().find(".input-sm").val('');
                $.each(data, function() {
                    $.each(this, function(index, val) {
                        $(this).parent().find(".input-sm").val(val);
                    });
                });
            });
        });            
    });
</script>
@endsection
