<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Relatórios - Unimontes</title>
    <style>
     
        body {
            font-family: sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-card {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-card h1 {
            color: #2A1871;   
            text-align: center;
            font-size: 28px;    
            margin-bottom: 10px; 
            font-weight: 600;    
        }
        .login-card h3 {
        color: #555;        
        text-align: center;
        font-size: 16px;
        font-weight: 400;    
        margin-top: 0;
        margin-bottom: 35px; 
        border-bottom: 1px solid #eee; 
        padding-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-button {
            width: 100%;
            padding: 12px;
            background-color: #2A1871;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-button:hover {
            background-color: #4126a8;
        }
        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        /* Adicione este CSS ao seu layouts/app.blade.php */

.dashboard-container {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    
    max-width: 100%;
}

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .dashboard-header h1 {
        color: #2A1871;
        margin: 0;
    }

    .logout-button {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
    }

    .filter-bar {
        margin-bottom: 20px;
    }

    .table-container table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-container th, .table-container td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    .table-container th {
        background-color: #f8f9fa;
    }

    .table-container tbody tr:hover {
        background-color: #f1f1f1;
    }

    .status-sent {
        color: #28a745;
        font-weight: bold;
    }

    .status-pending {
        color: #ffc107;
        font-weight: bold;
    }

    .actions .btn {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: white;
    }
    .btn-primary { background-color: #007bff; }
    .btn-secondary { background-color: #6c757d; }
    .btn-danger { background-color: #dc3545; }
    </style>
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>