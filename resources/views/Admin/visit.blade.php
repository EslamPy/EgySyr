<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

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



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      {{-- @section('content') --}}
          <div class="container">
              <h1>تفاصيل الزيارات</h1>

              <form method="GET" action="{{ route('visits') }}" class="mb-4">
                  <div>
                      <label>من تاريخ:</label>
                      <input type="date" name="from" value="{{ request('from') }}">
                      <label>إلى تاريخ:</label>
                      <input type="date" name="to" value="{{ request('to') }}">
                      <label>الدولة:</label>
                      <select name="country">
                          <option value="">-- الكل --</option>
                          @foreach($countries as $country)
                              <option value="{{ $country }}" @selected(request('country') == $country)>
                                  {{ $country }}
                              </option>
                          @endforeach
                      </select>
                      <button type="submit">فلتر</button>
                  </div>
              </form>

              <p>إجمالي النتائج: {{ $total }}</p>

              <table border="1" cellpadding="5">
                  <thead>
                      <tr>
                          <th>IP</th>
                          <th>الدولة</th>
                          <th>تاريخ الزيارة</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($visits as $visit)
                          <tr>
                              <td>{{ $visit->ip }}</td>
                              <td>{{ $visit->country }}</td>
                              <td>{{ $visit->visited_at }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>

              {{ $visits->withQueryString()->links() }}
          </div>
      {{-- @endsection --}}

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('admin.layouts.footer')

  
</div>
<!-- ./wrapper -->

@include('admin.layouts.js')
</body>
</html>
