@extends('layouts.app')

@section('content')
    <!-- CSS Tùy biến để bắt chước giao diện chuẩn trong ảnh image_cc5021.png -->
    <style>
        .vstore-header {
            background-color: #D05A3F;
            color: white;
            padding: 15px 40px;
            font-size: 32px;
            font-weight: bold;
            margin-top: -32px; /* Triệt tiêu khoảng trống nếu layout bọc ngoài có margin */
        }
        .vstore-header span {
            font-weight: normal;
            margin-left: 25px;
        }
        .vstore-title {
            text-align: center;
            color: #C19A43;
            font-size: 36px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .vstore-btn-add {
            background-color: #D05A3F;
            color: white;
            padding: 6px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            display: inline-block;
            margin-bottom: 15px;
        }
        .vstore-table {
            width: 100%;
            border-collapse: collapse;
        }
        .vstore-table th {
            background-color: #D05A3F;
            color: white;
            padding: 12px 20px;
            font-weight: normal;
            font-size: 16px;
            text-align: left;
        }
        .vstore-table td {
            padding: 20px 20px;
            color: #4A4A4A;
            font-size: 16px;
            border: none;
        }
        .vstore-table tbody tr {
            border-bottom: none; /* Giao diện phẳng, không kẻ viền rõ ràng */
        }

        .action-icon {
            color: #A0B2C6;
            text-decoration: none;
            margin-left: 12px;
            font-size: 18px;
        }
    </style>

    <!-- Header theo ảnh mẫu -->
    <div class="vstore-header">
        V_Store <span>Items</span>
    </div>

    <div class="max-w-7xl mx-auto px-10 mb-24">
        <!-- Tiêu đề chính giữa -->
        <h1 class="vstore-title">Sale Items</h1>

        <!-- Nút Add New -->
        <a href="{{ route('items.create') }}" class="vstore-btn-add">
            Add New
        </a>

        <!-- Bảng danh sách sản phẩm -->
        <div class="overflow-x-auto">
            <table class="vstore-table">
                <thead>
                <tr>
                    <th style="width: 8%;">Id</th>
                    <th style="width: 15%;">Item Code</th>
                    <th style="width: 20%;">Item Name</th>
                    <th style="width: 15%;">Quantity</th>
                    <th style="width: 20%;">Expired date</th>
                    <th style="width: 12%;">Note</th>
                    <th style="width: 10%;"></th> <!-- Cột trống chứa icon hành động -->
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->item_code }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ number_format($item->quantity, 0) }}</td>
                        <!-- Sửa từ expired_date sang expried_date và định dạng lại chuỗi nếu biến chưa được cast sang Carbon -->
                        <td>{{ date('d/m/Y', strtotime($item->expired_date)) }}</td>
                        <td>{{ $item->note }}</td>
                        <td style="text-align: right;">
                            <a href="{{ route('items.edit', $item->id) }}" class="action-icon">✏️</a>
                            <a href="#" class="action-icon">🗑️</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
