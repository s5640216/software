var City = function() {
	var dir = base_url();
	var citys = null;
	var areas = null;
	_init_event();
	getCity();
	getArea();
	function getCity(){
		$.ajax({
            url: dir + 'common/common/getCity',
            type: "POST",
            async: false,
            dataType: 'JSON',
            success: function (data) {
                citys = data;
				appendCity();
            }
        });
	}
	
	function getArea(){
		$.ajax({
            url: dir + 'common/common/getArea',
            type: "POST",
            async: false,
            dataType: 'JSON',
            success: function (data) {
                areas = data;
            }
        });
	}
	
	function appendCity(){
		citys.forEach(function(city){
			$('.sel_city').append("<option data-city_id=" + city.city_id +">" + city.city_name +  "</option>");
		})
	}
	
	
	function _init_event(){
		$('.sel_city').change(function(){
			var city_id = $(this).find(":selected").attr('data-city_id');
			var sel_area = $(this).parent().find('.sel_area');
			sel_area.empty();
			sel_area.append("<option>請選擇</option>");
			areas.forEach(function(area){
				if(city_id == area.city_id){
					sel_area.append("<option data-area_id=" + area.area_id +" data-zipcode=" + area.zipcode + ">" + area.area_name +  "</option>");
				}
			})
		});
	}
};