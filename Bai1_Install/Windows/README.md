# Thiết lập Elasticsearch trong Windows

## Mục lục
1. [Điều kiện tiên quyết](#điều-kiện-tiên-quyết)
2. [Giới thiệu và thuật ngữ cơ sở dữ liệu Elasticsearch](#giới-thiệu-và-thuật-ngữ-cơ-sở-dữ-liệu-elasticsearch)
3. [Thiết lập Elasticsearch](#thiết-lập-elasticsearch)
    - [Bước 1 - Tải xuống Elasticsearch](#bước-1---tải-xuống-elasticsearch)
    - [Bước 2 - Chạy Elasticsearch dưới dạng dịch vụ nền windows](#bước-2---chạy-elasticsearch-dưới-dạng-dịch-vụ-nền-windows)
    - [Bước 3 - Đặt lại mật khẩu người dùng "elastic"](#bước-3---đặt-lại-mật-khẩu-người-dùng-elastic)
    - [Bước 4 - Kiểm tra xem Elasticsearch có đang chạy không](#bước-4---kiểm-tra-xem-elasticsearch-có-đang-chạy-không)
4. [Thay đổi thư mục lưu trữ dữ liệu](#thay-đổi-thư-mục-lưu-trữ-dữ-liệu)
5. [Đặt giới hạn bộ nhớ của dịch vụ Elasticsearch](#đặt-giới-hạn-bộ-nhớ-của-dịch-vụ-elasticsearch)
6. [Vô hiệu hóa HTTPS (Tùy chọn)](#vô-hiệu-hóa-https-tùy-chọn)
7. [Hạn chế quyền truy cập Elasticsearch vào các kết nối từ xa (Tùy chọn)](#hạn-chế-quyền-truy-cập-elasticsearch-vào-các-kết-nối-từ-xa-tùy-chọn)
8. [Thay đổi cổng Elasticsearch (Tùy chọn)](#thay-đổi-cổng-elasticsearch-tùy-chọn)
9. [Băng hình](#băng-hình)

## Điều kiện tiên quyết
- Máy tính chạy Windows
- Kết nối internet để tải xuống Elasticsearch

## Giới thiệu và thuật ngữ cơ sở dữ liệu Elasticsearch
Trong bài đăng này, chúng tôi sẽ thiết lập cơ sở dữ liệu Elasticsearch một nút đơn giản trong Windows bằng tệp zip Elasticsearch. Cơ sở dữ liệu Elasticsearch có thể được cài đặt để chạy như một dịch vụ Windows giống như bất kỳ cơ sở dữ liệu nào khác như Oracle hoặc PostgreSQL.

## Thiết lập Elasticsearch

### Bước 1 - Tải xuống Elasticsearch
- Tải xuống tệp zip Elasticsearch cho Windows từ [Elasticsearch Download Page](https://www.elastic.co/downloads/elasticsearch).
- Giải nén thư mục Elasticsearch và đặt vào ổ C. Ví dụ: `C:\elasticsearch-8.10.2`.
- Chạy Elasticsearch từ dòng lệnh (không được khuyến nghị):
  - Mở dấu nhắc lệnh trong thư mục Elasticsearch.
  - Chạy Elasticsearch bằng lệnh `.\bin\elasticsearch.bat`.
  - Đóng dòng lệnh sẽ dừng Elasticsearch. Do đó, nên chạy Elasticsearch dưới dạng dịch vụ Windows.

### Bước 2 - Chạy Elasticsearch dưới dạng dịch vụ nền windows
- Mở dấu nhắc lệnh trong thư mục Elasticsearch.
- Chạy lệnh `.\bin\elasticsearch-service.bat install` để cài đặt dịch vụ Elasticsearch Windows.
- Chạy lệnh `.\bin\elasticsearch-service.bat start` để khởi động cơ sở dữ liệu Elasticsearch.
- Chạy lệnh `.\bin\elasticsearch-service.bat stop` để dừng cơ sở dữ liệu nếu được yêu cầu.
- Chạy lệnh `.\bin\elasticsearch-service.bat remove` để gỡ cài đặt dịch vụ cơ sở dữ liệu nếu được yêu cầu.

### Bước 3 - Đặt lại mật khẩu người dùng "elastic"
- Mở dấu nhắc lệnh trong thư mục Elasticsearch.
- Chạy lệnh `.\bin\elasticsearch-reset-password.bat -i -u elastic` và đặt lại mật khẩu của người dùng "elastic".

### Bước 4 - Kiểm tra xem Elasticsearch có đang chạy không
- Truy cập trình duyệt web và mở URL `https://localhost:9200`.
- Nhập tên người dùng và mật khẩu của người dùng "elastic".
- Chi tiết cơ sở dữ liệu Elasticsearch sẽ được hiển thị, điều này có nghĩa là cơ sở dữ liệu đang chạy với thông tin xác thực người dùng linh hoạt mong muốn.

## Thay đổi thư mục lưu trữ dữ liệu
- Theo mặc định dữ liệu Elasticsearch được lưu trữ trong thư mục dữ liệu của thư mục Elasticsearch.
- Các thư mục dữ liệu bổ sung hoặc sửa đổi thư mục dữ liệu hiện có có thể được thực hiện bằng cách sử dụng tệp `elasticsearch.yml`.
- Mở tệp `elasticsearch.yml` trong thư mục `config` của thư mục Elasticsearch.
- Tìm kiếm `path.data` và đặt nó vào một thư mục dữ liệu hoặc nhiều đường dẫn thư mục dữ liệu. Ví dụ: bạn có thể viết `path.data: "C:\elasticsearch-8.10.2\data"` hoặc `path.data: ["C:\elasticsearch-8.10.2\data","D:\elastic_data"]`.

## Đặt giới hạn bộ nhớ của dịch vụ Elasticsearch
- Theo mặc định, chỉ có 1 GB được phân bổ cho dịch vụ Elasticsearch Windows, điều này có thể dẫn đến lỗi khi chạy nhiều truy vấn hoặc truy vấn dữ liệu lớn.
- Giới hạn bộ nhớ của dịch vụ Elasticsearch có thể được tăng lên cho mục đích này:
  - Mở dấu nhắc lệnh trong thư mục Elasticsearch.
  - Chạy lệnh `.\bin\elasticsearch-service.bat manager`. Một cửa sổ cấu hình sẽ xuất hiện.
  - Chuyển đến tab `Java` và đặt giá trị nhóm bộ nhớ ban đầu và tối đa thành giá trị cao hơn, giả sử 10 GB (= 10240 MB).

## Vô hiệu hóa HTTPS (Tùy chọn)
- Mở tệp `elasticsearch.yml` trong thư mục `config` của thư mục Elasticsearch.
- Trong phần `xpack.security.http.ssl`, thiết lập `enabled: false` để tắt HTTPS.

## Hạn chế quyền truy cập Elasticsearch vào các kết nối từ xa (Tùy chọn)
- Mở tệp `elasticsearch.yml` trong thư mục `config` của thư mục Elasticsearch.
- Đặt `http.host: localhost` để tắt kết nối HTTP từ xa tới Elasticsearch. Nếu được yêu cầu, địa chỉ IP LAN cũng có thể được sử dụng trong `http.host` để hạn chế quyền truy cập vào mạng LAN.

## Thay đổi cổng Elasticsearch (Tùy chọn)
- Theo mặc định Elasticsearch chạy trên cổng 9200.
- Mở tệp `elasticsearch.yml` trong thư mục `config` của thư mục Elasticsearch.
- Thay đổi `http.port` thành giá trị mong muốn nếu được yêu cầu.

## Băng hình
Video cho bài viết này có thể được tìm thấy ở [đây](#).
