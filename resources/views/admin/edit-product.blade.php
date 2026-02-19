<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ویرایش محصول | موبوتک</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body { background: #f6f7fb; }
    .card { border: 0; border-radius: 1rem; box-shadow: 0 10px 30px rgba(27,39,94,.08); }
    .btn-primary { background-color: #ef394e; border-color: #ef394e; }
    .btn-primary:hover { background-color: #d92d44; border-color: #d92d44; }
  </style>
</head>
<body>
  <nav class="navbar bg-white border-bottom sticky-top">
    <div class="container py-2 d-flex justify-content-between">
      <span class="fw-bold text-danger">ویرایش محصول</span>
      <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary btn-sm">بازگشت به داشبورد</a>
    </div>
  </nav>

  <main class="container py-4 py-md-5">
    @if($errors->any())
      <div class="alert alert-danger border-0 shadow-sm" role="alert">
        <div class="fw-bold mb-2">برخی فیلدها معتبر نیستند:</div>
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <section class="card">
      <div class="card-body p-4 p-md-5">
        <h1 class="h5 fw-bold mb-4">{{ $product['name'] }}</h1>

        <form method="POST" action="{{ route('admin.products.update', $product['slug']) }}" class="row g-3" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="col-12 col-md-6">
            <label class="form-label">نام محصول</label>
            <input class="form-control" name="name" value="{{ old('name', $product['name']) }}" required>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">برند</label>
            <input class="form-control" name="brand" value="{{ old('brand', $product['brand']) }}" required>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">دسته‌بندی</label>
            <select class="form-select" name="category" required>
              @foreach($categories as $category)
                <option value="{{ $category }}" @selected(old('category', $product['category']) === $category)>{{ $category }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">نشانک</label>
            <input class="form-control" name="badge" value="{{ old('badge', $product['badge']) }}" required>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">قیمت</label>
            <input class="form-control" name="price" value="{{ old('price', $product['price']) }}" required>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">قیمت قبل</label>
            <input class="form-control" name="old_price" value="{{ old('old_price', $product['old_price']) }}" required>
          </div>

          <div class="col-12">
            <label class="form-label">آدرس تصویر (اختیاری)</label>
            <input class="form-control" name="image" value="{{ old('image', $product['image']) }}">
          </div>

          <div class="col-12">
            <label class="form-label">آپلود تصویر جدید (اختیاری)</label>
            <input type="file" class="form-control" name="image_file" accept="image/*">
          </div>

          <div class="col-12">
            <label class="form-label">توضیحات</label>
            <textarea class="form-control" name="description" rows="4" required>{{ old('description', $product['description']) }}</textarea>
          </div>

          <div class="col-12">
            <label class="form-label">مشخصات (هر مورد در یک خط)</label>
            <textarea class="form-control" name="specs" rows="6" required>{{ old('specs', implode(PHP_EOL, $product['specs'])) }}</textarea>
          </div>

          <div class="col-12 d-flex gap-2 mt-2">
            <button class="btn btn-primary" type="submit">ذخیره تغییرات</button>
            <a class="btn btn-outline-secondary" href="{{ route('admin.index') }}">انصراف</a>
          </div>
        </form>
      </div>
    </section>
  </main>
</body>
</html>
