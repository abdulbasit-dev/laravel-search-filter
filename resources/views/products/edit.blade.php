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
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="name">Name<sup class="text-danger">*</sup></label>
                    <input type='text' class="form-control" id="name"
                           name="name" value="{{old('name',$product->name)}}" required >

                </div>
                <div class="form-group">
                    <label for="description">Description<sup class="text-danger">*</sup></label>
                    <textarea name="description" id="description" cols="30" rows="4"
                              class="form-control" required>{{old('description',$product->description)}}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price<sup class="text-danger">*</sup></label>
                    <input type="number" name="price" id="price" class="form-control" required
                           value="{{ old('price',$product->price) }}"/>
                </div>
                <div class="form-group">
                    <label>Select Category<sup class="text-danger">*</sup></label>
                    @foreach($categories as $key=>$value)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category_id"
                                   value="{{$key}}"
                                   id="{{ $key }}" @if(old('category_id',$product->category_id)==$key)checked @endif>
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
                                   id="{{ $key }}" {{ is_array(old('tags',$selected_tags)) && in_array($key,old('tags',$selected_tags))?"checked":null }}>
                            <label class="form-check-label" for="{{ $key }}">
                                {{ $value }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
