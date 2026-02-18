<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $product['name'] }} | موبوتک</title>

  <!-- Bootstrap 5 RTL -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">

  <!-- Optional: Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    /* Minimal custom styling on top of Bootstrap */
    body{
      background: #f6f7fb;
    }
    .glass-nav{
      background: rgba(255,255,255,.8);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(0,0,0,.06);
    }
    .product-media{
      border-radius: 1rem;
      overflow:hidden;
      background:#fff;
      border: 1px solid rgba(0,0,0,.06);
      box-shadow: 0 10px 25px rgba(0,0,0,.06);
    }
    .product-media img{
      width:100%;
      height:auto;
      display:block;
      aspect-ratio: 4/3;
      object-fit: cover;
    }
    .card-soft{
      border: 1px solid rgba(0,0,0,.06);
      box-shadow: 0 10px 25px rgba(0,0,0,.06);
      border-radius: 1rem;
    }
    .price{
      font-weight: 900;
      letter-spacing: -.3px;
    }
    .old-price{
      color:#8a8f98;
      text-decoration: line-through;
      font-weight: 700;
      font-size: .9rem;
    }
    .section-title{
      font-weight: 900;
      letter-spacing: -.3px;
    }
  </style>
</head>

<body>

  <!-- Top Nav -->
  <nav class="navbar glass-nav sticky-top">
    <div class="container py-2">
      <a class="navbar-brand fw-black text-danger d-flex align-items-center gap-2" href="{{ route('home') }}">
        <span class="fw-bold">موبوتک</span>
      </a>

      <a href="{{ route('home') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">
        <i class="bi bi-arrow-right"></i>
        بازگشت
      </a>
    </div>
  </nav>

  <main class="container my-4 my-lg-5">

    <!-- Breadcrumb (optional) -->
    <nav aria-label="breadcrumb" class="mb-3">
      <ol class="breadcrumb mb-0 small">
        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">خانه</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $product['name'] }}</li>
      </ol>
    </nav>

    <!-- Product -->
    <div class="row g-4 align-items-start">

      <!-- Image -->
      <div class="col-12 col-lg-6">
        <div class="product-media">
          <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
        </div>

        <!-- Small info row -->
        <div class="d-flex flex-wrap gap-2 mt-3">
          <span class="badge text-bg-light border rounded-pill px-3 py-2">
            <i class="bi bi-shield-check"></i>
            ضمانت اصالت
          </span>
          <span class="badge text-bg-light border rounded-pill px-3 py-2">
            <i class="bi bi-truck"></i>
            ارسال سریع
          </span>
          <span class="badge text-bg-light border rounded-pill px-3 py-2">
            <i class="bi bi-arrow-repeat"></i>
            ۷ روز بازگشت
          </span>
        </div>
      </div>

      <!-- Details -->
      <div class="col-12 col-lg-6">
        <div class="card card-soft">
          <div class="card-body p-4 p-lg-4">

            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
              @if(!empty($product['badge']))
                <span class="badge text-bg-danger rounded-pill px-3 py-2">{{ $product['badge'] }}</span>
              @endif
              <span class="badge text-bg-light border rounded-pill px-3 py-2">
                برند: {{ $product['brand'] }}
              </span>
              <span class="badge text-bg-light border rounded-pill px-3 py-2">
                دسته: {{ $product['category'] }}
              </span>
            </div>

            <h1 class="h4 h3-lg fw-black mb-3 section-title">{{ $product['name'] }}</h1>

            <!-- Price -->
            <div class="d-flex align-items-baseline gap-3 mb-3">
              <div class="h3 text-danger mb-0 price">
                {{ $product['price'] }} <span class="fs-6 fw-bold text-muted">تومان</span>
              </div>

              @if(!empty($product['old_price']))
                <div class="old-price">{{ $product['old_price'] }} تومان</div>
              @endif
            </div>

            <!-- Description -->
            <p class="text-secondary mb-4" style="line-height:2;">
              {{ $product['description'] }}
            </p>

            <!-- Specs -->
            <div class="mb-4">
              <div class="fw-bold mb-2">مشخصات کلیدی</div>
              <div class="d-flex flex-wrap gap-2">
                @foreach($product['specs'] as $spec)
                  <span class="badge text-bg-light border rounded-pill px-3 py-2">{{ $spec }}</span>
                @endforeach
              </div>
            </div>

            <!-- Actions -->
            <div class="d-grid d-sm-flex gap-2">
              <button class="btn btn-danger rounded-pill px-4 py-2 fw-bold">
                <i class="bi bi-bag-plus"></i>
                افزودن به سبد خرید
              </button>
              <button class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">
                <i class="bi bi-bar-chart"></i>
                مقایسه
              </button>
              <button class="btn btn-light border rounded-pill px-4 py-2 fw-bold">
                <i class="bi bi-heart"></i>
                علاقه‌مندی
              </button>
            </div>

          </div>
        </div>
      </div>

    </div>

    <!-- Related Products -->
    <section class="mt-5">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h5 mb-0 section-title">محصولات مشابه</h2>
        <a class="text-decoration-none small" href="{{ route('home') }}">مشاهده همه</a>
      </div>

      <div class="row g-3">
        @foreach($relatedProducts as $related)
          <div class="col-12 col-sm-6 col-lg-3">
            <a href="{{ route('products.show', $related['slug']) }}" class="text-decoration-none text-dark">
              <div class="card card-soft h-100">
                <img src="{{ $related['image'] }}" alt="{{ $related['name'] }}" class="card-img-top"
                     style="aspect-ratio:4/3; object-fit:cover; border-top-left-radius:1rem; border-top-right-radius:1rem;">
                <div class="card-body">
                  <div class="fw-bold mb-2" style="line-height:1.9;">{{ $related['name'] }}</div>
                  <div class="text-danger fw-black">
                    {{ $related['price'] }} <span class="text-muted fw-bold">تومان</span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </section>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
