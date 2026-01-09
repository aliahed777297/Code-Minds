<form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="service_id" value="{{ $service->id }}">
    <label>الكمية:</label>
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit" class="btn btn-success">أضف إلى السلة</button>
</form>
