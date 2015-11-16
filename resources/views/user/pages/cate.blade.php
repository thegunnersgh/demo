@extends('user.master')

@section('description', 'Đây là trang chủ')

@section('content')

<div id="maincontainer">
  <section id="product">
    <div class="container">
     <!--  breadcrumb -->  
      <ul class="breadcrumb">
        <li>
          <a href="#">Home</a>
          <span class="divider">/</span>
        </li>
        <li class="active">Category</li>
      </ul>
      <div class="row">        
        <!-- Sidebar Start-->
        <aside class="span3">
         <!-- Category-->  
          <div class="sidewidt">
            <h2 class="heading2"><span>Categories</span></h2>
            <ul class="nav nav-list categories">
              @foreach($cate_buy as $item)
              <li>
                <a href="{!! url('loai-san-pham',[$item->id, $item->alias]) !!}">{!! $item->name !!}</a>
              </li>
              @endforeach
            </ul>
          </div>
         
          <!-- Latest Product -->  

          <div class="sidewidt">
            <h2 class="heading2"><span>Latest Products</span></h2>
            <ul class="bestseller">

              @foreach($product_new as $item)
              <li>
                <img width="40" src="{!! asset('resources/upload/'.$item->image) !!}" alt="product" title="product">
                <a class="productname" href="{!! url('chi-tiet-san-pham', [$item->id, $item->alias]) !!}">{!! $item->name !!}</a>
                <span class="procategory">
                    <?php
                        $name_cate = DB::table('cates')->where('id', $item->cate_id)->select('name')->first();
                    ?>
                    {!! $name_cate->name !!}
                </span>
                <span class="price">{!! number_format($item->price, 0, ',', '.') !!}</span>
              </li>
              
              @endforeach

            </ul>
          </div>
          <!--  Must have -->  
          <div class="sidewidt">
          <h2 class="heading2"><span>Must have</span></h2>
          <div class="flexslider" id="mainslider">
            <ul class="slides">
              <li>
                <img src="img/product1.jpg" alt="" />
              </li>
              <li>
                <img src="img/product2.jpg" alt="" />
              </li>
            </ul>
          </div>
          </div>
        </aside>
        <!-- Sidebar End-->
        <!-- Category-->
        <div class="span9">          
          <!-- Category Products-->
          <section id="category">
            <div class="row">
              <div class="span9">
               <!-- Category-->
                <section id="categorygrid">
                  <ul class="thumbnails grid">
                    
                    @foreach($product_cate as $item)
                    <li class="span3">
                      <a class="prdocutname" href="{!! url('chi-tiet-san-pham', [$item->id, $item->alias]) !!}">{!! $item->name !!}</a>
                      <div class="thumbnail">
                        <a href="{!! url('chi-tiet-san-pham', [$item->id, $item->alias]) !!}"><img alt="" src="{!! asset('resources/upload/'.$item->image) !!}"></a>
                        <div class="pricetag">
                          <span class="spiral"></span><a href="{!! url('mua-hang',[$item->id, $item->alias]) !!}" class="productcart">ADD TO CART</a>
                          <div class="price">
                            <div class="pricenew">{!! number_format($item->price, 0, ',', '.') !!}</div>
                            <div class="priceold">$5000.00</div>
                          </div>
                        </div>
                      </div>
                    </li>
                    @endforeach

                  </ul>

                  <!-- Tong so trang{!! $product_cate->lastPage() !!} -->
                  <!-- $product_cate->currentPage(): trang hiện tại -->
                  <!-- $product_cate->lastPage(): tổng số trang -->
                  <div class="pagination pull-right">
                    <ul>
                      @if($product_cate->currentPage() != 1)
                        <li><a href="{!! str_replace('/?', '?', $product_cate->url($product_cate->currentPage()- 1 )) !!}">Prev</a></li>
                      @endif
                      @for($i = 1; $i <= $product_cate->lastPage(); $i++ )
                        <li class="{!! ($product_cate->currentPage() == $i)? 'active': '' !!}">
                          <a href="{!! str_replace('/?', '?', $product_cate->url($i)) !!}">{!! $i !!}</a>
                        </li>
                      @endfor
                      @if($product_cate->currentPage() != $product_cate->lastPage())
                        <li><a href="{!! str_replace('/?', '?', $product_cate->url($product_cate->currentPage()+ 1 )) !!}">Next</a>
                      @endif
                      </li>
                    </ul>
                  </div>
                </section>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection