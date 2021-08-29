@extends('layouts.app')
@section('content')
    <div class="row ">
        <div class="col-md-8 bg-white p-3 shadow-sm">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name<sup class="text-danger">*</sup></label>
                    <input type='text' class="form-control" id="name"
                           name="name" value="{{old('name')}}" required >

                </div>
                <div class="form-group">
                    <label for="description">Description<sup class="text-danger">*</sup></label>
                    <textarea name="description" id="description" cols="30" rows="4"
                              class="form-control" required>{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price<sup class="text-danger">*</sup></label>
                    <input type="number" name="price" id="price" class="form-control" required
                           value="{{ old('price') }}"/>
                </div>
                <div class="form-group">
                    <label>Select Category<sup class="text-danger">*</sup></label>
                    @foreach($categories as $key=>$value)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category_id"
                                   value="{{$key}}"
                                   id="{{ $key }}" @if(old('category_id')==$key)checked @endif>
                            <label class="form-check-label" for="{{ $key }}">
                                {{ $value }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Select Tags<sup class="text-danger">*</sup></label>
                    @foreach($tags as $key=>$value)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tags[]"
                                   value="{{$key}}"
                                   id="{{ $key }}" {{ is_array(old('tags')) && in_array($key,old('tags'))?"checked":null }}>
                            <label class="form-check-label" for="{{ $key }}">
                                {{ $value }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
