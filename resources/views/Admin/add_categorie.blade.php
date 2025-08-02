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
            <h1 class="m-0">Add New categorie</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add categorie</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="card card-outline card-info">
                <div class="card-header">
                  <h3 class="card-title">categorie Information</h3>
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
                    <label for="name">name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter categorie name" required>
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
</body>
</html>
