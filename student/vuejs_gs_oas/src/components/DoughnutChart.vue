<template>
    <Bar :data="data" :options="options" />
</template>
  
<script lang="ts">
import { Chart } from 'chart.js'
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    PieElement,
    CategoryScale,
    LinearScale,
    Colors,
} from 'chart.js'
import { Pie } from 'vue-chartjs'


Chart.register(CategoryScale, LinearScale, PieElement, Title, Tooltip, Legend, Colors)

export default {
    name: 'components',
    components: {
        Pie
    },
    data() {
        return {
            data: {
                labels: ['Red', 'Blue', 'yellow'],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        // You can customize the appearance of the x-axis here
                        title: {
                            display: true,
                            text: 'Days of the Week',
                            color: 'red', // Change the color of the x-axis title
                        },
                    },
                    y: {
                        // Customize the appearance of the y-axis here
                        title: {
                            display: true,
                            text: 'Number of Admission',
                        },
                    },
                },
                plugins: {
                    legend: {
                        align: 'start',
                        title: {
                            text: 'HIIII'
                        }
                    },
                },
            }
        }
    }
}

</script>