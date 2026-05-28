<?php

namespace App\Http\Controllers;

use App\Models\Item; // Import Model vào để tương tác với database
use Illuminate\Http\Request;

class ItemSaleController extends Controller
{
    /**
     * 1.4 Hiển thị danh sách sản phẩm ra giao diện
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    /**
     * Hiển thị form để người dùng nhập thông tin thêm mới
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * 1.3 Xử lý lưu dữ liệu từ Form gửi lên vào Database
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_code' => ['required', 'max:6', 'regex:/^[a-zA-Z0-9]+$/'],
            'item_name' => [
                'required',
                'max:50',
                'regex:/^[a-zA-Z0-9\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝYỶỸĐ]+$/u'
            ],
            'quantity' => 'required|numeric|min:0',
            'expired_date' => 'required|date',
            'note' => 'nullable|max:60'
        ], [
            'item_code.required' => 'Mã sản phẩm không được để trống.',
            'item_code.max' => 'Mã sản phẩm không được vượt quá 6 ký tự.',
            'item_code.regex' => 'Mã sản phẩm chỉ được chứa chữ và số, không được có ký tự đặc biệt.',

            'item_name.required' => 'Tên sản phẩm không được để trống.',
            'item_name.max' => 'Tên sản phẩm không được vượt quá 50 ký tự.',
            'item_name.regex' => 'Tên sản phẩm không được phép chứa ký tự đặc biệt.',

            'quantity.required' => 'Số lượng không được để trống.',
            'quantity.numeric' => 'Số lượng phải nhập vào dạng số.',
            'quantity.min' => 'Số lượng không được nhỏ hơn 0.',

            'expired_date.required' => 'Ngày hết hạn không được để trống.',
            'expired_date.date' => 'Ngày hết hạn chưa đúng định dạng ngày tháng.',

            'note.max' => 'Ghi chú không được vượt quá 60 ký tự.'
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Thêm mới sản phẩm thành công!');
    }
    public function edit($id)
    {
        $item = Item::find($id);
        return view('items.edit', compact('item'));
    }

    /**
     * Xử lý cập nhật dữ liệu vừa chỉnh sửa vào Database
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        $request->validate([
            'item_code' => ['required', 'max:6', 'regex:/^[a-zA-Z0-9]+$/'],
            'item_name' => [
                'required',
                'max:50',
                'regex:/^[a-zA-Z0-9\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝYỶỸĐ]+$/u'
            ],
            'quantity' => 'required|numeric|min:0',
            'expired_date' => 'required|date',
            'note' => 'nullable|max:60'
        ], [
            'item_code.required' => 'Mã sản phẩm không được để trống.',
            'item_code.regex' => 'Mã sản phẩm không được chứa ký tự đặc biệt.',
            'item_name.required' => 'Tên sản phẩm không được để trống.',
            'item_name.regex' => 'Tên sản phẩm không được chứa ký tự đặc biệt.'
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }
}
