<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>فروشگاه موبایل و لپ‌تاپ | موبوتک</title>
    <style>
        :root {
            --bg: #f4f7fb;
            --card: #ffffff;
            --primary: #2563eb;
            --secondary: #1e293b;
            --muted: #64748b;
            --success: #16a34a;
            --warning: #f59e0b;
            --danger: #dc2626;
            --shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            --radius: 18px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Tahoma, Arial, sans-serif;
        }

        body {
            background: var(--bg);
            color: var(--secondary);
            line-height: 1.8;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: min(1180px, 92%);
            margin: auto;
        }

        .topbar {
            background: #0f172a;
            color: #fff;
            font-size: 14px;
            padding: 8px 0;
        }

        .topbar-inner,
        .nav,
        .hero,
        .cards,
        .grid,
        .brands,
        .testimonials,
        .features,
        .footer-grid {
            display: grid;
            gap: 20px;
        }

        .topbar-inner {
            grid-template-columns: 1fr auto;
            align-items: center;
        }

        .header {
            background: #fff;
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: var(--shadow);
        }

        .nav {
            grid-template-columns: auto 1fr auto;
            align-items: center;
            padding: 14px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
        }

        .logo-dot {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #38bdf8);
        }

        .search {
            background: #f1f5f9;
            border-radius: 999px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn {
            border: none;
            border-radius: 999px;
            padding: 10px 18px;
            cursor: pointer;
            font-weight: 700;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
        }

        .btn-light {
            background: #e2e8f0;
            color: var(--secondary);
        }

        main {
            padding: 30px 0 60px;
        }

        .hero {
            grid-template-columns: 1.1fr 0.9fr;
            align-items: center;
            background: linear-gradient(130deg, #1d4ed8, #0ea5e9);
            color: #fff;
            border-radius: var(--radius);
            padding: 34px;
            box-shadow: var(--shadow);
        }

        .hero h1 {
            font-size: clamp(28px, 4vw, 44px);
            line-height: 1.35;
            margin-bottom: 16px;
        }

        .hero p {
            margin-bottom: 20px;
            color: #e0f2fe;
        }

        .hero img {
            width: 100%;
            border-radius: 14px;
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.3);
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 34px 0 16px;
        }

        .section-title h2 {
            font-size: 24px;
        }

        .section-title a {
            color: var(--primary);
            font-weight: 700;
        }

        .cards {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        .card {
            background: var(--card);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 16px;
        }

        .card img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            border-radius: 14px;
            margin-bottom: 10px;
        }

        .badge {
            font-size: 12px;
            color: #fff;
            background: var(--danger);
            border-radius: 999px;
            padding: 4px 10px;
        }

        .price {
            color: var(--success);
            font-weight: 800;
            margin-top: 8px;
        }

        .old {
            color: var(--muted);
            text-decoration: line-through;
            font-size: 14px;
            margin-right: 8px;
        }

        .features {
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            margin-top: 20px;
        }

        .feature {
            background: #dbeafe;
            border: 1px solid #bfdbfe;
            border-radius: 14px;
            padding: 14px;
            text-align: center;
            font-weight: 700;
        }

        .grid {
            grid-template-columns: 1fr 1fr;
        }

        .promo {
            border-radius: var(--radius);
            overflow: hidden;
            min-height: 250px;
            position: relative;
            box-shadow: var(--shadow);
        }

        .promo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .promo .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(0deg, rgba(15, 23, 42, 0.75), transparent);
            color: #fff;
            display: flex;
            align-items: end;
            padding: 20px;
            font-size: 22px;
            font-weight: 800;
        }

        .brands {
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            text-align: center;
        }

        .brand {
            background: #fff;
            border-radius: 12px;
            padding: 16px 8px;
            box-shadow: var(--shadow);
            font-weight: 700;
            color: #334155;
        }

        .testimonials {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .quote {
            background: #fff;
            border-radius: 14px;
            padding: 16px;
            box-shadow: var(--shadow);
            border-right: 5px solid #60a5fa;
        }

        .faq details {
            background: #fff;
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 12px;
            box-shadow: var(--shadow);
        }

        footer {
            background: #0f172a;
            color: #cbd5e1;
            margin-top: 44px;
            padding: 38px 0;
        }

        .footer-grid {
            grid-template-columns: 1.4fr 1fr 1fr;
        }

        .footer-grid h4 {
            color: #fff;
            margin-bottom: 10px;
        }

        @media (max-width: 900px) {
            .hero,
            .grid,
            .nav,
            .footer-grid,
            .topbar-inner {
                grid-template-columns: 1fr;
            }

            .actions {
                justify-content: start;
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="container topbar-inner">
            <p>ارسال سریع به سراسر ایران | ضمانت اصالت کالا | پشتیبانی ۲۴ ساعته</p>
            <p>021-12345678</p>
        </div>
    </div>

    <header class="header">
        <div class="container nav">
            <a href="#" class="logo"><span class="logo-dot"></span> موبوتک</a>
            <label class="search">
                🔎
                <input type="text" placeholder="جستجوی موبایل، لپ‌تاپ، لوازم جانبی...">
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
                <img src="https://picsum.photos/seed/tech-hero/900/560" alt="تصویر پیش‌فرض فروشگاه موبایل و لپ‌تاپ">
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
                <article class="card"><img src="https://picsum.photos/seed/mobile-category/600/400" alt="گوشی موبایل"><h3>گوشی موبایل</h3><p>پرچمدار، میان‌رده و اقتصادی</p></article>
                <article class="card"><img src="https://picsum.photos/seed/laptop-category/600/400" alt="لپ‌تاپ"><h3>لپ‌تاپ</h3><p>برنامه‌نویسی، گرافیک و گیمینگ</p></article>
                <article class="card"><img src="https://picsum.photos/seed/tablet-category/600/400" alt="تبلت"><h3>تبلت و آیپد</h3><p>مناسب کار، درس و سرگرمی</p></article>
                <article class="card"><img src="https://picsum.photos/seed/accessory-category/600/400" alt="لوازم جانبی"><h3>لوازم جانبی</h3><p>هدفون، پاوربانک، کیف و موس</p></article>
            </section>

            <div class="section-title">
                <h2>پرفروش‌ترین محصولات</h2>
                <a href="#">مشاهده همه</a>
            </div>
            <section class="cards">
                <article class="card">
                    <img src="https://picsum.photos/seed/product-1/600/400" alt="محصول ۱">
                    <span class="badge">۱۵٪ تخفیف</span>
                    <h3>iPhone 15 Pro Max 256GB</h3>
                    <p class="price">۹۱,۵۰۰,۰۰۰ تومان <span class="old">۱۰۷,۰۰۰,۰۰۰</span></p>
                </article>
                <article class="card">
                    <img src="https://picsum.photos/seed/product-2/600/400" alt="محصول ۲">
                    <span class="badge" style="background: var(--warning)">پیشنهاد ویژه</span>
                    <h3>Samsung Galaxy S24 Ultra</h3>
                    <p class="price">۷۳,۹۰۰,۰۰۰ تومان <span class="old">۸۰,۰۰۰,۰۰۰</span></p>
                </article>
                <article class="card">
                    <img src="https://picsum.photos/seed/product-3/600/400" alt="محصول ۳">
                    <span class="badge" style="background: #0ea5e9">جدید</span>
                    <h3>MacBook Air M3 13"</h3>
                    <p class="price">۶۶,۴۰۰,۰۰۰ تومان <span class="old">۷۱,۰۰۰,۰۰۰</span></p>
                </article>
                <article class="card">
                    <img src="https://picsum.photos/seed/product-4/600/400" alt="محصول ۴">
                    <span class="badge" style="background: #6366f1">محبوب</span>
                    <h3>ASUS TUF Gaming F15</h3>
                    <p class="price">۵۴,۸۰۰,۰۰۰ تومان <span class="old">۵۹,۲۰۰,۰۰۰</span></p>
                </article>
            </section>

            <div class="section-title">
                <h2>بنرهای ویژه</h2>
            </div>
            <section class="grid">
                <article class="promo">
                    <img src="https://picsum.photos/seed/promo-mobile/1200/700" alt="تخفیف ویژه گوشی">
                    <div class="overlay">جشنواره گوشی‌های پرچمدار تا ۲۰٪ تخفیف</div>
                </article>
                <article class="promo">
                    <img src="https://picsum.photos/seed/promo-laptop/1200/700" alt="تخفیف ویژه لپ‌تاپ">
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
