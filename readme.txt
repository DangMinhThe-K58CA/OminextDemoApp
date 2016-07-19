Hướng dẫn chạy project:
- Import file database: "OminextDemoApp/OnlineNews/dumpsDb/Dump20160719.sql"
- Config database: "OminextDemoApp/OnlineNews/config/database.php":
	+ Tìm đến dòng chứa 'mysql'.
	+ Thay đổi các thông số sao cho phù hợp với localhost trên máy tính: 'port' , 'username', 'password'.
- Chạy project trên localhost:
	+ Mở cmd. cd tới "OminextDemoApp/OnlineNews".
	+ Chạy command line: php artisan serve
	+ Giữ vậy cmd.
	+ Mở trình duyệt, tới : "http://localhost:8000/" để vào trang chủ. (Tài khoản demo: id: admin4@gmail.com pas: 1111).
	+ Tới: "http://localhost:8000/quan-tri" để vào trang quản trị. (Tài khoản demo: id: minhthe@gmail.com pass: 1111).
	+ Tới: "http://localhost:8000/cong-tac-vien" để vào trang cộng tác viên. (Tài khoản demo: admin2@gmail.com pass: 1111).
NOTE: Nếu xảy ra lỗi vui lòng liên hệ : Minh Thế (Email: thekoy.95@gmail.com sđt: 01632400740).