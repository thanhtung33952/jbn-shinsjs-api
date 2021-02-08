### API public

**API_ROOT:** http://153.125.228.20/api/

## Danh sách các API liên quan tới ConstructionPlan
###### 1. [Lấy thông tin ConstructionPlan từ id](#1. Lấy thông tin ConstructionPlan từ id)
###### 2. [Thêm 1 ConstructionPlan mới](#2. Thêm 1 ConstructionPlan mới)
###### 3. [Cập nhật ConstructionPlan theo id](#3. Cập nhật ConstructionPlan theo id)


**********************************

## Danh sách các API liên quan tới ConstructionPlan


## <a name="1"></a>1. Lấy thông tin ConstructionPlan từ id
* **URL:** [{API_ROOT}/constructionplan/{id}](#)
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
		"building_structure": string,
		"number_of_floors": string,
		"foundation_shape": string,
		"foundation_area": string,
		"necessary_ground_strength": string,
		"total_building_weight": string,
		"station_number": string,
		"middle_layer_soil": string,
		"soil_name_at_the_tip": string,
		"improved_body_tip_depth": string,
		"improved_ground_short_side_width": string,
		"outer_circumference": string
	}
```

##### Ví dụ: {API_ROOT}/constructionplan/12
Dữ liệu trả về:
```
	{
		"id": "1",
		"survey_id": "12",
		"building_structure": "木造",
		"number_of_floors": "3階",
		"foundation_shape": "ベタ基礎",
		"foundation_area": "40.57",
		"necessary_ground_strength": "30",
		"total_building_weight": "1217.1",
		"station_number": "1",
		"middle_layer_soil": "砂質土・粘性土",
		"soil_name_at_the_tip": "砂質土",
		"improved_body_tip_depth": "2.5 GL-m",
		"improved_ground_short_side_width": "6.37",
		"outer_circumference": "25.48"
	}
```



## <a name="2"></a>2. Thêm 1 ConstructionPlan mới
* **URL:** [{API_ROOT}/constructionplan](#)
* **Method:** POST
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"survey_id": int,
		"building_structure": string,
		"number_of_floors": string,
		"foundation_shape": string,
		"foundation_area": string,
		"necessary_ground_strength": string,
		"total_building_weight": string,
		"station_number": string,
		"middle_layer_soil": string,
		"soil_name_at_the_tip": string,
		"improved_body_tip_depth": string,
		"improved_ground_short_side_width": string,
		"outer_circumference": string
	}
```

### Dữ liệu trả về:
```
	{
	        "survey_id": int,
		"building_structure": string,
		"number_of_floors": string,
		"foundation_shape": string,
		"foundation_area": string,
		"necessary_ground_strength": string,
		"total_building_weight": string,
		"station_number": string,
		"middle_layer_soil": string,
		"soil_name_at_the_tip": string,
		"improved_body_tip_depth": string,
		"improved_ground_short_side_width": string,
		"outer_circumference": string,
	        "id": int
	}
```

##### Ví dụ: 
```
	{
		"survey_id": "12",
		"building_structure": "木造",
		"number_of_floors": "3階",
		"foundation_shape": "ベタ基礎",
		"foundation_area": "40.57",
		"necessary_ground_strength": "30",
		"total_building_weight": "1217.1",
		"station_number": "1",
		"middle_layer_soil": "砂質土・粘性土",
		"soil_name_at_the_tip": "砂質土",
		"improved_body_tip_depth": "2.5 GL-m",
		"improved_ground_short_side_width": "6.37",
		"outer_circumference": "25.48",
		"id": "1"
	}
```

## <a name="3"></a>3. Cập nhật ConstructionPlan theo id
* **URL:** [{API_ROOT}/constructionplan/{id}](#)
* **Method:** PUT
* **Content Type:** application/json
* **Reponse Type:** text/json

### Tham số:

```
	{
		"building_structure": string,
		"number_of_floors": string,
		"foundation_shape": string,
		"foundation_area": string,
		"necessary_ground_strength": string,
		"total_building_weight": string,
		"station_number": string,
		"middle_layer_soil": string,
		"soil_name_at_the_tip": string,
		"improved_body_tip_depth": string,
		"improved_ground_short_side_width": string,
		"outer_circumference": string
	}
```

### Dữ liệu trả về:
```
	{
		
		"building_structure": string,
		"number_of_floors": string,
		"foundation_shape": string,
		"foundation_area": string,
		"necessary_ground_strength": string,
		"total_building_weight": string,
		"station_number": string,
		"middle_layer_soil": string,
		"soil_name_at_the_tip": string,
		"improved_body_tip_depth": string,
		"improved_ground_short_side_width": string,
		"outer_circumference": string
	}
```

##### Ví dụ: 
```
	{
		"building_structure": "木造",
		"number_of_floors": "3階",
		"foundation_shape": "ベタ基礎",
		"foundation_area": "40.57",
		"necessary_ground_strength": "30",
		"total_building_weight": "1217.1",
		"station_number": "1",
		"middle_layer_soil": "砂質土・粘性土",
		"soil_name_at_the_tip": "砂質土",
		"improved_body_tip_depth": "2.5 GL-m",
		"improved_ground_short_side_width": "6.37",
		"outer_circumference": "25.48"
	}
```
