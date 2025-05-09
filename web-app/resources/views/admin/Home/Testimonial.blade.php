@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Testimonial</h1>
</div>
<div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
</div>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TestimonialModal">
    Add New Testimonial
</button>

<div class="modal fade" id="TestimonialModal" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="slideModalLabel">Add Testimonial Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form method="POST" action="/saveTestimonial" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                    
                        
                            <!-- Name -->
                            <div class="mb-3">
                            <label for="tm_name" class="form-label">name</label>
                            <input type="text" class="form-control" id="tm_name" name="tt_name" placeholder="Enter Name">
                            </div>
                            
                            <!-- Profession -->
                            <div class="mb-3">
                            <label for="tt_profession" class="form-label">Profession</label>
                            <input type="text" class="form-control" id="tt_profession" name="tt_profession" placeholder="Enter Profession">
                            </div>
                            
                            <!-- Description -->
                            <div class="mb-3">
                            <label for="tt_description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="tt_description" name="tt_description" placeholder="Enter Description">
                            </div>
                            
                            <!-- Image Upload -->
                            <div class="mb-3">
                            <label for="tt_image" class="form-label">Image Upload</label>
                            <input type="file" class="form-control" id="tt_image" name="tt_image">
                            </div>
                    
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">ADD</button>
                    </div>
            </form>
        </div>
        </div>
</div>

<div class="row">
    <div class="card mb-4">
      <div class="card-header">
          <i class="fas fa-table me-1"></i>
          All Sliders
      </div>
      <div class="card-body">
          <table id="datatablesSimple">
              <thead>
                  <tr>
                      <th>id</th>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Actons</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($testimonials as $testimonial)
                  <tr>
                      <td>{{$testimonial->id}}</td>
                      <td>{{$testimonial->name}}</td>
                      <td>{{$testimonial->profession}}</td>
                      <td>{{$testimonial->description}}</td>
                      <td><img width="100" src="{{ asset('storage/' . $testimonial->image) }}" alt="" />"</td>
                      <td>
                         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#slideModal{{$testimonial->id}}">Edit</button> 
                          <a href="/deleteTestimonial/{{$testimonial->id}}" class="btn btn-danger">Delete</a></td>
                  </tr>

                  <div class="modal fade" id="slideModal{{$testimonial->id}}" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="slideModalLabel">Edit  Slide {{$testimonial->id}}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="/TestimonialUpdate" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="tt_id" value="{{$testimonial->id}}">
                         <div class="modal-body">
                           <!-- Name -->
                          <div class="mb-3">
                              <label for="tm_name" class="form-label">name</label>
                              <input type="text" class="form-control" id="tt_name" name="tt_name" value="{{$testimonial->name}}">
                          </div>
                          
                          <!-- Profession -->
                          <div class="mb-3">
                              <label for="tt_profession" class="form-label">Profession</label>
                              <input type="text" class="form-control" id="tt_profession" name="tt_profession" value="{{$testimonial->profession}}">
                          </div>
                          
                          <!-- Description -->
                          <div class="mb-3">
                              <label for="tt_description" class="form-label">Description</label>
                              <input type="text" class="form-control" id="tt_description" name="tt_description" value="{{$testimonial->description}}">
                          </div>
                          
                          <!-- Image Upload -->
                          <div class="mb-3">
                              <label for="tt_image" class="form-label">Image Upload</label>
                              <input type="file" class="form-control" id="tt_image" name="tt_image">
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