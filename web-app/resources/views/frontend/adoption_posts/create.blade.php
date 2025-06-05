@extends('frontend.layouts.master')

@section('content')
<main class="adoption-create-page">
    <section class="adoption-create-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="create-card">
                        <h2 class="section-title">Create an Adoption Post</h2>
                        <p class="section-subtitle">Help a pet find a loving home by creating an adoption post.</p>
                        <div class="create-action text-center">
                            <a href="{{ route('adoption-posts.form') }}" class="btn create-btn">
                                <i class="fas fa-plus-circle"></i> Add Post
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<style>
    .adoption-create-page {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Poppins', sans-serif;
        padding: 40px 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .adoption-create-section {
        width: 100%;
    }

    .create-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-align: center;
    }

    .create-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .section-title {
        font-size: 2rem;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 15px;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 30px;
    }

    .create-btn {
        background: #ff5733;
        color: white;
        padding: 12px 30px;
        border-radius: 25px;
        text-transform: uppercase;
        transition: background 0.3s ease, transform 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
    }

    .create-btn:hover {
        background: #e04e2b;
        transform: scale(1.05);
    }

    .create-btn i {
        font-size: 1.2rem;
    }

    @media (max-width: 991px) {
        .section-title {
            font-size: 1.8rem;
        }

        .col-lg-8 {
            flex: 0 0 90%;
            max-width: 90%;
        }
    }

    @media (max-width: 767px) {
        .adoption-create-section {
            padding: 30px 15px;
        }

        .create-card {
            padding: 20px;
        }

        .section-title {
            font-size: 1.6rem;
        }

        .section-subtitle {
            font-size: 1rem;
        }

        .create-btn {
            padding: 10px 25px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 1.4rem;
        }

        .section-subtitle {
            font-size: 0.9rem;
        }

        .create-btn {
            padding: 8px 20px;
            font-size: 0.85rem;
        }
    }
</style>
@endsection