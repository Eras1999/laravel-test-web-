@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/rescue_form.jpg') }}">
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
<link rel="stylesheet" href="{{ asset('frontend/css/adoption_form.css') }}">
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