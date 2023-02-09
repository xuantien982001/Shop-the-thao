<!DOCTYPE html>
<html lang="en">

<head>

    @include('Client.share.head')
</head>

<body>

    {{-- <!-- Home Popup Section -->
<div class="modal fade subscribe_popup" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                </button>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="popup_content">
                            <div class="popup-text">
                                <div class="heading_s3 text-center">
                                    <h4>Subscribe and Get 25% Discount!</h4>
                                </div>
                                <p>Subscribe to the newsletter to receive updates about new products.</p>
                            </div>
                            <form method="post" class="rounded_input">
                            	<div class="form-group">
                                	<input name="email" required type="email" class="form-control" placeholder="Enter Your Email">
                                </div>
                                <div class="form-group">
                                	<button class="btn btn-fill-line btn-block text-uppercase btn-radius" title="Subscribe" type="submit">Subscribe</button>
                                </div>
                            </form>
                            <div class="chek-form">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                    <label class="form-check-label" for="exampleCheckbox3"><span>Don't show this popup again!</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </div>
</div>
<!-- End Screen Load Popup Section --> --}}

    @include('Client.share.menu')
    @yield('slide')
    {{-- @include('Client.share.slide') --}}

    <!-- END MAIN CONTENT -->
    <div class="main_content">
        @yield('content')


    </div>
    <!-- END MAIN CONTENT -->

    <!-- START FOOTER -->
    @include('Client.share.footer')
    <!-- END FOOTER -->

    <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>


    @include('Client.share.js')
    <script src="/js/app.js"></script>
    <script src="/customers/customers.js">
        // $(document).ready(function() {
        //     $("#loginForm").submit(function(e) {
        //         e.preventDefault();
        //         var payload = window.getFormData($(this));
        //         axios
        //             .post('/login', payload)
        //             .then((res) => {
        //                 if (res.data.status == 1) {
        //                     // toastr.success("Đã login thành công!");
        //                     window.location.href = "/";
        //                 } else if (res.data.status == 2) {
        //                     toastr.warning("Tài khoản chưa kích hoạt!");
        //                 } else {
        //                     toastr.error("Đăng nhập thất bại");
        //                 }
        //             })
        //             .catch((res) => {
        //                 var listError = res.response.data.errors;
        //                 $.each(listError, function(key, value) {
        //                     toastr.error(value[0]);
        //                 });
        //             });
        //     });

        //     $("#registerForm").submit(function(e) {
        //         e.preventDefault();
        //         var payload = window.getFormData($(this));
        //         axios
        //             .post('/register', payload)
        //             .then((res) => {
        //                 if (res.status) {
        //                     toastr.success("Mã kích hoạt đã gửi đến Email!");
        //                 }
        //             })
        //             .catch((res) => {
        //                 var listError = res.response.data.errors;
        //                 $.each(listError, function(key, value) {
        //                     toastr.error(value[0]);
        //                 });
        //             });
        //     });

        //     $(".addToCart").click(function(e) {

        //         var id_san_pham = $(this).data('id');
        //         axios
        //             .get('/client/add-to-cart/' + id_san_pham)
        //             .then((res) => {
        //                 if (res.data.status) {
        //                     toastr.success(res.data.message);
        //                 } else {
        //                     toastr.error(res.data.message);
        //                 }
        //             });
        //     });
        // })
    </script>
    @yield('js')
</body>

</html>
