<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>فروشگاه موبایل و لپ‌تاپ | موبوتک</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">

  <style>
    :root{
      --primary:#ef394e;
      --primary-dark:#d92d41;
      --bg:#f6f7fb;
      --text:#0f172a;
      --muted:#667085;
      --card:#ffffff;
      --ring: rgba(239,57,78,.18);
    }
    body{background:var(--bg);font-family:IRANSans,Tahoma,sans-serif;color:var(--text)}
    a{color:inherit}
    .glass{
      background:rgba(255,255,255,.82);
      backdrop-filter: blur(12px);
      border-bottom:1px solid rgba(2,6,23,.08);
    }
    .rounded-16{border-radius:16px}
    .rounded-20{border-radius:20px}
    .shadow-soft{box-shadow:0 12px 35px rgba(15,23,42,.07)}
    .text-muted-2{color:var(--muted)}
    .btn-primary{background:var(--primary);border-color:var(--primary)}
    .btn-primary:hover{background:var(--primary-dark);border-color:var(--primary-dark)}
    .btn-outline-primary{border-color:rgba(239,57,78,.35); color:var(--primary)}
    .btn-outline-primary:hover{background:rgba(239,57,78,.08); border-color:rgba(239,57,78,.55); color:var(--primary-dark)}
    .chipbar{overflow:auto;white-space:nowrap;scrollbar-width:thin}
    .chipbar::-webkit-scrollbar{height:8px}
    .chipbar::-webkit-scrollbar-thumb{background:#d9d9df;border-radius:999px}
    .chip{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem .9rem;border-radius:999px;border:1px solid rgba(2,6,23,.1);background:#fff;font-weight:700;font-size:.86rem}
    .chip.active{background:rgba(239,57,78,.08);border-color:rgba(239,57,78,.35);color:var(--primary-dark)}
    .searchbox .input-group-text{background:#fff;border-left:0}
    .searchbox input{border-right:0}
    .searchbox input:focus{box-shadow:0 0 0 .25rem var(--ring)}
    .iconbtn{
      width:42px;height:42px;border-radius:14px;
      display:flex;align-items:center;justify-content:center;
      background:#fff;border:1px solid rgba(2,6,23,.1);
    }
    .iconbtn:hover{border-color:rgba(239,57,78,.35); box-shadow:0 10px 25px rgba(15,23,42,.06)}
    .hero-card{
      position:relative;
      overflow:hidden;
      border-radius:20px;
      background:linear-gradient(135deg, rgba(239,57,78,.12), rgba(255,107,124,.18));
      border:1px solid rgba(239,57,78,.15);
    }
    .hero-badge{
      display:inline-flex;align-items:center;gap:.5rem;
      background:#fff;border:1px solid rgba(2,6,23,.08);
      padding:.35rem .7rem;border-radius:999px;font-weight:800;font-size:.85rem;
    }
    .carousel-img{
      height:360px; object-fit:cover; border-radius:20px;
      filter:saturate(1.05);
    }
    @media (max-width: 992px){
      .carousel-img{height:240px}
    }

    .section-title{font-weight:900}
    .product-card{
      border:0;border-radius:20px;overflow:hidden;background:var(--card);
      box-shadow:0 12px 35px rgba(15,23,42,.07);
      transition:transform .2s ease,box-shadow .2s ease;
    }
    .product-card:hover{transform:translateY(-4px);box-shadow:0 18px 50px rgba(15,23,42,.12)}
    .product-img{height:220px;object-fit:cover;background:#f3f4f6}
    .badge-primary{background:var(--primary)}
    .price{font-weight:900;color:var(--primary);font-size:1.05rem}
    .old-price{color:#8b8b8b;text-decoration:line-through;font-weight:700;font-size:.85rem}
    .off{
      background:rgba(239,57,78,.1);
      border:1px solid rgba(239,57,78,.2);
      color:var(--primary-dark);
      padding:.2rem .55rem;border-radius:999px;font-weight:900;font-size:.75rem;
    }

    .deal-card{
      border-radius:20px;
      background:linear-gradient(135deg, var(--primary), #ff6b7c);
      color:#fff;
      box-shadow:0 14px 40px rgba(239,57,78,.25);
      overflow:hidden;
      position:relative;
    }
    .deal-card:after{
      content:"";
      position:absolute; inset:-60px -60px auto auto;
      width:180px;height:180px;border-radius:50%;
      background:rgba(255,255,255,.18);
      filter: blur(0px);
      transform: rotate(10deg);
    }
    .timer{
      display:flex; gap:.5rem; flex-wrap:wrap;
      margin-top:.75rem;
    }
    .timer .t{
      background:rgba(255,255,255,.16);
      border:1px solid rgba(255,255,255,.25);
      border-radius:14px;
      padding:.45rem .65rem;
      font-weight:900;
      min-width:70px;
      text-align:center;
    }

    .blog-card{
      border:1px solid rgba(2,6,23,.08);
      border-radius:20px; overflow:hidden; background:#fff;
      box-shadow:0 12px 35px rgba(15,23,42,.06);
      transition:transform .2s ease, box-shadow .2s ease;
    }
    .blog-card:hover{transform:translateY(-4px); box-shadow:0 18px 50px rgba(15,23,42,.10)}
    .blog-img{height:170px; object-fit:cover; background:#eef2ff}

    footer{
      background:#0b1220;
      color:rgba(255,255,255,.85);
    }
    footer a{color:rgba(255,255,255,.85); text-decoration:none}
    footer a:hover{color:#fff}
    .footer-box{
      background:rgba(255,255,255,.06);
      border:1px solid rgba(255,255,255,.10);
      border-radius:18px;
      padding:16px;
    }
  </style>
</head>

<body>

<!-- Header -->
<header class="sticky-top glass">
  <div class="container py-3">
    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">

      <a href="{{ route('home') }}" class="text-decoration-none d-flex align-items-center gap-2">
        <span class="fw-black fs-3" style="color:var(--primary);font-weight:900">موبوتک</span>
        <span class="badge rounded-pill text-bg-light border text-dark fw-semibold">Mobile • Laptop</span>
      </a>

      <!-- Search -->
      <form class="searchbox d-none d-md-block" role="search" action="{{ route('home') }}" method="GET">
        <div class="input-group shadow-soft rounded-20 overflow-hidden">
          <span class="input-group-text">🔎</span>
          <input type="search" name="q" value="{{ request('q') }}"
                 class="form-control"
                 placeholder="جستجوی محصول، برند یا مدل…"
                 style="min-width:360px">
          <button class="btn btn-primary fw-semibold px-4" type="submit">جستجو</button>
        </div>
      </form>

      <!-- Actions -->
      <div class="d-flex align-items-center gap-2">
        <a href="#" class="iconbtn" title="علاقه‌مندی‌ها">❤️</a>
        <a href="#" class="iconbtn" title="سبد خرید">🛒</a>
        <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary rounded-16 fw-semibold">
          پنل ادمین
        </a>
        <button type="button" class="btn btn-primary rounded-16 fw-semibold px-3">
          ورود / ثبت‌نام
        </button>
      </div>

    </div>

    <!-- Mobile search -->
    <form class="d-md-none mt-3" role="search" action="{{ route('home') }}" method="GET">
      <div class="input-group shadow-soft rounded-20 overflow-hidden">
        <span class="input-group-text bg-white">🔎</span>
        <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="جستجو…">
        <button class="btn btn-primary fw-semibold px-4" type="submit">بگرد</button>
      </div>
    </form>

    <!-- Categories -->
    <div class="d-flex align-items-center gap-2 mt-3">
      <div class="dropdown">
        <button class="btn btn-outline-primary rounded-16 fw-semibold dropdown-toggle" data-bs-toggle="dropdown">
          همه دسته‌ها
        </button>
        <ul class="dropdown-menu dropdown-menu-end rounded-16 shadow-soft">
          <li><a class="dropdown-item" href="{{ route('home') }}">همه</a></li>
          @foreach($categories as $category)
            <li>
              <a class="dropdown-item" href="{{ route('home', ['category' => $category]) }}">
                {{ $category }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      <nav class="chipbar flex-grow-1 pb-1" aria-label="دسته‌بندی‌ها">
        <div class="d-inline-flex gap-2">
          <a href="{{ route('home') }}" class="chip {{ request('category') ? '' : 'active' }}">همه</a>
          @foreach($categories as $category)
            <a href="{{ route('home', ['category' => $category, 'q' => request('q'), 'sort' => request('sort')]) }}"
               class="chip {{ request('category')===$category ? 'active' : '' }}">
              {{ $category }}
            </a>
          @endforeach
        </div>
      </nav>
    </div>
  </div>
</header>

<main class="container py-4">

  <!-- Hero + Slider -->
  <div class="row g-3 align-items-stretch mb-4">
    <div class="col-12 col-lg-5">
      <div class="hero-card p-4 h-100 shadow-soft">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
          <span class="hero-badge">🚚 ارسال سریع • ✅ ضمانت اصالت</span>
          <span class="badge text-bg-light border text-dark fw-semibold rounded-pill">پشتیبانی واقعی</span>
        </div>

        <h1 class="mt-3 mb-2 section-title" style="font-size:1.35rem;">
          خرید آنلاین موبایل و لپ‌تاپ با قیمت مناسب
        </h1>
        <div class="text-muted-2">بهترین برندها، بهترین قیمت‌ها، تجربه خرید مطمئن.</div>

        <div class="d-flex gap-2 mt-4 flex-wrap">
          <a href="#products" class="btn btn-primary rounded-16 fw-semibold px-4">مشاهده محصولات</a>
          <a href="#deals" class="btn btn-outline-primary rounded-16 fw-semibold px-4">پیشنهاد ویژه</a>
        </div>

        <div class="mt-4 p-3 bg-white rounded-16 border shadow-soft">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <div class="fw-bold">تعداد کالا</div>
              <div class="text-muted-2 small">موجودی به‌روز فروشگاه</div>
            </div>
            <div class="fs-3 fw-black" style="color:var(--primary);font-weight:900">{{ count($products) }}</div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-7">
      <div id="mainCarousel" class="carousel slide shadow-soft rounded-20 overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1600&auto=format&fit=crop"
                 class="d-block w-100 carousel-img" alt="بنر موبایل">
            <div class="carousel-caption text-end">
              <div class="bg-dark bg-opacity-50 p-3 rounded-16">
                <div class="fw-black fs-4">گوشی‌های پرچمدار</div>
                <div class="opacity-75">تخفیف‌های محدود همین امروز</div>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=1600&auto=format&fit=crop"
                 class="d-block w-100 carousel-img" alt="بنر لپ‌تاپ">
            <div class="carousel-caption text-end">
              <div class="bg-dark bg-opacity-50 p-3 rounded-16">
                <div class="fw-black fs-4">لپ‌تاپ‌های کاری و گیمینگ</div>
                <div class="opacity-75">ارسال سریع به سراسر کشور</div>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?q=80&w=1600&auto=format&fit=crop"
                 class="d-block w-100 carousel-img" alt="بنر اکسسوری">
            <div class="carousel-caption text-end">
              <div class="bg-dark bg-opacity-50 p-3 rounded-16">
                <div class="fw-black fs-4">لوازم جانبی اورجینال</div>
                <div class="opacity-75">هدفون، شارژر، کیف و بیشتر</div>
              </div>
            </div>
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </div>

  <!-- Deals / Special Offers -->
  <section id="deals" class="mb-4">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
      <div>
        <h2 class="h5 section-title m-0">پیشنهادات ویژه 🔥</h2>
        <div class="text-muted-2 small">تخفیف‌های محدود — فرصت رو از دست نده!</div>
      </div>
      <a href="#products" class="btn btn-outline-secondary btn-sm rounded-16 fw-semibold">دیدن همه محصولات</a>
    </div>

    <div class="row g-3">
      <div class="col-12 col-lg-4">
        <div class="deal-card p-4 h-100">
          <div class="fw-black fs-5">پیشنهاد امروز</div>
          <div class="opacity-90 mt-1">روی محصولات منتخب تخفیف ویژه داریم.</div>

          <div class="timer" id="dealTimer">
            <div class="t"><div id="tH">00</div><div class="small opacity-75">ساعت</div></div>
            <div class="t"><div id="tM">00</div><div class="small opacity-75">دقیقه</div></div>
            <div class="t"><div id="tS">00</div><div class="small opacity-75">ثانیه</div></div>
          </div>

          <a href="#products" class="btn btn-light mt-3 rounded-16 fw-semibold">مشاهده محصولات ویژه</a>
        </div>
      </div>

      <div class="col-12 col-lg-8">
        <div class="row g-3">
          <!-- 2 کارت نمونه (می‌تونی با دیتای واقعی جایگزین کنی) -->
          <div class="col-12 col-md-6">
            <div class="p-4 bg-white rounded-20 border shadow-soft h-100">
              <div class="d-flex justify-content-between align-items-center">
                <span class="off">تا ۱۵٪ تخفیف</span>
                <span class="text-muted-2 small">ویژه موبایل</span>
              </div>
              <div class="fw-black fs-5 mt-2">گوشی‌های سامسونگ سری S</div>
              <div class="text-muted-2 mt-1">بهترین انتخاب برای پرچمدارها.</div>
              <a href="{{ route('home', ['category' => 'موبایل']) }}" class="btn btn-outline-primary rounded-16 fw-semibold mt-3">
                رفتن به دسته موبایل
              </a>
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="p-4 bg-white rounded-20 border shadow-soft h-100">
              <div class="d-flex justify-content-between align-items-center">
                <span class="off">تا ۲۰٪ تخفیف</span>
                <span class="text-muted-2 small">ویژه لپ‌تاپ</span>
              </div>
              <div class="fw-black fs-5 mt-2">لپ‌تاپ‌های گیمینگ</div>
              <div class="text-muted-2 mt-1">قدرت بالا برای بازی و رندر.</div>
              <a href="{{ route('home', ['category' => 'لپ‌تاپ']) }}" class="btn btn-outline-primary rounded-16 fw-semibold mt-3">
                رفتن به دسته لپ‌تاپ
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Products header -->
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
    <div class="d-flex align-items-center gap-2">
      <h2 id="products" class="h5 section-title m-0">محصولات فروشگاه</h2>
      <span class="badge text-bg-light border text-dark fw-semibold">{{ count($products) }} کالا</span>
    </div>

    <form class="d-flex align-items-center gap-2" action="{{ route('home') }}" method="GET">
      <input type="hidden" name="q" value="{{ request('q') }}">
      <input type="hidden" name="category" value="{{ request('category') }}">
      <select class="form-select form-select-sm rounded-16" name="sort" style="min-width:190px">
        <option value="">مرتب‌سازی: پیش‌فرض</option>
        <option value="new" {{ request('sort')==='new' ? 'selected' : '' }}>جدیدترین</option>
        <option value="cheap" {{ request('sort')==='cheap' ? 'selected' : '' }}>ارزان‌ترین</option>
        <option value="expensive" {{ request('sort')==='expensive' ? 'selected' : '' }}>گران‌ترین</option>
      </select>
      <button class="btn btn-outline-secondary btn-sm rounded-16 fw-semibold" type="submit">اعمال</button>
    </form>
  </div>

  <!-- Products grid -->
  <div class="row g-3">
    @forelse($products as $product)
      <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
        <div class="card product-card h-100">
          <div class="position-relative">
            <img class="product-img w-100" src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
            @if(!empty($product['old_price']))
              <span class="position-absolute top-0 start-0 m-3 off">تخفیف</span>
            @endif
          </div>

          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <span class="badge badge-primary rounded-pill px-3 py-2 fw-semibold">{{ $product['badge'] }}</span>
              <span class="text-muted small">{{ $product['brand'] }}</span>
            </div>

            <h3 class="h6 fw-bold mb-2" style="line-height:1.8;">{{ $product['name'] }}</h3>
            <div class="text-muted-2 small mb-3">{{ $product['category'] }}</div>

            <div class="d-flex align-items-end justify-content-between">
              <div>
                <div class="price">{{ $product['price'] }} تومان</div>
                @if(!empty($product['old_price']))
                  <div class="old-price">{{ $product['old_price'] }}</div>
                @endif
              </div>

              <a href="{{ route('products.show', $product['slug']) }}"
                 class="btn btn-outline-primary btn-sm rounded-16 fw-semibold">
                مشاهده
              </a>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-light border rounded-16">
          محصولی برای نمایش وجود ندارد.
        </div>
      </div>
    @endforelse
  </div>

  <!-- Blog -->
  <section id="blog" class="mt-5">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
      <div>
        <h2 class="h5 section-title m-0">بلاگ موبوتک ✍️</h2>
        <div class="text-muted-2 small">راهنمای خرید، بررسی‌ها و نکات کاربردی</div>
      </div>
      <a href="#" class="btn btn-outline-secondary btn-sm rounded-16 fw-semibold">مشاهده همه مقالات</a>
    </div>

    <div class="row g-3">
      <div class="col-12 col-md-4">
        <div class="blog-card h-100">
          <img class="blog-img w-100" src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1200&auto=format&fit=crop" alt="مقاله ۱">
          <div class="p-3">
            <div class="text-muted-2 small">راهنمای خرید</div>
            <div class="fw-black mt-1" style="font-weight:900">چطور بهترین گوشی برای نیازت انتخاب کنی؟</div>
            <div class="text-muted-2 small mt-2">چند نکته مهم برای انتخاب درست قبل از خرید...</div>
            <a href="#" class="btn btn-outline-primary btn-sm rounded-16 fw-semibold mt-3">ادامه مطلب</a>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="blog-card h-100">
          <img class="blog-img w-100" src="https://images.unsplash.com/photo-1515879218367-8466d910aaa4?q=80&w=1200&auto=format&fit=crop" alt="مقاله ۲">
          <div class="p-3">
            <div class="text-muted-2 small">مقایسه</div>
            <div class="fw-black mt-1" style="font-weight:900">مقایسه لپ‌تاپ گیمینگ و کاری؛ کدام بهتره؟</div>
            <div class="text-muted-2 small mt-2">اگر بین دو مدل مردد هستی، این مقاله کمک می‌کنه...</div>
            <a href="#" class="btn btn-outline-primary btn-sm rounded-16 fw-semibold mt-3">ادامه مطلب</a>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="blog-card h-100">
          <img class="blog-img w-100" src="https://images.unsplash.com/photo-1518441902117-f0a0eec0d9d5?q=80&w=1200&auto=format&fit=crop" alt="مقاله ۳">
          <div class="p-3">
            <div class="text-muted-2 small">آموزشی</div>
            <div class="fw-black mt-1" style="font-weight:900">چطور عمر باتری گوشی رو بیشتر کنیم؟</div>
            <div class="text-muted-2 small mt-2">ترفندهای ساده ولی خیلی مؤثر برای باتری...</div>
            <a href="#" class="btn btn-outline-primary btn-sm rounded-16 fw-semibold mt-3">ادامه مطلب</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<!-- Footer -->
<footer class="mt-5 pt-5 pb-4">
  <div class="container">
    <div class="row g-3">
      <div class="col-12 col-lg-4">
        <div class="footer-box h-100">
          <div class="fw-black fs-4" style="font-weight:900">موبوتک</div>
          <div class="opacity-75 mt-2">فروش موبایل، لپ‌تاپ و لوازم جانبی با ضمانت اصالت و ارسال سریع.</div>
          <div class="d-flex gap-2 mt-3 flex-wrap">
            <span class="badge rounded-pill text-bg-light text-dark">✅ ضمانت اصالت</span>
            <span class="badge rounded-pill text-bg-light text-dark">🚚 ارسال سریع</span>
            <span class="badge rounded-pill text-bg-light text-dark">☎️ پشتیبانی</span>
          </div>
        </div>
      </div>

      <div class="col-6 col-lg-2">
        <div class="footer-box h-100">
          <div class="fw-bold mb-2">لینک‌های سریع</div>
          <div class="d-grid gap-2 small">
            <a href="#">درباره ما</a>
            <a href="#">تماس با ما</a>
            <a href="#">سوالات متداول</a>
            <a href="#blog">بلاگ</a>
          </div>
        </div>
      </div>

      <div class="col-6 col-lg-3">
        <div class="footer-box h-100">
          <div class="fw-bold mb-2">خدمات مشتریان</div>
          <div class="d-grid gap-2 small">
            <a href="#">پیگیری سفارش</a>
            <a href="#">رویه ارسال</a>
            <a href="#">رویه مرجوعی</a>
            <a href="#">حریم خصوصی</a>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-3">
        <div class="footer-box h-100">
          <div class="fw-bold mb-2">شبکه‌های اجتماعی</div>
          <div class="d-flex gap-2 flex-wrap">
            <a class="btn btn-outline-light btn-sm rounded-16" href="#">اینستاگرام</a>
            <a class="btn btn-outline-light btn-sm rounded-16" href="#">تلگرام</a>
            <a class="btn btn-outline-light btn-sm rounded-16" href="#">واتساپ</a>
          </div>
          <div class="small opacity-75 mt-3">© {{ date('Y') }} موبوتک — طراحی شده با Bootstrap</div>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // شمارش‌معکوس نمونه (مثلاً تا 6 ساعت آینده)
  const end = Date.now() + (6 * 60 * 60 * 1000);
  const pad = n => String(n).padStart(2,'0');

  function tick(){
    const diff = Math.max(0, end - Date.now());
    const s = Math.floor(diff/1000);
    const h = Math.floor(s/3600);
    const m = Math.floor((s%3600)/60);
    const sec = s%60;

    document.getElementById('tH').textContent = pad(h);
    document.getElementById('tM').textContent = pad(m);
    document.getElementById('tS').textContent = pad(sec);
  }
  tick();
  setInterval(tick, 1000);
</script>

</body>
</html>
