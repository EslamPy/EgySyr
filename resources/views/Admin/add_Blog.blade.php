<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Add Article</title>
  <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
  @include('admin.layouts.css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  @include('admin.layouts.navbar')
  @include('admin.layouts.sidebar')

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add New Article</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Article</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="card card-outline card-info">
                <div class="card-header">
                  <h3 class="card-title">Article Information</h3>
                </div>
        
                <div class="card-body">
                  @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
        
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
        
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter article title" required>
                  </div>
        
                  <div class="form-group">
                    <label for="summary">Summary</label>
                    <input type="text" name="summary" class="form-control" placeholder="Short summary..." required>
                  </div>
        
                  <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control" required>
                      <option value="">-- Select Category --</option>
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>
        
                  <div class="form-group">
                    <label for="image">Image (webp)</label>
                    <input type="file" name="image" class="form-control" accept=".webp" required>
                  </div>
        
                  <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="summernote" name="content"></textarea>
                  </div>
        
                </div>
        
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Publish</button>
                </div>
        
              </div>
            </div>
          </div>
        </form>
        
      </div>
    </section>
  </div>

  @include('admin.layouts.footer')
</div>

@include('admin.layouts.js')
<script>
  $(function () {
    $('#summernote').summernote({
      height: 300
    });
  });
</script>
</body>
</html>
