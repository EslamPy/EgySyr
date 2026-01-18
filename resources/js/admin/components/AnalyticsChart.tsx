import { ApexOptions } from 'apexcharts'
import ReactApexChart from 'react-apexcharts'

interface AnalyticsChartProps {
    selectedPeriod: string
    data: Array<{
        date: string
        visits: number
        unique_visitors: number
    }>
}

export default function AnalyticsChart({ selectedPeriod, data }: AnalyticsChartProps) {
    // ApexCharts options with dark theme
    const options: ApexOptions = {
        chart: {
            type: 'bar',
            height: 320,
            toolbar: { show: false },
            fontFamily: 'Inter, sans-serif',
            zoom: { enabled: false },
            background: 'transparent',
        },
        colors: ['#8B5CF6'], // neon-purple from your theme
        plotOptions: {
            bar: {
                borderRadius: 5,
                borderRadiusApplication: 'end',
                columnWidth: '25%',
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: data.map(d => {
                const date = new Date(d.date);
                if (selectedPeriod === 'optionFour') {
                    return date.getHours() + ':00';
                }
                if (selectedPeriod === 'optionThree') {
                    return date.toLocaleDateString('en-US', { weekday: 'short' });
                }
                if (selectedPeriod === 'optionOne') {
                    return date.toLocaleDateString('en-US', { month: 'short' });
                }
                return date.toLocaleDateString('en-US', { day: 'numeric', month: 'short' });
            }),
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            labels: {
                style: {
                    fontSize: '12px',
                    colors: '#9CA3AF', // gray-400
                }
            }
        },
        yaxis: {
            min: 0,
            labels: {
                style: {
                    fontSize: '12px',
                    colors: '#9CA3AF', // gray-400
                }
            },
        },
        fill: {
            opacity: 1,
        },
        grid: {
            show: true,
            borderColor: 'rgba(255, 255, 255, 0.1)', // white/10
            strokeDashArray: 4,
            position: 'back',
            xaxis: {
                lines: {
                    show: false
                }
            },
            yaxis: {
                lines: {
                    show: true
                }
            },
        },
        tooltip: {
            theme: 'dark',
            style: {
                fontSize: '12px',
                fontFamily: 'Inter, sans-serif',
            },
            onDatasetHover: {
                highlightDataSeries: false,
            },
            x: {
                show: true,
            },
            y: {
                formatter: (val: number) => `${val} visits`,
                title: {
                    formatter: () => '',
                }
            },
            marker: {
                show: true,
            },
        },
    }

    // Series data
    const series = [
        {
            name: 'Visits',
            data: data.map(d => d.visits),
        },
    ]

    return (
        <div className="max-w-full overflow-x-auto">
            <div className="-ml-5 min-w-[1300px] pl-2">
                <ReactApexChart
                    options={options}
                    series={series}
                    type="bar"
                    height={380}
                />
            </div>
        </div>
    )
}
