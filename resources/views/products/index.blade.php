@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <form action="{{ route('products.index') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="keyword" class="h3">Search</label>
                    <input type="text" class="form-control" id="keyword" name="keyword"
                           placeholder="Search word here" value="{{ old('keyword',$keyword) }}">
                </div>

                <div class="form-group">
                    <h3>Price</h3>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="price_0_500" name="price"
                               class="custom-control-input"
                               value='price_0_500' {{ isset($selected_price) && $selected_price == 'price_0_500'?"checked":null}}>
                        <label class="custom-control-label" for="price_0_500">0 - 500</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="price_501_1500" name="price"
                               class="custom-control-input"
                               value='price_501_1500' {{ isset($selected_price) && $selected_price == 'price_501_1500'?"checked":null}}>
                        <label class="custom-control-label" for="price_501_1500">501 - 1500</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="price_1501_3000" name="price"
                               class="custom-control-input"
                               value='price_1501_3000' {{ isset($selected_price) && $selected_price == 'price_1501_3000'?"checked":null}}>
                        <label class="custom-control-label" for="price_1501_3000">1501 -
                            3000</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="price_3001_5000" name="price"
                               class="custom-control-input"
                               value='price_3001_5000' {{ isset($selected_price) && $selected_price == 'price_3001_5000'?"checked":null}}>
                        <label class="custom-control-label" for="price_3001_5000">3001 -
                            5000</label>
                    </div>
                </div>

                <div class="form-group">
                    <h3>Category</h3>
                    @foreach($categories as $key=>$value)
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio{{ $key }}" name="category"
                                   class="custom-control-input"
                                   value='{{ $key }}' {{ isset($selected_category) && $selected_category == $key?"checked":null }}>
                            <label class="custom-control-label"
                                   for="customRadio{{ $key }}">{{ $value }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <h3>Tags</h3>
                    @foreach($tags as $key=>$value)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   id="defaultCheck{{$key}}"
                                   name="tags[]"
                                   value="{{ $key }}" {{ is_array($selected_tags) && in_array($key,$selected_tags)  ?'checked':null }}>
                            <label class="form-check-label" for="defaultCheck{{$key}}">
                                {{$value}}
                            </label>
                        </div>
                    @endforeach
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('products.index') }}" class="btn btn-success" id="reset">Reset</a>
                </div>
            </form>
        </div>
        <div class="col-lg-9">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-5">
                        <div class="card">
                            <img src="{{ $product->image }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4>{{ $product->name }}</h4>
                                <h5>${{ $product->price }}</h5>
                                <p class="card-text mb-2">{{ $product->desciption }}</p>
                                @foreach ($product->tags as $tag)
                                    <span
                                        class="badge bg-secondary text-white">{{ $tag->name }}</span>
                                @endforeach
                                <hr>
                                <span
                                    class="badge bg-primary text-white">{{ $product->category->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $products->appends(request()->input())->links() }}

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            console.log("ready")
        })
    </script>
@endpush
