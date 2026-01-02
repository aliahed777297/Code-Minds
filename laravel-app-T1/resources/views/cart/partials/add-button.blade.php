<form method="POST" action="{{ route('cart.store') }}">
    @csrf
    <input type="hidden" name="service_id" value="{{ $service->id }}">
    <input type="hidden" name="quantity" value="1">
    <button class="add-to-cart-btn">أضف إلى السلة</button>
</form>
