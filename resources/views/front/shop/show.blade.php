@extends('front.layout.master')

@section('content')
        <!--Breadcrumb Section Begin  -->
        <div class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-text">
                            <a href="index.html"><i class="fa fa-home"></i></a>
                            <a href="shop.html">Shop</a>
                            <span>Detail</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breachcrumb Section End  -->
    
        <!-- Product shop section begin -->
        <section class="product-shop spad page-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="filter-widget">
                            <h4 class="fw-title">Categories</h4>
                            <ul class="filter-catagories">
                                <li><a href="">Men</a></li>
                                <li><a href="">Women</a></li>
                                <li><a href="">Kid</a></li>
                            </ul>
                        </div>
                        <div class="filter-widget">
                            <h4 class="fw-title">Brand</h4>
                            <div class="fw-brand-check">
                                <div class="bc-item">
                                    <label for="">
                                        CalVin Klein
                                        <input type="checkbox" name="" id="bc-calvin">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-widget">
                            <h4 class="fw-title">Price</h4>
                            <div class="filter-range-wrap">
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
    
                                </div>
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizonal ui-widget ui-widget-content"
                                            data-min="33" data-max="98">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header" ></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
    
                                </div>
                            </div>
                            <a href="" class="filter-btn">Filter</a>
                        </div>
                        <div class="filter-widget">
                            <h4 class="fw-title">Color</h4>
                            <div class="fw-color-choose">
                                <div class="cs-item">
                                    <input type="radio" id="cs-black">
                                    <label for="cs-black" class="cs-balck">balck</label>
                                </div>
                                <div class="cs-item">
                                    <input type="radio" id="cs-violet">
                                    <label for="cs-violet" class="cs-violet">violet</label>
                                </div>
                                <div class="cs-item">
                                    <input type="radio" id="cs-blue">
                                    <label for="cs-blue" class="cs-blue">blue</label>
                                </div>
                                <div class="cs-item">
                                    <input type="radio" id="cs-yellow">
                                    <label for="cs-yellow" class="cs-yellow">yellow</label>
                                </div>
                                <div class="cs-item">
                                    <input type="radio" id="cs-red">
                                    <label for="cs-red" class="cs-red">red</label>
                                </div>
                                <div class="cs-item">
                                    <input type="radio" id="cs-green">
                                    <label for="cs-green" class="cs-green">green</label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-widget">
                            <h4 class="fw-title">Size</h4>
                            <div class="fw-size-choose">
                                <div class="sc-item">
                                    <input type="radio" id="s-sieze">
                                    <label for="s-size">S</label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" id="m-sieze">
                                    <label for="m-size">M</label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" id="l-sieze">
                                    <label for="l-size">L</label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" id="xs-sieze">
                                    <label for="xs-size">XS</label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-widget">
                            <h4 class="fw-title">Tags</h4>
                            <div class="fw-tags">
                                <a href="#">Towel</a>
                                <a href="#">Shoes</a>
                                <a href="#">Coat</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-pic-zoom">
                                    <img class="product-pic-image" src="front/img/products/{{$product->productImages[0]->path}}" alt="">
                                    <div class="zoom-icon">
                                        <i class="fa fa-search-plus"></i>
                                    </div>
                                </div>
                                <div class="product-thumbs">
                                    <div class="product-thumbs-track ps-slider owl-carousel">   
                                        @foreach ($product->productImages as $productImage)
                                            <div class="pt active" data-imgbigurl="front/img/products/{{$productImage->path}}">
                                                <img src="front/img/products{{$productImage->path}}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product-details">
                                    <div class="pd-title">
                                        <span>{{$product->tag}}</span>
                                        <h3>{{$product->name}}</h3>
                                        <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                                    </div>
                                    <div class="pd-rating">
                                        @for ($i = 0; $i < 5; $i++)

                                            @if ($i < $avgRating)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                            
                                        @endfor
                                       
                                        <span>({{count($product->productComments)}})</span>
                                    </div>
                                    <div class="pd-desc">
                                        <p>{{$product->content}}</p>
                                        @if ($product->discount != null)
                                        <h4>${{$product->discount}} <span>{{$product->price}}</span></h4>
                                        @else
                                        <h4>${{$product->price}}</h4>
                                        @endif
                                       
                                    </div>
                                    <div class="pd-color">
                                        <h6>Color</h6>
                                        <div class="pd-color-choose">
                                           @foreach (array_unique(array_column($product->productDetails->toArray(), 'color')) as $productColor)
                                            <div class="cc-item">
                                                <input type="radio" id="cc-{{$productColor}}">
                                                <label for="cc-{{$productColor}}" class="cc-{{$productColor}}"></label>
                                            </div>
                                           @endforeach
                                           
                                        </div>
                                    </div>
                                    <div class="pd-size-choose">
                                        @foreach (array_unique(array_column($product->productDetails->toArray(), 'size')) as $productSize)
                                              <div class="sc-item">
                                            <input type="radio" id="sm-{{$productSize}}">
                                            <label for="sm-{{$productSize}}">{{$productSize}}</label>
                                            </div>
                                        @endforeach
                                      
                                       
                                    </div>
                                    <div class="quantity"> 
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{$product->qty}}">
                                            </div>
                                            <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                                        </div>
                                    </div>
                                    <ul class="pd-tags">
                                        <li><span>CATEGORIES</span>: {{$product->productCategory->name}}</li>
                                        <li><span>TAGS</span>: {{$product->tag}}</li>
                                    </ul>
                                    <div class="pd-share">
                                        <div class="p-code">Sku: {{$product->sku}}</div>
                                        <div class="pd-social">
                                            <a href="#"><i class="ti-facebook"></i></a>
                                            <a href="#"><i class="ti-twitter-alt"></i></a>
                                            <a href="#"><i class="ti-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab">
                            <div class="tab-item">
                                <ul class="nav" role="tablist">
                                    <li><a class="active" href="#tab-1" data-toggle="tab" role="tab">DESCRIPTION</a></li>
                                    <li><a href="#tab-2" data-toggle="tab" role="tab">SPECIFICATION</a></li>
                                    <li><a href="#tab-3" data-toggle="tab" role="tab">Customer reviews (82)</a></li>
                                </ul>
                            </div>
                            <div class="tab-item-content">
                                <div class="tab-content">
                                    <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                        <div class="product-content">
                                            <div class="row">
                                                <div class="col-lg-7">
                                                    <h5>Introduction</h5>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur temporibus culpa, commodi saepe cupiditate deserunt veniam molestiae dolores pariatur rem ad voluptatem id rerum fuga impedit
                                                         minus voluptatum quidem. Recusandae?</p>
                                                    <h5>Features</h5>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur temporibus culpa, commodi saepe cupiditate deserunt veniam molestiae dolores pariatur rem ad voluptatem id rerum fuga impedit
                                                        minus voluptatum quidem. Recusandae?</p>
                                                </div>
                                                <div class="col-lg-5">
                                                    <img src="front/img/product-single/tab-desc.jpg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                        <div class="specification-table">
                                            <table>
                                                <tr>
                                                    <td class="p-catagory">
                                                        Customer Rating
                                                    </td>
                                                    <td>
                                                        <div class="pd-rating">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if ($i < $avgRating)
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif                                                              
                                                            @endfor
                                                           
                                                            <span>({{count($product->productComments)}})</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Price</td>
                                                    <td>
                                                        <div class="p-price">
                                                            ${{$product->price}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Add to cart</td>
                                                    <td>
                                                        <div class="cart-add">+ add to cart</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Availability</td>
                                                    <td>
                                                        <div class="p-stock">{{$product->qty}} in stock</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Weight</td>
                                                    <td>
                                                        <div class="p-weight">{{$product->weight}}kg</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Size</td>
                                                    <td>
                                                        
                                                        <div class="p-size">
                                                            @foreach (array_unique(array_column($product->productDetails->toArray(), 'size')) as $productSize)
                                                                {{$productSize}}
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Color</td>
                                                    <td>
                                                        @foreach (array_unique(array_column($product->productDetails->toArray(), 'color')) as $productColor)
                                                            <span class="cs-{{$productColor}}"></span>
                                                        @endforeach
                                  
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Sku</td>
                                                    <td>
                                                        <div class="p-code">
                                                            {{$product->sku}}
                                                        </div>
                                                    </td>
                                                </tr>
        
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                       <div class="customer-review-option">
                                        <h4>{{count($product->productComments)}} Comments</h4>
                                        <div class="comment-option">
                                            @foreach ($product->productComments as $productComment)
                                                <div class="co-item">
                                                    <div class="avatar-pic">
                                                        <img src="front/img/product-single/{{$productComment->user->avatar ?? 'default.jpg'}}" alt="">
                                                    </div>
                                                    <div class="avatar-text">
                                                        <div class="at-rating">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if ($i < $avgRating)
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif                                                              
                                                            @endfor
                                                        </div>
                                                        <h5>{{$productComment->name}}<span>{{date('M d,Y', strtotime($productComment->create_at))}}/span></h5>
                                                        <div class="at-reply">Nice !</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                           
                                        </div>
                                      
                                        <div class="leave-comment">
                                            <h4>Leave A Comment</h4>
                                            <form action="" method="POST" class="comment-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id ?? null}}">

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input type="text" placeholder="Name" name="name" id="">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="text" placeholder="Email" name="email" id="">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea placeholder="Messages" name="messages"></textarea>
                                                        <div class="personal-rating">
                                                            <h6>Your Rating</h6>
                                                            <div class="rate">
                                                                <input type="radio" id="star5" name="rating" value="5" />
                                                                <label for="star5" title="text">5 stars</label>
                                                                <input type="radio" id="star4" name="rating" value="4" />
                                                                <label for="star4" title="text">4 stars</label>
                                                                <input type="radio" id="star3" name="rating" value="3" />
                                                                <label for="star3" title="text">3 stars</label>
                                                                <input type="radio" id="star2" name="rating" value="2" />
                                                                <label for="star2" title="text">2 stars</label>
                                                                <input type="radio" id="star1" name="rating" value="1" />
                                                                <label for="star1" title="text">1 star</label>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="site-btn">Send Message</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                       </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
               
            </div>
        </section>
        <!-- Product shop section end -->   
    
        <!-- Related Products Section Begin -->
        <div class="related-products spad" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Related Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                   
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-lg-3 col-sm-6">
                            @include('front.components.product-item', ['product' => $relatedProduct])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Related Products Section End -->
    
        <!-- Partner Logo Section begin -->
        <div class="partner-logo">
            <div class="container">
                <div class="logo-carousel owl-carousel">
                    <div class="logo-item">
                        <div class="tablecell-inner">
                            <img src="front/img/logo-carousel/logo-1.png" alt="">
                        </div>
                    </div>
                    <div class="logo-item">
                        <div class="tablecell-inner">
                            <img src="front/img/logo-carousel/logo-2.png" alt="">
                        </div>
                    </div>
                    <div class="logo-item">
                        <div class="tablecell-inner">
                            <img src="front/img/logo-carousel/logo-3.png" alt="">
                        </div>
                    </div>
                    <div class="logo-item">
                        <div class="tablecell-inner">
                            <img src="front/img/logo-carousel/logo-4.png" alt="">
                        </div>
                    </div>
                    <div class="logo-item">
                        <div class="tablecell-inner">
                            <img src="front/img/logo-carousel/logo-5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Partner Logo Section end -->
@endsection



    




  

