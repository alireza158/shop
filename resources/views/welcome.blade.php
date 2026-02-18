<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>فروشگاه موبایل و لپ‌تاپ | موبوتک</title>
  <style>
    :root{--primary:#ef394e;--text:#333;--muted:#666;--border:#e5e5e5;--bg:#f7f7f7;--white:#fff;}
    *{box-sizing:border-box}
    body{margin:0;font-family:IRANSans,Tahoma,sans-serif;background:var(--bg);color:var(--text)}
    .container{width:min(1150px,92%);margin:auto}
    .header{background:var(--white);border-bottom:1px solid var(--border);position:sticky;top:0;z-index:20}
    .top{display:flex;justify-content:space-between;align-items:center;padding:14px 0;gap:12px}
    .logo{font-size:24px;color:var(--primary);font-weight:900;text-decoration:none}
    .actions{display:flex;gap:8px}
    .btn{padding:9px 14px;border:1px solid var(--border);border-radius:9px;background:var(--white);text-decoration:none;color:inherit;font-weight:700}
    .btn-primary{background:var(--primary);border-color:transparent;color:#fff}
    .category-nav{display:flex;gap:10px;overflow:auto;padding:0 0 14px}
    .category-pill{white-space:nowrap;padding:7px 12px;border-radius:999px;background:#f3f3f3;border:1px solid var(--border);font-size:13px}
    .section-title{display:flex;justify-content:space-between;align-items:center;margin:22px 0 14px}
    .cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:15px;padding-bottom:30px}
    .card{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:12px;box-shadow:0 4px 20px rgba(0,0,0,.04)}
    .card img{width:100%;height:190px;object-fit:cover;border-radius:10px}
    .badge{display:inline-block;margin-top:8px;background:var(--primary);color:#fff;padding:4px 10px;border-radius:8px;font-size:12px;font-weight:700}
    .card h3{font-size:15px;margin:8px 0 4px;line-height:1.7}
    .meta{color:var(--muted);font-size:13px}
    .price{margin-top:8px;color:var(--primary);font-weight:900}
    .old{margin-right:6px;color:#8a8a8a;text-decoration:line-through;font-size:12px}
    .link{display:inline-block;margin-top:8px;text-decoration:none;color:#b42335;font-weight:700}
  </style>
</head>
<body>
  <header class="header">
    <div class="container">
      <div class="top">
        <a href="{{ route('home') }}" class="logo">موبوتک</a>
        <div class="actions">
          <a href="{{ route('admin.index') }}" class="btn">پنل ادمین</a>
          <button class="btn btn-primary">ورود</button>
        </div>
      </div>
      <nav class="category-nav" aria-label="دسته‌بندی‌ها">
        @foreach($categories as $category)
          <span class="category-pill">{{ $category }}</span>
        @endforeach
      </nav>
    </div>
  </header>

  <main class="container">
    <div class="section-title">
      <h2>محصولات فروشگاه</h2>
      <small>{{ count($products) }} کالا</small>
    </div>

    <section class="cards">
      @foreach($products as $product)
        <article class="card">
          <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" />
          <span class="badge">{{ $product['badge'] }}</span>
          <h3>{{ $product['name'] }}</h3>
          <p class="meta">{{ $product['brand'] }} | {{ $product['category'] }}</p>
          <p class="price">{{ $product['price'] }} تومان <span class="old">{{ $product['old_price'] }}</span></p>
          <a class="link" href="{{ route('products.show', $product['slug']) }}">مشاهده محصول ←</a>
        </article>
      @endforeach
    </section>
  </main>
</body>
</html>
