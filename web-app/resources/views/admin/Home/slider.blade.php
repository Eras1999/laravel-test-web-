
@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Slider Manager</h1>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add New Slide
    </button>

    <!-- Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Top Heading -->
                        <div class="mb-3">
                            <label for="topHeading" class="form-label">Top Heading</label>
                            <input type="text" class="form-control" id="topHeading" name="top_heading" placeholder="Enter top heading" value="{{ old('top_heading') }}">
                            @error('top_heading')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Sub Heading -->
                        <div class="mb-3">
                            <label for="subHeading" class="form-label">Sub Heading</label>
                            <input type="text" class="form-control" id="subHeading" name="sub_heading" placeholder="Enter sub heading" value="{{ old('sub_heading') }}">
                            @error('sub_heading')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <input type="text" class="form-control" id="content" name="content" placeholder="Enter content" value="{{ old('content') }}">
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Image Upload</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- View More Link -->
                        <div class="mb-3">
                            <label for="viewMoreLink" class="form-label">View More Link</label>
                            <input type="url" class="form-control" id="viewMoreLink" name="view_more_link" placeholder="Enter link for more info" value="{{ old('view_more_link') }}">
                            @error('view_more_link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal -->

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>top_heading</th>
                        <th>sub_heading</th>
                        <th>content</th>
                        <th>image_link</th>
                        <th>view_more_link</th>
                        <th>Actons</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                    <tr>
                        <td>{{ $slider->top_heading }}</td>
                        <td>{{ $slider->sub_heading }}</td>
                        <td>{{ $slider->content }}</td>
                        <td><img width="100" src="{{ asset('storage/' . $slider->image_link) }}" alt="" /></td>
                        <td>{{ $slider->view_more_link }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#slideModal{{ $slider->id }}">Edit</button>
                            <a href="/deleteSlider/{{ $slider->id }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>

                    <div class="modal fade" id="slideModal{{ $slider->id }}" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="slideModalLabel">Edit Slide {{ $slider->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="/sliderUpdate" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="slider_id" value="{{ $slider->id }}">
                                    <div class="modal-body">
                                        <!-- Top Heading -->
                                        <div class="mb-3">
                                            <label for="topHeading" class="form-label">Top Heading</label>
                                            <input type="text" class="form-control" id="topHeading" name="top_heading" value="{{ $slider->top_heading }}">
                                            @error('top_heading')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Sub Heading -->
                                        <div class="mb-3">
                                            <label for="subHeading" class="form-label">Sub Heading</label>
                                            <input type="text" class="form-control" id="subHeading" name="sub_heading" value="{{ $slider->sub_heading }}">
                                            @error('sub_heading')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Content -->
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <input type="text" class="form-control" id="content" name="content" value="{{ $slider->content }}">
                                            @error('content')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="mb-3">
                                            <label for="imageUpload" class="form-label">Image Upload</label>
                                            <input type="file" class="form-control" id="imageUpload" name="image">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- View More Link -->
                                        <div class="mb-3">
                                            <label for="viewMoreLink" class="form-label">View More Link</label>
                                            <input type="url" class="form-control" id="viewMoreLink" name="view_more_link" value="{{ $slider->view_more_link }}">
                                            @error('view_more_link')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
