<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('https://jooinn.com/images/lonely-tree-reflection-3.jpg'); 
            background-size: cover;
            color: white;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
        }
        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            background: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
        .remember {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Bienvenue</h1>
        <form>
            <input type="email" placeholder="Entrez votre Email" required>
            <input type="password" placeholder="Entrez votre mot de passe" required>
            <div class="remember">
                <input type="checkbox"> Se rappeler de moi
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <p>Vous n'avez pas de compte ? <a href="#" style="color: lightblue;">Enregistrez-vous</a></p>
    </div>
</body>
</html>