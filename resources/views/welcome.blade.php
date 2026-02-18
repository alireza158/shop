<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>فروشگاه موبایل و لپ‌تاپ | موبوتک</title>

  <style>
    :root{
      --primary:#ef394e;
      --primary-dark:#d32f41;
      --text:#333;
      --muted:#555;
      --border:#e0e0e0;
      --bg:#fafafa;
      --white:#fff;
      --radius:12px;
      --shadow:0 2px 8px rgba(0,0,0,.08);
    }

    body{
      margin:0;
      font-family:IRANSans, Tahoma, sans-serif;
      background:var(--bg);
      color:var(--text);
      line-height:1.8;
    }
    a{ color:inherit; text-decoration:none; }

    img{ max-width:100%; display:block; border-radius:var(--radius); }

    .container{ width:min(1200px, 92%); margin:auto; }

    /* ------------------ Topbar ------------------ */
    .topbar{
      background:#fff;
      border-bottom:1px solid var(--border);
      font-size:13px;
      padding:8px 0;
      color:var(--muted);
    }

    .topbar-inner{
      display:flex;
      justify-content:space-between;
      align-items:center;
    }

    /* ------------------ Header ------------------ */
    .header{
      background:#fff;
      border-bottom:1px solid var(--border);
      position:sticky; top:0; z-index:20;
    }

    .nav{
      display:grid;
      grid-template-columns:auto 1fr auto;
      align-items:center;
      gap:20px;
      padding:14px 0;
    }

    .logo{
      font-size:22px;
      font-weight:900;
      color:var(--primary);
    }

    /* ------------------ Search ------------------ */
    .search{
      background:#f1f1f1;
      padding:10px 14px;
      border-radius:8px;
      display:flex;
      align-items:center;
      gap:10px;
      border:1px solid #ddd;
    }
    .search input{
      flex:1;
      border:none;
      background:none;
      outline:none;
      font-size:14px;
    }

    /* ------------------ Buttons ------------------ */
    .btn{
      padding:10px 16px;
      border-radius:8px;
      border:1px solid var(--border);
      background:#fff;
      cursor:pointer;
      font-weight:600;
      transition:.2s;
    }
    .btn:hover{ background:#f6f6f6; }

    .btn-primary{
      background:var(--primary);
      color:white;
      border:none;
    }
    .btn-primary:hover{ background:var(--primary-dark); }

    /* ------------------ Hero ------------------ */
    .hero{
      background:#fff;
      border-radius:var(--radius);
      padding:24px;
      margin-top:20px;
      display:grid;
      grid-template-columns:1.1fr .9fr;
      gap:24px;
      box-shadow:var(--shadow);
    }

    .hero h1{
      font-size:28px;
      margin-bottom:10px;
    }

    .hero p{
      color:var(--muted);
      max-width:48ch;
    }

    /* ------------------ Sections ------------------ */
    .section-title{
      margin:28px 0 14px;
      display:flex;
      align-items:center;
      justify-content:space-between;
    }

    .section-title h2{
      font-size:20px;
      font-weight:700;
    }

    .section-title a{
      color:var(--primary);
      font-weight:700;
    }

    /* ------------------ Cards ------------------ */
    .cards{
      display:grid;
      grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
      gap:16px;
    }
    .card{
      background:#fff;
      padding:14px;
      border-radius:var(--radius);
      border:1px solid var(--border);
      box-shadow:var(--shadow);
      transition:.2s;
    }
    .card:hover{
      box-shadow:0 4px 12px rgba(0,0,0,.12);
    }

    .card-link{ display:block; }

    .card-link:focus-visible{
      outline:2px solid var(--primary);
      outline-offset:4px;
      border-radius:var(--radius);
    }

    .card h3{
      font-size:15px;
      margin-top:8px;
      font-weight:700;
    }

    .price{
      margin-top:12px;
      color:var(--primary);
      font-weight:900;
    }
    .old{
      font-size:13px;
      color:#888;
      text-decoration:line-through;
      margin-right:6px;
    }

    .badge{
      background:var(--primary);
      color:#fff;
      padding:4px 10px;
      border-radius:6px;
      font-size:12px;
      font-weight:700;
      display:inline-block;
      margin-bottom:6px;
    }

    .view-product{
      display:inline-block;
      margin-top:10px;
      font-size:13px;
      color:var(--primary-dark);
      font-weight:700;
    }

    /* ------------------ Features ------------------ */
    .features{
      display:grid;
      grid-template-columns:repeat(auto-fit, minmax(200px,1fr));
      gap:12px;
      margin-top:20px;
    }
    .feature{
      background:#fff;
      padding:14px;
      border-radius:var(--radius);
      border:1px solid var(--border);
      text-align:center;
      font-weight:700;
      color:var(--muted);
    }

    /* ------------------ Promo (Banners) ------------------ */
    .grid{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:16px;
    }
    .promo{
      position:relative;
      border-radius:var(--radius);
      overflow:hidden;
      box-shadow:var(--shadow);
    }

    .promo .overlay{
      position:absolute;
      bottom:0;
      width:100%;
      padding:14px;
      background:rgba(0,0,0,.45);
      color:#fff;
      font-weight:700;
      font-size:16px;
    }

    /* ------------------ Brands ------------------ */
    .brands{
      display:grid;
      grid-template-columns:repeat(auto-fit, minmax(120px,1fr));
      gap:12px;
    }
    .brand{
      background:#fff;
      border:1px solid var(--border);
      padding:14px;
      text-align:center;
      border-radius:var(--radius);
      font-weight:700;
    }

    /* ------------------ Testimonials ------------------ */
    .testimonials{
      display:grid;
      grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));
      gap:16px;
    }
    .quote{
      background:#fff;
      padding:16px;
      border-radius:var(--radius);
      border:1px solid var(--border);
      box-shadow:var(--shadow);
    }
    .quote p{ color:var(--muted); }

    /* ------------------ FAQ ------------------ */
    .faq details{
      background:#fff;
      border:1px solid var(--border);
      padding:14px;
      border-radius:var(--radius);
      margin-bottom:10px;
    }

    .faq summary{
      cursor:pointer;
      font-weight:700;
    }

    /* ------------------ Footer ------------------ */
    footer{
      background:#fff;
      border-top:1px solid var(--border);
      margin-top:40px;
      padding:40px 0;
    }
    .footer-grid{
      display:grid;
      grid-template-columns:1.4fr 1fr 1fr;
      gap:20px;
    }
    footer p{ color:var(--muted); }

    /* ------------------ Responsive ------------------ */
    @media(max-width:900px){
      .nav{
        grid-template-columns:1fr;
        gap:12px;
      }
      .hero{ grid-template-columns:1fr; }
      .grid{ grid-template-columns:1fr; }
      .footer-grid{ grid-template-columns:1fr; }
    }
  </style>

</head>

<body>
  <div class="blob b1"></div>
  <div class="blob b2"></div>

  <div class="topbar">
    <div class="container topbar-inner">
      <p>ارسال سریع به سراسر ایران | ضمانت اصالت کالا | پشتیبانی ۲۴ ساعته</p>
      <p>021-12345678</p>
    </div>
  </div>

  <header class="header">
    <div class="container nav">
      <a href="#" class="logo"><span class="logo-dot"></span> موبوتک</a>

      <label class="search" aria-label="جستجو">
        🔎
        <input type="text" placeholder="جستجوی موبایل، لپ‌تاپ، لوازم جانبی..." />
      </label>

      <div class="actions">
        <button class="btn btn-light">ورود / ثبت‌نام</button>
        <button class="btn btn-primary">سبد خرید (۰)</button>
      </div>
    </div>
  </header>

  <main>
    <div class="container">

      <section class="hero">
        <div>
          <h1>فروشگاه تخصصی موبایل و لپ‌تاپ با بهترین قیمت و گارانتی معتبر</h1>
          <p>جدیدترین گوشی‌ها، لپ‌تاپ‌های حرفه‌ای، گیمینگ و دانشجویی به‌همراه تخفیف‌های روزانه، خرید اقساطی و ارسال فوری.</p>
          <div class="actions">
            <button class="btn btn-primary">مشاهده محصولات</button>
            <button class="btn btn-light">پیشنهاد ویژه امروز</button>
          </div>
        </div>

        <img src="https://picsum.photos/seed/tech-hero/900/560" alt="تصویر پیش‌فرض فروشگاه موبایل و لپ‌تاپ" />
      </section>

      <div class="features">
        <div class="feature">💳 خرید اقساطی تا ۱۲ ماه</div>
        <div class="feature">🚚 ارسال فوری در همان روز</div>
        <div class="feature">🛡️ ضمانت بازگشت ۷ روزه</div>
        <div class="feature">🎁 جشنواره تخفیف هفتگی</div>
      </div>

      <div class="section-title">
        <h2>دسته‌بندی‌های محبوب</h2>
        <a href="#">مشاهده همه</a>
      </div>

      <section class="cards">
        <article class="card">
          <img src="https://picsum.photos/seed/mobile-category/600/400" alt="گوشی موبایل" />
          <h3>گوشی موبایل</h3>
          <p>پرچمدار، میان‌رده و اقتصادی</p>
        </article>

        <article class="card">
          <img src="https://picsum.photos/seed/laptop-category/600/400" alt="لپ‌تاپ" />
          <h3>لپ‌تاپ</h3>
          <p>برنامه‌نویسی، گرافیک و گیمینگ</p>
        </article>

        <article class="card">
          <img src="https://picsum.photos/seed/tablet-category/600/400" alt="تبلت" />
          <h3>تبلت و آیپد</h3>
          <p>مناسب کار، درس و سرگرمی</p>
        </article>

        <article class="card">
          <img src="https://picsum.photos/seed/accessory-category/600/400" alt="لوازم جانبی" />
          <h3>لوازم جانبی</h3>
          <p>هدفون، پاوربانک، کیف و موس</p>
        </article>
      </section>

      <div class="section-title">
        <h2>پرفروش‌ترین محصولات</h2>
        <a href="#">مشاهده همه</a>
      </div>

      <section class="cards">
        @foreach($products as $product)
          <a href="{{ route('products.show', $product['slug']) }}" class="card-link" aria-label="مشاهده {{ $product['name'] }}">
            <article class="card">
              <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" />
              <span class="badge">{{ $product['badge'] }}</span>
              <h3>{{ $product['name'] }}</h3>
              <p class="price">{{ $product['price'] }} تومان <span class="old">{{ $product['old_price'] }}</span></p>
              <span class="view-product">مشاهده جزئیات محصول ←</span>
            </article>
          </a>
        @endforeach
      </section>

      <div class="section-title">
        <h2>بنرهای ویژه</h2>
      </div>

      <section class="grid">
        <article class="promo">
          <img src="https://picsum.photos/seed/promo-mobile/1200/700" alt="تخفیف ویژه گوشی" />
          <div class="overlay">جشنواره گوشی‌های پرچمدار تا ۲۰٪ تخفیف</div>
        </article>

        <article class="promo">
          <img src="https://picsum.photos/seed/promo-laptop/1200/700" alt="تخفیف ویژه لپ‌تاپ" />
          <div class="overlay">فروش ویژه لپ‌تاپ‌های گیمینگ و دانشجویی</div>
        </article>
      </section>

      <div class="section-title">
        <h2>برندهای موجود</h2>
      </div>

      <section class="brands">
        <div class="brand">Apple</div>
        <div class="brand">Samsung</div>
        <div class="brand">Xiaomi</div>
        <div class="brand">ASUS</div>
        <div class="brand">Lenovo</div>
        <div class="brand">HP</div>
        <div class="brand">Acer</div>
        <div class="brand">MSI</div>
      </section>

      <div class="section-title">
        <h2>نظر مشتریان</h2>
      </div>

      <section class="testimonials">
        <article class="quote">
          <p>«ارسال خیلی سریع بود و گوشی کاملاً پلمپ و با گارانتی رسید. قیمت هم از بازار بهتر بود.»</p>
          <strong>— سارا، تهران</strong>
        </article>

        <article class="quote">
          <p>«لپ‌تاپ گیمینگ خریدم، مشاوره عالی و حرفه‌ای بود. خیلی راحت انتخاب کردم.»</p>
          <strong>— مهدی، شیراز</strong>
        </article>

        <article class="quote">
          <p>«امکان خرید اقساطی و پشتیبانی بعد خرید واقعاً عالیه. پیشنهاد می‌کنم.»</p>
          <strong>— امیرحسین، اصفهان</strong>
        </article>
      </section>

      <div class="section-title">
        <h2>سوالات متداول</h2>
      </div>

      <section class="faq">
        <details open>
          <summary>آیا امکان خرید اقساطی وجود دارد؟</summary>
          <p>بله، می‌توانید از طریق درگاه اقساطی با بازپرداخت ۳ تا ۱۲ ماه خرید کنید.</p>
        </details>

        <details>
          <summary>زمان ارسال سفارش چقدر است؟</summary>
          <p>برای تهران همان روز و برای سایر شهرها بین ۱ تا ۳ روز کاری ارسال می‌شود.</p>
        </details>

        <details>
          <summary>محصولات گارانتی دارند؟</summary>
          <p>تمامی کالاها با ضمانت اصالت و گارانتی معتبر شرکتی عرضه می‌شوند.</p>
        </details>
      </section>

    </div>
  </main>

  <footer>
    <div class="container footer-grid">
      <div>
        <h4>موبوتک</h4>
        <p>مرجع خرید آنلاین موبایل و لپ‌تاپ با قیمت رقابتی، پشتیبانی تخصصی و ارسال سریع.</p>
      </div>

      <div>
        <h4>دسترسی سریع</h4>
        <p>موبایل</p>
        <p>لپ‌تاپ</p>
        <p>تخفیف‌ها</p>
        <p>تماس با ما</p>
      </div>

      <div>
        <h4>ارتباط با ما</h4>
        <p>تهران، خیابان ولیعصر</p>
        <p>021-12345678</p>
        <p>info@mobotech.ir</p>
      </div>
    </div>
  </footer>
</body>
</html>
