@extends('layouts.app')

@section('title', 'Backend')

@section('content')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

<div class="container-fluid py-4">
    <div class="card bg-white text-dark shadow-sm rounded-3 p-4">
        <h4 class="text-center mb-4">F&B Analytics Overview</h4>

        <div class="row">
            <!-- Doughnut Chart (Left) -->
            <div class="col-md-6 mb-4">
                <h5 class="text-center">Sales Distribution by Channel</h5>
                <canvas id="doughnutChart" style="width:100%; max-width:600px;"></canvas>
            </div>

            <!-- Line Chart (Right) -->
            <div class="col-md-6 mb-4">
                <h5 class="text-center">Sales Trends by Channel</h5>
                <canvas id="lineChart" style="width:100%; max-width:600px;"></canvas>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mt-4">
            <!-- Total Orders -->
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm p-3 text-center" style="background-color: #3d9970; color: #fff;">
                    <h6>Total Orders</h6>
                    <h4>{{ rand(3000, 8000) }}</h4>
                </div>
            </div>

            <!-- POS Orders -->
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm p-3 text-center" style="background-color: #8e5ea2; color: #fff;">
                    <h6>Orders via POS</h6>
                    <h4>{{ rand(1500, 5000) }}</h4>
                </div>
            </div>

            <!-- KIOSK Orders -->
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm p-3 text-center" style="background-color: #3cba9f; color: #fff;">
                    <h6>Orders via KIOSK</h6>
                    <h4>{{ rand(500, 3000) }}</h4>
                </div>
            </div>

            <!-- WEB Orders -->
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm p-3 text-center" style="background-color: #e8c3b9; color: #333;">
                    <h6>Orders via WEB</h6>
                    <h4>{{ rand(800, 4000) }}</h4>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const labels = ["POS", "KIOSK", "WEB"];
        const salesDistribution = [
            Math.floor(Math.random() * 50) + 30,
            Math.floor(Math.random() * 30) + 10,
            Math.floor(Math.random() * 30) + 10
        ];

        const timeLabels = ["Jan", "Feb", "Mar", "Apr", "May"];
        const salesTrends = {
            POS: timeLabels.map(() => Math.floor(Math.random() * 500) + 500),
            KIOSK: timeLabels.map(() => Math.floor(Math.random() * 400) + 200),
            WEB: timeLabels.map(() => Math.floor(Math.random() * 300) + 300)
        };

        new Chart(document.getElementById("doughnutChart"), {
            type: "doughnut",
            data: {
                labels: labels,
                datasets: [{
                    backgroundColor: ["#8e5ea2", "#3cba9f", "#e8c3b9"],
                    data: salesDistribution
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Sales Distribution by Channel",
                    fontColor: "#333"
                },
                legend: {
                    labels: {
                        fontColor: "#333"
                    }
                }
            }
        });
        new Chart(document.getElementById("lineChart"), {
            type: "line",
            data: {
                labels: timeLabels,
                datasets: [{
                        label: "POS",
                        data: salesTrends.POS,
                        borderColor: "#8e5ea2",
                        fill: false
                    },
                    {
                        label: "KIOSK",
                        data: salesTrends.KIOSK,
                        borderColor: "#3cba9f",
                        fill: false
                    },
                    {
                        label: "WEB",
                        data: salesTrends.WEB,
                        borderColor: "#e8c3b9",
                        fill: false
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: "Sales Trends by Channel",
                    fontColor: "#333"
                },
                legend: {
                    labels: {
                        fontColor: "#333"
                    }
                }
            }
        });
    });
</script>
@endsection