@extends('layouts.dashboardmaster')

@section('content')

<div class="row">
            <div class="col-lg-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="header-title">Categories Table</h4>

                                                            <div class="table-responsive">
                                                                <table class="table mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th>ID</th>
                                                                            <th>Image</th>
                                                                            <th>Title</th>
                                                                            <th>Status</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($categories as $category)
                                                                        <tr>
                                                                            <th scope="row">
                                                                                {{ $loop->index + 1 }}
                                                                            </th>
                                                                            <td>
                                                                                <img style="height: 50px; width: 80px;" src="{{ asset('uploads/category') }}/{{ $category->image }}" alt="">
                                                                            </td>
                                                                            <td>{{ $category->title }}</td>
                                                                            <td>
                                                                            <form id="ecommarce{{ $category->id }}" action="{{ route('home.category.status', $category->slug) }}" method="post">
                                                                                @csrf
                                                                                <div class="form-check form-switch">
                                                                                    <input onchange="document.querySelector('#ecommarce{{ $category->id }}').submit()" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $category->status == 'active' ? 'checked' : '' }}>
                                                                                </div>
                                                                            </form>
                                                                            </td>
                                                                            <td>
                                                                                <a class="btn btn-info btn-sm" href="{{ route('home.category.edit',$category->slug) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                                                <a class="btn btn-danger btn-sm" href="{{ route('home.category.destoy',$category->slug) }}"><i class="fa-solid fa-trash"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div> <!-- end table-responsive-->
                                                        </div>
                                                    </div> <!-- end card -->
            </div>

             {{-- Insert Table --}}

            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Category Insert form</h4>

                                        <form role="form" action="{{ route('home.category.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Title</label>
                                                <div class="col-sm-9">
                                                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="inputEmail3" placeholder="Title">
                                                 @error('title')
                                                   <p class="text-danger text-center">{{ $message }}</p>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputPassword3" class="col-sm-3 col-form-label">Slug</label>
                                                <div class="col-sm-9">
                                                    <input name="slug" type="text" class="form-control" id="inputPassword3" placeholder="Slug">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="inputPassword5" class="col-sm-3 col-form-label">Image</label>
                                                <div class="col-sm-9">
                                                    <input name="image" type="file" class="form-control @error('image') is-invalid @enderror" id="inputPassword5" >
                                                @error('image')
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
