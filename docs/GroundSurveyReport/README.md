### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới Ground Survey Report
###### 1. [Lấy thông tin Ground Survey Report từ id](#1. Lấy thông tin Ground Survey Report từ id)

###### 2. [Lấy thông tin Ground Survey Report 1 And 2 từ id](#2. Lấy thông tin Ground Survey Report 1 And 2 từ id)
###### 3. [Thêm 1 Ground Survey Report 1 And 2 mới](#3. Thêm 1 Ground Survey Report 1 And 2 mới)
###### 4. [Cập nhật Ground Survey Report 1 And 2 theo id](#4. Cập nhật Ground Survey Report 1 And 2 theo id)

###### 5. [Lấy thông tin Ground Survey Report 4 từ id](#5. Lấy thông tin Ground Survey Report 4 từ id)
###### 6. [Thêm 1 Ground Survey Report 4 mới](#6. Thêm 1 Ground Survey Report 4 mới)
###### 7. [Cập nhật Ground Survey Report 4 theo id](#7. Cập nhật Ground Survey Report 4 theo id)

###### 8. [Lấy thông tin Ground Survey Report 5 từ id](#8. Lấy thông tin Ground Survey Report 5 từ id)
###### 9. [Thêm 1 Ground Survey Report 5 mới](#9. Thêm 1 Ground Survey Report 5 mới)
###### 10. [Cập nhật Ground Survey Report 5 theo id](#10. Cập nhật Ground Survey Report 5 theo id)

###### 11. [Lấy thông tin Ground Survey Report 6 từ id](#11. Lấy thông tin Ground Survey Report 6 từ id)
###### 12. [Thêm 1 Ground Survey Report 6 mới](#12. Thêm 1 Ground Survey Report 6 mới)
###### 13. [Cập nhật Ground Survey Report 6 theo id](#13. Cập nhật Ground Survey Report 6 theo id)

###### 14. [Lấy thông tin Ground Survey Report 7 từ id](#14. Lấy thông tin Ground Survey Report 7 từ id)
###### 15. [Thêm 1 Ground Survey Report 7 mới](#15. Thêm 1 Ground Survey Report 7 mới)
###### 16. [Cập nhật Ground Survey Report 7 theo id](#16. Cập nhật Ground Survey Report 7 theo id)

###### 17. [Lấy thông tin Ground Survey Report 14_1 từ id](#17. Lấy thông tin Ground Survey Report 14_1 từ id)
###### 18. [Thêm 1 Ground Survey Report 14_1 mới](#18. Thêm 1 Ground Survey Report 14_1 mới)
###### 19. [Cập nhật Ground Survey Report 14_1 theo id](#19. Cập nhật Ground Survey Report 14_1 theo id)

###### 20. [Lấy thông tin Ground Survey Report 14_2 từ id](#20. Lấy thông tin Ground Survey Report 14_2 từ id)
###### 21. [Thêm 1 Ground Survey Report 14_2 mới](#21. Thêm 1 Ground Survey Report 14_2 mới)
###### 22. [Cập nhật Ground Survey Report 14_2 theo id](#22. Cập nhật Ground Survey Report 14_2 theo id)

###### 23. [Lấy thông tin Ground Survey Report 14_3 từ id](#23. Lấy thông tin Ground Survey Report 14_3 từ id)
###### 24. [Thêm 1 Ground Survey Report 14_3 mới](#24. Thêm 1 Ground Survey Report 14_3 mới)
###### 25. [Cập nhật Ground Survey Report 14_3 theo id](#25. Cập nhật Ground Survey Report 14_3 theo id)

###### 26. [Lấy thông tin Ground Survey Report 14_4 từ id](#26. Lấy thông tin Ground Survey Report 14_4 từ id)
###### 27. [Thêm 1 Ground Survey Report 14_4 mới](#27. Thêm 1 Ground Survey Report 14_4 mới)
###### 28. [Cập nhật Ground Survey Report 14_4 theo id](#28. Cập nhật Ground Survey Report 14_4 theo id)
**********************************

## Danh sách các API liên quan tới GroundSurveyReport

## <a name="1"></a>1. Lấy thông tin Ground Survey Report từ id
* **URL:** [{API_ROOT}/groundsurveyreport/{id}](#)
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
		"userId": "12",
		"permission_range": string,
		"last_display": datetime,
		"author": "12",
		"edit_permission_range": string,
		"status": string,
		"ground_safe_house_app_ID": string,
		"survey_ordering_company": string,
		"ordering_person": string
	}
```

##### Ví dụ: {API_ROOT}/groundsurveyreport/12
Dữ liệu trả về:
```
	{
		"id": "1",
		"survey_id": "12",
		"userId": "12",
		"permission_range": "編集可能",
		"last_display": "2019-09-03 00:00:00",
		"author": "12",
		"edit_permission_range": "調査会社",
		"status": "作成中",
		"ground_safe_house_app_ID": "s0012541",
		"survey_ordering_company": "〇〇会社",
		"ordering_person": "〇〇"
	}
```


## <a name="2"></a>2. Lấy thông tin Ground Survey Report 1 And 2 từ id
* **URL:** [{API_ROOT}/groundsurveyreport1and2/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"id_ground_survey_report": int,
	        "property_name": string,
	        "survey_site": string,
	        "survey_date": datetỉme,
	        "survey_equipment": string,
	        "person_in_charge": string
	}
```

##### Ví dụ: {API_ROOT}/groundsurveyreport1and2/2
Dữ liệu trả về:
```
	{
		"id": "1",
		"property_name": "property_name_test",
		"survey_site": "survey_site_test",
		"survey_date": "2019-09-03",
		"survey_equipment": "test",
		"person_in_charge": "12",
		"id_ground_survey_report": "10"
	}
```



## <a name="3"></a>3. Thêm 1 Ground Survey Report 1 And 2 mới
* **URL:** [{API_ROOT}/groundsurveyreport1and2](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"id_ground_survey_report": int,
	        "property_name": string,
	        "survey_site": string,
	        "survey_date": datetỉme,
	        "survey_equipment": string,
	        "person_in_charge": string
	}
```

### Dữ liệu trả về:
```
	{
	        "id_ground_survey_report": int,
	        "property_name": string,
	        "survey_site": string,
	        "survey_date": datetỉme,
	        "survey_equipment": string,
	        "person_in_charge": string,
	        "id": int
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
	        "property_name": "property_name_test",
	        "survey_site": "survey_site_test",
	        "survey_date": "2019-09-03",
	        "survey_equipment": "test",
	        "person_in_charge": "12",
	        "id": "5"
	}
```

## <a name="4"></a>4. Cập nhật Ground Survey Report 1 And 2 theo id
* **URL:** [{API_ROOT}/groundsurveyreport1and2/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"id_ground_survey_report": int,
	        "property_name": string,
	        "survey_site": string,
	        "survey_date": datetỉme,
	        "survey_equipment": string,
	        "person_in_charge": string
	}
```

### Dữ liệu trả về:
```
	{
		
		"id_ground_survey_report": int,
	        "property_name": string,
	        "survey_site": string,
	        "survey_date": datetỉme,
	        "survey_equipment": string,
	        "person_in_charge": string
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"property_name": "property_name_test1",
		"survey_site": "survey_site_test1",
		"survey_date": "2019-09-04",
		"survey_equipment": "test1",
		"person_in_charge": "12"
	}
```


## <a name="5"></a>5. Lấy thông tin Ground Survey Report 4 từ id
* **URL:** [{API_ROOT}/groundsurveyreport4/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"id_ground_survey_report": int,
	        "temporary_address": string,
	        "final_address": string,
	        "coordinates": string
	}
```

##### Ví dụ: {API_ROOT}/groundsurveyreport4/2
Dữ liệu trả về:
```
	{
		"id": "1",
		"temporary_address": "Tokyo, Japan",
		"final_address": "Tokyo, Japan",
		"coordinates": "35.652832,139.839478",
		"id_ground_survey_report": "12"
	}
```



## <a name="6"></a>6. Thêm 1 Ground Survey Report 4 mới
* **URL:** [{API_ROOT}/groundsurveyreport4](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"temporary_address": string,
		"final_address": string,
		"coordinates": string,
		"id_ground_survey_report": int
	}
```

### Dữ liệu trả về:
```
	{
	        "id": int,
		"temporary_address": string,
		"final_address": string,
		"coordinates": string,
		"id_ground_survey_report": int
	}
```

##### Ví dụ: 
```
	{
		"id": "1",
		"temporary_address": "Tokyo, Japan",
		"final_address": "Tokyo, Japan",
		"coordinates": "35.652832,139.839478",
		"id_ground_survey_report": "12"
	}
```

## <a name="7"></a>7. Cập nhật Ground Survey Report 4 theo id
* **URL:** [{API_ROOT}/groundsurveyreport4/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
	        "temporary_address": string,
	        "final_address": string,
	        "coordinates": string
	}
```

### Dữ liệu trả về:
```
	{
	        "temporary_address": string,
	        "final_address": string,
	        "coordinates": string
	}
```

##### Ví dụ: 
```
	{
		"temporary_address": "Tokyo, Japan",
		"final_address": "Tokyo, Japan",
		"coordinates": "35.652833,139.839473"
	}
```



## <a name="8"></a>8. Lấy thông tin Ground Survey Report 5 từ id
* **URL:** [{API_ROOT}/groundsurveyreport5/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"file": string,
		"e_adjacent_ground_level_difference": string,
		"e_retaining_wall": string,
		"e_type": string,
		"e_distance": string,
		"w_adjacent_ground_level_difference": string,
		"w_retaining_wall": string,
		"w_type": string,
		"w_distance": string,
		"s_adjacent_ground_level_difference": string,
		"s_retaining_wall": string,
		"s_type": string,
		"s_distance": string,
		"n_adjacent_ground_level_difference": string,
		"n_retaining_wall": string,
		"n_type": string,
		"n_distance": string
	}
```

##### Ví dụ: {API_ROOT}/groundsurveyreport5/2
Dữ liệu trả về:
```
	{
		"id": "1",
		"file": "abc.jpg",
		"e_adjacent_ground_level_difference": "なし",
		"e_retaining_wall": "なし",
		"e_type": "石積・石垣",
		"e_distance": "35.6",
		"w_adjacent_ground_level_difference": "なし",
		"w_retaining_wall": "なし",
		"w_type": "石積・石垣",
		"w_distance": "35.6",
		"s_adjacent_ground_level_difference": "なし",
		"s_retaining_wall": "なし",
		"s_type": "石積・石垣",
		"s_distance": "35.6",
		"n_adjacent_ground_level_difference": "なし",
		"n_retaining_wall": "なし",
		"n_type": "石積・石垣",
		"n_distance": "35.6"
	}
```



## <a name="9"></a>9. Thêm 1 Ground Survey Report 5 mới
* **URL:** [{API_ROOT}/groundsurveyreport5](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"id_ground_survey_report": int,
		"file": string,
		"e_adjacent_ground_level_difference": string,
		"e_retaining_wall": string,
		"e_type": string,
		"e_distance": string,
		"w_adjacent_ground_level_difference": string,
		"w_retaining_wall": string,
		"w_type": string,
		"w_distance": string,
		"s_adjacent_ground_level_difference": string,
		"s_retaining_wall": string,
		"s_type": string,
		"s_distance": string,
		"n_adjacent_ground_level_difference": string,
		"n_retaining_wall": string,
		"n_type": string,
		"n_distance": string
	}
```

### Dữ liệu trả về:
```
	{
		"id_ground_survey_report": int,
		"file": string,
		"e_adjacent_ground_level_difference": string,
		"e_retaining_wall": string,
		"e_type": string,
		"e_distance": string,
		"w_adjacent_ground_level_difference": string,
		"w_retaining_wall": string,
		"w_type": string,
		"w_distance": string,
		"s_adjacent_ground_level_difference": string,
		"s_retaining_wall": string,
		"s_type": string,
		"s_distance": string,
		"n_adjacent_ground_level_difference": string,
		"n_retaining_wall": string,
		"n_type": string,
		"n_distance": string,
		"id": int
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"file": "abc.jpg",
		"e_adjacent_ground_level_difference": "なし",
		"e_retaining_wall": "なし",
		"e_type": "石積・石垣",
		"e_distance": "35.6",
		"w_adjacent_ground_level_difference": "なし",
		"w_retaining_wall": "なし",
		"w_type": "石積・石垣",
		"w_distance": "35.6",
		"s_adjacent_ground_level_difference": "なし",
		"s_retaining_wall": "なし",
		"s_type": "石積・石垣",
		"s_distance": "35.6",
		"n_adjacent_ground_level_difference": "なし",
		"n_retaining_wall": "なし",
		"n_type": "石積・石垣",
		"n_distance": "35.6",
		"id": "1"
	}
```

## <a name="10"></a>10. Cập nhật Ground Survey Report 5 theo id
* **URL:** [{API_ROOT}/groundsurveyreport5/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"file": string,
		"e_adjacent_ground_level_difference": string,
		"e_retaining_wall": string,
		"e_type": string,
		"e_distance": string,
		"w_adjacent_ground_level_difference": string,
		"w_retaining_wall": string,
		"w_type": string,
		"w_distance": string,
		"s_adjacent_ground_level_difference": string,
		"s_retaining_wall": string,
		"s_type": string,
		"s_distance": string,
		"n_adjacent_ground_level_difference": string,
		"n_retaining_wall": string,
		"n_type": string,
		"n_distance": string
	}
```

### Dữ liệu trả về:
```
	{
		
		"file": string,
		"e_adjacent_ground_level_difference": string,
		"e_retaining_wall": string,
		"e_type": string,
		"e_distance": string,
		"w_adjacent_ground_level_difference": string,
		"w_retaining_wall": string,
		"w_type": string,
		"w_distance": string,
		"s_adjacent_ground_level_difference": string,
		"s_retaining_wall": string,
		"s_type": string,
		"s_distance": string,
		"n_adjacent_ground_level_difference": string,
		"n_retaining_wall": string,
		"n_type": string,
		"n_distance": string
	}
```

##### Ví dụ: 
```
	{
		"file": "abcdef.jpg",
		"e_adjacent_ground_level_difference": "なし",
		"e_retaining_wall": "なし",
		"e_type": "石積・石垣",
		"e_distance": "35.6",
		"w_adjacent_ground_level_difference": "なし",
		"w_retaining_wall": "なし",
		"w_type": "石積・石垣",
		"w_distance": "35.6",
		"s_adjacent_ground_level_difference": "なし",
		"s_retaining_wall": "なし",
		"s_type": "石積・石垣",
		"s_distance": "35.6",
		"n_adjacent_ground_level_difference": "なし",
		"n_retaining_wall": "なし",
		"n_type": "石積・石垣",
		"n_distance": "35.6"
	}
```


## <a name="11"></a>11. Lấy thông tin Ground Survey Report 6 từ id
* **URL:** [{API_ROOT}/groundsurveyreport6/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"survey_topography": string,
		"rivers_and_irrigation_canals_0": string,
		"rivers_and_irrigation_canals_1": string,
		"rivers_and_irrigation_canals_2": string,
		"surrounding_buildings": string,
		"overview_abnormal_0": string,
		"overview_abnormal_1": string,
		"overview_abnormal_2": string,
		"overview_abnormal_3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"pavement": string,
		"abnormal": string,
		"adjacent_land": string
	}
```

##### Ví dụ: {API_ROOT}/groundsurveyreport6/2
Dữ liệu trả về:
```
	{
		"id": "1",
		"survey_topography": "test",
		"rivers_and_irrigation_canals_0": "河川",
		"rivers_and_irrigation_canals_1": "河川",
		"rivers_and_irrigation_canals_2": "河川",
		"surrounding_buildings": "少ない",
		"overview_abnormal_0": "木造",
		"overview_abnormal_1": "F",
		"overview_abnormal_2": "事務所など",
		"overview_abnormal_3": "５〜10年程度",
		"crack": "大",
		"deflection": "小",
		"slope": "小",
		"pavement": "なし",
		"abnormal": "あり",
		"adjacent_land": "池沼"
	}
```



## <a name="12"></a>12. Thêm 1 Ground Survey Report 6 mới
* **URL:** [{API_ROOT}/groundsurveyreport6](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"id_ground_survey_report": int,
		"survey_topography": string,
		"rivers_and_irrigation_canals_0": string,
		"rivers_and_irrigation_canals_1": string,
		"rivers_and_irrigation_canals_2": string,
		"surrounding_buildings": string,
		"overview_abnormal_0": string,
		"overview_abnormal_1": string,
		"overview_abnormal_2": string,
		"overview_abnormal_3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"pavement": string,
		"abnormal": string,
		"adjacent_land": string
	}
```

### Dữ liệu trả về:
```
	{
		"id_ground_survey_report": int,
		"survey_topography": string,
		"rivers_and_irrigation_canals_0": string,
		"rivers_and_irrigation_canals_1": string,
		"rivers_and_irrigation_canals_2": string,
		"surrounding_buildings": string,
		"overview_abnormal_0": string,
		"overview_abnormal_1": string,
		"overview_abnormal_2": string,
		"overview_abnormal_3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"pavement": string,
		"abnormal": string,
		"adjacent_land": string,
		"id": int
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"survey_topography": "test",
		"rivers_and_irrigation_canals_0": "河川",
		"rivers_and_irrigation_canals_1": "河川",
		"rivers_and_irrigation_canals_2": "河川",
		"surrounding_buildings": "少ない",
		"overview_abnormal_0": "木造",
		"overview_abnormal_1": "F",
		"overview_abnormal_2": "事務所など",
		"overview_abnormal_3": "５〜10年程度",
		"crack": "大",
		"deflection": "小",
		"slope": "小",
		"pavement": "なし",
		"abnormal": "あり",
		"adjacent_land": "池沼",
		"id": "1"
	}
```

## <a name="13"></a>13. Cập nhật Ground Survey Report 6 theo id
* **URL:** [{API_ROOT}/groundsurveyreport6/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"survey_topography": string,
		"rivers_and_irrigation_canals_0": string,
		"rivers_and_irrigation_canals_1": string,
		"rivers_and_irrigation_canals_2": string,
		"surrounding_buildings": string,
		"overview_abnormal_0": string,
		"overview_abnormal_1": string,
		"overview_abnormal_2": string,
		"overview_abnormal_3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"pavement": string,
		"abnormal": string,
		"adjacent_land": string
	}
```

### Dữ liệu trả về:
```
	{
		
		"survey_topography": string,
		"rivers_and_irrigation_canals_0": string,
		"rivers_and_irrigation_canals_1": string,
		"rivers_and_irrigation_canals_2": string,
		"surrounding_buildings": string,
		"overview_abnormal_0": string,
		"overview_abnormal_1": string,
		"overview_abnormal_2": string,
		"overview_abnormal_3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"pavement": string,
		"abnormal": string,
		"adjacent_land": string
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"survey_topography": "test",
		"rivers_and_irrigation_canals_0": "河川",
		"rivers_and_irrigation_canals_1": "河川",
		"rivers_and_irrigation_canals_2": "河川",
		"surrounding_buildings": "少ない",
		"overview_abnormal_0": "木造",
		"overview_abnormal_1": "F",
		"overview_abnormal_2": "事務所など",
		"overview_abnormal_3": "５〜10年程度",
		"crack": "大",
		"deflection": "小",
		"slope": "小",
		"pavement": "なし",
		"abnormal": "あり",
		"adjacent_land": "池沼"
	}
```


## <a name="14"></a>14. Lấy thông tin Ground Survey Report 7 từ id
* **URL:** [{API_ROOT}/groundsurveyreport7/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"survey_topography": string,
		"rivers_and_irrigation_canals_0": string,
		"rivers_and_irrigation_canals_1": string,
		"rivers_and_irrigation_canals_2": string,
		"surrounding_buildings": string,
		"overview_abnormal_0": string,
		"overview_abnormal_1": string,
		"overview_abnormal_2": string,
		"overview_abnormal_3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"pavement": string,
		"abnormal": string,
		"adjacent_land": string
	}
```

##### Ví dụ: {API_ROOT}/groundsurveyreport7/2
Dữ liệu trả về:
```
	{
		"id": "1",
		"creation_status": "古い",
		"ground_surface": "起伏",
		"soil_quality": "礫質土",
		"moisture_content": "なし",
		"underground_objects": "なし",
		"current_situation": "造成更地",
		"existing_building0": "鉄骨",
		"existing_building1": "１F",
		"existing_building2": "集合住宅",
		"existing_building3": "５〜10年程度",
		"crack": "大",
		"deflection": "小",
		"slope": "小",
		"carry_in0": "4tショート",
		"carry_in1": "100",
		"carry_in2": "200",
		"carry_in3": "300",
		"carry_in4": "電線"
	}
```



## <a name="15"></a>15. Thêm 1 Ground Survey Report 7 mới
* **URL:** [{API_ROOT}/groundsurveyreport7](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"id_ground_survey_report": int,
		"creation_status": string,
		"ground_surface": string,
		"soil_quality": string,
		"moisture_content": string,
		"underground_objects": string,
		"current_situation": string,
		"existing_building0": string,
		"existing_building1": string,
		"existing_building2": string,
		"existing_building3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"carry_in0": string,
		"carry_in1": string,
		"carry_in2": string,
		"carry_in3": string,
		"carry_in4": string
	}
```

### Dữ liệu trả về:
```
	{
		"id_ground_survey_report": int,
		"creation_status": string,
		"ground_surface": string,
		"soil_quality": string,
		"moisture_content": string,
		"underground_objects": string,
		"current_situation": string,
		"existing_building0": string,
		"existing_building1": string,
		"existing_building2": string,
		"existing_building3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"carry_in0": string,
		"carry_in1": string,
		"carry_in2": string,
		"carry_in3": string,
		"carry_in4": string,
		"id": int
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"creation_status": "古い",
		"ground_surface": "起伏",
		"soil_quality": "礫質土",
		"moisture_content": "なし",
		"underground_objects": "なし",
		"current_situation": "造成更地",
		"existing_building0": "鉄骨",
		"existing_building1": "１F",
		"existing_building2": "集合住宅",
		"existing_building3": "５〜10年程度",
		"crack": "大",
		"deflection": "小",
		"slope": "小",
		"carry_in0": "4tショート",
		"carry_in1": "100",
		"carry_in2": "200",
		"carry_in3": "300",
		"carry_in4": "電線",
		"id": "1"
	}
```

## <a name="16"></a>16. Cập nhật Ground Survey Report 7 theo id
* **URL:** [{API_ROOT}/groundsurveyreport7/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"survey_topography": string,
		"creation_status": string,
		"ground_surface": string,
		"soil_quality": string,
		"moisture_content": string,
		"underground_objects": string,
		"current_situation": string,
		"existing_building0": string,
		"existing_building1": string,
		"existing_building2": string,
		"existing_building3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"carry_in0": string,
		"carry_in1": string,
		"carry_in2": string,
		"carry_in3": string,
		"carry_in4": string
	}
```

### Dữ liệu trả về:
```
	{
		
		"creation_status": string,
		"ground_surface": string,
		"soil_quality": string,
		"moisture_content": string,
		"underground_objects": string,
		"current_situation": string,
		"existing_building0": string,
		"existing_building1": string,
		"existing_building2": string,
		"existing_building3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"carry_in0": string,
		"carry_in1": string,
		"carry_in2": string,
		"carry_in3": string,
		"carry_in4": string
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": int,
		"creation_status": "古い",
		"ground_surface": "起伏",
		"soil_quality": "礫質土",
		"moisture_content": "なし",
		"underground_objects": "なし",
		"current_situation": "造成更地",
		"existing_building0": "鉄骨",
		"existing_building1": "１F",
		"existing_building2": "集合住宅",
		"existing_building3": "５〜10年程度",
		"crack": "大",
		"deflection": "小",
		"slope": "小",
		"carry_in0": "4tショート",
		"carry_in1": "100",
		"carry_in2": "200",
		"carry_in3": "300",
		"carry_in4": "電線"
	}
```


## <a name="13"></a>13. Cập nhật Ground Survey Report 6 theo id
* **URL:** [{API_ROOT}/groundsurveyreport6/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"survey_topography": string,
		"rivers_and_irrigation_canals_0": string,
		"rivers_and_irrigation_canals_1": string,
		"rivers_and_irrigation_canals_2": string,
		"surrounding_buildings": string,
		"overview_abnormal_0": string,
		"overview_abnormal_1": string,
		"overview_abnormal_2": string,
		"overview_abnormal_3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"pavement": string,
		"abnormal": string,
		"adjacent_land": string
	}
```

### Dữ liệu trả về:
```
	{
		
		"survey_topography": string,
		"rivers_and_irrigation_canals_0": string,
		"rivers_and_irrigation_canals_1": string,
		"rivers_and_irrigation_canals_2": string,
		"surrounding_buildings": string,
		"overview_abnormal_0": string,
		"overview_abnormal_1": string,
		"overview_abnormal_2": string,
		"overview_abnormal_3": string,
		"crack": string,
		"deflection": string,
		"slope": string,
		"pavement": string,
		"abnormal": string,
		"adjacent_land": string
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"survey_topography": "test",
		"rivers_and_irrigation_canals_0": "河川",
		"rivers_and_irrigation_canals_1": "河川",
		"rivers_and_irrigation_canals_2": "河川",
		"surrounding_buildings": "少ない",
		"overview_abnormal_0": "木造",
		"overview_abnormal_1": "F",
		"overview_abnormal_2": "事務所など",
		"overview_abnormal_3": "５〜10年程度",
		"crack": "大",
		"deflection": "小",
		"slope": "小",
		"pavement": "なし",
		"abnormal": "あり",
		"adjacent_land": "池沼"
	}
```


## <a name="17"></a>17. Lấy thông tin Ground Survey Report 14_1 từ id
* **URL:** [{API_ROOT}/groundsurveyreport14_1/{id}?no={no}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"front_road_east_side": string,
		"front_road_south_side": string,
		"western_border": string,
		"east_border": string,
		"southern_boundary": string,
		"north_border": string
	}
```

##### Ví dụ: {API_ROOT}/groundsurveyreport14_1/2
Dữ liệu trả về:
```
	{
		"id": "1",
		"front_road_east_side": "abc.jpg",
		"front_road_south_side": "abc.jpg",
		"western_border": "abc.jpg",
		"east_border": "abc.jpg",
		"southern_boundary": "abc.jpg",
		"north_border": "abc.jpg"
	}
```



## <a name="18"></a>18. Thêm 1 Ground Survey Report 14_1 mới
* **URL:** [{API_ROOT}/groundsurveyreport14_1](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"id_ground_survey_report": int,
		"front_road_east_side": string,
		"front_road_south_side": string,
		"western_border": string,
		"east_border": string,
		"southern_boundary": string,
		"north_border": string
	}
```

### Dữ liệu trả về:
```
	{
		"id_ground_survey_report": int,
		"front_road_east_side": string,
		"front_road_south_side": string,
		"western_border": string,
		"east_border": string,
		"southern_boundary": string,
		"north_border": string,
		"id": int
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"front_road_east_side": "abc.jpg",
		"front_road_south_side": "abc.jpg",
		"western_border": "abc.jpg",
		"east_border": "abc.jpg",
		"southern_boundary": "abc.jpg",
		"north_border": "abc.jpg",
		"id": "1"
	}
```

## <a name="19"></a>19. Cập nhật Ground Survey Report 14_1 theo id
* **URL:** [{API_ROOT}/groundsurveyreport14_1/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"front_road_east_side": string,
		"front_road_south_side": string,
		"western_border": string,
		"east_border": string,
		"southern_boundary": string,
		"north_border": string
	}
```

### Dữ liệu trả về:
```
	{
		"front_road_east_side": string,
		"front_road_south_side": string,
		"western_border": string,
		"east_border": string,
		"southern_boundary": string,
		"north_border": string
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"front_road_east_side": "abc.jpg",
		"front_road_south_side": "abc.jpg",
		"western_border": "abc.jpg",
		"east_border": "abc.jpg",
		"southern_boundary": "abc.jpg",
		"north_border": "abc.jpg"
	}
```

## <a name="20"></a>20. Lấy thông tin Ground Survey Report 14_2 từ id
* **URL:** [{API_ROOT}/groundsurveyreport14_2/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"south_west": string,
		"south_east": string,
		"north_west": string,
		"north_east": string,
		"check_direction": string,
		"TBM": string
	}
```

##### Ví dụ: {API_ROOT}/groundsurveyreport14_2/2
Dữ liệu trả về:
```
	{
		"id": "1",
		"south_west": "abc.jpg",
		"south_east": "abc.jpg",
		"north_west": "abc.jpg",
		"north_east": "abc.jpg",
		"check_direction": "abc.jpg",
		"TBM": "abc.jpg"
	}
```



## <a name="21"></a>21. Thêm 1 Ground Survey Report 14_2 mới
* **URL:** [{API_ROOT}/groundsurveyreport14_2](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"id_ground_survey_report": int,
		"south_west": string,
		"south_east": string,
		"north_west": string,
		"north_east": string,
		"check_direction": string,
		"TBM": string
	}
```

### Dữ liệu trả về:
```
	{
		"id_ground_survey_report": int,
		"south_west": string,
		"south_east": string,
		"north_west": string,
		"north_east": string,
		"check_direction": string,
		"TBM": string,
		"id": int
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"south_west": "abc.jpg",
		"south_east": "abc.jpg",
		"north_west": "abc.jpg",
		"north_east": "abc.jpg",
		"check_direction": "abc.jpg",
		"TBM": "abc.jpg",
		"id": "1"
	}
```

## <a name="22"></a>22. Cập nhật Ground Survey Report 14_2 theo id
* **URL:** [{API_ROOT}/groundsurveyreport14_2/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"south_west": string,
		"south_east": string,
		"north_west": string,
		"north_east": string,
		"check_direction": string,
		"TBM": string
	}
```

### Dữ liệu trả về:
```
	{
		"south_west": string,
		"south_east": string,
		"north_west": string,
		"north_east": string,
		"check_direction": string,
		"TBM": string
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"south_west": "abc.jpg",
		"south_east": "abc.jpg",
		"north_west": "abc.jpg",
		"north_east": "abc.jpg",
		"check_direction": "abc.jpg",
		"TBM": "abc.jpg"
	}
```

## <a name="23"></a>23. Lấy thông tin Ground Survey Report 14_3 từ id
* **URL:** [{API_ROOT}/groundsurveyreport14_3/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"screw_point": string,
		"station_1": string,
		"station_2": string,
		"station_3": string,
		"station_4": string,
		"station_5": string
	}
```

##### Ví dụ: {API_ROOT}/groundsurveyreport14_3/2
Dữ liệu trả về:
```
	{
		"id": "1",
		"screw_point": "abc.jpg",
		"station_1": "abc.jpg",
		"station_2": "abc.jpg",
		"station_3": "abc.jpg",
		"station_4": "abc.jpg",
		"station_5": "abc.jpg"
	}
```



## <a name="24"></a>24. Thêm 1 Ground Survey Report 14_3 mới
* **URL:** [{API_ROOT}/groundsurveyreport14_3](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"id_ground_survey_report": int,
		"screw_point": string,
		"station_1": string,
		"station_2": string,
		"station_3": string,
		"station_4": string,
		"station_5": string
	}
```

### Dữ liệu trả về:
```
	{
		"id_ground_survey_report": int,
		"screw_point": string,
		"station_1": string,
		"station_2": string,
		"station_3": string,
		"station_4": string,
		"station_5": string,
		"id": int
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"screw_point": "abc.jpg",
		"station_1": "abc.jpg",
		"station_2": "abc.jpg",
		"station_3": "abc.jpg",
		"station_4": "abc.jpg",
		"station_5": "abc.jpg",
		"id": "1"
	}
```

## <a name="25"></a>25. Cập nhật Ground Survey Report 14_3 theo id
* **URL:** [{API_ROOT}/groundsurveyreport14_3/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"screw_point": string,
		"station_1": string,
		"station_2": string,
		"station_3": string,
		"station_4": string,
		"station_5": string
	}
```

### Dữ liệu trả về:
```
	{
		"screw_point": string,
		"station_1": string,
		"station_2": string,
		"station_3": string,
		"station_4": string,
		"station_5": string
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"screw_point": "abc.jpg",
		"station_1": "abc.jpg",
		"station_2": "abc.jpg",
		"station_3": "abc.jpg",
		"station_4": "abc.jpg",
		"station_5": "abc.jpg"
	}
```

## <a name="26"></a>26. Lấy thông tin Ground Survey Report 14_4 từ id
* **URL:** [{API_ROOT}/groundsurveyreport14_4/{id}](#)
* **Method:** GET
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:
* {id} là mã của survey id cần truyền vào

### Dữ liệu trả về:
```
	{
		"id": int,
		"west_area": string,
		"around_the_east_side": string,
		"around_the_south_side": string,
		"north_side": string
	}
```

##### Ví dụ: {API_ROOT}/groundsurveyreport14_4/2
Dữ liệu trả về:
```
	{
		"id": "1",
		"west_area": "abc.jpg",
		"around_the_east_side": "abc.jpg",
		"around_the_south_side": "abc.jpg",
		"north_side": "abc.jpg"
	}
```



## <a name="27"></a>27. Thêm 1 Ground Survey Report 14_4 mới
* **URL:** [{API_ROOT}/groundsurveyreport14_4](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"id_ground_survey_report": int,
		"west_area": string,
		"around_the_east_side": string,
		"around_the_south_side": string,
		"north_side": string
	}
```

### Dữ liệu trả về:
```
	{
		"id_ground_survey_report": int,
		"west_area": string,
		"around_the_east_side": string,
		"around_the_south_side": string,
		"north_side": string,
		"id": int
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"west_area": "abc.jpg",
		"around_the_east_side": "abc.jpg",
		"around_the_south_side": "abc.jpg",
		"north_side": "abc.jpg",
		"id": "1"
	}
```

## <a name="28"></a>28. Cập nhật Ground Survey Report 14_4 theo id
* **URL:** [{API_ROOT}/groundsurveyreport14_4/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"west_area": string,
		"around_the_east_side": string,
		"around_the_south_side": string,
		"north_side": string
	}
```

### Dữ liệu trả về:
```
	{
		"west_area": string,
		"around_the_east_side": string,
		"around_the_south_side": string,
		"north_side": string
	}
```

##### Ví dụ: 
```
	{
		"id_ground_survey_report": "12",
		"west_area": "abc.jpg",
		"around_the_east_side": "abc.jpg",
		"around_the_south_side": "abc.jpg",
		"north_side": "abc.jpg"
	}
```

