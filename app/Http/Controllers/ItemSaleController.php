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
        // Lấy toàn bộ dữ liệu từ bảng item_sale
        $items = Item::all();

        // Trả về view 'items.index' và truyền biến $items sang giao diện
        return view('items.index', compact('items'));
    }

    /**
     * Hiển thị form để người dùng nhập thông tin thêm mới
     */
    public function create()
    {
        // Trả về giao diện trang form thêm mới sản phẩm
        return view('items.create');
    }

    /**
     * 1.3 Xử lý lưu dữ liệu từ Form gửi lên vào Database
     */
    public function store(Request $request)
    {
        // 1.2 Thực hiện Validate dữ liệu theo yêu cầu đề bài
        $request->validate([
            // Bắt buộc nhập, tối đa 6 ký tự, chỉ chứa chữ và số (không ký tự đặc biệt)
            'item_code' => ['required', 'max:6', 'regex:/^[a-zA-Z0-9]+$/'],

            // Bắt buộc nhập, tối đa 50 ký tự, hỗ trợ chữ tiếng Việt + khoảng trắng, không ký tự đặc biệt
            'item_name' => [
                'required',
                'max:50',
                'regex:/^[a-zA-Z0-9\sàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝYỶỸĐ]+$/u'
            ],
            // Bắt buộc nhập, phải là kiểu số và không được là số âm
            'quantity' => 'required|numeric|min:0',

            // Bắt buộc nhập và phải đúng định dạng ngày tháng
            'expired_date' => 'required|date',

            // Không bắt buộc nhập (có thể để trống), tối đa 60 ký tự
            'note' => 'nullable|max:60'
        ], [
            // Cấu hình các thông báo lỗi hiển thị bằng tiếng Việt bằng Custom Message
            'item_code.required' => 'Mã sản phẩm (Item Code) không được để trống.',
            'item_code.max' => 'Mã sản phẩm không được vượt quá 6 ký tự.',
            'item_code.regex' => 'Mã sản phẩm chỉ được chứa chữ và số, không được có ký tự đặc biệt.',

            'item_name.required' => 'Tên sản phẩm (Item Name) không được để trống.',
            'item_name.max' => 'Tên sản phẩm không được vượt quá 50 ký tự.',
            'item_name.regex' => 'Tên sản phẩm không được phép chứa ký tự đặc biệt.',

            'quantity.required' => 'Số lượng (Quantity) không được để trống.',
            'quantity.numeric' => 'Số lượng phải nhập vào dạng số.',
            'quantity.min' => 'Số lượng không được nhỏ hơn 0.',

            'expired_date.required' => 'Ngày hết hạn (Expired date) không được để trống.',
            'expired_date.date' => 'Ngày hết hạn chưa đúng định dạng ngày tháng.',

            'note.max' => 'Ghi chú (Note) không được vượt quá 60 ký tự.'
        ]);

        // Sau khi vượt qua Validate thành công, tiến hành lưu dữ liệu vào bảng item_sale
        Item::create($request->all());


        // Chuyển hướng người dùng quay trở lại trang danh sách kèm theo thông báo thành công
        return redirect()->route('items.index')->with('success', 'Thêm mới sản phẩm thành công!');
    }
    public function edit($id)
    {
        // Tìm sản phẩm theo ID, nếu không thấy sẽ tự động trả về lỗi 404
        $item = Item::findOrFail($id);

        // Trả về view edit và truyền dữ liệu sản phẩm qua
        return view('items.edit', compact('item'));
    }

    /**
     * Xử lý cập nhật dữ liệu vừa chỉnh sửa vào Database
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        // Áp dụng lại logic Validate tương tự như khi thêm mới (Yêu cầu 1.2)
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
