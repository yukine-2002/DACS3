@extends('layouts.layout')
@section('title','detail Product')

@section('detailProduct')
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor', {
    filebrowserUploadUrl: '{{asset("detailProduct/layout/ckeditor/ck_upload.php")}}',
    filebrowserUploadMethod: 'form'
  });
</script>
@endsection

@section('mains')

<main style="max-width: 1300px;
    width: 100%;
    margin: auto;">
  <div class="card-wrapper">
    <div class="card">
      <div class="product-imgs">
        <div class="img-display">
          <div class="img-showcase">
            <img src="{{asset('layout/Img/')}}/{{ $detailProducts[0]['image'] }} " alt="" />
            @isset($detailImg[0]['img1'])
            <img src="{{asset('layout/Img/')}}/{{ $detailImg[0]['img1']  }} " alt="" />
            <img src="{{asset('layout/Img/')}}/{{ $detailImg[0]['img2'] }} " alt="" />
            <img src="{{asset('layout/Img/')}}/{{ $detailImg[0]['img3'] }} " alt="" />
            @endisset
          </div>
        </div>
        <div class="img-select">
          <div class="img-item">
            <a href="#" data-id="1">
              <img src="{{asset('layout/Img/')}}/{{ $detailProducts[0]['image'] }}" alt="" />
            </a>
          </div>
          @isset($detailImg[0]['img1'])
          <div class="img-item">
            <a href="#" data-id="2">
              <img src="{{asset('layout/Img/')}}/{{ $detailImg[0]['img1'] }}" alt="" />
            </a>
          </div>
          <div class="img-item">
            <a href="#" data-id="3">
              <img src="{{asset('layout/Img/')}}/{{ $detailImg[0]['img2'] }}" alt="" />
            </a>
          </div>
          <div class="img-item">
            <a href="#" data-id="4">
              <img src="{{asset('layout/Img/')}}/{{ $detailImg[0]['img3']}}" alt="" />
            </a>
          </div>
          @endisset
        </div>
      </div>
      <div class="product-content">
        <h4 class="product-title">{{$detailProducts[0]['name_pro'] }}</h4>
        <a href="{{route('product')}}" class="product-link">Quay tr??? l???i trang s???n ph???m</a>
        <div class="product-raiting">
          @if(!session('id'))
          <p style="color: brown;">????ng nh???p ????? ???????c ????nh gi?? s???n ph???m</p>
          @for($i = 1 ; $i<= 5 ; $i++) @if(FLOOR($tb)>= $i)
            <i class="fas fa-star  vang"></i>
            @endif
            @if(FLOOR($tb) < $i) <i class="fas fa-star "></i>
              @endif
              @endfor

              @endif
              @if(session('id'))
              @for($i = 1 ; $i<= 5 ; $i++) @if(FLOOR($tb)>= $i)
                <i class="fas fa-star fa-stars  vang"></i>
                @endif
                @if(FLOOR($tb) < $i) <i class="fas fa-star fa-stars "></i>
                  @endif
                  @endfor
                  @endif
                  <span class="tbRate">{{round($tb,2)}}<b class="countRate">({{$count}})</b></span>
        </div>
        <div class="product-price">
          @if($detailProducts[0]['price_new'] !== '')
          <p class="last-price">Gi?? c?? <span>{{$detailProducts[0]['price_old']}} VND</span></p>
          <p class="new-price">gi?? m???i <span>{{$detailProducts[0]['price_new']}} VND</span></p>
          @endif
          @if($detailProducts[0]['price_new'] === '')
          <p class="new-price">gi??: <span>{{$detailProducts[0]['price_old']}} VND</span></p>
          @endif
        </div>
        <div class="product-detail">
          <h2>Gi???i thi???u v??? s???n ph???m</h2>
          <div class="content-deltails">
            {!! html_entity_decode($detailProducts[0]['mieuta']) !!}
          </div>
          <ul>
            <li>Chi???u cao : <span> {{$detailProducts[0]['chieucao']}} cm</span></li>
            @if( $detailProducts[0]['id_Cate'] === 1)
            <li>Category : <span>Action figure</span> </li>
            @endif
            @if($detailProducts[0]['id_Cate'] === 2)
            <li>Category :<span>Chibi figure</span> </li>
            @endif
            @if($detailProducts[0]['id_Cate'] === 3)
            <li>Category :<span>Scale figure</span> </li>
            @endif
            @if($detailProducts[0]['id_Cate'] === 4)
            <li>Category : <span>BB figure</span> </li>
            @endif
            <li>S???n xu???t t???i : <span>{{ $detailProducts[0]['xuatsu'] }}</span></li>
            <li>Giao h??ng : <span>To??n qu???c</span></li>
          </ul>
        </div>
        @if($detailProducts[0]['soluong'] !== 0)
        <div class="purchase-info">     
          <input type="number" id="quantity" name="quantity" min="0" value="1">
          <button type="submit" class="btn addToCart"><a id="superman" href="">Add to cart</a> <i class="fas fa-shopping-cart"></i></button>
        </div>
        @endif
        <input type="hidden" class="id_pros" name="id" value="{{ $detailProducts[0]['id_pro'] }}">
        @if($detailProducts[0]['soluong'] === 0)
        <div class="purchase-info">
          <p style="color: red;"><b>S???n ph???m h???t h??ng</b></p>
        </div>
        @endif
      </div>
    </div>
  </div>

  <div class="slide">
    <div class="title">
      <h3>C?? th??? b???n mu???n xem th??m</h3>
    </div>
    <section class="slide-show-product">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          @foreach( $productRecommender as $productRecommenders )
          <div class="swiper-slide">
            <div class="slide-show">
              <div class="slide-show-img">
                <img src="{{asset('layout/Img')}}/{{ $productRecommenders['image'] }}" alt="gaixinh">
                <div class="bg"></div>
                <div class="line">
                  <h4>{{ $productRecommenders['name_pro'] }}</h4>
                </div>
              </div>
              <div class="slide-show-container">
                <div class="slide-show-title">
                  <h3>{{ $productRecommenders['name_pro'] }}</h3>
                </div>
                <div class="slide-show-price">
                  <strong>{{ $productRecommenders['price_new'] }} VND</strong>
                </div>
                @if($productRecommenders['soluong'] !== 0)
                <a href="../detailProduct/{{$productRecommenders['id_pro']}}">
                  <div class="slide-show-btn">
                    <button> Xem SP </button>
                  </div>
                </a>
                @endif
                @if($productRecommenders['soluong'] === 0)
                <div class="slide-show-btn">
                  <button type="button">H???t h??ng </button>
                </div>
                @endif
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div>

    </section>
  </div>
  <div class="comment">
    <div class="title-comment">
      <h3>B??nh lu???n</h3>
    </div>
    <div class="cdk-comment">
      @if(session() -> has('id'))
      <div class="input-comment">
        <form action="/commentDetailProduct" method="GET" class="form-comment">
          @CSRF
          <input type="hidden" id="id_user" value="{{ session('id') }}">
          <textarea name="content" id="editor"></textarea>
          <button>B??nh lu???n</button>
        </form>
      </div>
      @endif
      @if(!session() -> has('id'))
      <h3 style="color: aqua; width:100%">Vui l??ng ????ng nh???p ????? b??nh lu???n</h3>
      @endif
      <div class="show-comment">
        @foreach( $comment as $productLists)
        <input type="hidden" id="id_com" value="{{ $productLists['id_com'] }}">
        <div class="div-comment">
          <div class="div-comment-img">
            <img src="{{asset('layout/Img/gaixinh 600x600.png')}}" alt="">
          </div>
          <div class="commentContent">
            <div class="title-comment">
              <h4>{{$productLists['fullname']}}</h4>
              <span>{{$productLists['date']}}</span>
            </div>
            <div class="content">
              {!! html_entity_decode($productLists['content']) !!}
            </div>
            <div class="adv-comment feel-comment">
              <div class="like">
                <span class="countLike  ">{{ $productLists['like'] }}</span> <i class="far fa-thumbs-up likenek"></i>
              </div>
              <div class="dislike">
                <span class="countdisLike">{{ $productLists['dislike'] }}</span> <i class="far fa-thumbs-down dislienek"></i>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</main>
<div class="show-motife"></div>
@section('ajax')
<script src="{{asset('layout/Ajax/detailsProduct.js')}}"></script>
@stop()
@stop()