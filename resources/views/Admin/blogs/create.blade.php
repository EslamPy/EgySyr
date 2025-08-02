@extends('dashboard')

@section('title', 'Create Blog Post')

@section('additional_styles')
<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<!-- Dropzone CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">
<style>
    .note-editor .dropdown-toggle::after {
        display: none;
    }
    .taginput-container {
        display: flex;
        flex-wrap: wrap;
        padding: 0.375rem 0.75rem;
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        background-color: #fff;
        min-height: 38px;
    }
    .taginput-container.focus {
        border-color: #bac8f3;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    .tag {
        display: inline-flex;
        align-items: center;
        margin: 2px;
        padding: 3px 8px;
        background-color: #4e73df;
        color: white;
        border-radius: 3px;
        font-size: 0.85rem;
    }
    .tag-close {
        margin-left: 5px;
        cursor: pointer;
    }
    .tag-input {
        flex: 1;
        outline: none;
        border: none;
        min-width: 60px;
        background: transparent;
    }
    .tag-input:focus {
        outline: none;
    }
    .dropzone {
        border: 2px dashed #4e73df;
        border-radius: 5px;
        background: white;
    }
    .dropzone .dz-message {
        font-weight: 500;
        color: #6e707e;
    }
    .thumbnail-preview {
        position: relative;
        display: inline-block;
        margin: 10px;
    }
    .thumbnail-preview img {
        width: 120px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        border: 1px solid #d1d3e2;
    }
    .thumbnail-preview .remove-btn {
        position: absolute;
        top: -10px;
        right: -10px;
        background: #e74a3b;
        color: white;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        text-align: center;
        line-height: 22px;
        font-size: 10px;
        cursor: pointer;
    }
    .category-badge {
        display: inline-block;
        margin: 5px;
        padding: 5px 10px;
        border-radius: 15px;
        background-color: #4e73df;
        color: white;
        cursor: pointer;
        transition: all 0.2s;
    }
    .category-badge:hover {
        background-color: #2e59d9;
    }
    .category-badge.selected {
        background-color: #1cc88a;
    }
</style>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create New Blog Post</h1>
    <a href="{{ url('admin/blogs') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Back to All Posts
    </a>
</div>

<!-- Create Blog Post Form -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Post Information</h6>
    </div>
    <div class="card-body">
        <form action="{{ url('admin/blogs') }}" method="POST" enctype="multipart/form-data" id="blogPostForm">
            @csrf
            
            <!-- Title and Status Row -->
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Enter blog post title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status" class="font-weight-bold">Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Slug and Category Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="slug" class="font-weight-bold">Slug</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="slug-addon">/blog/</span>
                            </div>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Enter slug or leave empty for auto-generation" aria-describedby="slug-addon">
                        </div>
                        <small class="form-text text-muted">The slug will be automatically generated from the title if left empty.</small>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Category <span class="text-danger">*</span></label>
                        <div>
                            <input type="hidden" id="category_id" name="category_id" value="{{ old('category_id') }}">
                            <div class="category-badges">
                                @foreach(['Web Development', 'Design', 'Marketing', 'Business'] as $i => $category)
                                    <span class="category-badge" data-id="{{ $i + 1 }}">{{ $category }}</span>
                                @endforeach
                            </div>
                        </div>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Summary -->
            <div class="form-group">
                <label for="summary" class="font-weight-bold">Summary <span class="text-danger">*</span></label>
                <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="3" placeholder="Enter a brief summary of your post">{{ old('summary') }}</textarea>
                <small class="form-text text-muted">A short summary of your post (max 255 characters).</small>
                @error('summary')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Tags -->
            <div class="form-group">
                <label for="tags" class="font-weight-bold">Tags</label>
                <div class="taginput-container" id="tag-container">
                    <input type="text" id="tag-input" class="tag-input" placeholder="Add tags...">
                </div>
                <input type="hidden" name="tags" id="tags-hidden" value="{{ old('tags') }}">
                <small class="form-text text-muted">Press Enter or comma to add tags.</small>
                @error('tags')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <!-- Featured Image -->
            <div class="form-group">
                <label for="featured_image" class="font-weight-bold">Featured Image <span class="text-danger">*</span></label>
                <div class="dropzone" id="featured-image-dropzone"></div>
                <input type="hidden" name="featured_image" id="featured_image" value="{{ old('featured_image') }}">
                <small class="form-text text-muted">Upload a high-quality image for your post (recommended size: 1200x630px).</small>
                @error('featured_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <!-- Content -->
            <div class="form-group">
                <label for="content" class="font-weight-bold">Content <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- SEO Section -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">SEO Settings</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="meta_title" class="font-weight-bold">Meta Title</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" placeholder="Enter meta title">
                        <small class="form-text text-muted">If left empty, the post title will be used.</small>
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meta_description" class="font-weight-bold">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3" placeholder="Enter meta description">{{ old('meta_description') }}</textarea>
                        <small class="form-text text-muted">If left empty, the post summary will be used.</small>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Settings and Options -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Additional Settings</h6>
                </div>
                <div class="card-body">
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="featured" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="featured">Mark as Featured Post</label>
                        <small class="form-text text-muted">Featured posts will be displayed prominently on the website.</small>
                    </div>
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="allow_comments" name="allow_comments" value="1" {{ old('allow_comments', '1') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="allow_comments">Allow Comments</label>
                    </div>
                    <div class="form-group">
                        <label for="publish_date" class="font-weight-bold">Schedule Publication</label>
                        <input type="datetime-local" class="form-control @error('publish_date') is-invalid @enderror" id="publish_date" name="publish_date" value="{{ old('publish_date') }}">
                        <small class="form-text text-muted">If set, the post will be published at the specified date and time. Leave empty to publish immediately.</small>
                        @error('publish_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-save mr-2"></i> Save Post
                </button>
                <a href="{{ url('admin/blogs') }}" class="btn btn-secondary btn-lg px-5 ml-2">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<!-- Dropzone JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('#content').summernote({
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    // Upload image functionality would go here
                    for (let i = 0; i < files.length; i++) {
                        // Simulate upload
                        $(this).summernote('insertImage', 'https://via.placeholder.com/800x400', function($image) {
                            $image.css('max-width', '100%');
                        });
                    }
                }
            }
        });
        
        // Auto-generate slug from title
        $('#title').keyup(function() {
            if ($('#slug').val() == '') {
                let slug = $(this).val()
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
                $('#slug').val(slug);
            }
        });
        
        // Initialize tags input
        const tagContainer = document.querySelector('#tag-container');
        const tagInput = document.querySelector('#tag-input');
        const tagsHidden = document.querySelector('#tags-hidden');
        
        let tags = [];
        
        // Focus input when clicking on container
        tagContainer.addEventListener('click', function() {
            tagInput.focus();
            tagContainer.classList.add('focus');
        });
        
        // Remove focus class when input loses focus
        tagInput.addEventListener('blur', function() {
            tagContainer.classList.remove('focus');
        });
        
        // Add tag on Enter or comma
        tagInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                
                const tagText = tagInput.value.trim().replace(',', '');
                
                if (tagText !== '' && !tags.includes(tagText)) {
                    // Create tag
                    const tag = document.createElement('span');
                    tag.classList.add('tag');
                    tag.textContent = tagText;
                    
                    // Add close button
                    const closeBtn = document.createElement('span');
                    closeBtn.classList.add('tag-close');
                    closeBtn.textContent = '×';
                    closeBtn.addEventListener('click', function() {
                        const index = tags.indexOf(tagText);
                        if (index !== -1) {
                            tags.splice(index, 1);
                            updateTagsInput();
                        }
                        tag.remove();
                    });
                    
                    tag.appendChild(closeBtn);
                    tagContainer.insertBefore(tag, tagInput);
                    
                    // Add to tags array
                    tags.push(tagText);
                    updateTagsInput();
                    
                    // Clear input
                    tagInput.value = '';
                }
            }
        });
        
        function updateTagsInput() {
            tagsHidden.value = JSON.stringify(tags);
        }
        
        // Initialize existing tags if any
        if (tagsHidden.value) {
            try {
                tags = JSON.parse(tagsHidden.value);
                tags.forEach(tag => {
                    const tagElement = document.createElement('span');
                    tagElement.classList.add('tag');
                    tagElement.textContent = tag;
                    
                    const closeBtn = document.createElement('span');
                    closeBtn.classList.add('tag-close');
                    closeBtn.textContent = '×';
                    closeBtn.addEventListener('click', function() {
                        const index = tags.indexOf(tag);
                        if (index !== -1) {
                            tags.splice(index, 1);
                            updateTagsInput();
                        }
                        tagElement.remove();
                    });
                    
                    tagElement.appendChild(closeBtn);
                    tagContainer.insertBefore(tagElement, tagInput);
                });
            } catch (e) {
                console.error('Invalid tags JSON');
            }
        }
        
        // Initialize Dropzone
        Dropzone.autoDiscover = false;
        
        const featuredImageDropzone = new Dropzone('#featured-image-dropzone', {
            url: '/file/upload', // Replace with your upload endpoint
            paramName: 'file',
            maxFiles: 1,
            maxFilesize: 5, // MB
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            dictDefaultMessage: '<i class="fas fa-cloud-upload-alt fa-3x mb-3"></i><br>Drag and drop your image here or click to browse',
            dictRemoveFile: 'Remove',
            autoProcessQueue: false,
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                    
                    // For demo, generate a base64 string as if it was uploaded
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#featured_image').val(e.target.result);
                    };
                    reader.readAsDataURL(file);
                });
                
                this.on('removedfile', function() {
                    $('#featured_image').val('');
                });
            }
        });
        
        // Category selection
        $('.category-badge').click(function() {
            $('.category-badge').removeClass('selected');
            $(this).addClass('selected');
            $('#category_id').val($(this).data('id'));
        });
        
        // Form validation
        $('#blogPostForm').submit(function(e) {
            let valid = true;
            
            // Check required fields
            if ($('#title').val().trim() === '') {
                $('#title').addClass('is-invalid');
                valid = false;
            }
            
            if ($('#summary').val().trim() === '') {
                $('#summary').addClass('is-invalid');
                valid = false;
            }
            
            if ($('#category_id').val() === '') {
                $('.category-badges').after('<small class="text-danger">Please select a category</small>');
                valid = false;
            }
            
            if ($('#featured_image').val() === '') {
                $('#featured-image-dropzone').after('<small class="text-danger">Please upload a featured image</small>');
                valid = false;
            }
            
            let content = $('#content').summernote('code');
            if (content === '<p><br></p>' || content.trim() === '') {
                $('.note-editor').after('<small class="text-danger">Please enter some content</small>');
                valid = false;
            }
            
            if (!valid) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: 0 }, 'slow');
            }
        });
        
        // Initialize selected category if exists
        const categoryId = $('#category_id').val();
        if (categoryId) {
            $(`.category-badge[data-id="${categoryId}"]`).addClass('selected');
        }
    });
</script>
@endsection 