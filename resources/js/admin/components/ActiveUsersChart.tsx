import { ApexOptions } from 'apexcharts'
import { useEffect, useState } from 'react'
import ReactApexChart from 'react-apexcharts'

interface ActiveUsersChartProps {
    data: Array<{
        time: string
        count: number
    }>
}

export default function ActiveUsersChart({ data }: ActiveUsersChartProps) {
    const [series, setSeries] = useState([
        {
            name: 'Active Users',
            data: data.map(d => d.count),
        },
    ])

    useEffect(() => {
        setSeries([{
            name: 'Active Users',
            data: data.map(d => d.count)
        }])
    }, [data])

    const options: ApexOptions = {
        chart: {
            type: 'area',
            height: 155,
            toolbar: {
                show: false,
            },
            zoom: {
                enabled: false,
            },
            sparkline: {
                enabled: true, // Hides grid, axes, and labels
            },
            fontFamily: 'Inter, sans-serif',
            animations: {
                enabled: true,
                dynamicAnimation: {
                    speed: 800, // Animation duration
                }
            },
            background: 'transparent',
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: ['#8B5CF6'], // neon-purple from your theme
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [0, 100],
                colorStops: [
                    {
                        offset: 0,
                        color: '#8B5CF6',
                        opacity: 0.4
                    },
                    {
                        offset: 100,
                        color: '#8B5CF6',
                        opacity: 0
                    }
                ]
            },
        },
        markers: {
            size: 0,
        },
        tooltip: {
            theme: 'dark',
            x: {
                show: false,
            },
            y: {
                formatter: (val: number) => `${val}`,
            },
        },
        grid: {
            show: false,
        },
        xaxis: {
            labels: { show: false },
            axisBorder: { show: false },
            axisTicks: { show: false },
        },
        yaxis: {
            min: 0,
            max: 100, // Fixed range prevents the chart from "jumping" when scaling
            labels: { show: false },
        },
    }

    return (
        <div className="w-full">
            <ReactApexChart
                options={options}
                series={series}
                type="area"
                height={155}
            />
        </div>
    )
}
