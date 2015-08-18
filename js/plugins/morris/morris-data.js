$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            Zaman: 2666,
            Munir: null,
            Salam: 2647
        }, {
            period: '2010 Q2',
            Zaman: 2778,
            Munir: 2294,
            Salam: 2441
        }, {
            period: '2010 Q3',
            Zaman: 4912,
            Munir: 1969,
            Salam: 2501
        }, {
            period: '2010 Q4',
            Zaman: 3767,
            Munir: 3597,
            Salam: 5689
        }, {
            period: '2011 Q1',
            Zaman: 6810,
            Munir: 1914,
            Salam: 2293
        }, {
            period: '2011 Q2',
            Zaman: 5670,
            Munir: 4293,
            Salam: 1881
        }, {
            period: '2011 Q3',
            Zaman: 4820,
            Munir: 3795,
            Salam: 1588
        }, {
            period: '2011 Q4',
            Zaman: 15073,
            Munir: 5967,
            Salam: 5175
        }, {
            period: '2012 Q1',
            Zaman: 10687,
            Munir: 4460,
            Salam: 2028
        }, {
            period: '2012 Q2',
            Zaman: 8432,
            Munir: 5713,
            Salam: 1791
        }],
        xkey: 'period',
        ykeys: ['Zaman', 'Munir', 'Salam'],
        labels: ['Zaman', 'Munir', 'Salam'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});
