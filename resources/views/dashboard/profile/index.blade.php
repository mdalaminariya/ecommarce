@extends('layouts.dashboardmaster')

@section('content')

{{-- name update --}}
<div class="row">
<div class="col-xl-6">
 <div class="card">
     <div class="card-body">
         <h5 class="header-title">Name Update Form</h5>
        <form action="{{ route('home.profile.name.update') }}" method="POST">
             @csrf
            <div class="form-floating mb-3">
                   <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="floatingnameInput" placeholder="Enter Name" value="{{ old('name') }}">
                   <label for="floatingnameInput">Name</label>

                  @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                  @enderror
             </div>
             <div>
                                                <button type="submit" class="btn btn-primary w-md">Save</button>
             </div>
         </form>
    </div>
      <!-- end card body -->
</div>
<!-- end card --></div>

{{-- email update --}}

<div class="col-xl-6">
<div class="card">
    <div class="card-body">
        <h5 class="header-title">E-mail Update Form</h5>
        <form action="{{ route('home.profile.email.update') }}" method="POST">
             @csrf
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="floatingnameInput" placeholder="Enter Email" value="{{ old('email') }}">
                <label for="floatingnameInput">Email</label>

                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
             <div>
                <button type="submit" class="btn btn-primary w-md">Save</button>
             </div>
         </form>
    </div>
 <!-- end card body -->
 </div>
  <!-- end card -->
</div>
{{-- password update --}}
<div class="col-xl-6">
<div class="card">
    <div class="card-body">
        <h5 class="header-title">Password Update Form</h5>
        <form action="{{ route('home.profile.password.update') }}" method="POST">
             @csrf
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="floatingnameInput" placeholder="Enter Email" value="{{ old('current_password') }}">
                <label for="floatingnameInput">Current Password</label>

                @error('current_password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="floatingnameInput" placeholder="Enter Email" value="{{ old('password') }}">
                <label for="floatingnameInput">New Password</label>

                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password_confirmation" id="floatingnameInput" placeholder="Enter Email" value="{{ old('password_confirmation') }}">
                <label for="floatingnameInput">Confirm Password</label>
            </div>
             <div>
                <button type="submit" class="btn btn-primary w-md">Save</button>
             </div>
         </form>
    </div>
 <!-- end card body -->
 </div>
  <!-- end card -->
</div>
{{-- image update --}}
<div class="col-xl-6">
<div class="card">
    <div class="card-body">
        <h5 class="header-title">Image Update Form</h5>
        <form action="{{ route('home.profile.image.update') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="row mb-3">
                <img id="ecommarce" src="{{ asset('uploads/profile') }}/{{ auth()->user()->image }}" alt=""  style="width: 50%; height: 50%; margin-left: 20%; object-fit: contain">
             </div>
            <div class="form-floating mb-3">
                <input onchange="document.querySelector('#ecommarce').src = window.URL.createObjectURL(this.files[0])" type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="floatingnameInput">
                <label for="floatingnameInput">Image</label>

                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
             <div>
                <button type="submit" class="btn btn-primary w-md">Save</button>
             </div>
         </form>
    </div>
 <!-- end card body -->
 </div>
  <!-- end card -->
</div>
</div>


@endsection


@section('script')
@if (session('success'))
       <script>
         Toastify({
      text: "{{ session('success') }}",
      duration: 5000,
      newWindow: true,
      close: true,
      gravity: "top", // `top` or `bottom`
      position: "center", // `left`, `center` or `right`
      stopOnFocus: true, // Prevents dismissing of toast on hover
      style: {
        background: "linear-gradient(to right, #00b09b, #96c93d)",
      },
      onClick: function(){} // Callback after click
    }).showToast();
       </script>
@endif
@endsection
