<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap Local CSS -->
    <link href="<?= Flight::get('flight.base_url') ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .form-control, .form-select {
            border-radius: 0.75rem !important;
            border: 1px solid #e2e8f0 !important;
            background-color: #f8fafc !important;
            padding: 0.75rem 1rem !important;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #14b8a6 !important;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.2) !important;
            background-color: #fff !important;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-teal-50/30 to-slate-100 min-h-screen">
    <?php include 'header.php'; ?>

        <?php 
        echo $content ?? ''; 
        ?>

    <?php include 'footer.php'; ?>
</body>
</html>