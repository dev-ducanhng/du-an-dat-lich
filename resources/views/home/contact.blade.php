@extends('layouts.home')
@section('content')
    <!-- contact form -->
    <div class="contact-from-section mt-150 mb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title">
                        <h2>Phản hồi về dịch vụ</h2>
                    </div>
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form type="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
                            <p>
                                <input type="text" placeholder="Name" name="name" id="name">
                                <input type="email" placeholder="Email" name="email" id="email">

                            </p>
                            <p>
                                <input style="width: 100%" type="tel" placeholder="Phone" name="phone" id="phone">
                            </p>
                            <p>
                                <textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea></p>
                            <input type="hidden" name="token" value="FsWga4&@f6aw" />
                            <p><input type="submit" value="Submit"></p>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-form-wrap">
                        <div class="contact-form-box">
                            <h4><i class="fas fa-map"></i> Địa chỉ</h4>
                            <p>82 Trần Đại Nghĩa, P. Đồng Tâm, Q. Hai Bà Trưng, HN</p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="far fa-clock"></i> Thời gian làm việc</h4>
                            <p>Thứ 2 đến thứ 6: 8h00 - 21h00 <br> Thứ 7, chủ nhật: 7h30 - 21h00</p>
                        </div>
                        <div class="contact-form-box">
                            <h4><i class="fas fa-address-book"></i> Liên hệ</h4>
                            <p>Số điện thoại: 098224212 <br> Email: isalon@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact form -->

    <!-- find our location -->
    <div class="find-location blue-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p> <i class="fas fa-map-marker-alt"></i> Địa chỉ</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end find our location -->

    <!-- google map section -->
    <div class="embed-responsive embed-responsive-21by9">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7116674747035!2d105.84338685099047!3d21.00419199392265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac76918c364f%3A0x24646ca31f54d544!2zODEgUC4gVHLhuqduIMSQ4bqhaSBOZ2jEqWEsIELDoWNoIEtob2EsIEhhaSBCw6AgVHLGsG5nLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1658570909265!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
    <!-- end google map section -->
@endsection
