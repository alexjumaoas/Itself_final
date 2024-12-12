<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .unauthorized-container {
            text-align: center;
            background: white;
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .unauthorized-container h1 {
            font-size: 100px;
            color: #d9534f;
            margin-bottom: 10px;
        }
        .unauthorized-container p {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }
        .unauthorized-container a {
            color: white;
        }
    </style>
</head>
<body>
    <div class="unauthorized-container">
        <h1><span class="glyphicon glyphicon-ban-circle"></span> 403</h1>
        <p>You do not have permission to access this page.</p>
        <a 
            href="{{ Auth::guard('custom_users')->user() 
                    ? (Auth::guard('custom_users')->user()->usertype == '1' 
                        ? route('admin.dashboard') 
                        : (Auth::guard('custom_users')->user()->usertype == '3' 
                            ? route('technician.dashboard') 
                            : route('requester.dashboard')))
                    : route('login') }}" 
            class="btn btn-danger btn-lg"
        >
            <span class="glyphicon glyphicon-home"></span> Go to Home
        </a>
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>