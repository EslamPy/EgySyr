<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Add Article</title>
  <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
  @include('admin.layouts.css')


  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
            <h1 class="m-0">review details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">review details</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              
          </div>
      @endif

      @if (session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              
          </div>
      @endif

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">review details</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <p><strong>profile image:</strong>
              <img src="{{ asset($review->profile_image) }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
          </p>
          <p><strong>Name:</strong> {{ $review->full_name }}</p>
          <p><strong>Service type:</strong> {{ $review->service_type }}</p>
          <p><strong>Status:</strong> {{ $review->status }}</p>
          <p><strong>Comment:</strong> {{ $review->comment }}</p>
      
          <form action="{{ route('reviews.toggleStatus', $review->id) }}" method="POST" style="margin-top: 10px;">
              @csrf
              @method('PUT')
              <button type="submit" class="btn btn-primary">
                  @if ($review->status === 'Under review')
                    Post evaluation
                  @else
                    Return for review
                  @endif
              </button>
          </form>
      </div>
      
        <!-- /.card-body -->
      </div>
    </section>
  </div>

</div>

@include('admin.layouts.js')



</body>
</html>
