<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portail SIO</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: radial-gradient(circle at top center, #3498db, #111028);
      font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #f0f0f0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      overflow: hidden;
    }

    h1 {
      font-size: 3.5em;
      margin-bottom: 1em;
      text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.7);
      animation: fadeInDown 1s ease-out;
    }

    .links {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1.5em;
      animation: fadeInUp 1.5s ease-out;
    }

    .links a {
      text-decoration: none;
      background: rgba(255, 255, 255, 0.1);
      padding: 1em 2.5em;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 15px;
      color: white;
      font-weight: 600;
      font-size: 1.2em;
      backdrop-filter: blur(10px);
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
      transition: all 0.4s ease;
      width: 525px;
      text-align: center;
    }

    .links a:hover {
      background: rgba(255, 255, 255, 0.3);
      color: #222;
      transform: translateY(-5px) scale(1.05);
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.6);
    }

    .links .double-links {
      display: flex;
      gap: 1.5em;
      margin-top: 1em;
    }

    .double-links a {
      width: 200px;
    }

    @keyframes moveStars {
      from { background-position: 0 0; }
      to { background-position: 0 1000px; }
    }

    @keyframes fadeInDown {
      0% { opacity: 0; transform: translateY(-50px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(50px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .content {
      position: relative;
      z-index: 1;
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="content">
    <h1>sio.marvinfm.fr</h1>
    <div class="links">
      <a href="./TCG_Terroir">CheeseCards (Trading Cards Game)</a>
      <a href="./LeBonStage">LeBonStage (Challenge)</a>
      <div class="double-links">
        <a href="https://subdomains.marvinfm.fr">sd.marvinfm.fr</a>
        <a href="https://marvinfm.fr">marvinfm.fr</a>
      </div>
    </div>
  </div>
</body>
</html>

