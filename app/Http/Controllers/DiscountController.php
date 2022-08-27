<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use App\Models\User;
use App\Modules\SendSMSModule;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function getListDiscount() {
        $discounts = Discount::paginate(10);
        return view('discount.list', compact('discounts'));
    }

    public function addDiscount() {
        return view('discount.add');
    }

    public function postAddDiscount(DiscountRequest $request) {
        $discount = new Discount();
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $discount->fill($request->all());
        $discount->start_date = $start_date;
        $discount->end_date = $end_date;
        $discount->save();
        // dd($discount);
        $user = User::all();
        foreach($user as $item){
            if($item->role_id ==4){
                $sendSMS = new SendSMSModule();
                $sendSMS->sendSMSTwil($item->phone, 'isalon.site thông báo áp dụng trương trình khuyến mãi '.$request->name.' giảm giá các đơn thanh toán từ ngày '. $request->start_date .' đến ngày '.$request->end_date. ' lên đến '.$request->percent . '% khi nhập mã code:'.$request->code_discount   );
            }
        }
       
        return redirect()->route('dashboard.discount.list')->with('message', 'Thêm mới mã giảm giá thành công!');
    }

    public function editDiscount($discountId) {
        $discount = Discount::find($discountId);
        if (!$discount) {
            return redirect()->route('dashboard.discount.list')->with('message', 'Không tìm thấy mã giảm giá mà bạn chọn!');
        }
        return view('discount.edit', compact('discount'));
    }

    public function postEditDiscount($discountId, DiscountRequest $request) {
        $discount = Discount::find($discountId);
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $discount->fill($request->all());
        $discount->start_date = $start_date;
        $discount->end_date = $end_date;
        $discount->save();
        return redirect()->route('dashboard.discount.list')->with('message', 'Sửa thông tin mã giảm giá thành công!');
    }
}
