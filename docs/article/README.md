### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới article
###### 1. [Lấy toàn bộ Tags](#1. Lấy toàn bộ Tags)
###### 2. [Lấy toàn bộ title article theo tag id](#2. Lấy toàn bộ title article theo tag id)
###### 3. [Lấy toàn bộ chi tiết article theo article id](#3. Lấy toàn bộ chi tiết article theo article id)
###### 4. [Thêm 1 article mới](#4. Thêm 1 article mới)
###### 5. [Cập nhật article theo article id](#5. Cập nhật article theo article id)
###### 6. [Upload photo lên server](#6. Upload photo lên server)
###### 7. [Upload file lên server](#7. Upload file lên server)
###### 8. [Tìm kiếm article theo title](#8. Tìm kiếm article theo title)
###### 9. [Xóa article theo id](#9. Xóa article theo id)
###### 10. [Cập nhật tag theo tag id](#10. Cập nhật tag theo tag id)
###### 11. [Cập nhật toàn bộ Tags](#11. Cập nhật toàn bộ Tags)

**********************************

## Danh sách các API liên quan tới article
## 1. Lấy toàn bộ Tags
* **URL:** [{API_ROOT}/tags](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/tags?limit={limit}&offset={offset}

### Dữ liệu trả về:
    
  ```
	[
	    {
	        "id": string,
	        "tagName": string
	    },
	    {
	        "id": string,
	        "tagName": string
	    },
	    ...
	]
  ```

###### Ví dụ:
```
	[
	    {
	        "id": "1",
	        "tagName": "ナレッジベース1"
	    },
	    {
	        "id": "2",
	        "tagName": "ナレッジベース2"
	    }
	]
  ```

## <a name="2"></a>2. Lấy toàn bộ title article theo tag id
* **URL:** [{API_ROOT}/tags/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của tag id cần truyền vào
* Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

  - **limit**: số lượng record trả về
  - **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/tag/{id}?limit={limit}&offset={offset}

### Dữ liệu trả về:
```
	[
	    {
	        "id": string,
	        "title": string
	    },
	    {
	        "id": string,
	        "title": string
	    },
	    ...
	]
```

##### Ví dụ:
```
	[
	    {
	        "id": "8f95ca7cf16d87a634d85839fab06154",
	        "title": "ナレッジベースの使い方1"
	    },
	    {
	        "id": "06d3e127222102395f7d0ad31e630f8e",
	        "title": "ナレッジベースの使い方2"
	    },
	    {
	        "id": "93a64b7c78b6ff7631a162a1ac96c288",
	        "title": "ナレッジベースの使い方3"
	    }
	]
```

## <a name="3"></a>3. Lấy toàn bộ chi tiết article theo article id
* **URL:** [{API_ROOT}/article/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của article id cần truyền vào

### Dữ liệu trả về:
```
	{
	    "article": {
	        "id": string,
	        "title": string
	    },
	    "tags": [
	        {
	            "id": int,
	            "tagName": string
	        },
	        ...
	    ],
	    "details": [
	        {
	            "type": string,
	            "seq": int,
	            "val1": string,
	            "val2": string
	        },
	        ...
	    ],
	    "history": [
	        {
	            "useremail": string,
	            "updateTime": dateTime
	        },
	        ...
	    ]
	}
```

##### Ví dụ: {API_ROOT}/article/06d3e127222102395f7d0ad31e630f8e
Dữ liệu trả về:
```
	{
	    "article": {
	        "id": "06d3e127222102395f7d0ad31e630f8e",
	        "title": "ナレッジベースの使い方2"
	    },
	    "tags": [
	        {
	            "id": "1",
	            "tagName": "ナレッジベース"
	        }
	    ],
	    "details": [
	        {
	            "type": "subtitleCol",
	            "seq": "1",
	            "val1": "<span style=\"color: rgb(0, 51, 0); font-size: medium; font-weight: 400;\">上のタイトルも編集可能です。</span>",
	            "val2": null
	        },
	        {
	            "type": "contentCol",
	            "seq": "2",
	            "val1": "<span style=\"font-size: medium;\">上のタイト</span>",
	            "val2": null
	        },
	        {
	            "type": "noteFooterCol",
	            "seq": "3",
	            "val1": "<span style=\"color: rgb(0, 51, 0); font-size: medium;\">グは削除されます。</span>",
	            "val2": null
	        },
	        {
	            "type": "uploadCol",
	            "seq": "4",
	            "val1": "test.jpg",
	            "val2": null
	        },
	        {
	            "type": "linkCol",
	            "seq": "5",
	            "val1": "<span style=\"color: rgb(0, 51, 0); font-size: medium;\">グは削</span>",
	            "val2": null
	        }
	    ],
	    "history": [
	        {
	            "userName": "user2",
	            "updateTime": "2018-11-15 09:59:38"
	        },
	        {
	            "userName": "user1",
	            "updateTime": "2018-11-14 19:15:48"
	        }
	    ]
	}
```

## <a name="4"></a>4. Thêm 1 article mới
* **URL:** [{API_ROOT}/article](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
	    "useremail": string,
	    "article": {
	        "title": string
	    },
	    "tags": [
	        {
	            "id": int,
	            "tagName": string
	        },
	        ...
	    ],
	    "details": [
	        {
	            "type": string,
	            "seq": int,
	            "val1": string,
	            "val2": string
	        },
	        ...
	    ]
	}
```

### Dữ liệu trả về:
```
	{
	    "useremail": string,
	    "article": {
	        "id": string,
	        "title": string
	    },
	    "tags": [
	        {
	            "id": int,
	            "tagName": string
	        },
	        ...
	    ],
	    "details": [
	        {
	            "type": string,
	            "seq": int,
	            "val1": string,
	            "val2": string
	        },
	        ...
	    ]
	}
```

##### Ví dụ: 
```
	{
	    "useremail": "test@gmail.com",
	    "article": {
	        "id": "06d3e127222102395f7d0ad31e630f8e",
	        "title": "ナレッジベースの使い方2"
	    },
	    "tags": [
	        {
	            "id": "1",
	            "tagName": "ナレッジベース"
	        }
	    ],
	    "details": [
	        {
	            "type": "subtitleCol",
	            "seq": "1",
	            "val1": "<span style=\"color: rgb(0, 51, 0); font-size: medium; font-weight: 400;\">上のタイトルも編集可能です。</span>",
	            "val2": null
	        },
	        {
	            "type": "contentCol",
	            "seq": "2",
	            "val1": "<span style=\"font-size: medium;\">上のタイト</span>",
	            "val2": null
	        },
	        {
	            "type": "noteFooterCol",
	            "seq": "3",
	            "val1": "<span style=\"color: rgb(0, 51, 0); font-size: medium;\">グは削除されます。</span>",
	            "val2": null
	        },
	        {
	            "type": "uploadCol",
	            "seq": "4",
	            "val1": "test.jpg",
	            "val2": null
	        },
	        {
	            "type": "linkCol",
	            "seq": "5",
	            "val1": "<span style=\"color: rgb(0, 51, 0); font-size: medium;\">グは削</span>",
	            "val2": null
	        }
	    ]
	}
```

## <a name="5"></a>5. Cập nhật article theo article id
* **URL:** [{API_ROOT}/article/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
```
	{
	    "useremail": string,
	    "article": {
	        "id": string,
	        "title": string
	    },
	    "tags": [
	        {
	            "id": int,
	            "tagName": string
	        },
	        ...
	    ],
	    "details": [
	        {
	            "type": string,
	            "seq": int,
	            "val1": string,
	            "val2": string
	        },
	        ...
	    ]
	}
```

### Dữ liệu trả về:
```
	{
	    "useremail": string,
	    "article": {
	        "id": string,
	        "title": string
	    },
	    "tags": [
	        {
	            "id": int,
	            "tagName": string
	        },
	        ...
	    ],
	    "details": [
	        {
	            "type": string,
	            "seq": int,
	            "val1": string,
	            "val2": string
	        },
	        ...
	    ]
	}
```

##### Ví dụ: 
```
	{
	    "useremail": "test@gmail.com",
	    "article": {
	        "id": "06d3e127222102395f7d0ad31e630f8e",
	        "title": "ナレッジベースの使い方2"
	    },
	    "tags": [
	        {
	            "id": "1",
	            "tagName": "ナレッジベース"
	        }
	    ],
	    "details": [
	        {
	            "type": "subtitleCol",
	            "seq": "1",
	            "val1": "<span style=\"color: rgb(0, 51, 0); font-size: medium; font-weight: 400;\">上のタイトルも編集可能です。</span>",
	            "val2": null
	        },
	        {
	            "type": "contentCol",
	            "seq": "2",
	            "val1": "<span style=\"font-size: medium;\">上のタイト</span>",
	            "val2": null
	        },
	        {
	            "type": "noteFooterCol",
	            "seq": "3",
	            "val1": "<span style=\"color: rgb(0, 51, 0); font-size: medium;\">グは削除されます。</span>",
	            "val2": null
	        },
	        {
	            "type": "uploadCol",
	            "seq": "4",
	            "val1": "test.jpg",
	            "val2": null
	        },
	        {
	            "type": "linkCol",
	            "seq": "5",
	            "val1": "<span style=\"color: rgb(0, 51, 0); font-size: medium;\">グは削</span>",
	            "val2": null
	        }
	    ]
	}
```

## <a name="6"></a>6. Upload photo lên server
* **URL:** [{API_ROOT}/uploadphoto](#)
* **Method:** POST
* **Content Type:** text/plain
* **Reponse Type:** text/plain

### Tham số:
 - Truyền vào file upload với name: **my_file**
 - Định dạng file hợp lệ: "jpg", "jpg", "png", "gif"
 - Chỉ nhận được 1 file

### Dữ liệu trả về:
 file_name sau khi upload thành công. 
 Trường hợp bị lỗi, sẽ trả về thông báo và status lỗi bằng 500
 

## <a name="7"></a>7. Upload file lên server
* **URL:** [{API_ROOT}/uploadfile](#)
* **Method:** POST
* **Content Type:** text/plain
* **Reponse Type:** text/plain

### Tham số:
 - Truyền vào file upload với name: **my_file[]**
 - Định dạng file hợp lệ: "pdf", "docx", "xlsx"
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
 
 
## <a name="8"></a>8. Tìm kiếm article theo title
* **URL:** [{API_ROOT}/articles/search/{title}](#)
* **Method:** GET
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào title name trên url, nếu tìm tất cả ko cần truyền giá trị title

Nếu muốn **giới hạn số lượng record trả về** và **lấy bắt đầu từ vị trí nào** thì truyền thêm 2 param

- **limit**: số lượng record trả về
- **offset**: bắt đầu từ record thứ mấy
##### Ví dụ: 
		URL: [{API_ROOT}/articles/search/{title}?limit={limit}&offset={offset}

### Dữ liệu trả về:
```
	[
	    {
	        "article": {
	            "id": string,
	            "title": string
	        },
	        "tags": [
	            {
	                "id": int,
	                "tagName": string
	            },
	            ...
	        ]
	    },
	    ...
	]
```

##### Ví dụ: 	
	
```
	[
	    {
	        "article": {
	            "id": "36ac7f6bca8df1facef016f2e43d8a30",
	            "title": "ナレッジベースの使い方"
	        },
	        "tags": [
	            {
	                "id": "56",
	                "tagName": "ナレッジベース"
	            },
	            {
	                "id": "58",
	                "tagName": "ナレッジベース 1"
	            },
	            {
	                "id": "60",
	                "tagName": "ナレッジベース 3"
	            }
	        ]
	    },
	    {
	        "article": {
	            "id": "4052a4f11d85c4ea931989162f83341c",
	            "title": "string new2"
	        },
	        "tags": [
	            {
	                "id": "57",
	                "tagName": "eee"
	            }
	        ]
	    }
	]
```

## <a name="9"></a>9. Xóa article theo id
* **URL:** [{API_ROOT}/article/{id}](#)
* **Method:** DELETE
* **Content Type:** text/plain
* **Reponse Type:** text/json

### Tham số:
Truyền vào id của article cần xóa


##### Ví dụ: 
		URL: [{API_ROOT}/article/123

### Dữ liệu trả về:
- Xóa thành công: **Status code**= 200
- Xóa không thành công: **Status code** = 500



## <a name="10"></a>10. Cập nhật tag theo tag id
* **URL:** [{API_ROOT}/tag/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
- {id} chính là tag id muốn cập nhật
```
        {
            "tagName": string
        }
```

### Dữ liệu trả về:
```
	{
            "id": int,
            "tagName": string
        }
```

##### Ví dụ: 
```
        {
            "id": "1",
            "tagName": "ナレッジベース"
        }
	    
```


## <a name="11"></a>11. Cập nhật toàn bộ Tags
* **URL:** [{API_ROOT}/tags](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
- {id} chính là tag id muốn cập nhật
```
        [
	    {
	        "id": int,
	        "tagName": string
	    },
	    {
	        "id": int,
	        "tagName": string
	    },
	    ...
	]
```

### Dữ liệu trả về:
```
	[
	    {
	        "id": int,
	        "tagName": string
	    },
	    {
	        "id": int,
	        "tagName": string
	    },
	    ...
	]
```

##### Ví dụ: 
```
        [
	    {
	        "id": "29",
	        "tagName": "abcdef"
	    },
	    {
	        "id": "25",
	        "tagName": "アプリケーション"
	    },
	    ...
	]
	    
```
