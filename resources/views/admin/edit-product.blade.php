<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ویرایش محصول | موبوتک</title>
  <style>
    :root{--primary:#ef394e;--border:#e4e4e4;--bg:#f7f7f7;--white:#fff;--text:#333}
    body{margin:0;background:var(--bg);font-family:IRANSans,Tahoma,sans-serif;color:var(--text)}
    .container{width:min(900px,92%);margin:auto}
    .card{background:var(--white);border:1px solid var(--border);border-radius:12px;padding:16px;margin:20px 0}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .full{grid-column:1/-1}
    input,select,textarea{width:100%;padding:10px;border:1px solid var(--border);border-radius:8px;font:inherit}
    label{display:block;font-size:13px;margin-bottom:6px}
    .btn{padding:10px 14px;border-radius:8px;border:1px solid var(--border);background:#fff;text-decoration:none;color:inherit}
    .btn-primary{background:var(--primary);color:#fff;border:none;cursor:pointer}
    .actions{display:flex;gap:10px;margin-top:14px}
  </style>
</head>
<body>
  <main class="container">
    <section class="card">
      <h2>ویرایش محصول</h2>
      <form method="POST" action="{{ route('admin.products.update', $product['slug']) }}" class="grid">
        @csrf
        @method('PUT')

        <div>
          <label>نام محصول</label>
          <input name="name" value="{{ old('name', $product['name']) }}" required>
        </div>
        <div>
          <label>برند</label>
          <input name="brand" value="{{ old('brand', $product['brand']) }}" required>
        </div>
        <div>
          <label>دسته‌بندی</label>
          <select name="category" required>
            @foreach($categories as $category)
              <option value="{{ $category }}" @selected(old('category', $product['category']) === $category)>{{ $category }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label>نشانک</label>
          <input name="badge" value="{{ old('badge', $product['badge']) }}" required>
        </div>
        <div>
          <label>قیمت</label>
          <input name="price" value="{{ old('price', $product['price']) }}" required>
        </div>
        <div>
          <label>قیمت قبل</label>
          <input name="old_price" value="{{ old('old_price', $product['old_price']) }}" required>
        </div>
        <div class="full">
          <label>آدرس تصویر</label>
          <input name="image" value="{{ old('image', $product['image']) }}" required>
        </div>
        <div class="full">
          <label>توضیحات</label>
          <textarea name="description" rows="4" required>{{ old('description', $product['description']) }}</textarea>
        </div>
        <div class="full">
          <label>مشخصات (هر مورد در یک خط)</label>
          <textarea name="specs" rows="6" required>{{ old('specs', implode(PHP_EOL, $product['specs'])) }}</textarea>
        </div>

        <div class="actions full">
          <button class="btn btn-primary" type="submit">ذخیره تغییرات</button>
          <a class="btn" href="{{ route('admin.index') }}">انصراف</a>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
