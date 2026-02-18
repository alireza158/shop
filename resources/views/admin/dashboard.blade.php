<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>پنل ادمین | موبوتک</title>

  <!-- Bootstrap RTL -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <style>
    :root{
      --brand:#ef394e;
      --bg:#f6f7fb;
      --card-shadow: 0 12px 32px rgba(27,39,94,.08);
      --radius: 1.1rem;
    }
    body{ background: var(--bg); }
    .brand-text{ color: var(--brand) !important; }

    /* Sidebar */
    .sidebar{
      width: 280px;
      min-height: 100vh;
      position: sticky;
      top: 0;
      background: #fff;
      border-left: 1px solid rgba(0,0,0,.06);
    }
    .sidebar .nav-link{
      color: #1f2937;
      border-radius: .85rem;
      padding: .7rem .9rem;
      display: flex;
      align-items: center;
      gap: .6rem;
    }
    .sidebar .nav-link:hover{ background: rgba(239,57,78,.07); color: var(--brand); }
    .sidebar .nav-link.active{
      background: rgba(239,57,78,.12);
      color: var(--brand);
      font-weight: 700;
    }
    .sidebar .section-title{
      color: #6b7280;
      font-size: .8rem;
      font-weight: 800;
      letter-spacing: .2px;
    }

    /* Layout */
    .content{
      min-width: 0;
    }
    .app-card{
      border: 0;
      border-radius: var(--radius);
      box-shadow: var(--card-shadow);
      overflow: hidden;
    }
    .card-header-lite{
      background: #fff;
      border-bottom: 1px solid rgba(0,0,0,.06);
    }
    .page-title{ font-weight: 900; color: #111827; }
    .muted{ color:#6b7280; }

    /* Buttons */
    .btn-brand{
      background: var(--brand);
      border-color: var(--brand);
      color: #fff;
    }
    .btn-brand:hover{
      background: #d92d44;
      border-color: #d92d44;
      color: #fff;
    }
    .badge-soft{
      background: rgba(239,57,78,.10);
      color: var(--brand);
      border: 1px solid rgba(239,57,78,.18);
    }

    /* Tables */
    .table thead th{
      color: #6b7280;
      font-weight: 800;
      font-size: .9rem;
      white-space: nowrap;
    }
    .table td{ vertical-align: middle; }
    .table-hover tbody tr:hover{ background: rgba(15,23,42,.03); }

    /* Topbar */
    .topbar{
      position: sticky;
      top: 0;
      z-index: 1020;
      background: rgba(246,247,251,.85);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(0,0,0,.06);
    }

    /* Mobile sidebar offcanvas */
    @media (max-width: 991.98px){
      .sidebar{ position: static; min-height:auto; width: 100%; border-left: 0; }
    }
  </style>
</head>

<body>

  <!-- Mobile: Offcanvas Sidebar -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title fw-bold" id="sidebarOffcanvasLabel">
        <span class="brand-text">مدیریت موبوتک</span>
      </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
      <!-- Same menu as desktop -->
      <div class="d-flex align-items-center gap-2 mb-3">
        <div class="rounded-4 d-inline-flex align-items-center justify-content-center"
             style="width:44px;height:44px;background:rgba(239,57,78,.12);">
          <i class="bi bi-shield-lock brand-text fs-5"></i>
        </div>
        <div>
          <div class="fw-bold">پنل ادمین</div>
          <div class="small muted">مدیریت محصولات و بلاگ</div>
        </div>
      </div>

      <div class="section-title mb-2">منو</div>
      <nav class="nav flex-column gap-1">
        <a class="nav-link active" href="{{ route('admin.index') }}"><i class="bi bi-grid-1x2"></i> داشبورد</a>
        <a class="nav-link" href="#section-categories"><i class="bi bi-tags"></i> دسته‌بندی‌ها</a>
        <a class="nav-link" href="#section-add-product"><i class="bi bi-plus-circle"></i> افزودن محصول</a>
        <a class="nav-link" href="#section-products"><i class="bi bi-box-seam"></i> لیست محصولات</a>
        <a class="nav-link" href="#section-add-post"><i class="bi bi-pencil-square"></i> افزودن نوشته</a>
        <a class="nav-link" href="#section-posts"><i class="bi bi-journal-text"></i> مدیریت نوشته‌ها</a>
      </nav>

      <hr class="my-3">

      <div class="d-grid gap-2">
        <a class="btn btn-outline-secondary" href="{{ route('home') }}">
          <i class="bi bi-shop me-1"></i> مشاهده فروشگاه
        </a>
      </div>
    </div>
  </div>

  <div class="d-flex">
    <!-- Desktop Sidebar -->
    <aside class="sidebar d-none d-lg-block p-3">
      <a class="text-decoration-none d-flex align-items-center gap-2 mb-4" href="{{ route('admin.index') }}">
        <div class="rounded-4 d-inline-flex align-items-center justify-content-center"
             style="width:48px;height:48px;background:rgba(239,57,78,.12);">
          <i class="bi bi-shield-lock brand-text fs-4"></i>
        </div>
        <div>
          <div class="fw-bold brand-text">مدیریت موبوتک</div>
          <div class="small muted">پنل ادمین</div>
        </div>
      </a>

      <div class="section-title mb-2">منو</div>
      <nav class="nav flex-column gap-1">
        <a class="nav-link active" href="{{ route('admin.index') }}"><i class="bi bi-grid-1x2"></i> داشبورد</a>
        <a class="nav-link" href="#section-categories"><i class="bi bi-tags"></i> دسته‌بندی‌ها</a>
        <a class="nav-link" href="#section-add-product"><i class="bi bi-plus-circle"></i> افزودن محصول</a>
        <a class="nav-link" href="#section-products"><i class="bi bi-box-seam"></i> لیست محصولات</a>
        <a class="nav-link" href="#section-add-post"><i class="bi bi-pencil-square"></i> افزودن نوشته</a>
        <a class="nav-link" href="#section-posts"><i class="bi bi-journal-text"></i> مدیریت نوشته‌ها</a>
      </nav>

      <hr class="my-4">

      <div class="d-grid gap-2">
        <a class="btn btn-outline-secondary" href="{{ route('home') }}">
          <i class="bi bi-shop me-1"></i> مشاهده فروشگاه
        </a>
      </div>

      <div class="mt-4 p-3 rounded-4" style="background:rgba(15,23,42,.03);">
        <div class="small muted mb-1">وضعیت سیستم</div>
        <div class="fw-bold">همه چیز اوکیه ✅</div>
        <div class="small muted mt-1">آخرین بروزرسانی: {{ now()->format('Y/m/d H:i') }}</div>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="content flex-grow-1">

      <!-- Topbar -->
      <div class="topbar">
        <div class="container-fluid px-3 px-lg-4 py-3 d-flex align-items-center justify-content-between gap-2">
          <div class="d-flex align-items-center gap-2">
            <!-- Mobile menu button -->
            <button class="btn btn-outline-secondary d-lg-none" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
              <i class="bi bi-list"></i>
            </button>

            <div>
              <div class="page-title h5 mb-0">داشبورد ادمین</div>
              <div class="small muted">مدیریت محصولات، دسته‌بندی‌ها و بلاگ</div>
            </div>
          </div>

          <div class="d-flex align-items-center gap-2 flex-wrap">
            <span class="badge rounded-pill badge-soft px-3 py-2">
              <i class="bi bi-box-seam me-1"></i> {{ count($products) }} محصول
            </span>
            <span class="badge rounded-pill badge-soft px-3 py-2">
              <i class="bi bi-journal-text me-1"></i> {{ count($posts) }} نوشته
            </span>
            <a href="{{ route('home') }}" class="btn btn-brand">
              <i class="bi bi-shop me-1"></i> فروشگاه
            </a>
          </div>
        </div>
      </div>

      <main class="container-fluid px-3 px-lg-4 py-4 py-lg-5">

        @if(session('status'))
          <div class="alert alert-success border-0 shadow-sm rounded-4" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('status') }}
          </div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger border-0 shadow-sm rounded-4" role="alert">
            <div class="fw-bold mb-2"><i class="bi bi-exclamation-triangle me-1"></i> لطفاً خطاهای زیر را بررسی کنید:</div>
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- Stats -->
        <div class="row g-3 mb-4">
          <div class="col-12 col-md-4">
            <div class="app-card p-3">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <div class="small muted">تعداد محصولات</div>
                  <div class="h4 fw-black mb-0">{{ count($products) }}</div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center"
                     style="width:46px;height:46px;background:rgba(239,57,78,.12);">
                  <i class="bi bi-box-seam brand-text fs-4"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="app-card p-3">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <div class="small muted">نوشته‌های بلاگ</div>
                  <div class="h4 fw-black mb-0">{{ count($posts) }}</div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center"
                     style="width:46px;height:46px;background:rgba(239,57,78,.12);">
                  <i class="bi bi-journal-text brand-text fs-4"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="app-card p-3">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <div class="small muted">امروز</div>
                  <div class="h6 fw-bold mb-0">{{ now()->format('Y/m/d') }}</div>
                </div>
                <div class="rounded-4 d-inline-flex align-items-center justify-content-center"
                     style="width:46px;height:46px;background:rgba(239,57,78,.12);">
                  <i class="bi bi-calendar3 brand-text fs-4"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sections -->
        <div class="row g-4">

          <!-- Categories -->
          <div class="col-12 col-xl-4" id="section-categories">
            <section class="app-card">
              <div class="card-header-lite p-4">
                <div class="d-flex align-items-center gap-2">
                  <i class="bi bi-tags brand-text fs-5"></i>
                  <div>
                    <h2 class="h6 fw-bold mb-0">مدیریت دسته‌بندی‌ها</h2>
                    <div class="small muted">هر دسته‌بندی را در یک خط بنویسید (تکراری‌ها حذف می‌شوند)</div>
                  </div>
                </div>
              </div>
              <div class="p-4">
                <form method="POST" action="{{ route('admin.categories.update') }}" class="d-grid gap-3">
                  @csrf
                  @method('PUT')
                  <div>
                    <label for="categories" class="form-label small muted">دسته‌بندی‌ها</label>
                    <textarea id="categories" name="categories" rows="10" class="form-control rounded-4"
                              placeholder="مثلاً: گوشی موبایل">{{ old('categories', implode(PHP_EOL, $categories)) }}</textarea>
                  </div>
                  <button class="btn btn-brand rounded-4" type="submit">
                    <i class="bi bi-save me-1"></i> ذخیره دسته‌بندی‌ها
                  </button>
                </form>
              </div>
            </section>
          </div>

          <!-- Add Product -->
          <div class="col-12 col-xl-8" id="section-add-product">
            <section class="app-card">
              <div class="card-header-lite p-4">
                <div class="d-flex align-items-center gap-2">
                  <i class="bi bi-plus-circle brand-text fs-5"></i>
                  <div>
                    <h2 class="h6 fw-bold mb-0">افزودن محصول جدید</h2>
                    <div class="small muted">بعد از افزودن، محصول در صفحه اصلی نمایش داده می‌شود</div>
                  </div>
                </div>
              </div>

              <div class="p-4">
                <form method="POST" action="{{ route('admin.products.store') }}" class="row g-3">
                  @csrf

                  <div class="col-12 col-md-6">
                    <label class="form-label">نام محصول</label>
                    <input class="form-control rounded-4" name="name" value="{{ old('name') }}" required>
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label">برند</label>
                    <input class="form-control rounded-4" name="brand" value="{{ old('brand') }}" required>
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label">دسته‌بندی</label>
                    <input class="form-control rounded-4" list="admin-categories" name="category" value="{{ old('category') }}" required>
                    <datalist id="admin-categories">
                      @foreach($categories as $category)
                        <option value="{{ $category }}"></option>
                      @endforeach
                    </datalist>
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label">نشانک</label>
                    <input class="form-control rounded-4" name="badge" value="{{ old('badge') }}" required placeholder="مثلاً: پرفروش">
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label">قیمت</label>
                    <input class="form-control rounded-4" name="price" value="{{ old('price') }}" required placeholder="مثلاً: 12,500,000">
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label">قیمت قبل (اختیاری)</label>
                    <input class="form-control rounded-4" name="old_price" value="{{ old('old_price') }}" placeholder="مثلاً: 13,900,000">
                  </div>

                  <div class="col-12">
                    <label class="form-label">آدرس تصویر</label>
                    <input class="form-control rounded-4" name="image" value="{{ old('image') }}" required placeholder="https://...">
                  </div>

                  <div class="col-12">
                    <label class="form-label">توضیحات</label>
                    <textarea class="form-control rounded-4" name="description" rows="3" required>{{ old('description') }}</textarea>
                  </div>

                  <div class="col-12">
                    <label class="form-label">مشخصات (هر مورد در یک خط)</label>
                    <textarea class="form-control rounded-4" name="specs" rows="4" required
                              placeholder="مثلاً:
حافظه 256 گیگ
رم 8 گیگ
باتری 5000mAh">{{ old('specs') }}</textarea>
                  </div>

                  <div class="col-12 d-flex gap-2 flex-wrap">
                    <button class="btn btn-brand rounded-4" type="submit">
                      <i class="bi bi-check2-circle me-1"></i> افزودن محصول
                    </button>
                    <button class="btn btn-outline-secondary rounded-4" type="reset">
                      <i class="bi bi-arrow-counterclockwise me-1"></i> پاک کردن فرم
                    </button>
                  </div>
                </form>
              </div>
            </section>
          </div>

          <!-- Products List -->
          <div class="col-12" id="section-products">
            <section class="app-card">
              <div class="card-header-lite p-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                  <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-box-seam brand-text fs-5"></i>
                    <div>
                      <h2 class="h6 fw-bold mb-0">لیست محصولات</h2>
                      <div class="small muted">برای هر محصول می‌توانید اطلاعات کامل را ویرایش کنید</div>
                    </div>
                  </div>
                  <div class="d-flex gap-2 flex-wrap">
                    <div class="input-group">
                      <span class="input-group-text bg-white rounded-start-4"><i class="bi bi-search"></i></span>
                      <input class="form-control rounded-end-4" placeholder="جستجو (نمایشی)" disabled>
                    </div>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
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
                        <td>
                          <span class="badge rounded-pill text-bg-light border">
                            {{ $product['category'] }}
                          </span>
                        </td>
                        <td class="fw-bold brand-text">{{ $product['price'] }}</td>
                        <td class="text-center pe-4">
                          <a class="btn btn-sm btn-outline-primary rounded-4"
                             href="{{ route('admin.products.edit', $product['slug']) }}">
                            <i class="bi bi-pencil-square me-1"></i> ویرایش
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </section>
          </div>

          <!-- Add Post -->
          <div class="col-12 col-lg-5" id="section-add-post">
            <section class="app-card h-100">
              <div class="card-header-lite p-4">
                <div class="d-flex align-items-center gap-2">
                  <i class="bi bi-pencil-square brand-text fs-5"></i>
                  <div>
                    <h2 class="h6 fw-bold mb-0">افزودن نوشته بلاگ</h2>
                    <div class="small muted">نوشته‌ها داینامیک در صفحه اصلی نمایش داده می‌شوند</div>
                  </div>
                </div>
              </div>

              <div class="p-4">
                <form method="POST" action="{{ route('admin.posts.store') }}" class="row g-3">
                  @csrf

                  <div class="col-12">
                    <label class="form-label">عنوان نوشته</label>
                    <input class="form-control rounded-4" name="title" value="{{ old('title') }}" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">دسته نوشته</label>
                    <input class="form-control rounded-4" name="category" value="{{ old('category') }}" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">خلاصه نوشته</label>
                    <textarea class="form-control rounded-4" name="excerpt" rows="4" required>{{ old('excerpt') }}</textarea>
                  </div>

                  <div class="col-12">
                    <label class="form-label">آدرس تصویر</label>
                    <input class="form-control rounded-4" name="image" value="{{ old('image') }}" required placeholder="https://...">
                  </div>

                  <div class="col-12">
                    <button class="btn btn-brand rounded-4" type="submit">
                      <i class="bi bi-plus-circle me-1"></i> افزودن نوشته
                    </button>
                  </div>
                </form>
              </div>
            </section>
          </div>

          <!-- Posts List -->
          <div class="col-12 col-lg-7" id="section-posts">
            <section class="app-card h-100">
              <div class="card-header-lite p-4">
                <div class="d-flex align-items-center gap-2">
                  <i class="bi bi-journal-text brand-text fs-5"></i>
                  <div>
                    <h2 class="h6 fw-bold mb-0">مدیریت بلاگ و نوشته‌ها</h2>
                    <div class="small muted">می‌توانید نوشته‌ها را ویرایش یا حذف کنید</div>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                  <thead>
                    <tr>
                      <th class="ps-4">عنوان</th>
                      <th>دسته</th>
                      <th>خلاصه</th>
                      <th class="text-center pe-4">عملیات</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($posts as $post)
                      <tr>
                        <td class="ps-4 fw-semibold">{{ $post['title'] }}</td>
                        <td>
                          <span class="badge text-bg-light border rounded-pill">
                            {{ $post['category'] }}
                          </span>
                        </td>
                        <td class="small muted">{{ \Illuminate\Support\Str::limit($post['excerpt'], 70) }}</td>
                        <td class="pe-4">
                          <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                            <a class="btn btn-sm btn-outline-primary rounded-4"
                               href="{{ route('admin.posts.edit', $post['slug']) }}">
                              <i class="bi bi-pencil-square me-1"></i> ویرایش
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.posts.destroy', $post['slug']) }}"
                                  onsubmit="return confirm('از حذف این نوشته مطمئن هستید؟');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-outline-danger rounded-4">
                                <i class="bi bi-trash me-1"></i> حذف
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4" class="text-center p-4 muted">نوشته‌ای ثبت نشده است.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </section>
          </div>

        </div><!-- /row -->
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
