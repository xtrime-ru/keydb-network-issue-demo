# KeyDB network issue demo
Demo project to reproduce network utilisation issue

## Run
```shell
docker compose up demo
docker stats
docker compose down
```

## Results
 - "child" nodes receives updates twice. Expected: receive updates once.
 - "child" nodes send all received data back to sender. Expected: nodes don't send data back to sender.
 - "main" node has 6x times input traffic and 4x times output of keys size. Expected: 1x input and 2x output (for 2 child nodes)

