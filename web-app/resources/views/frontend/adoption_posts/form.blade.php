@extends('frontend.layouts.master')

@section('content')
<main class="adoption-form-page">
    <section class="adoption-form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="form-card">
                        <h2 class="section-title">Adoption Post Form</h2>
                        <form action="{{ route('adoption-posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="author_name" class="form-label">Author Name</label>
                                <input type="text" name="author_name" id="author_name" class="form-control" value="{{ Auth::guard('frontend')->user()->name }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
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
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
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
                            <div class="form-group mb-3">
                                <label for="mobile_number" class="form-label">Mobile Number</label>
                                <input type="text" name="mobile_number" id="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number') }}" required>
                                @error('mobile_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group text-center">
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
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Poppins', sans-serif;
        padding: 40px 0;
        min-height: 100vh;
    }

    .adoption-form-section {
        width: 100%;
    }

    .form-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .form-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .section-title {
        font-size: 2rem;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 10px;
        font-size: 0.95rem;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ff5733;
        box-shadow: none;
        outline: none;
    }

    .submit-btn {
        background: #ff5733;
        color: white;
        padding: 12px 30px;
        border-radius: 25px;
        text-transform: uppercase;
        transition: background 0.3s ease, transform 0.3s ease;
        border: none;
        font-size: 1rem;
    }

    .submit-btn:hover {
        background: #e04e2b;
        transform: scale(1.05);
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
        .adoption-form-section {
            padding: 30px 15px;
        }

        .form-card {
            padding: 20px;
        }

        .section-title {
            font-size: 1.6rem;
        }

        .form-control, .form-select {
            font-size: 0.9rem;
            padding: 8px;
        }

        .submit-btn {
            padding: 10px 25px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 1.4rem;
        }

        .form-label {
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            font-size: 0.85rem;
        }

        .submit-btn {
            padding: 8px 20px;
            font-size: 0.85rem;
        }

        .row > div {
            margin-bottom: 15px;
        }
    }
</style>
@endsection

@section('scripts')
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
</script>
@endsection