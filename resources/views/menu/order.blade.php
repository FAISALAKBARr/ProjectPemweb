@extends('layouts.app')

@section('title', 'Food and Drink Order')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($menuItems as $menuItem)
        <div class="col-3 mb-3">
            <button type="button" class="btn btn-light" onclick="showModal('{{ $menuItem->id }}')">{{ $menuItem->name }}</button>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Order <span id="modalItemName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="orderForm" action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="itemId" name="item_id">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required min="0">
                    </div>
                    <div class="form-group">
                        <label for="specialRequests">Special Requests:</label>
                        <textarea class="form-control" id="specialRequests" name="special_requests"></textarea>
                    </div>
                </form>
                <h5>Current Orders for <span id="modalItemName"></span>:</h5>
                <ul id="orderList"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveOrder()">Order</button>
            </div>
        </div>
    </div>
</div>

<script>
function showModal(itemId) {
    document.getElementById('itemId').value = itemId;
    fetch(`/menu-items/${itemId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalItemName').textContent = data.name;
            fetchOrders(itemId);
        })
        .catch(error => console.error('Error:', error));
    $('#orderModal').modal('show');
}

function fetchOrders(itemId) {
    fetch(`/orders/by-item-id?item_id=${itemId}`)
        .then(response => response.json())
        .then(data => {
            const orderList = document.getElementById('orderList');
            orderList.innerHTML = '';
            if (data.orders.length > 0) {
                data.orders.forEach(order => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${order.quantity}x ${order.special_requests ? '(' + order.special_requests + ')' : ''}`;
                    orderList.appendChild(listItem);
                });
            } else {
                orderList.textContent = 'No orders found.';
            }
        })
        .catch(error => console.error('Error:', error));
}

function saveOrder() {
    const form = document.getElementById('orderForm');
    const formData = new FormData(form);

    fetch('/orders', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "{{ route('order') }}";
        } else {
            alert(data.message);
        }
        $('#orderModal').modal('hide');
        form.reset();
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection
