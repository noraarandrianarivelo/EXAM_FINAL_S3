<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload - Photo-Share</title>
    <style>
        /* Reset et styles de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .logo:hover {
            opacity: 0.9;
        }

        .menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Main content */
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem 2rem;
        }

        /* Formulaire */
        .upload-form {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 3rem;
            width: 100%;
            max-width: 500px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .form-header h1 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #7f8c8d;
        }

        /* Groupes de formulaire */
        .form-group {
            margin-bottom: 2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.8rem;
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1rem;
        }

        /* Zone de fichier */
        .file-input-wrapper {
            border: 2px dashed #ddd;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-wrapper:hover {
            border-color: #6a11cb;
            background: #f0f4ff;
        }

        .file-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #6a11cb;
        }

        .file-input {
            width: 100%;
            padding: 1rem;
            margin-top: 1rem;
            border: 2px solid #e1e5eb;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
        }

        .file-input:focus {
            outline: none;
            border-color: #6a11cb;
            box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
        }

        /* Zone de description */
        textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e1e5eb;
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
            resize: vertical;
            min-height: 120px;
        }

        textarea:focus {
            outline: none;
            border-color: #6a11cb;
            box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
        }

        /* Bouton de soumission */
        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%);
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: auto;
        }

        footer p {
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .upload-form {
                padding: 2rem;
            }

            .form-header h1 {
                font-size: 1.7rem;
            }

            nav {
                flex-direction: column;
                gap: 1rem;
            }`

            .menu {
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .upload-form {
                padding: 1.5rem;
            }

            .file-input-wrapper {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <a href="index.html" class="logo">Photo-Share</a>
                <ul class="menu">
                    <li><a href="/api/images">Accueil</a></li>
                    <li><a href="/uploader">Upload</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="upload-form">
            <div class="form-header">
                <h1>Uploader une photo</h1>
                <p>Partagez vos meilleurs moments avec la communauté</p>
            </div>

            <form action="/api/save" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="image">Sélectionnez une image</label>
                    <div class="file-input-wrapper">
                        <div class="file-icon">📁</div>
                        <p>Cliquez pour choisir un fichier</p>
                        <input type="file" name="image" id="image" accept="image/*" class="file-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description (optionnelle)</label>
                    <textarea name="description" id="description" placeholder="Ajoutez une description à votre photo..."></textarea>
                </div>

                <button type="submit" class="submit-btn">
                    Uploader l'image
                </button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Photo-Share</p>
    </footer>
</body>

</html>