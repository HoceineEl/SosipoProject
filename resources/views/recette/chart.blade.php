@extends('layout')

@section('content')
<div class="container">
    <div class="row"></div>
    <div class="row">
        <div class="card">
                <div class="card-header">
                    Le montant d'argent que chaque rubrique possède
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="150"></canvas>
                </div>
        </div>

</div>
</div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var data = @json($data);

        var labels = [];
        var amounts = [];
        var colors = [];

        data.forEach(function(item) {
            labels.push(item.label);
            amounts.push(item.amount);
            colors.push(getRandomColor());
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Amount',
                    data: amounts,
                    backgroundColor: colors,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>
@endsection
