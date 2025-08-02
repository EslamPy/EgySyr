@extends('admin.layout')

@section('title', 'Blog Posts')

@section('styles')
<style>
    .blog-image {
        width: 80px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }
    .tag {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        border-radius: 50px;
        background-color: rgba(0, 71, 171, 0.1);
        color: var(--primary-color);
    }
    .blog-title {
        display: block;
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 0.25rem;
        font-weight: 500;
        color: var(--dark-color);
        text-decoration: none;
    }
    .blog-title:hover {
        color: var(--primary-color);
    }
    .status-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 0.5rem;
    }
    .status-dot.published {
        background-color: var(--secondary-color);
    }
    .status-dot.draft {
        background-color: var(--warning-color);
    }
    .filter-container {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    @media (min-width: 768px) {
        .filter-container {
            grid-template-columns: 2fr 1fr 1fr auto;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Title -->
<div class="page-title">
    <h1>Blog Posts</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog Posts</li>
        </ol>
    </nav>
</div>

<!-- Blog Management Card -->
<div class="card">
    <div class="card-header">
        <h5>All Blog Posts</h5>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i> Add New Post
        </a>
    </div>
    <div class="card-body">
        <!-- Filters -->
        <div class="filter-container mb-4">
            <div class="search-bar">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search blogs...">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="category-filter">
                <select class="form-select">
                    <option value="">All Categories</option>
                    <option value="1">Web Development</option>
                    <option value="2">Design</option>
                    <option value="3">Business</option>
                    <option value="4">Marketing</option>
                </select>
            </div>
            <div class="status-filter">
                <select class="form-select">
                    <option value="">All Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
            <div class="export-actions">
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-file-export me-1"></i> Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="far fa-file-excel me-2"></i>Excel</a></li>
                        <li><a class="dropdown-item" href="#"><i class="far fa-file-pdf me-2"></i>PDF</a></li>
                        <li><a class="dropdown-item" href="#"><i class="far fa-file-csv me-2"></i>CSV</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Blog Posts Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 20px">
                            <input type="checkbox" class="form-check-input" id="selectAll">
                        </th>
                        <th style="width: 80px">Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Views</th>
                        <th style="width: 120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 10; $i++)
                        @php
                            $title = "How to create a responsive website with modern design principles";
                            $categories = ['Web Development', 'Design', 'Business', 'Marketing'];
                            $statuses = ['published', 'draft'];
                            $status = $statuses[$i % 2];
                            $category = $categories[$i % 4];
                            $date = date('M d, Y', strtotime("-$i days"));
                            $views = rand(50, 2000);
                            $featured = $i % 5 == 0;
                        @endphp
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input post-checkbox">
                            </td>
                            <td>
                                <img src="https://via.placeholder.com/80x50" alt="Blog Image" class="blog-image">
                            </td>
                            <td>
                                <a href="{{ route('admin.blogs.edit', $i) }}" class="blog-title">{{ $title }}</a>
                                <div class="d-flex align-items-center">
                                    @if($featured)
                                        <span class="tag me-2">Featured</span>
                                    @endif
                                    <small class="text-muted">ID: #{{ $i }}</small>
                                </div>
                            </td>
                            <td>{{ $category }}</td>
                            <td>
                                <span class="d-flex align-items-center">
                                    <span class="status-dot {{ $status }}"></span>
                                    <span>{{ ucfirst($status) }}</span>
                                </span>
                            </td>
                            <td>{{ $date }}</td>
                            <td>{{ $views }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.blogs.edit', $i) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-info" title="Preview" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $i }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $i }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $i }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $i }}">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this blog post?</p>
                                                <p class="mb-0 text-danger"><small>This action cannot be undone.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.blogs.destroy', $i) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="pagination-info">
                <p class="text-muted mb-0">Showing <span class="fw-semibold">1-10</span> of <span class="fw-semibold">42</span> items</p>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all checkbox functionality
        const selectAllCheckbox = document.getElementById('selectAll');
        const postCheckboxes = document.querySelectorAll('.post-checkbox');
        
        selectAllCheckbox.addEventListener('change', function() {
            postCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
        
        // Update "Select All" checkbox when individual checkboxes change
        postCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const allChecked = Array.from(postCheckboxes).every(function(checkbox) {
                    return checkbox.checked;
                });
                
                const someChecked = Array.from(postCheckboxes).some(function(checkbox) {
                    return checkbox.checked;
                });
                
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            });
        });
    });
</script>
@endsection 