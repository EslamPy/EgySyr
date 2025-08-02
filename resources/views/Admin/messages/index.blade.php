@extends('dashboard')

@section('title', 'Messages Management')

@section('additional_styles')
<style>
    .message-list {
        max-height: 650px;
        overflow-y: auto;
    }
    .message-item {
        cursor: pointer;
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }
    .message-item:hover {
        background-color: rgba(78, 115, 223, 0.05);
    }
    .message-item.active {
        background-color: rgba(78, 115, 223, 0.1);
        border-left-color: #4e73df;
    }
    .message-item.unread {
        background-color: rgba(28, 200, 138, 0.05);
    }
    .message-item.unread .sender {
        font-weight: 700;
    }
    .message-item.unread .indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #1cc88a;
        display: inline-block;
        margin-right: 5px;
    }
    .message-preview {
        color: #858796;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .message-time {
        font-size: 0.7rem;
        color: #858796;
    }
    .message-content {
        min-height: 300px;
    }
    .message-actions {
        border-bottom: 1px solid #e3e6f0;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
    }
    .btn-circle.btn-xs {
        width: 1.25rem;
        height: 1.25rem;
        font-size: 0.65rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .status-badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
        border-radius: 10rem;
        display: inline-block;
    }
    .message-header {
        border-bottom: 1px solid #e3e6f0;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }
    .attachment-item {
        background: #f8f9fc;
        border-radius: 0.35rem;
        padding: 0.75rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    .attachment-icon {
        font-size: 1.5rem;
        margin-right: 0.75rem;
        color: #4e73df;
    }
    .attachment-info {
        flex: 1;
    }
    .attachment-actions {
        margin-left: 0.5rem;
    }
    .file-size {
        font-size: 0.7rem;
        color: #858796;
    }
    .reply-box {
        border-top: 1px solid #e3e6f0;
        padding-top: 1rem;
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Messages Management</h1>
    <div>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mr-2" id="markAllRead">
            <i class="fas fa-check fa-sm text-white-50 mr-1"></i> Mark All as Read
        </a>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#deleteSelectedModal">
            <i class="fas fa-trash fa-sm text-white-50 mr-1"></i> Delete Selected
        </a>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Message List Column -->
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">All Messages</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Filter By:</div>
                        <a class="dropdown-item" href="#" data-filter="all">All Messages</a>
                        <a class="dropdown-item" href="#" data-filter="unread">Unread Only</a>
                        <a class="dropdown-item" href="#" data-filter="read">Read Only</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-sort="newest">Sort by Newest</a>
                        <a class="dropdown-item" href="#" data-sort="oldest">Sort by Oldest</a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <!-- Search Box -->
                <div class="p-3">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search messages..." id="message-search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Message List -->
                <div class="message-list">
                    @for ($i = 1; $i <= 15; $i++)
                        @php
                            $isUnread = $i % 3 === 0;
                            $daysAgo = $i % 7;
                            $daysAgo = $daysAgo === 0 ? 'Today' : ($daysAgo === 1 ? 'Yesterday' : $daysAgo . ' days ago');
                            $names = [
                                'John Doe', 'Jane Smith', 'Robert Johnson', 'Emily Davis', 'Michael Wilson',
                                'Sarah Brown', 'David Miller', 'Lisa Anderson', 'James Taylor', 'Jennifer Thomas',
                                'Richard Garcia', 'Patricia Martinez', 'Charles Robinson', 'Linda Walker', 'Joseph Lee'
                            ];
                            $subjects = [
                                'Website Inquiry', 'Service Quote Request', 'Project Proposal', 'Feedback on Website',
                                'Partnership Opportunity', 'Job Application', 'Technical Support', 'Billing Question',
                                'Custom Project Request', 'Newsletter Subscription', 'Event Invitation',
                                'Collaboration Request', 'Media Inquiry', 'Product Information', 'General Question'
                            ];
                        @endphp
                        <div class="message-item p-3 border-bottom {{ $isUnread ? 'unread' : '' }}" data-id="{{ $i }}">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="mb-0 sender">
                                    @if($isUnread)
                                        <span class="indicator"></span>
                                    @endif
                                    {{ $names[$i-1] }}
                                </h6>
                                <small class="message-time">{{ $daysAgo }}</small>
                            </div>
                            <div class="font-weight-bold small mb-1">{{ $subjects[$i-1] }}</div>
                            <div class="small message-preview">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor velit eu magna hendrerit, at tempor purus aliquam.
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-xs">Showing 1-15 of 47 messages</span>
                    <div>
                        <button class="btn btn-sm btn-outline-primary mr-1">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Content Column -->
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary message-subject">Message Details</h6>
                <div>
                    <button class="btn btn-sm btn-primary" id="reply-btn">
                        <i class="fas fa-reply mr-1"></i> Reply
                    </button>
                </div>
            </div>
            <div class="card-body" id="message-detail-container">
                <!-- Message Loading Placeholder -->
                <div class="text-center p-5" id="message-placeholder">
                    <p class="text-gray-500">Select a message to view its contents</p>
                    <i class="fas fa-envelope fa-3x text-gray-300"></i>
                </div>

                <!-- Message Content (Initially Hidden) -->
                <div class="message-full d-none" id="message-content">
                    <div class="message-actions d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <button class="btn btn-sm btn-outline-primary mr-1">
                                <i class="fas fa-reply"></i> Reply
                            </button>
                            <button class="btn btn-sm btn-outline-secondary mr-1">
                                <i class="fas fa-forward"></i> Forward
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                        <div>
                            <button class="btn btn-circle btn-sm btn-outline-secondary mr-1" title="Previous Message">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-circle btn-sm btn-outline-secondary" title="Next Message">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="message-header">
                        <div class="row align-items-center mb-2">
                            <div class="col-auto">
                                <div class="avatar-circle bg-primary text-white font-weight-bold d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 50%;">JD</div>
                            </div>
                            <div class="col">
                                <h5 class="mb-0 font-weight-bold">John Doe</h5>
                                <div class="small text-gray-600">john.doe@example.com</div>
                            </div>
                            <div class="col-auto">
                                <span class="status-badge bg-success text-white">New</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="small text-gray-600">
                                    <strong>To:</strong> info@egysyr.com
                                </div>
                            </div>
                            <div class="col-md-4 text-md-right">
                                <div class="small text-gray-600">June 15, 2023, 10:30 AM</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="message-content mb-4">
                        <p>Hello,</p>
                        <p>I'm interested in your web development services and would like to discuss a potential project for my business. We are looking to revamp our existing website to make it more modern and mobile-friendly.</p>
                        <p>Our current website is outdated and doesn't reflect our brand identity anymore. We'd like to create a new site that focuses on user experience and has e-commerce capabilities.</p>
                        <p>Could you please provide me with information about your services, pricing structure, and the typical timeline for a project like this? Also, I'd like to know if you offer ongoing maintenance and support after the site goes live.</p>
                        <p>I look forward to hearing from you soon.</p>
                        <p>Best regards,<br>John Doe<br>Marketing Director<br>ABC Company</p>
                    </div>
                    
                    <div class="message-attachments mb-4">
                        <h6 class="font-weight-bold">Attachments (2)</h6>
                        <div class="attachment-item">
                            <div class="attachment-icon">
                                <i class="far fa-file-pdf"></i>
                            </div>
                            <div class="attachment-info">
                                <div class="font-weight-bold">Project_Requirements.pdf</div>
                                <div class="file-size">2.3 MB</div>
                            </div>
                            <div class="attachment-actions">
                                <button class="btn btn-circle btn-xs btn-outline-primary mr-1" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-circle btn-xs btn-outline-success" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                        <div class="attachment-item">
                            <div class="attachment-icon">
                                <i class="far fa-file-image"></i>
                            </div>
                            <div class="attachment-info">
                                <div class="font-weight-bold">Logo_Design.png</div>
                                <div class="file-size">1.7 MB</div>
                            </div>
                            <div class="attachment-actions">
                                <button class="btn btn-circle btn-xs btn-outline-primary mr-1" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-circle btn-xs btn-outline-success" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="reply-box d-none" id="reply-form">
                        <h6 class="font-weight-bold mb-3">Reply to John Doe</h6>
                        <form>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" placeholder="Type your reply here..."></textarea>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="attachmentInput">
                                    <label class="custom-file-label" for="attachmentInput">Attach files</label>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-secondary mr-2" id="cancel-reply">Cancel</button>
                                <button type="submit" class="btn btn-primary">Send Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Selected Modal -->
<div class="modal fade" id="deleteSelectedModal" tabindex="-1" role="dialog" aria-labelledby="deleteSelectedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSelectedModalLabel">Delete Selected Messages</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the selected messages? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete Selected</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Handle message item click
        $('.message-item').click(function() {
            // Update active state
            $('.message-item').removeClass('active');
            $(this).addClass('active');
            
            // If unread, mark as read
            if ($(this).hasClass('unread')) {
                $(this).removeClass('unread');
                $(this).find('.indicator').remove();
            }
            
            // Show message content and hide placeholder
            $('#message-placeholder').addClass('d-none');
            $('#message-content').removeClass('d-none');
            
            // Update message subject
            $('.message-subject').text($(this).find('.font-weight-bold').text());
            
            // In a real app, we would fetch the message content via AJAX here
            // For this demo, we'll just use the pre-populated content
        });
        
        // Handle reply button
        $('#reply-btn').click(function() {
            $('#reply-form').removeClass('d-none');
            $('html, body').animate({
                scrollTop: $('#reply-form').offset().top
            }, 500);
        });
        
        // Handle cancel reply
        $('#cancel-reply').click(function() {
            $('#reply-form').addClass('d-none');
        });
        
        // Handle message search
        $('#message-search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('.message-item').filter(function() {
                $(this).toggle(
                    $(this).text().toLowerCase().indexOf(value) > -1
                );
            });
        });
        
        // Handle mark all as read
        $('#markAllRead').click(function(e) {
            e.preventDefault();
            $('.message-item.unread').removeClass('unread').find('.indicator').remove();
        });
        
        // Handle filter dropdown options
        $('[data-filter]').click(function(e) {
            e.preventDefault();
            const filter = $(this).data('filter');
            
            if (filter === 'all') {
                $('.message-item').show();
            } else if (filter === 'unread') {
                $('.message-item').hide();
                $('.message-item.unread').show();
            } else if (filter === 'read') {
                $('.message-item').hide();
                $('.message-item:not(.unread)').show();
            }
        });
        
        // Handle sort dropdown options
        $('[data-sort]').click(function(e) {
            e.preventDefault();
            const sort = $(this).data('sort');
            const messageList = $('.message-list');
            const messageItems = messageList.children('.message-item').get();
            
            messageItems.sort(function(a, b) {
                const aId = parseInt($(a).data('id'));
                const bId = parseInt($(b).data('id'));
                
                if (sort === 'newest') {
                    return aId - bId; // Ascending order (newest first)
                } else {
                    return bId - aId; // Descending order (oldest first)
                }
            });
            
            $.each(messageItems, function(index, item) {
                messageList.append(item);
            });
        });
    });
</script>
@endsection 