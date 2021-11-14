== Những cập nhật ==

Thông tin thêm [về plugin này](http://levantoan.com/san-pham/plugin-mua-hang-nhanh-cho-woocommerce-woocommerce-quick-buy/).

= 2.0.0 - 19.06.2018 =

* Add: Thêm nút mua hàng vào danh sách sản phẩm (product loop). Có thể mua nhanh sản phẩm bất kỳ đâu bạn thích.
* Update: Cập nhật Shortcode hiển thị nút mua hàng.
    - Shortcode dạng [devvn_quickbuy id="{ID}" button_text1="Ví dụ" button_text2 = "Ví dụ sub text" small_link="{1,0}"]
    - Bắt buộc phải có id của sản phẩm id="{ID}" ví dụ [devvn_quickbuy id="68"]
    - Có thể thay đổi chữ hiển thị bằng button_text1 và button_text2
    - Thuộc tính small_link có giá trị là 1 hoặc 0; 0 để hiển thị dạng button có style sẵn; 1 để hiển thị dạng text link đơn giản KHÔNG có style sẵn

    * Ví dụ muốn hiển thị tại 1 page nào đó hoặc tại bất kỳ đâu thì dùng shortcode như sau
        [devvn_quickbuy id="36" button_text1="Ví dụ" button_text2 = "Ví dụ sub text"]
        Hoặc
        [devvn_quickbuy id="35"]
        Hoặc dạng text link thì
        [devvn_quickbuy id="35" small_link="1"]

    * Ví dụ muốn hiển thị thêm 1 button mua nhanh ngay trong trang chi tiết sản phẩm (single product) thì dạng như sau
        [devvn_quickbuy id="36" view="0"]

    * Đối với theme Flatsome khi bạn sử dụng customizer product page thì hãy sử dụng shortcode [devvn_quickbuy] vào chỗ cần thêm


= 1.1.4 - 07.06.2018 =

* Add: Thêm tùy chọn chuyển đến trang cảm ơn khi đặt hàng xong
* Add: Auto Update bằng license

= 1.1.3 - 04.06.2018 =

* Fix: Lỗi khi thay đổi tổng khi có miễn phí vận chuyển và 1 phí vận chuyển khác
* Fix: Tỉnh thành mặc định

= 1.1.2 - 27.02.2018 =

* Update: Tương thích với plugin Woo vs GHTK - https://levantoan.com/san-pham/plugin-ket-noi-giao-hang-tiet-kiem-voi-woocommerce-ghtk-vs-woocommerce/