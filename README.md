# estate-rental-management

**Setup**

**Note: If you are not new to this project and to setup**
```
make setup
```
**This will do all necessary jobs for you**

For windows: 

1. Install docker desktop
[Docker website](https://www.docker.com/)

2. Then for make command to use, install from **powershell** ***Note: Run as administrator, make sure chocolatey is already installed***
```
choco install make -y
```

3. To build docker ***Note: This will build completely new***
```
make build
```

4. To up docker
```
make up
```

5. To down docker
```
make down
```

6. To clear caches ***Note: Laravel caches***

1. config-cache
```
make config-cache
```

2. route-clear
```
make route-clear
```

3. view-clear
```
make view-clear
```

4. optimize-clear
```
make optimize-clear
```

**To run as LINUX distribution**

```
docker exec -it app bash
```

***Note: app -> build name***