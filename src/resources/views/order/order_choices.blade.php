@if (count($errors) > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
@if (Session::has('message'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            @foreach($product_types as $type)
                <a href="{{ route('order', ['active_category' => $type->name]) }}"
                   class="list-group-item {{ $active_category != $type->name ?: 'active' }}">{{ $type->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-3"><strong>Product</strong></div>
            <div class="col-md-3">
                @if (count($products[0]->toppings))
                    <strong>Extra's</strong>
                @endif
            </div>
            <div class="col-md-2">
                <strong>Aantal</strong>
            </div>
            <div class="col-md-4"><strong>Winkelmand</strong></div>
        </div>
        @foreach ($products as $product)
            <div class="row">
                <form action="{{ route('add_to_order') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    <div class="col-md-3">
                        <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                        {{ $product->name }}
                    </div>
                    <div class="col-md-3">
                        @if (count($product->toppings))
                            <select name="topping_id" id="topping" class="form-control">
                                <option value="0" selected="selected">Niets</option>
                                @foreach($product->toppings as $topping)
                                    <option value="{{ $topping->id }}">{{ $topping->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="quantity" min="1" max="20" value="1" class="form-control"/>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" class="btn btn-primary" value="Toevoegen aan bestelling"/>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</div>

