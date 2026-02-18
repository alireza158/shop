<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>پنل ادمین | موبوتک</title>
  <style>
    :root{--primary:#ef394e;--border:#e4e4e4;--bg:#f7f7f7;--white:#fff;--text:#333}
    body{margin:0;background:var(--bg);font-family:IRANSans,Tahoma,sans-serif;color:var(--text)}
    .container{width:min(1100px,92%);margin:auto}
    .header{background:var(--white);border-bottom:1px solid var(--border);padding:12px 0;margin-bottom:20px}
    .row{display:flex;justify-content:space-between;align-items:center;gap:12px}
    .card{background:var(--white);border:1px solid var(--border);border-radius:12px;padding:16px;margin-bottom:16px}
    .btn{border:1px solid var(--border);border-radius:8px;padding:8px 12px;background:#fff;text-decoration:none;color:inherit}
    .btn-primary{background:var(--primary);color:#fff;border:none;cursor:pointer}
    textarea,input,select{width:100%;padding:10px;border:1px solid var(--border);border-radius:8px;font:inherit}
    table{width:100%;border-collapse:collapse}
    th,td{padding:10px;border-bottom:1px solid var(--border);text-align:right;font-size:14px}
    .status{padding:10px;margin-bottom:10px;background:#e8fff0;border:1px solid #b6f0c5;border-radius:8px}
  </style>
</head>
<body>
  <header class="header">
    <div class="container row">
      <strong>پنل ادمین فروشگاه</strong>
      <a class="btn" href="{{ route('home') }}">بازگشت به فروشگاه</a>
    </div>
  </header>

  <main class="container">
    @if(session('status'))
      <div class="status">{{ session('status') }}</div>
    @endif

    <section class="card">
      <h3>ویرایش دسته‌بندی‌ها</h3>
      <p>هر دسته‌بندی را در یک خط وارد کنید.</p>
      <form method="POST" action="{{ route('admin.categories.update') }}">
        @csrf
        @method('PUT')
        <textarea name="categories" rows="6">{{ old('categories', implode(PHP_EOL, $categories)) }}</textarea>
        <div style="margin-top:12px">
          <button class="btn btn-primary" type="submit">ذخیره دسته‌بندی‌ها</button>
        </div>
      </form>
    </section>

    <section class="card">
      <h3>مدیریت محصولات</h3>
      <table>
        <thead>
          <tr>
            <th>نام</th>
            <th>برند</th>
            <th>دسته‌بندی</th>
            <th>قیمت</th>
            <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
            <tr>
              <td>{{ $product['name'] }}</td>
              <td>{{ $product['brand'] }}</td>
              <td>{{ $product['category'] }}</td>
              <td>{{ $product['price'] }}</td>
              <td><a class="btn" href="{{ route('admin.products.edit', $product['slug']) }}">ویرایش</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>
