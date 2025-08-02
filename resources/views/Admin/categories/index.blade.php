@extends('dashboard')

@section('title', 'Categories Management')

@section('additional_styles')
<style>
    .category-card {
        transition: all 0.3s;
    }
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem 0 rgba(58, 59, 69, 0.2) !important;
    }
    .category-count {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0,0,0,0.5);
        color: white;
        border-radius: 20px;
        padding: 2px 10px;
        font-size: 0.8rem;
    }
    .color-indicator {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 10px;
    }
    .modal-confirm {
        color: #636363;
        width: 400px;
        margin: 30px auto;
    }
    .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
    }
    .modal-confirm .modal-header {
        border-bottom: none;   
        position: relative;
    }
    .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -15px;
    }
    .modal-confirm .form-control, .modal-confirm .btn {
        min-height: 40px;
        border-radius: 3px; 
    }
    .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -5px;
    }
    .modal-confirm .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
    }
    .modal-confirm .icon-box {
        color: #fff;
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #82ce34;
        padding: 15px;
        text-align: center;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .modal-confirm .icon-box i {
        font-size: 58px;
        position: relative;
        top: 3px;
    }
    .modal-confirm.modal-dialog {
        margin-top: 80px;
    }
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
        background: #82ce34;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }
    .modal-confirm .btn:hover, .modal-confirm .btn:focus {
        background: #6fb32b;
        outline: none;
    }
</style>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Categories Management</h1>
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addCategoryModal">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add New Category
    </button>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-8">
        <!-- Categories List Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Sort By:</div>
                        <a class="dropdown-item" href="#">Name (A-Z)</a>
                        <a class="dropdown-item" href="#">Name (Z-A)</a>
                        <a class="dropdown-item" href="#">Most Posts</a>
                        <a class="dropdown-item" href="#">Newest First</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="categoriesTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Color</th>
                                <th>Post Count</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 6; $i++)
                                @php
                                    $colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#6f42c1'];
                                    $names = ['Web Development', 'Design', 'Marketing', 'Business', 'Technology', 'Tutorials'];
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td class="font-weight-bold">{{ $names[$i-1] }}</td>
                                    <td>{{ strtolower(str_replace(' ', '-', $names[$i-1])) }}</td>
                                    <td>
                                        <span class="color-indicator" style="background-color: {{ $colors[$i-1] }}"></span>
                                        <span class="small">{{ $colors[$i-1] }}</span>
                                    </td>
                                    <td>{{ rand(5, 50) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#editCategoryModal{{ $i }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#deleteCategoryModal{{ $i }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Category Modal -->
                                <div class="modal fade" id="editCategoryModal{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel{{ $i }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCategoryModalLabel{{ $i }}">Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ url('admin/categories/' . $i) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="edit_name{{ $i }}">Category Name</label>
                                                        <input type="text" class="form-control" id="edit_name{{ $i }}" name="name" value="{{ $names[$i-1] }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_slug{{ $i }}">Slug</label>
                                                        <input type="text" class="form-control" id="edit_slug{{ $i }}" name="slug" value="{{ strtolower(str_replace(' ', '-', $names[$i-1])) }}">
                                                        <small class="form-text text-muted">Leave empty to auto-generate from name</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_description{{ $i }}">Description (Optional)</label>
                                                        <textarea class="form-control" id="edit_description{{ $i }}" name="description" rows="3">Sample description for {{ $names[$i-1] }} category.</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_color{{ $i }}">Color</label>
                                                        <input type="color" class="form-control" id="edit_color{{ $i }}" name="color" value="{{ $colors[$i-1] }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Category Modal -->
                                <div class="modal fade" id="deleteCategoryModal{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel{{ $i }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteCategoryModalLabel{{ $i }}">Confirm Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete the category <strong>{{ $names[$i-1] }}</strong>?</p>
                                                <p class="text-danger">This action cannot be undone and will affect all associated posts.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ url('admin/categories/' . $i) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete Category</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Category Overview Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category Overview</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4">
                    <canvas id="categoryPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    @for ($i = 0; $i < 6; $i++)
                        @php
                            $colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#6f42c1'];
                            $names = ['Web Development', 'Design', 'Marketing', 'Business', 'Technology', 'Tutorials'];
                        @endphp
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: {{ $colors[$i] }}"></i> {{ $names[$i] }}
                        </span>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Recent Activity Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
            </div>
            <div class="card-body">
                <div class="activity-feed">
                    <div class="feed-item pb-3 mb-3 border-bottom">
                        <div class="d-flex align-items-center mb-2">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-plus text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">Today</div>
                                <span>New category <strong>Tutorials</strong> added</span>
                            </div>
                        </div>
                    </div>
                    <div class="feed-item pb-3 mb-3 border-bottom">
                        <div class="d-flex align-items-center mb-2">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-edit text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">Yesterday</div>
                                <span>Category <strong>Design</strong> updated</span>
                            </div>
                        </div>
                    </div>
                    <div class="feed-item pb-3 mb-3 border-bottom">
                        <div class="d-flex align-items-center mb-2">
                            <div class="mr-3">
                                <div class="icon-circle bg-danger">
                                    <i class="fas fa-trash text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">3 days ago</div>
                                <span>Category <strong>News</strong> deleted</span>
                            </div>
                        </div>
                    </div>
                    <div class="feed-item">
                        <div class="d-flex align-items-center mb-2">
                            <div class="mr-3">
                                <div class="icon-circle bg-info">
                                    <i class="fas fa-sync text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">1 week ago</div>
                                <span>Categories structure reorganized</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('admin/categories') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug">
                        <small class="form-text text-muted">Leave empty to auto-generate from name</small>
                    </div>
                    <div class="form-group">
                        <label for="description">Description (Optional)</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="color" class="form-control" id="color" name="color" value="#4e73df">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fas fa-check"></i>
                </div>				
                <h4 class="modal-title w-100">Success!</h4>	
            </div>
            <div class="modal-body">
                <p class="text-center">Your operation has been completed successfully.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#categoriesTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true,
            "pageLength": 10,
            "language": {
                "search": "Search:",
                "paginate": {
                    "previous": "&lt;",
                    "next": "&gt;"
                }
            }
        });
        
        // Auto-generate slug from name
        $('#name').keyup(function() {
            let slug = $(this).val()
                .toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            $('#slug').val(slug);
        });
        
        // Category Distribution Chart
        var ctx = document.getElementById("categoryPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Web Development", "Design", "Marketing", "Business", "Technology", "Tutorials"],
                datasets: [{
                    data: [35, 15, 12, 10, 18, 10],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#6f42c1'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617', '#5a3596'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 70,
            },
        });
        
        // Show success modal if needed
        @if(session('success'))
            $('#successModal').modal('show');
        @endif
    });
</script>
@endsection 