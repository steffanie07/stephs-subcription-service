<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stephanie's</title>
    <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,700|Mukta:500,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
       
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Include Bootstrap CSS (optional) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

</head>
<body class="is-boxed has-animations">
    <div class="body-wrap boxed-container">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
                            <a href="/">
                                <svg width="48" height="32" viewBox="0 0 48 32" xmlns="http://www.w3.org/2000/svg">
                                    <title>Stephanie</title>
                                    <defs>
                                        <linearGradient x1="0%" y1="100%" y2="0%" id="logo-a">
                                            <stop stop-color="#007CFE" stop-opacity="0" offset="0%"/>
                                            <stop stop-color="#007DFF" offset="100%"/>
                                        </linearGradient>
                                        <linearGradient x1="100%" y1="50%" x2="0%" y2="50%" id="logo-b">
                                            <stop stop-color="#FF4F7A" stop-opacity="0" offset="0%"/>
                                            <stop stop-color="#FF4F7A" offset="100%"/>
                                        </linearGradient>
                                    </defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <rect fill="url(#logo-a)" width="32" height="32" rx="16"/>
                                        <rect fill="url(#logo-b)" x="16" width="32" height="32" rx="16"/>
                                    </g>
                                </svg>
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <main>
<div class="container">
    <h1>Subscribers</h1>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
   @endif
    <table id="subscribers-table" class="display">
    </table>
</div>          
        </main>

        <footer class="site-footer text-light">
            <div class="container">
                <div class="site-footer-inner has-top-divider">
                    <div class="brand footer-brand">
                        <a href="#">
                            <svg width="48" height="32" viewBox="0 0 48 32" xmlns="http://www.w3.org/2000/svg">
                                <title>Stephanie</title>
                                <defs>
                                    <linearGradient x1="0%" y1="100%" y2="0%" id="logo-footer-a">
                                        <stop stop-color="#007CFE" stop-opacity="0" offset="0%"/>
                                        <stop stop-color="#007DFF" offset="100%"/>
                                    </linearGradient>
                                    <linearGradient x1="100%" y1="50%" x2="0%" y2="50%" id="logo-footer-b">
                                        <stop stop-color="#FF4F7A" stop-opacity="0" offset="0%"/>
                                        <stop stop-color="#FF4F7A" offset="100%"/>
                                    </linearGradient>
                                </defs>
                                <g fill="none" fill-rule="evenodd">
                                    <rect fill="url(#logo-footer-a)" width="32" height="32" rx="16"/>
                                    <rect fill="url(#logo-footer-b)" x="16" width="32" height="32" rx="16"/>
                                </g>
                            </svg>
                        </a>
                    </div>
                   
                   
                    <div class="footer-copyright">&copy; 2023 Stephanie, all rights reserved</div>
                </div>
            </div>
        </footer>
    </div>
<script src="{{ asset('js/main.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    var subscribersData = @json($subscribers);
    var dataSet = [];
    function getFieldValue(fields, targetKey) {
    for (let field of fields) {
        if (field.key === targetKey) {
            return field.value;
        }
    }
    return null;
}

function formatDate(dateString) {
  const date = new Date(dateString);
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = date.getFullYear();
  const hours = String(date.getHours()).padStart(2, '0');
  const minutes = String(date.getMinutes()).padStart(2, '0');
  const seconds = String(date.getSeconds()).padStart(2, '0');

  return {
    date: `${day}/${month}/${year}`,
    time: `${hours}:${minutes}:${seconds}`
  };
}
    subscribersData.forEach(function(subscriber) {
        dataSet.push([
    '<a href="/subscribers/' + encodeURIComponent(subscriber.email) + '/edit">' + subscriber.email + '</a>',
    subscriber.name,
    getFieldValue(subscriber.fields, 'country'),
      formatDate(subscriber.date_created).date,
      formatDate(subscriber.date_created).time
]);
    });

   $('#subscribers-table').DataTable({
    data: dataSet,
    columns: [
        { title: "Email" },
        { title: "Name" },
        { title: "Country" },
        { title: "Subscribe Date" },
        { title: "Subscribe Time" },
        { title: "Actions", defaultContent: ' <button class="delete-btn">Delete</button>' }
    ]
});
   $('#subscribers-table tbody').on('click', 'button.edit-btn', function() {
    var data = $('#subscribers-table').DataTable().row($(this).parents('tr')).data();
    var subscriberId = data[0]; // Assuming the first column is the email, adjust as needed
    window.location.href = '/subscribers/' + encodeURIComponent(subscriberId) + '/edit';
});

$('#subscribers-table tbody').on('click', 'button.delete-btn', function() {
    var data = $('#subscribers-table').DataTable().row($(this).parents('tr')).data();
    var subscriberId = data[0]; // Assuming the first column is the email, adjust as needed

    // Store the reference to the delete button element
    var deleteButton = $(this);
    
    // Perform an AJAX request to delete the subscriber
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/subscribers/' + encodeURIComponent(subscriberId),
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(result) {
            // Remove the deleted row from the DataTable
            $('#subscribers-table').DataTable().row(deleteButton.parents('tr')).remove().draw();
        },
        error: function(xhr, status, error) {
            // Handle the error
            alert('Error deleting subscriber: ' + error);
        }
    });
});


    

});

</script>

</body>
</html>