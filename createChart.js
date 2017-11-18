function generateChart()
{
	var myChart = Highcharts.chart('graph', 
	{
        chart: 
		{
            type: 'column'
        },
		plotOptions: 
		{
			column:
			{
				pointPadding: 0,
				borderWidth: 0,
				groupPadding: 0.2,
				shadow: false
			}
		},
        title: 
		{
            text: 'Total Advertisements for Regions'
        },
        xAxis: 
		{
			gridLineWidth: 2,
			categories: categories
        },
        yAxis: 
		{
			gridLineWidth: 2,
			allowDecimals: false,
            title: 
			{
                text: 'Advertisements'
            }
        },
        series: series
    });
}