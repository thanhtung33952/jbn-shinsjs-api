### API public

**API_ROOT:** http://153.125.228.20/api/

## API common
###### 1. [Lấy địa chỉ từ zipcode](#1. Lấy địa chỉ từ zipcode)
###### 2. [Download file](#2. Download file)
###### 3. [Upload file lên server](#3. Upload file lên server)
###### 4. [Upload photo lên server](#4. Upload photo lên server)

***********************

## 1. Lấy địa chỉ từ zipcode

* **URL:** [{API_ROOT}/zipaddress/{zipcode}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {zipcode} là mã địa chỉ bạn muốn lấy dữ liệu

##### Ví dụ: 
		URL: [{API_ROOT}/zipaddress/103-0027

### Dữ liệu trả về:
    
  ```
	{
	    "code": 200,
	    "data": {
	        "pref": "東京都",
	        "address": "中央区日本橋",
	        "city": "中央区",
	        "town": "日本橋",
	        "fullAddress": "東京都中央区日本橋"
	    }
	}
  ```

## 2. Download file

* **URL:** [{API_ROOT}/download/{filename}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {filename} là tên file cần download

##### Ví dụ: 
		URL: [{API_ROOT}/download/6d783bdcf61225971.xlsx

### Dữ liệu trả về:
    - Bắt đầu tải xuống file cần download
    - Trường hợp không tìm thấy, trả về lỗi 500, với thông báo **File not found.**
    
    
## <a name="3"></a>3. Upload file lên server
* **URL:** [{API_ROOT}/common/uploadfile](#)
* **Method:** POST
* **Content Type:** text/plain
* **Reponse Type:** text/plain

### Tham số:
 - Truyền vào file upload với name: **my_file[]**
 - Có thể upload nhiều file

### Dữ liệu trả về:
 file_name sau khi upload thành công. 
 Trường hợp bị lỗi, sẽ trả về thông báo và status lỗi bằng 500
 
##### Ví dụ: 
```
	{
	    "data": [
	        "02dd0dbebcb30296.xlsx",
	        "a93e36f8970b7fb2.xlsx"
	    ]
	}
```

## <a name="4"></a>4. Upload photo lên server
* **URL:** [{API_ROOT}/common/uploadphoto](#)
* **Method:** POST
* **Content Type:** text/plain
* **Reponse Type:** text/plain

### Tham số:
 - Truyền vào file upload với name: **my_file[]**
 - Có thể upload nhiều file

### Dữ liệu trả về:
 file_name sau khi upload thành công. 
 Trường hợp bị lỗi, sẽ trả về thông báo và status lỗi bằng 500
 
##### Ví dụ: 
```
	{
	    "data": [
	        "Icon1.JPG",
	        "Icon2.JPG"
	    ]
	}
```
