@extends('layout.master')
@section('content')
<div id="home-slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 slider-left"></div>
            <div class="col-sm-9 header-top-right">
                <div class="homeslider">
                    <div class="content-slide">
                        <ul id="contenhomeslider">
                            @foreach ($slide as $sl)
                            <li><img class="image-slide" style="height: 450px" alt="Funky roots" src="{{ config('image.paths.resource') }}/{{ $sl->image }}" title="Funky roots" /></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="header-banner banner-opacity">
                    <a><img class="image-slide" style="height: 450px" alt="Funky roots" src="{{ config('image.paths.resource') }}/watch.jpg" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Home slideder-->
<!-- servives -->
<div class="container">
    <div class="service ">
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="{{ config('image.paths.resource') }}/s1.png" />
            </div>
            <div class="info">
                <a><h3>{{ __('text.free_ship') }}</h3></a>
                <span>{{ __('text.free_ship_oder') }}</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="{{ config('image.paths.resource') }}/s2.png" />
            </div>
            <div class="info">
                <a><h3>{{ __('text.30day') }}</h3></a>
                <span>{{ __('text.money_back') }}</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="{{ config('image.paths.resource') }}/s3.png" />
            </div>
            
            <div class="info" >
                <a><h3>{{ __('text.supp') }}</h3></a>
                <span>{{ __('text.online') }}</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="{{ config('image.paths.resource') }}/s4.png" />
            </div>
            <div class="info">
                <a><h3>{{ __('text.safe1') }}</h3></a>
                <span>{{ __('text.safe2') }}</span>
            </div>
        </div>
    </div>
</div>
<!-- end services -->
<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-9 page-top-left">
                <div class="popular-tabs">
                  <ul class="nav-tab">
                    <li class="active"><a data-toggle="tab" href="#tab-1">{{ __('text.best_sellers') }}</a></li>
                    <li><a data-toggle="tab" href="#tab-2">{{ __('text.on_sale') }}</a></li>
                    <li><a data-toggle="tab" href="#tab-3">{{ __('text.new_products') }}</a></li>
                </ul>
                <div class="tab-container">
                    <div id="tab-1" class="tab-panel active">
                        <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
                            @foreach ($product_best_seller as $pro)
                            <li>
                                <div class="left-block">
                                    <a href="product/{{ $pro->id }}">
                                        <img class="img-responsive" alt="product" src="{{ config('image.paths.resource') }}/{{ ($pro->productImages()->first())->image }}" />
                                    </a>
                                    <div class="quick-view">
                                        <a title="Add to my wishlist" class="heart" href="home"></a>
                                        <a title="Add to compare" class="compare" href="home"></a>
                                        <a title="Quick view" class="search" href="product/{{ $pro->id }}"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a title="Add to Cart" href="product/{{ $pro->id }}">{{ __('text.view_more') }}</a>
                                    </div>
                                    <div class="group-price">
                                        @if ($pro->getPromotions() == null)
                                        <span class="product-new">{{ __('text.new') }}</span>
                                        @else
                                        <span class="product-sale">{{ __('text.sale') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="product/{{ $pro->id }}">{{ $pro->name }}</a></h5>
                                    <div class="content_price"> 
                                        <span class="price product-price">{{ number_format((($pro->unit_price)*(100-($pro->getPromotions()))/100)) }} <span style="text-decoration:underline;">đ</span></span>
                                        @if ($pro->getPromotions() != null)
                                        <span class="price old-price">{{ number_format($pro->unit_price) }} <span style="text-decoration:underline;">đ</span></span>
                                        @endif
                                    </div>
                                    
                                    <div class="product-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </li>   
                            @endforeach
                        </ul>
                    </div>
                    <div id="tab-2" class="tab-panel">
                        <ul class="product-list owl-carousel"  data-dots="false" data-loop="true" data-nav = "true" data-margin = "30"  data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
                            @foreach ($product_sale as $pr)
                            <li>
                                <div class="left-block">
                                    <a href="product/{{ $pr->id }}">
                                        <img class="img-responsive" alt="product" src="{{ config('image.paths.resource') }}/{{ ($pr->productImages()->first())->image }}" />
                                    </a>
                                    <div class="quick-view">
                                        <a title="Add to my wishlist" class="heart" href="home"></a>
                                        <a title="Add to compare" class="compare" href="home"></a>
                                        <a title="Quick view" class="search" href="product/{{ $pr->id }}"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a title="Add to Cart" href="product/{{ $pro->id }}">{{__('text.view_more')}}</a>
                                    </div>
                                    <div class="group-price">

                                        @if ($pro->getPromotions() == null)
                                        <span class="product-new">{{ __('text.new') }}</span>
                                        @else
                                        <span class="product-sale">{{ __('text.sale') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="product/{{ $pr->id }}">{{ $pr->name }}</a></h5>
                                    <div class="content_price">
                                        <span class="price product-price">{{ number_format(($pr->unit_price)*(100-($pr->getPromotions()))/100 ) }} <span style="text-decoration:underline;">đ</span></span>
                                        @if($pr->getPromotions() != null)
                                        <span class="price old-price">{{ number_format($pr->unit_price) }} <span style="text-decoration:underline;">đ</span></span>
                                        @endif
                                    </div>
                                    <div class="product-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="tab-3" class="tab-panel">
                        <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
                            @foreach ($new_product as $pro)
                            <li>
                                <div class="left-block">
                                    <a href="product/{{ $pro->id }}"><img class="img-responsive" alt="product" src="{{ config('image.paths.resource') }}/{{ ($pro->productImages()->first())->image }}" /></a>
                                    <div class="quick-view">
                                        <a title="Add to my wishlist" class="heart" href="home"></a>
                                        <a title="Add to compare" class="compare" href="home"></a>
                                        <a title="Quick view" class="search" href="product/{{ $pro->id }}"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a title="Add to Cart" href="product/{{ $pro->id }}">{{__('text.view_more')}}</a>
                                    </div>
                                    <div class="group-price">
                                        @if ($pro->getPromotions() == null)
                                        <span class="product-new">{{ __('text.new') }}</span>
                                        @else
                                        <span class="product-sale">{{ __('text.sale') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="product/{{ $pro->id }}">{{ $pro->name }}</a></h5>
                                    <div class="content_price">
                                        <span class="price product-price">{{ number_format(($pro->unit_price)*(100-($pro->getPromotions()))/100 ) }} <span style="text-decoration:underline;">đ</span></span>
                                        @if($pro->getPromotions() != null)
                                        <span class="price old-price">{{ number_format($pro->unit_price) }} <span style="text-decoration:underline;">đ</span></span>
                                        @endif
                                    </div>
                                    <div class="product-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 page-top-right">
            <div class="latest-deals">
                <h2 class="latest-deal-title">latest deals</h2>
                <div class="latest-deal-content">
                    <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":1}}'>
                        <li>
                            <div class="count-down-time" data-countdown="2015/06/27"></div>
                            <div class="left-block">
                                <a href="home"><img class="img-responsive" alt="product" src="{{ config('image.paths.resource') }}/ld1.jpg" /></a>
                                <div class="quick-view">
                                    <a title="Add to my wishlist" class="heart" href="home"></a>
                                    <a title="Add to compare" class="compare" href="home"></a>
                                    <a title="Quick view" class="search" href="home"></a>
                                </div>
                                <div class="add-to-cart">
                                    <a title="Add to Cart" href="product/{{ $pro->id }}">{{ __('text.view_more') }}</a>
                                </div>
                            </div>
                            <div class="right-block">
                                <h5 class="product-name"><a href="home">Maecenas consequat mauris</a></h5>
                                <div class="content_price">
                                    <span class="price product-price">230,000 đ</span>
                                    <span class="price old-price">250,000 đ</span>
                                    <span class="colreduce-percentage">(-10%)</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="count-down-time" data-countdown="2015/06/27 9:20:00"></div>
                            <div class="left-block">
                                <a href="home"><img class="img-responsive" alt="product" src="{{ config('image.paths.resource') }}/ld2.jpg" /></a>
                                <div class="quick-view">
                                    <a title="Add to my wishlist" class="heart" href="home"></a>
                                    <a title="Add to compare" class="compare" href="home"></a>
                                    <a title="Quick view" class="search" href="home"></a>
                                </div>
                                <div class="add-to-cart">
                                    <a title="Add to Cart" href="home">Add to Cart</a>
                                </div>
                            </div>
                            <div class="right-block">
                                <h5 class="product-name"><a href="home">Maecenas consequat mauris</a></h5>
                                <div class="content_price">
                                    <span class="price product-price">240,000 đ</span>
                                    <span class="price old-price">380,000 đ</span>
                                    <span class="colreduce-percentage">(-90%)</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="count-down-time" data-countdown="2015/06/27 9:20:00"></div>
                            <div class="left-block">
                                <a href="home"><img class="img-responsive" alt="product" src="{{ config('image.paths.resource') }}/ld3.jpg" /></a>
                                <div class="quick-view">
                                    <a title="Add to my wishlist" class="heart" href="home"></a>
                                    <a title="Add to compare" class="compare" href="home"></a>
                                    <a title="Quick view" class="search" href="home"></a>
                                </div>
                                <div class="add-to-cart">
                                    <a title="Add to Cart" href="home">Add to Cart</a>
                                </div>
                            </div>
                            <div class="right-block">
                                <h5 class="product-name"><a href="home">Maecenas consequat mauris</a></h5>
                                <div class="content_price">
                                    <span class="price product-price">290,000 đ</span>
                                    <span class="price old-price">320,000 đ</span>
                                    <span class="colreduce-percentage">(-20%)</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!---->
<div class="content-page">
    <div class="container">
        <!-- featured category fashion -->
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-red show-brand">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-brand"><a href="home"><img alt="fashion" src="{{ config('image.paths.resource') }}/fashion.png" />fashion</a></div>
                <span class="toggle-menu"></span>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">           
                  <ul class="nav navbar-nav">
                    <li class="active"><a data-toggle="tab" href="#tab-4">{{ __('text.most_viewed') }}</a></li>
                    <li><a data-toggle="tab" href="#tab-5">{{ __('text.all') }}</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        <div id="elevator-1" class="floor-elevator">
            <a href="home" class="btn-elevator up disabled fa fa-angle-up"></a>
            <a href="#elevator-2" class="btn-elevator down fa fa-angle-down"></a>
        </div>
    </nav>
    <div class="category-banner">
        <div class="col-sm-6 banner">
            <a href="home"><img alt="ads2" class="img-responsive" src="{{ config('image.paths.resource') }}/ads2.jpg" /></a>
        </div>
        <div class="col-sm-6 banner">
            <a href="home"><img alt="ads2" class="img-responsive" src="{{ config('image.paths.resource') }}/ads3.jpg" /></a>
        </div>
    </div>
    <div class="product-featured clearfix">
        <div class="banner-featured">
            <div class="featured-text"><span>featured</span></div>
            <div class="banner-img">
                <a href="home"><img alt="Featurered 1" src="{{ config('image.paths.resource') }}/f1.jpg" /></a>
            </div>
        </div>
        <div class="product-featured-content">
            <div class="product-featured-list">
                <div class="tab-container">
                    <!-- tab product -->
                    <div class="tab-panel active" id="tab-4">
                        <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            @foreach ($product_most_views as $pro)
                            <li>
                                <div class="left-block">
                                    <a href="product/{{ $pro->id }}">
                                        <img class="img-responsive" alt="product" src="{{ config('image.paths.resource') }}/{{ ($pro->productImages()->first())->image }}"/>
                                    </a>
                                    <div class="quick-view">
                                        <a title="Add to my wishlist" class="heart" href="home"></a>
                                        <a title="Add to compare" class="compare" href="home"></a>
                                        <a title="Quick view" class="search" href="product/{{ $pro->id }}"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a title="Add to Cart" href="product/{{ $pro->id }}">{{ __('text.view_more') }}</a>
                                    </div>
                                    <div class="group-price">
                                        @if ($pro->getPromotions() == null)
                                        <span class="product-new">{{ __('text.new') }}</span>
                                        @else
                                        <span class="product-sale">{{ __('text.sale') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="product/{{ $pro->id }}">{{ $pro->name }}</a></h5>
                                    <div class="content_price">
                                        <span class="price product-price">{{ number_format(($pro->unit_price)*(100-($pro->getPromotions()))/100 ) }} <span style="text-decoration:underline;">đ</span></span>
                                        @if($pro->getPromotions() != null)
                                        <span class="price old-price">{{ number_format($pro->unit_price) }} <span style="text-decoration:underline;">đ</span></span>
                                        @endif
                                    </div>
                                    <div class="product-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- tab product -->
                    <div class="tab-panel" id="tab-5">
                        <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            @foreach ($product as $pro)
                            <li>
                                <div class="left-block">
                                    <a href="product/{{ $pro->id }}">
                                        <img class="img-responsive" alt="product" src="{{ config('image.paths.resource') }}/{{ ($pro->productImages()->first())->image }}" />
                                    </a>
                                    <div class="quick-view">
                                        <a title="Add to my wishlist" class="heart" href="home"></a>
                                        <a title="Add to compare" class="compare" href="home"></a>
                                        <a title="Quick view" class="search" href="product/{{ $pro->id }}"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a title="Add to Cart" href="product/{{ $pro->id }}">{{ __('text.view_more')}}</a>
                                    </div>
                                    <div class="group-price">
                                        @if ($pro->getPromotions() == null)
                                        <span class="product-new">{{ __('text.new') }}</span>
                                        @else
                                        <span class="product-sale">{{ __('text.sale') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="product/{{ $pro->id }}">{{ $pro->name }}</a></h5>
                                    <div class="content_price">
                                        <span class="price product-price">{{ number_format(($pro->unit_price)*(100-($pro->getPromotions()))/100 ) }} <span style="text-decoration:underline;">đ</span></span>
                                        @if($pro->getPromotions() != null)
                                        <span class="price old-price">{{ number_format($pro->unit_price) }} <span style="text-decoration:underline;">đ</span></span>
                                        @endif
                                    </div>
                                    <div class="product-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end featured category fashion -->

<!-- Baner bottom -->
<div class="row banner-bottom">
    <div class="col-sm-6">
        <div class="banner-boder-zoom">
            <a><img alt="ads" class="img-responsive" src="{{ config('image.paths.resource') }}/ads17.jpg" /></a>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="banner-boder-zoom">
            <a><img alt="ads" class="img-responsive" src="{{ config('image.paths.resource') }}/ads18.jpg" /></a>
        </div>
    </div>
</div>
<!-- end banner bottom -->
</div>
</div>

<div class="container">
    <div class="brand-showcase">
        <h2 class="brand-showcase-title">
            {{ __('text.brand_showcase') }}
        </h2>
        <div class="brand-showcase-box">
            <ul class="brand-showcase-logo owl-carousel" data-loop="true" data-nav = "true" data-dots="false" data-margin = "1" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":2},"600":{"items":5},"1000":{"items":8}}'>
                <li data-tab="showcase-1" class="item active"><img src="{{ config('image.paths.resource') }}/gucci.png" alt="logo" class="item-img" /></li>
                <li data-tab="showcase-2" class="item"><img src="{{ config('image.paths.resource') }}/gucci.png" alt="logo" class="item-img" /></li>
            </ul>
            <div class="brand-showcase-content">
                <div class="brand-showcase-content-tab active" id="showcase-1">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 trademark-info">
                            <div class="trademark-logo">
                                <a href="home"><img src="source/assets/data/trademark.jpg" alt="trademark"></a>
                            </div>
                            <div class="trademark-desc">
                                Whatever the occasion, complete your outfit with one of Hermes Fashion’s stylish women’s bags. Discover our spring collection.
                            </div>
                            <a href="home" class="trademark-link">shop this brand</a>
                        </div>
                        <div class="col-xs-12 col-sm-8 trademark-product">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 product-item">
                                    <div class="image-product hover-zoom">
                                        <a href="home"><img class="img-repon" src="{{ config('image.paths.resource') }}/p24.jpg" alt=""></a>
                                    </div>
                                    <div class="info-product">
                                        <a href="home">
                                            <h5>Áo len</h5>
                                        </a>
                                        <span class="product-price">270,000 đ</span>
                                        <div class="product-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a class="btn-view-more" title="View More" href="home">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="brand-showcase-content-tab" id="showcase-2">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 trademark-info">
                            <div class="trademark-logo">
                                <a href="home"><img src="{{ config('image.paths.resource') }}/trademark.jpg" alt="trademark"></a>
                            </div>
                            <div class="trademark-desc">
                                Whatever the occasion, complete your outfit with one of Hermes Fashion’s stylish women’s bags. Discover our spring collection.
                            </div>
                            <a href="home" class="trademark-link">shop this brand</a>
                        </div>
                        <div class="col-xs-12 col-sm-8 trademark-product">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 product-item">
                                    <div class="image-product hover-zoom">
                                        <a href="home"><img class="img-repon" src="{{ config('image.paths.resource') }}/p10.jpg" alt=""></a>
                                    </div>
                                    <div class="info-product">
                                        <a href="home">
                                            <h5>Váy hoa</h5>
                                        </a>
                                        <span class="product-price">250,000 đ</span>
                                        <div class="product-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a class="btn-view-more" title="View More" href="home">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection
