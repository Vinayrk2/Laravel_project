<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #090841;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Order Details</h2>
    
    <h3>Customer Information:</h3>
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>

    <h3>Order Summary:</h3>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->product->price, 2) }}</td>
                <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Subtotal</strong></td>
                <td>${{ number_format($subTotal, 2) }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Tax (13%)</strong></td>
                <td>${{ number_format($tax, 2) }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td>${{ number_format($total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <p>Thank you for your order!</p>
</body>
</html> 