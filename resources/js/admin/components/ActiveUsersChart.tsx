import { ApexOptions } from 'apexcharts'
import React, { useEffect, useState, useRef } from 'react'
import ReactApexChart from 'react-apexcharts'

export default function ActiveUsersChart() {
    // Initial data to populate the chart
    const initialData = [40, 55, 85, 75, 60, 50, 45, 42, 40, 55, 75, 60, 45, 50, 65, 70, 85, 80, 65, 55, 50]
    const [series, setSeries] = useState([
        {
            name: 'Active Users',
            data: initialData,
        },
    ])

    // Use a ref to keep track of data without triggering re-renders for logic
    const dataRef = useRef(initialData)

    useEffect(() => {
        const interval = setInterval(() => {
            const currentData = [...dataRef.current]
            const lastVal = currentData[currentData.length - 1]

            // Simulate organic fluctuation (slight up/down)
            // Range: -7 to +7, keeping values between 30 and 95 for visual consistency
            let newVal = lastVal + (Math.floor(Math.random() * 15) - 7)
            newVal = Math.max(30, Math.min(95, newVal))

            // Sliding window logic: remove first, add new to end
            currentData.shift()
            currentData.push(newVal)

            dataRef.current = currentData

            setSeries([{
                name: 'Active Users',
                data: currentData
            }])
        }, 2000) // Update every 2 seconds for a smooth, non-jittery flow

        return () => clearInterval(interval)
    }, [])

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
