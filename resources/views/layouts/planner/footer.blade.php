<style>
    .dt-buttons{float: left;}
</style>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
</script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>










<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>





<script>
// var xArray = [50,60,70,80,90,100,110,120,130,140,150];
// var yArray = [7,8,8,9,9,9,10,11,14,14,15];

// Define Data
// var data = [{
//   x: xArray,
//   y: yArray,
//   mode:"lines"
// }];

// Define Layout
// var layout = {
//   xaxis: {range: [40, 160]},
//   yaxis: {range: [5, 16], title: "Ticket Sold"},

// };

// Display using Plotly
// Plotly.newPlot("myPlot", data, layout);
</script>



<script>
// var xArray = ["Jan", "Feb", "Mar", "April", "May","june"];
// var yArray = [55, 49, 44, 24, 15,22];

// var data = [{
//   x:xArray,
//   y:yArray,
//   type:"bar"
// }];

// var layout = {title:"Sales Report"};

// Plotly.newPlot("myPlot1", data, layout);
</script>



















<script type="text/javascript">
$(document).ready(function() {

    $('#example001').DataTable({
        "ordering": false,
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20],
            [5, 10, 20]
        ]
    });


});
$(document).ready(function() {
    var table = $('#example0011').DataTable({
        "ordering": false,
        pageLength : 10,
        lengthMenu: [[5, 10, 20], [5, 10, 20]],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                className: 'btn btn-primary', // Specify your custom class
                text: '<i class="fas fa-copy"></i>', // Use an icon instead of text
                titleAttr: 'Copy to Clipboard' // Tooltip for the button
            },
            {
                extend: 'csv',
                className: 'btn btn-outline-success', // Specify your custom class
                text: '<i class="fas fa-file-csv"></i>', // Use an icon instead of text
                titleAttr: 'Export to CSV' // Tooltip for the button
            },
            {
                extend: 'excel',
                className: 'btn btn-outline-warning', // Specify your custom class
                text: '<i class="fas fa-file-excel"></i>', // Use an icon instead of text
                titleAttr: 'Export to Excel' // Tooltip for the button
            },
            {
                extend: 'pdf',
                className: 'btn btn-outline-danger', // Specify your custom class
                text: '<i class="fas fa-file-pdf"></i>', // Use an icon instead of text
                titleAttr: 'Export to PDF' // Tooltip for the button
            },
            {
                extend: 'print',
                className: 'btn btn-outline-info', // Specify your custom class
                text: '<i class="fas fa-print"></i>', // Use an icon instead of text
                titleAttr: 'Print' // Tooltip for the button
            }
        ]
    });
});
$(document).ready(function() {

    $('#example00').DataTable({
        "ordering": false,
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20],
            [5, 10, 20]
        ]
    });


});
</script>


</body>

</html>
