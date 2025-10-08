(function ($) {
	"use strict";

/*			var chart = c3.generate({
				bindto: '#chart-bar', // id of chart wrapper
				data: {
					columns: [
						// each columns data
						['data1', 10, 8, 5, 4, 5, 10],
						['data2', 7, 7, 5, 7, 9, 6]
					],
					type: 'bar', // default type of chart
					colors: {
						data1: '#393939',
						data2: '#e31e24'
					},
					names: {
						// name of each serie
						'data1': 'Maximum',
						'data2': 'Minimum'
					}
				},
				axis: {
					x: {
						type: 'category',
						// name of each category
						categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
					},
				},
				bar: {
					width: 16
				},
				legend: {
					show: false, //hide legend
				},
				padding: {
					bottom: 0,
					top: 0
				},
			});
*/

	$.ajax({
		url: "https://crm.ilekasoft.com/Home/istatistikBar",
		type: "GET",
		success: function (data) {
			var x = data.split("-");
			var a=x[0].split(",");
			var b=x[1].split(",");
			var c=x[2].split(",");
			var chart = c3.generate({
				bindto: '#chart-bar', // id of chart wrapper
				data: {
					columns: [
						// each columns data
						['data1', a[0],a[1],a[2],a[3],a[4],a[5],a[6]],
						['data2', b[0],b[1],b[2],b[3],b[4],b[5],b[6]]
					],
					type: 'bar', // default type of chart
					colors: {
						data1: '#393939',
						data2: '#e31e24'
					},
					names: {
						// name of each serie
						'data1': 'Satış Faturası',
						'data2': 'Alış Faturası'
					}
				},
				axis: {
					x: {
						type: 'category',
						// name of each category
						categories: [c[0], c[1], c[2], c[3],c[4], c[5],c[6]]
					},
				},
				bar: {
					width: 16
				},
				legend: {
					show: false, //hide legend
				},
				padding: {
					bottom: 0,
					top: 0
				},
			});

		}});

	$.ajax({
		url: "https://crm.ilekasoft.com/Home/istatistikDonut",
		type: "GET",
		success: function (data) {
			var x =data.split(",");
			/*chart-donut**/
			var chart = c3.generate({
				bindto: '#chart-donut', // id of chart wrapper

				data: {
					columns:
						[['data1', x[0]],['data2', x[1]]]
					,
					type: 'donut', // default type of chart
					colors: {
						data1: '#393939',
						data2: '#e31e24'
					},
					names: {
						// name of each serie
						'data1': 'Satış Faturası Genel Toplam',
						'data2': 'Alış Faturası Genel Toplam'
					}
				},
				axis: {},
				legend: {
					show: false, //hide legend
				},
				padding: {
					bottom: 0,
					top: 0
				},
			});

		}
	});

})(jQuery);
