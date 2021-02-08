### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới Judgement
###### 1. [Lấy thông tin Judgement từ id](#1. Lấy thông tin Judgement từ id)
###### 2. [Thêm 1 Judgement mới](#2. Thêm 1 Judgement mới)
###### 3. [Cập nhật Judgement theo id](#3. Cập nhật Judgement theo id)


**********************************

## Danh sách các API liên quan tới Judgement


## <a name="1"></a>1. Lấy thông tin Judgement từ id
* **URL:** [{API_ROOT}/judgement/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"survey_id": int,
		"status": string,
		"survey_data_topography": string,
		"surrounding_situation": string,
		"creation_status": string,
		"ground_surface": string
	}
```

##### Ví dụ: {API_ROOT}/judgement/12
Dữ liệu trả về:
```
	{
		"id": "1",
		"survey_id": "12",
		"status": "未着手",
		"survey_data_topography": "問題なし",
		"surrounding_situation": "注意が必要",
		"creation_status": "問題なし1",
		"ground_surface": "作業が必要"
	}
```



## <a name="2"></a>2. Thêm 1 Judgement mới
* **URL:** [{API_ROOT}/judgement](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"survey_id": int,
		"status": string,
		"survey_data_topography": string,
		"surrounding_situation": string,
		"creation_status": string,
		"ground_surface": string
	}
```

### Dữ liệu trả về:
```
	{
	        "survey_id": int,
		"status": string,
		"survey_data_topography": string,
		"surrounding_situation": string,
		"creation_status": string,
		"ground_surface": string,
	        "id": int
	}
```

##### Ví dụ: 
```
	{
		"survey_id": "12",
		"status": "未着手",
		"survey_data_topography": "問題なし",
		"surrounding_situation": "注意が必要",
		"creation_status": "問題なし1",
		"ground_surface": "作業が必要",
	        "id": "5"
	}
```

## <a name="3"></a>3. Cập nhật Judgement theo id
* **URL:** [{API_ROOT}/judgement/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"status": string,
		"survey_data_topography": string,
		"surrounding_situation": string,
		"creation_status": string,
		"ground_surface": string
	}
```

### Dữ liệu trả về:
```
	{
		
		"status": string,
		"survey_data_topography": string,
		"surrounding_situation": string,
		"creation_status": string,
		"ground_surface": string
	}
```

##### Ví dụ: 
```
	{
		"status": "未着手",
		"survey_data_topography": "問題なし",
		"surrounding_situation": "注意が必要",
		"creation_status": "問題なし",
		"ground_surface": "作業が必要"
	}
```
