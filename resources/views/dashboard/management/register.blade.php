@extends('layouts.dashboardmaster')

@section('content')

<div class="row">
     <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Assign Role & Register</h4>

                                        <form role="form" action="{{ route('home.management.store.register') }}" method="post">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                                                <div class="col-sm-9">
                                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="inputEmail3" placeholder="Name">
                                                 @error('name')
                                                   <p class="text-danger text-center">{{ $message }}</p>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputPassword3" class="col-sm-3 col-form-label">E-mail</label>
                                                <div class="col-sm-9">
                                                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="inputPassword3" placeholder="Email">
                                                @error('email')
                                                   <p class="text-danger text-center">{{ $message }}</p>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="inputPassword5" class="col-sm-3 col-form-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword5" placeholder="Password">
                                                @error('password')
                                                   <p class="text-danger text-center">{{ $message }}</p>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="inputPassword5" class="col-sm-3 col-form-label">Role</label>
                                                <div class="col-sm-9">
                                                  <select class="form-select @error('role') is-invalid @enderror" name="role">
                                                    <option selected="">Select Role</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="blogger">Blogger</option>
                                                    <option value="user">User</option>
                                                 </select>
                                                @error('role')
                                                   <p class="text-danger text-center">{{ $message }}</p>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
