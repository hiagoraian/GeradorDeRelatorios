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
    </style>
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>