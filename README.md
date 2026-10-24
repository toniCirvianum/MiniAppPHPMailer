# MiniApp PHPMailer

Aplicació didàctica PHP sense frameworks, amb arquitectura MVC, router propi i dades guardades en sessions.
Inclou login, CRUD de productes i un formulari per provar l'enviament de correus amb PHPMailer i Mailpit.
L'entorn Docker incorpora Apache, PHP, Composer i Mailpit, i instal·la les dependències automàticament en arrencar.

## Arrencada

Des de l'arrel del projecte, amb Docker i Docker Compose disponibles:

```bash
docker compose up -d
```

La primera arrencada construeix la imatge si encara no existeix. Si es modifica el `Dockerfile`, cal reconstruir-la:

```bash
docker compose up -d --build
```

Un cop acabada la instal·lació automàtica de dependències:

- Aplicació: http://localhost:8089

- Bústia de Mailpit: http://localhost:8025

Per aturar el projecte:

```bash
docker compose down
```

