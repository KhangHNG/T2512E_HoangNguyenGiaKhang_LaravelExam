@extends('layouts.app')

@section('content')
    <style>
        .vstore-header {
            background-color: #D05A3F;
            color: white;
            padding: 15px 40px;
            font-size: 32px;
            font-weight: bold;
            margin-top: -32px;
        }
        .vstore-header span {
            font-weight: normal;
            margin-left: 25px;
        }
        .vstore-btn-orange {
            background-color: #D05A3F;
            color: white;
            transition: background-color 0.2s;
        }
        .vstore-btn-orange:hover {
            background-color: #B84D34;
        }
        .vstore-text-orange {
            color: #D05A3F;
        }
        .focus-orange:focus {
            border-color: #D05A3F;
            box-shadow: 0 0 0 3px rgba(208, 90, 63, 0.15);
        }
    </style>

    <div class="vstore-header">
        V_Store <span>Items</span>
    </div>

    <div class="max-w-4xl mx-auto my-8 px-4 mb-24">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                Add New Sale Item
            </h1>
            <a href="{{ route('items.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1 transition">
                Back to list
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-6 shadow-sm flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <p class="font-semibold text-red-800">Đã có lỗi xảy ra!</p>
                    <p class="text-sm text-red-700">Vui lòng kiểm tra lại thông tin các trường dữ liệu bị báo đỏ bên dưới.</p>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <form action="{{ route('items.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Item Code <span class="text-red-500">*</span></label>
                        <input type="text" name="item_code" value="{{ old('item_code') }}" placeholder="Ví dụ: Coca" maxlength="6"
                               class="w-full px-3 py-2.5 rounded-lg border text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition focus-orange
                           @error('item_code') border-red-400 bg-red-50/50 focus:ring-red-200 @else border-gray-300 focus:ring-orange-100 @enderror">
                        @error('item_code')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Item Name <span class="text-red-500">*</span></label>
                        <input type="text" name="item_name" value="{{ old('item_name') }}" placeholder="Ví dụ: Coca cola" maxlength="50"
                               class="w-full px-3 py-2.5 rounded-lg border text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition focus-orange
                           @error('item_name') border-red-400 bg-red-50/50 focus:ring-red-200 @else border-gray-300 focus:ring-orange-100 @enderror">
                        @error('item_name')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Quantity <span class="text-red-500">*</span></label>
                        <input type="text" name="quantity" value="{{ old('quantity', 0) }}" min="0" step="any" placeholder="100"
                               class="w-full px-3 py-2.5 rounded-lg border text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition focus-orange
                           @error('quantity') border-red-400 bg-red-50/50 focus:ring-red-200 @else border-gray-300 focus:ring-orange-100 @enderror">
                        @error('quantity')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Expired Date <span class="text-red-500">*</span></label>
                        <input type="date" name="expired_date" value="{{ old('expired_date') }}"
                               class="w-full px-3 py-2.5 rounded-lg border text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition focus-orange
                           @error('expired_date') border-red-400 bg-red-50/50 focus:ring-red-200 @else border-gray-300 focus:ring-orange-100 @enderror">
                        @error('expired_date')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Note</label>
                        <input type="text" name="note" value="{{ old('note') }}" placeholder="Ví dụ: Discount" maxlength="60"
                               class="w-full px-3 py-2.5 rounded-lg border text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition focus-orange
                           @error('note') border-red-400 bg-red-50/50 focus:ring-red-200 @else border-gray-300 focus:ring-orange-100 @enderror">
                        @error('note')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="submit" class="px-6 py-2.5 rounded-lg vstore-btn-orange text-white text-sm font-medium shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-offset-2 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Save Item
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
