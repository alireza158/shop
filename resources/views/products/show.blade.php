<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $product['name'] }} | موبوتک</title>
  <style>
    :root{
      --primary:#ef394e;
      --primary-dark:#d32f41;
      --text:#333;
      --muted:#666;
      --border:#e8e8e8;
      --bg:#fafafa;
      --white:#fff;
      --radius:14px;
      --shadow:0 6px 24px rgba(0,0,0,.08);
    }

    *{ box-sizing:border-box; }
    body{
      margin:0;
      font-family:IRANSans, Tahoma, sans-serif;
      background:var(--bg);
      color:var(--text);
      line-height:1.9;
    }

    .container{ width:min(1100px, 92%); margin:auto; }

    .header{
      background:var(--white);
      border-bottom:1px solid var(--border);
      position:sticky;
      top:0;
      z-index:10;
    }

    .header-inner{
      display:flex;
      justify-content:space-between;
      align-items:center;
      padding:14px 0;
      gap:12px;
    }

    .logo{ color:var(--primary); font-size:22px; font-weight:900; text-decoration:none; }

    .btn{
      border:1px solid var(--border);
      border-radius:10px;
      background:#fff;
      padding:10px 14px;
      text-decoration:none;
      color:inherit;
      display:inline-block;
      font-weight:700;
    }

    .layout{
      margin-top:24px;
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:20px;
      align-items:start;
    }

    .card{
      background:var(--white);
      border:1px solid var(--border);
      border-radius:var(--radius);
      padding:18px;
      box-shadow:var(--shadow);
    }

    img{ width:100%; border-radius:12px; object-fit:cover; }

    .badge{
      display:inline-block;
      padding:6px 10px;
      background:var(--primary);
      color:#fff;
      border-radius:8px;
      font-size:13px;
      font-weight:700;
      margin-bottom:10px;
    }

    h1{ margin:0 0 6px; font-size:30px; line-height:1.4; }
    .meta{ color:var(--muted); margin-bottom:12px; }

    .price{
      color:var(--primary);
      font-size:28px;
      font-weight:900;
    }

    .old{
      color:#8e8e8e;
      text-decoration:line-through;
      font-size:14px;
      margin-right:8px;
    }

    ul{ margin:0; padding-right:18px; }

    .actions{
      display:flex;
      flex-wrap:wrap;
      gap:10px;
      margin-top:18px;
    }

    .btn-primary{
      background:var(--primary);
      color:#fff;
      border-color:transparent;
    }

    .btn-primary:hover{ background:var(--primary-dark); }

    .related{
      margin-top:30px;
    }

    .related-grid{
      display:grid;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
      gap:14px;
    }

    .related-card{
      background:#fff;
      border:1px solid var(--border);
      border-radius:12px;
      padding:12px;
      text-decoration:none;
      color:inherit;
    }

    .related-card h3{ font-size:15px; margin:10px 0 6px; }
    .related-card p{ margin:0; color:var(--primary-dark); font-weight:800; }

    @media (max-width: 900px){
      .layout{ grid-template-columns:1fr; }
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="container header-inner">
      <a href="{{ route('home') }}" class="logo">موبوتک</a>
      <a href="{{ route('home') }}" class="btn">← بازگشت به لیست محصولات</a>
    </div>
  </header>

  <main class="container">
    <section class="layout">
      <article class="card">
        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" />
      </article>

      <article class="card">
        <span class="badge">{{ $product['badge'] }}</span>
        <h1>{{ $product['name'] }}</h1>
        <p class="meta">برند {{ $product['brand'] }} | دسته‌بندی: {{ $product['category'] }}</p>

        <p class="price">{{ $product['price'] }} تومان <span class="old">{{ $product['old_price'] }}</span></p>

        <p>{{ $product['description'] }}</p>

        <h3>مشخصات کلیدی</h3>
        <ul>
          @foreach($product['specs'] as $spec)
            <li>{{ $spec }}</li>
          @endforeach
        </ul>

        <div class="actions">
          <button class="btn btn-primary">افزودن به سبد خرید</button>
          <button class="btn">مقایسه محصول</button>
        </div>
      </article>
    </section>

    <section class="related">
      <h2>محصولات مشابه</h2>
      <div class="related-grid">
        @foreach($relatedProducts as $related)
          <a class="related-card" href="{{ route('products.show', $related['slug']) }}">
            <img src="{{ $related['image'] }}" alt="{{ $related['name'] }}" />
            <h3>{{ $related['name'] }}</h3>
            <p>{{ $related['price'] }} تومان</p>
          </a>
        @endforeach
      </div>
    </section>
  </main>
</body>
</html>
