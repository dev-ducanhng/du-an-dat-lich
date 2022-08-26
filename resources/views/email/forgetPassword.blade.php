<h4>Thông báo!!</h4>
<p>Tài khoản có địa chỉ email là: {{$email}}</p>
<p>Nhấn vào link này để thay đổi mật khẩu: {{route('formReset', ['token' => $token,'email'=>$email])}}</p>