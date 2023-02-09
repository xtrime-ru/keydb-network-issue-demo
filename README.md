# KeyDB network issue demo
Demo project to reproduce network utilisation issue

## Run
```shell
docker compose up demo
docker stats
docker compose down
```

## Results
 - "child" nodes send all received data back to sender. Expected: nodes don't send data back to sender.