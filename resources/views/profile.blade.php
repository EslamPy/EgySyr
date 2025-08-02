@extends('dashboard')

@section('title', 'My Profile')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
    <a href="{{ route('dashboard') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Back to Dashboard
    </a>
</div>

<div class="row">
    <!-- Profile Information Card -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('profile/update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                        <small class="form-text text-muted">Email addresses cannot be changed for security reasons.</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Save Changes
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Password Change Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
            </div>
            <div class="card-body">
                <form action="{{ url('profile/password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <small class="form-text text-muted">Password must be at least 8 characters long.</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-key mr-1"></i> Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Profile Sidebar -->
    <div class="col-lg-4">
        <!-- Profile Image Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile Picture</h6>
            </div>
            <div class="card-body text-center">
                <img class="img-profile rounded-circle mb-3" src="https://placehold.it/150x150" width="150" height="150">
                <div class="mb-3">
                    <h5 class="font-weight-bold text-gray-800">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                    <p class="text-gray-600">{{ Auth::user()->email }}</p>
                </div>
                <button type="button" class="btn btn-primary btn-block">
                    <i class="fas fa-upload mr-1"></i> Change Picture
                </button>
            </div>
        </div>
        
        <!-- Account Stats Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Account Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-gray-600">Member Since</small>
                    <div class="font-weight-bold text-gray-800">{{ Auth::user()->created_at->format('F d, Y') }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-gray-600">Last Login</small>
                    <div class="font-weight-bold text-gray-800">{{ now()->format('F d, Y h:i A') }}</div>
                </div>
                <div>
                    <small class="text-gray-600">Account Status</small>
                    <div class="font-weight-bold text-success">Active</div>
                </div>
                
                <hr>
                
                <div class="text-center">
                    <a href="#" class="btn btn-danger btn-block">
                        <i class="fas fa-trash mr-1"></i> Delete Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 