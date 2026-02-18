<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>پنل ادمین | موبوتک</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body { background: #f6f7fb; }
    .navbar-brand { letter-spacing: .3px; }
    .page-title { font-weight: 800; color: #222; }
    .card { border: 0; border-radius: 1rem; box-shadow: 0 10px 30px rgba(27,39,94,.08); }
    .table thead th { color: #6c757d; font-weight: 700; font-size: .9rem; }
    .badge-soft { background: #fff1f3; color: #ef394e; border: 1px solid #ffd9df; }
    .btn-primary { background-color: #ef394e; border-color: #ef394e; }
    .btn-primary:hover { background-color: #d92d44; border-color: #d92d44; }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container py-2">
      <a class="navbar-brand fw-bold text-danger" href="{{ route('admin.index') }}">مدیریت موبوتک</a>
      <div class="d-flex align-items-center gap-2">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">مشاهده فروشگاه</a>
      </div>
    </div>
  </nav>

  <main class="container py-4 py-md-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h1 class="page-title h4 mb-0">داشبورد ادمین</h1>
      <span class="badge rounded-pill badge-soft px-3 py-2">{{ count($products) }} محصول</span>
    </div>

    @if(session('status'))
      <div class="alert alert-success border-0 shadow-sm" role="alert">
        {{ session('status') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger border-0 shadow-sm" role="alert">
        <div class="fw-bold mb-2">لطفاً خطاهای زیر را بررسی کنید:</div>
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="row g-4">
      <div class="col-12 col-lg-4">
        <section class="card h-100">
          <div class="card-body p-4">
            <h2 class="h6 fw-bold mb-3">مدیریت دسته‌بندی‌ها</h2>
            <p class="text-secondary small mb-3">هر دسته‌بندی را در یک خط بنویسید. موارد تکراری خودکار حذف می‌شوند.</p>
            <form method="POST" action="{{ route('admin.categories.update') }}" class="d-grid gap-3">
              @csrf
              @method('PUT')
              <div>
                <label for="categories" class="form-label small text-secondary">دسته‌بندی‌ها</label>
                <textarea id="categories" name="categories" rows="10" class="form-control">{{ old('categories', implode(PHP_EOL, $categories)) }}</textarea>
              </div>
              <button class="btn btn-primary" type="submit">ذخیره دسته‌بندی‌ها</button>
            </form>
          </div>
        </section>
      </div>

      <div class="col-12 col-lg-8">
        <section class="card h-100">
          <div class="card-body p-0">
            <div class="p-4 border-bottom">
              <h2 class="h6 fw-bold mb-1">محصولات</h2>
              <p class="text-secondary small mb-0">برای هر محصول می‌توانید اطلاعات کامل را ویرایش کنید.</p>
            </div>
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead>
                  <tr>
                    <th class="ps-4">نام محصول</th>
                    <th>برند</th>
                    <th>دسته‌بندی</th>
                    <th>قیمت</th>
                    <th class="text-center pe-4">عملیات</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                    <tr>
                      <td class="ps-4 fw-semibold">{{ $product['name'] }}</td>
                      <td>{{ $product['brand'] }}</td>
                      <td><span class="badge rounded-pill text-bg-light border">{{ $product['category'] }}</span></td>
                      <td class="text-danger fw-bold">{{ $product['price'] }}</td>
                      <td class="text-center pe-4">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.edit', $product['slug']) }}">ویرایش</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
</body>
</html>
