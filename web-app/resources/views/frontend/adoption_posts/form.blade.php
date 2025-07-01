@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/about1.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Adoption Post Form</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Adoption Post Form</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->
    <main class="adoption-form-page">
        <section class="adoption-form-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-sm-12">
                        <div class="form-card">
                            <h2 class="section-title">Adoption Post Form</h2>
                            <form id="adoptionForm" action="{{ route('adoption-posts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="author_name" class="form-label">Author Name</label>
                                    <input type="text" name="author_name" id="author_name" class="form-control" value="{{ Auth::guard('frontend')->user()->name }}" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category" id="category" class="form-select @error('category') is-invalid @enderror" required>
                                        <option value="" disabled selected>Select Category</option>
                                        <option value="dog" {{ old('category') == 'dog' ? 'selected' : '' }}>Dog</option>
                                        <option value="cat" {{ old('category') == 'cat' ? 'selected' : '' }}>Cat</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Location</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="district" class="form-label">District</label>
                                            <select name="district" id="district" class="form-select @error('district') is-invalid @enderror" required>
                                                <option value="" disabled selected>Select District</option>
                                                <option value="Ampara" {{ old('district') == 'Ampara' ? 'selected' : '' }}>Ampara</option>
                                                <option value="Anuradhapura" {{ old('district') == 'Anuradhapura' ? 'selected' : '' }}>Anuradhapura</option>
                                                <option value="Badulla" {{ old('district') == 'Badulla' ? 'selected' : '' }}>Badulla</option>
                                                <option value="Batticaloa" {{ old('district') == 'Batticaloa' ? 'selected' : '' }}>Batticaloa</option>
                                                <option value="Colombo" {{ old('district') == 'Colombo' ? 'selected' : '' }}>Colombo</option>
                                                <option value="Galle" {{ old('district') == 'Galle' ? 'selected' : '' }}>Galle</option>
                                                <option value="Gampaha" {{ old('district') == 'Gampaha' ? 'selected' : '' }}>Gampaha</option>
                                                <option value="Hambantota" {{ old('district') == 'Hambantota' ? 'selected' : '' }}>Hambantota</option>
                                                <option value="Jaffna" {{ old('district') == 'Jaffna' ? 'selected' : '' }}>Jaffna</option>
                                                <option value="Kalutara" {{ old('district') == 'Kalutara' ? 'selected' : '' }}>Kalutara</option>
                                                <option value="Kandy" {{ old('district') == 'Kandy' ? 'selected' : '' }}>Kandy</option>
                                                <option value="Kegalle" {{ old('district') == 'Kegalle' ? 'selected' : '' }}>Kegalle</option>
                                                <option value="Kilinochchi" {{ old('district') == 'Kilinochchi' ? 'selected' : '' }}>Kilinochchi</option>
                                                <option value="Kurunegala" {{ old('district') == 'Kurunegala' ? 'selected' : '' }}>Kurunegala</option>
                                                <option value="Mannar" {{ old('district') == 'Mannar' ? 'selected' : '' }}>Mannar</option>
                                                <option value="Matale" {{ old('district') == 'Matale' ? 'selected' : '' }}>Matale</option>
                                                <option value="Matara" {{ old('district') == 'Matara' ? 'selected' : '' }}>Matara</option>
                                                <option value="Moneragala" {{ old('district') == 'Moneragala' ? 'selected' : '' }}>Moneragala</option>
                                                <option value="Mullaitivu" {{ old('district') == 'Mullaitivu' ? 'selected' : '' }}>Mullaitivu</option>
                                                <option value="Nuwara Eliya" {{ old('district') == 'Nuwara Eliya' ? 'selected' : '' }}>Nuwara Eliya</option>
                                                <option value="Polonnaruwa" {{ old('district') == 'Polonnaruwa' ? 'selected' : '' }}>Polonnaruwa</option>
                                                <option value="Puttalam" {{ old('district') == 'Puttalam' ? 'selected' : '' }}>Puttalam</option>
                                                <option value="Ratnapura" {{ old('district') == 'Ratnapura' ? 'selected' : '' }}>Ratnapura</option>
                                                <option value="Trincomalee" {{ old('district') == 'Trincomalee' ? 'selected' : '' }}>Trincomalee</option>
                                                <option value="Vavuniya" {{ old('district') == 'Vavuniya' ? 'selected' : '' }}>Vavuniya</option>
                                            </select>
                                            @error('district')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="city" class="form-label">City</label>
                                            <select name="city" id="city" class="form-select @error('city') is-invalid @enderror" required>
                                                <option value="" disabled selected>Select City</option>
                                            </select>
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nearby_city" class="form-label">Nearby City</label>
                                            <input type="text" name="nearby_city" id="nearby_city" class="form-control @error('nearby_city') is-invalid @enderror" value="{{ old('nearby_city') }}" required>
                                            @error('nearby_city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="mobile_number" class="form-label">Mobile Number</label>
                                    <input type="text" name="mobile_number" id="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number') }}" required>
                                    @error('mobile_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-actions text-center">
                                    <a href="{{ route('adoption-posts.create') }}" class="btn back-btn">Back</a>
                                    <button type="submit" class="btn submit-btn">Submit Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('styles')
<style>
    .adoption-form-page {
        background: linear-gradient(135deg, #e6f0fa 0%, #b3d4fc 100%);
        font-family: 'Poppins', sans-serif;
        padding: 60px 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .adoption-form-section {
        width: 100%;
    }

    .form-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 25px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        padding: 40px;
        backdrop-filter: blur(15px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(70, 172, 11, 0.1);
    }

    .form-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .section-title {
        font-size: 2.2rem;
        color: #2c3e50;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 35px;
        text-align: center;
        font-weight: 700;
        position: relative;
    }

    .section-title::after {
        content: '';
        width: 50px;
        height: 3px;
        background: #46ac0b;
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
    }

    .form-label {
        font-weight: 600;
        color: #34495e;
        margin-bottom: 10px;
        display: block;
        font-size: 1rem;
    }

    .form-control, .form-select {
        border-radius: 15px;
        padding: 12px 15px;
        font-size: 1rem;
        border: 2px solid #ecf0f1;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background: #fafafa;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .form-control:focus, .form-select:focus {
        border-color: #46ac0b;
        box-shadow: 0 0 10px rgba(70, 172, 11, 0.2);
        outline: none;
    }

    .form-actions {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 30px;
        border-radius: 25px;
        text-transform: uppercase;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .submit-btn {
        background: linear-gradient(45deg, #46ac0b, #7ed321);
        color: white;
        border: none;
        box-shadow: 0 5px 15px rgba(70, 172, 11, 0.3);
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(70, 172, 11, 0.4);
        background: linear-gradient(45deg, #3d9a0a, #6cc217);
    }

    .back-btn {
        background: #bdc3c7;
        color: #2c3e50;
        border: none;
    }

    .back-btn:hover {
        background: #95a5a6;
        color: #fff;
        transform: translateY(-3px);
    }

    .invalid-feedback {
        font-size: 0.85rem;
        color: #e74c3c;
    }

    @media (max-width: 991px) {
        .section-title {
            font-size: 1.9rem;
        }

        .col-lg-8 {
            flex: 0 0 90%;
            max-width: 90%;
        }

        .form-actions {
            flex-direction: column;
            gap: 15px;
        }

        .btn {
            width: 100%;
        }
    }

    @media (max-width: 767px) {
        .adoption-form-section {
            padding: 30px 15px;
        }

        .form-card {
            padding: 25px;
        }

        .section-title {
            font-size: 1.7rem;
        }

        .form-label {
            font-size: 0.95rem;
        }

        .form-control, .form-select {
            font-size: 0.9rem;
            padding: 10px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 1.5rem;
        }

        .form-label {
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            font-size: 0.85rem;
        }

        .btn {
            padding: 8px 15px;
            font-size: 0.85rem;
        }

        .row > div {
            margin-bottom: 15px;
        }
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const districtCities = {
        Ampara: ['Ampara', 'Kalmunai', 'Akkaraipattu'],
        Anuradhapura: ['Anuradhapura', 'Medawachchiya', 'Kekirawa'],
        Badulla: ['Badulla', 'Bandarawela', 'Haputale'],
        Batticaloa: ['Batticaloa', 'Kattankudy', 'Eravur'],
        Colombo: ['Colombo', 'Dehiwala', 'Moratuwa'],
        Galle: ['Galle', 'Hikkaduwa', 'Ambalangoda'],
        Gampaha: ['Gampaha', 'Negombo', 'Ja-Ela'],
        Hambantota: ['Hambantota', 'Tangalle', 'Tissamaharama'],
        Jaffna: ['Jaffna', 'Chavakachcheri', 'Point Pedro'],
        Kalutara: ['Kalutara', 'Panadura', 'Horana'],
        Kandy: ['Kandy', 'Peradeniya', 'Gampola'],
        Kegalle: ['Kegalle', 'Mawanella', 'Rambukkana'],
        Kilinochchi: ['Kilinochchi', 'Pallai', 'Paranthan'],
        Kurunegala: ['Kurunegala', 'Kuliyapitiya', 'Narammala'],
        Mannar: ['Mannar', 'Thalaimannar', 'Nanaddan'],
        Matale: ['Matale', 'Dambulla', 'Ukuwela'],
        Matara: ['Matara', 'Weligama', 'Dikwella'],
        Moneragala: ['Moneragala', 'Bibile', 'Wellawaya'],
        Mullaitivu: ['Mullaitivu', 'Puthukkudiyiruppu', 'Oddusuddan'],
        'Nuwara Eliya': ['Nuwara Eliya', 'Hatton', 'Talawakelle'],
        Polonnaruwa: ['Polonnaruwa', 'Kaduruwela', 'Medirigiriya'],
        Puttalam: ['Puttalam', 'Chilaw', 'Wennappuwa'],
        Ratnapura: ['Ratnapura', 'Embilipitiya', 'Balangoda'],
        Trincomalee: ['Trincomalee', 'Kinniya', 'Mutur'],
        Vavuniya: ['Vavuniya', 'Nedunkeni', 'Settikulam'],
    };

    document.getElementById('district').addEventListener('change', function() {
        const district = this.value;
        const citySelect = document.getElementById('city');
        citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';

        if (district && districtCities[district]) {
            districtCities[district].forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        }
    });

    // Set initial city dropdown if old district value exists
    @if(old('district'))
        document.getElementById('district').dispatchEvent(new Event('change'));
        document.getElementById('city').value = "{{ old('city') }}";
    @endif

    // Handle form submission with SweetAlert
    document.getElementById('adoptionForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#46ac0b',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route('adoption-posts.index') }}';
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message || 'Something went wrong. Please try again.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#e74c3c',
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An unexpected error occurred. Please try again later.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#e74c3c',
            });
        });
    });
</script>
@endsection