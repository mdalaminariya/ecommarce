@extends('layouts.dashboardmaster')

@section('content')

<div class="row">
    <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Category Insert form</h4>

                                        <form role="form" action="{{ route('home.category.update',$category->slug) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Title</label>
                                                <div class="col-sm-9">
                                                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="inputEmail3" placeholder="Title" value="{{ $category->title }}">
                                                 @error('title')
                                                   <p class="text-danger text-center">{{ $message }}</p>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputPassword3" class="col-sm-3 col-form-label">Slug</label>
                                                <div class="col-sm-9">
                                                    <input name="slug" type="text" class="form-control" id="inputPassword3" placeholder="Slug" value="{{ $category->slug }}">
                                                </div>
                                            </div>

                                            <div class="row mb-2" style="width: 35%; width: 40%; object-fit: contain; margin-left: 35%;">
                                                <img id="ecommarce" src="{{ asset('uploads/category') }}/{{ $category->image }}" alt="">
                                            </div>

                                            <div class="row mb-2">
                                                <label for="inputPassword5" class="col-sm-3 col-form-label">Image</label>
                                                <div class="col-sm-9">
                                                    <input onchange="document.querySelector('#ecommarce').src =window.URL.createObjectURL(this.files[0])" name="image" type="file" class="form-control @error('image') is-invalid @enderror" id="inputPassword5" >
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
