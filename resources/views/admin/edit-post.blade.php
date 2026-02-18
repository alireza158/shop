<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ویرایش نوشته | موبوتک</title>
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
      <span class="fw-bold text-danger">ویرایش نوشته بلاگ</span>
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
        <h1 class="h5 fw-bold mb-4">{{ $post['title'] }}</h1>

        <form method="POST" action="{{ route('admin.posts.update', $post['slug']) }}" class="row g-3">
          @csrf
          @method('PUT')

          <div class="col-12">
            <label class="form-label">عنوان نوشته</label>
            <input class="form-control" name="title" value="{{ old('title', $post['title']) }}" required>
          </div>

          <div class="col-12">
            <label class="form-label">دسته نوشته</label>
            <input class="form-control" name="category" value="{{ old('category', $post['category']) }}" required>
          </div>

          <div class="col-12">
            <label class="form-label">خلاصه نوشته</label>
            <textarea class="form-control" name="excerpt" rows="5" required>{{ old('excerpt', $post['excerpt']) }}</textarea>
          </div>

          <div class="col-12">
            <label class="form-label">آدرس تصویر</label>
            <input class="form-control" name="image" value="{{ old('image', $post['image']) }}" required>
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
