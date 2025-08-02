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
            <h1 class="m-0">all Article</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">all Article</li>
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
          <h3 class="card-title">all Article</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>title</th>
              <th>summary</th>
              <th>updated_at</th>
              <th>Category</th>
              <th>admin</th>
              <th>img</th>
              <th>DELETE/EDIT</th>
            </tr>
            </thead>
            <tbody>
              @forelse ($all_Blog as $article)
                  <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->summary }}</td>
                    <td>{{ $article->updated_at}}</td>
                    <td>{{ $article->category->name ?? 'غير محدد' }}</td>
                    <td>{{ $article->author->name ?? 'غير معروف' }}</td>
                    <td> <img width="50px" src="{{ asset('storage/' . $article->image) }}" alt="blog image"></td>
                    <td>
                      <!-- زر التعديل -->
                      <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-block btn-outline-success btn-lg">تعديل</a>
                  
                      <!-- زر الحذف -->
                      <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline-block; width: 100%;" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا المقال؟');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-block btn-danger btn-lg">حذف</button>
                      </form>
                    </td>
                  
                  
                  </tr>
                  @empty
                  <p>لا توجد مقالات لعرضها حالياً.</p>
              @endforelse
            
            </tbody>
            <tfoot>
            <tr>
              <th>title</th>
              <th>summary</th>
              <th>updated_at</th>
              <th>Category</th>
              <th>admin</th>
              <th>img</th>
              <th>DELETE/EDIT</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </section>
  </div>

</div>

@include('admin.layouts.js')

<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</script>
</body>
</html>
