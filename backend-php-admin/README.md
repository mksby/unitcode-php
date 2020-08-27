# CSV to MySQL task

Use the following code to run the application locally

```
DB_HOST=127.0.0.1 DB_NAME=unitcode DB_USER=unitcode DB_USER_PASSWORD=unitcode123 php index.php ./data/import.csv
```

Use the following code to run the application in Docker

```
docker build -t unitcode .
docker run -p 80:80 -e IMPORT_FILE=./data/import.csv unitcode
```