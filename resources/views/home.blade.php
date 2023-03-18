@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
            Recette par rubrique
            </div>
            <div class="card-body">
            <canvas id="recette-chart"></canvas>
            </div>
        </div>
        </div>
        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
            Dépenses par rubrique
            </div>
            <div class="card-body">
            <canvas id="depense-chart"></canvas>
            </div>
        </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Solde Chart</h5>
                <canvas id="solde-chart"></canvas>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var recetteData = {!! json_encode($data['recetteRubrique']) !!};
    var depenseData = {!! json_encode($data['depenseRubrique']) !!};

    var recetteLabels = [];
    var recetteAmounts = [];
    var recetteColors = [];

    recetteData.forEach(function(item) {
        recetteLabels.push(item.label);
        recetteAmounts.push(item.amount);
        recetteColors.push('rgb(' + Math.floor(Math.random()*256) + ',' + Math.floor(Math.random()*256) + ',' + Math.floor(Math.random()*256) + ')');
    });

    var depenseLabels = [];
    var depenseAmounts = [];
    var depenseColors = [];

    depenseData.forEach(function(item) {
        depenseLabels.push(item.label);
        depenseAmounts.push(item.amount);
        depenseColors.push('rgb(' + Math.floor(Math.random()*256) + ',' + Math.floor(Math.random()*256) + ',' + Math.floor(Math.random()*256) + ')');
    });

    var recetteCtx = document.getElementById('recette-chart').getContext('2d');
    var recetteChart = new Chart(recetteCtx, {
        type: 'doughnut',
        data: {
        labels: recetteLabels,
        datasets: [{
            data: recetteAmounts,
            backgroundColor: recetteColors
        }]
        },
        options: {
        responsive: true,
        maintainAspectRatio: false
        }
    });

    var depenseCtx = document.getElementById('depense-chart').getContext('2d');
    var depenseChart = new Chart(depenseCtx, {
        type: 'doughnut',
        data: {
        labels: depenseLabels,
        datasets: [{
            data: depenseAmounts,
            backgroundColor: depenseColors
        }]
        },
        options: {
        responsive: true,
        maintainAspectRatio: false
        }
    });
</script>


<script>
    // Extract the years, caisse, and banque values from the data
    var years = @json($data['years']);
    var caisseValues = @json($data['caisseValues']);
    var banqueValues = @json($data['banqueValues']);
    var latestCaisse = @json($data['latestCaisse']);
    var latestBanque = @json($data['latestBanque']);

    // Create a line chart using Chart.js library
    var ctx = document.getElementById('solde-chart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: years,
        datasets: [{
            label: 'Caisse',
            data: caisseValues,
            borderColor: 'rgb(54, 162, 235)',
            fill: false
        }, {
            label: 'Banque',
            data: banqueValues,
            borderColor: 'rgb(255, 99, 132)',
            fill: false
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

    // Display the latest caisse and banque values in a card
    document.getElementById('latest-caisse').innerHTML = latestCaisse;
    document.getElementById('latest-banque').innerHTML = latestBanque;
</script>

@endsection
