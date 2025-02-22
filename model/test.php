<!DOCTYPE html>
<html>
<head>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script>
        // Fetch KOOS score data for Koki Ohira from the database
        fetch('fetch_koos_scores.php')
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    console.error("No data available for Koki Ohira");
                    document.getElementById("chartContainer").innerHTML = "<p>No data found for Koki Ohira</p>";
                    return;
                }
                
                // Use only one set of columns
                let entry = data[0]; // Assuming one entry per fetch
                let dataPoints = [
                    { label: "KOOS Pain", y: parseFloat(entry.koos_pain) },
                    { label: "KOOS Function", y: parseFloat(entry.koos_function) },
                    { label: "KOOS QOL", y: parseFloat(entry.koos_qol) },
                    { label: "KOOS Total", y: parseFloat(entry.koos_total) }
                ];

                // Render chart
                let chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light2",
                    title: {
                        text: "KOOS Scores for Koki Ohira"
                    },
                    axisY: {
                        title: "Score (0-100)",
                        maximum: 100,
                        minimum: 0
                    },
                    data: [{
                        type: "column", 
                        dataPoints: dataPoints
                    }]
                });
                chart.render();
            })
            .catch(error => console.error('Error fetching KOOS score data:', error));
    </script>
</body>
</html>
