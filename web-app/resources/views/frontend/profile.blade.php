@extends('frontend.layouts.master')

@section('content')
<main class="profile-page">
    <section class="profile-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="profile-card">
                        <div class="profile-header">
                            <h1 class="profile-title">My Profile</h1>
                            <p class="profile-subtitle">Welcome, {{ $user->name }}!</p>
                        </div>
                        <div class="profile-content">
                            <div class="profile-details">
                                <div class="detail-item">
                                    <i class="fas fa-user"></i>
                                    <span class="detail-label">Full Name:</span>
                                    <span class="detail-value">{{ $user->name }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-envelope"></i>
                                    <span class="detail-label">Email Address:</span>
                                    <span class="detail-value">{{ $user->email }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-calendar"></i>
                                    <span class="detail-label">Joined:</span>
                                    <span class="detail-value">{{ $user->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="profile-actions">
                                <a href="{{ route('logout') }}" class="btn logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/profile.css') }}">
@endsection