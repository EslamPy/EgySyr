import { ApexOptions } from 'apexcharts'
import ReactApexChart from 'react-apexcharts'

interface AnalyticsChartProps {
    selectedPeriod: string
}

export default function AnalyticsChart({ selectedPeriod }: AnalyticsChartProps) {
    // Chart data based on selected period
    const chartDataMap: Record<string, { categories: string[]; data: number[] }> = {
        optionOne: {
            // 12 months
            categories: [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
            ],
            data: [120, 150, 180, 140, 200, 170, 220, 210, 190, 230, 250, 270],
        },

        optionTwo: {
            // 30 days
            categories: Array.from({ length: 30 }, (_, i) => `${i + 1}`),
            data: [
                165, 385, 200, 295, 185, 195, 290, 110, 215, 390,
                280, 110, 125, 210, 270, 190, 310, 115, 90, 380,
                110, 225, 295, 170, 290, 110, 115, 290, 385, 315
            ],
        },

        optionThree: {
            // 7 days
            categories: ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            data: [80, 120, 150, 110, 170, 140, 160],
        },

        optionFour: {
            // 24 hours
            categories: Array.from({ length: 24 }, (_, i) => `${i}:00`),
            data: Array.from({ length: 24 }, () =>
                Math.floor(Math.random() * 100) + 20
            ),
        },
    }

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
            categories: chartDataMap[selectedPeriod].categories,
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
            max: 400,
            tickAmount: 4,
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
            data: chartDataMap[selectedPeriod].data,
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
