# LAB Checkpoint 1 (CP-1) — Docker

## 📌 Sobre o projeto

Este projeto demonstra a execução de dois cenários utilizando Docker:

- LAB 1: Página estática com NGINX
- LAB 2: Aplicação PHP + MySQL com persistência

---

# 🧪 Ambiente utilizado

```bash
Last login: Thu Mar 19 00:51:41 on console
ronaldoattamah@QQWFK990LC ~ % docker --version
Docker version 29.2.1, build a5c7197
ronaldoattamah@QQWFK990LC ~ % docker ps
CONTAINER ID   IMAGE     COMMAND   CREATED   STATUS    PORTS     NAMES
ronaldoattamah@QQWFK990LC ~ % cd '/Users/ronaldoattamah/Developer/Projects/Cloud Developer/lab1-static-site'
ronaldoattamah@QQWFK990LC lab1-static-site % touch site/index.html
touch: site/index.html: No such file or directory
ronaldoattamah@QQWFK990LC lab1-static-site % touch site/index.html
ronaldoattamah@QQWFK990LC lab1-static-site % touch dockerfile
ronaldoattamah@QQWFK990LC lab1-static-site % docker build -t lab1-nginx .
[+] Building 21.7s (6/6) FINISHED                          docker:desktop-linux
 => [internal] load build definition from dockerfile                       0.0s
 => => transferring dockerfile: 64B                                        0.0s
 => [internal] load metadata for docker.io/library/nginx:latest            2.8s
 => [auth] library/nginx:pull token for registry-1.docker.io               0.0s
 => [internal] load .dockerignore                                          0.0s
 => => transferring context: 2B                                            0.0s
 => [1/1] FROM docker.io/library/nginx:latest@sha256:dec7a90bd0973b07683  18.9s
 => => resolve docker.io/library/nginx:latest@sha256:dec7a90bd0973b076832  0.0s
 => => sha256:dec7a90bd0973b076832dc56933fe876bc014929e 10.23kB / 10.23kB  0.0s
 => => sha256:be275332f8853c71c4b5dc5478840381bd43179acae 2.29kB / 2.29kB  0.0s
 => => sha256:c755eb98e755f546d294f6036b10ec449685c12c2ee 9.11kB / 9.11kB  0.0s
 => => sha256:f4badedbec24858ef2dc51256f6418328e305e9c 30.14MB / 30.14MB  16.7s
 => => sha256:74d322dac342b6fd2003a33b74eebdbb4d48e41e 31.14MB / 31.14MB  18.2s
 => => sha256:2bf7833cbb884e4308b225edf054563c8209bc3c1af2218 627B / 627B  0.7s
 => => sha256:39db0d317f1e6829b5e10fa2fed607eca1250b2c6f28737 954B / 954B  1.3s
 => => sha256:bcc43639f11c826527333461fc557189a213400ecf77f53 404B / 404B  1.9s
 => => sha256:6dd09f2dc2e1675cc0ffacf3ec4749412dfb5b23c6c 1.21kB / 1.21kB  2.2s
 => => sha256:13a86953cc5f550cdd05a4c5d4dd5710017045d0b26 1.40kB / 1.40kB  2.5s
 => => extracting sha256:f4badedbec24858ef2dc51256f6418328e305e9c3c5a5e09  0.8s
 => => extracting sha256:74d322dac342b6fd2003a33b74eebdbb4d48e41e1f0e1f5e  0.5s
 => => extracting sha256:2bf7833cbb884e4308b225edf054563c8209bc3c1af22184  0.0s
 => => extracting sha256:39db0d317f1e6829b5e10fa2fed607eca1250b2c6f28737e  0.0s
 => => extracting sha256:bcc43639f11c826527333461fc557189a213400ecf77f531  0.0s
 => => extracting sha256:6dd09f2dc2e1675cc0ffacf3ec4749412dfb5b23c6c923f9  0.0s
 => => extracting sha256:13a86953cc5f550cdd05a4c5d4dd5710017045d0b260dc03  0.0s
 => exporting to image                                                     0.0s
 => => exporting layers                                                    0.0s
 => => writing image sha256:3de225e226299a6eb35d7d51fd4d15385a02a241d0706  0.0s
 => => naming to docker.io/library/lab1-nginx                              0.0s

What's next:
    View a summary of image vulnerabilities and recommendations → docker scout quickview 
ronaldoattamah@QQWFK990LC lab1-static-site % docker run -d \
  --name lab1-container \
  -p 8080:80 \
  -v $(pwd)/site:/usr/share/nginx/html \
  lab1-nginx
docker: invalid reference format

Run 'docker run --help' for more information
ronaldoattamah@QQWFK990LC lab1-static-site % docker run -d --name lab1-container -p 8080:80 -v "$(pwd)/site:/usr/share/nginx/html" lab1-nginx
3bf1eb311ecca615c316be4f1ef2e4615f834d9a5f7ab7a3a71bb4f26d6c429b
ronaldoattamah@QQWFK990LC lab1-static-site % docker ps
CONTAINER ID   IMAGE        COMMAND                  CREATED          STATUS          PORTS                                     NAMES
3bf1eb311ecc   lab1-nginx   "/docker-entrypoint.…"   18 seconds ago   Up 17 seconds   0.0.0.0:8080->80/tcp, [::]:8080->80/tcp   lab1-container
ronaldoattamah@QQWFK990LC lab1-static-site % docker network create lab2-network
0261963ade4544f13c6a793cd2344a689cd38def1d8f5d38d7d4b5e548a20534
ronaldoattamah@QQWFK990LC lab1-static-site % docker network ls
NETWORK ID     NAME                         DRIVER    SCOPE
d654eecef204   bridge                       bridge    local
4dca43b488ad   cosmocareapipython_default   bridge    local
fbc985ea5d05   host                         host      local
8578d5bc8b68   insight-filesystem_default   bridge    local
0261963ade45   lab2-network                 bridge    local
3b10e31f8cdc   none                         null      local
ronaldoattamah@QQWFK990LC lab1-static-site % docker volume create mysql_data_lab2
mysql_data_lab2
ronaldoattamah@QQWFK990LC lab1-static-site % docker volume ls
DRIVER    VOLUME NAME
local     cosmocareapipython_pgdata
local     insight-conda-filesystem_data
local     insight-conda-filesystem_public-certificates
local     insight-conda-filesystem_workbench-data
local     insight-conda-filesystem_workbench-logs
local     insight-conda-filesystem_workbench-server-credentials
local     insight-filesystem_data
local     insight-filesystem_public-certificates
local     insight-filesystem_workbench-data
local     insight-filesystem_workbench-logs
local     insight-filesystem_workbench-server-credentials
local     mysql_data_lab2
local     node_red_data
ronaldoattamah@QQWFK990LC lab1-static-site % docker run -d --name mysql-db --network lab2-network -e MYSQL_ROOT_PASSWORD=root123 -e MYSQL_DATABASE=meubanco -e MYSQL_USER=userlab -e MYSQL_PASSWORD=senhalab -v mysql_data_lab2:/var/lib/mysql -p 3307:3306 mysql:8.0
Unable to find image 'mysql:8.0' locally
8.0: Pulling from library/mysql
b877fed8ea0c: Pull complete 
39676fe80096: Pull complete 
a2bca3b1a468: Pull complete 
8816a4545c8d: Pull complete 
63ab8f2de72f: Pull complete 
c79772aa74f1: Pull complete 
ba34007679fc: Pull complete 
2e64b1ca3afd: Pull complete 
ae051ab9e6ff: Pull complete 
9ee96801673c: Pull complete 
ab0c0a95555d: Pull complete 
Digest: sha256:0f34c70018dcbde655ba3eaba3d33c02198d392b9364974462eee13a903af385
Status: Downloaded newer image for mysql:8.0
9b3632ca499c2e5ae3c3bbccaabf05e7e87c8906038f2a65f458093da67e010a
ronaldoattamah@QQWFK990LC lab1-static-site % docker ps
CONTAINER ID   IMAGE        COMMAND                  CREATED          STATUS          PORTS                                         NAMES
9b3632ca499c   mysql:8.0    "docker-entrypoint.s…"   46 seconds ago   Up 45 seconds   0.0.0.0:3307->3306/tcp, [::]:3307->3306/tcp   mysql-db
3bf1eb311ecc   lab1-nginx   "/docker-entrypoint.…"   21 minutes ago   Up 21 minutes   0.0.0.0:8080->80/tcp, [::]:8080->80/tcp       lab1-container
ronaldoattamah@QQWFK990LC lab1-static-site % docker logs mysql-db
2026-03-19 18:58:15+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.45-1.el9 started.
2026-03-19 18:58:15+00:00 [Note] [Entrypoint]: Switching to dedicated user 'mysql'
2026-03-19 18:58:15+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.45-1.el9 started.
2026-03-19 18:58:15+00:00 [Note] [Entrypoint]: Initializing database files
2026-03-19T18:58:15.677875Z 0 [Warning] [MY-011068] [Server] The syntax '--skip-host-cache' is deprecated and will be removed in a future release. Please use SET GLOBAL host_cache_size=0 instead.
2026-03-19T18:58:15.677929Z 0 [System] [MY-013169] [Server] /usr/sbin/mysqld (mysqld 8.0.45) initializing of server in progress as process 80
2026-03-19T18:58:15.688836Z 1 [System] [MY-013576] [InnoDB] InnoDB initialization has started.
2026-03-19T18:58:15.985497Z 1 [System] [MY-013577] [InnoDB] InnoDB initialization has ended.
2026-03-19T18:58:16.712027Z 6 [Warning] [MY-010453] [Server] root@localhost is created with an empty password ! Please consider switching off the --initialize-insecure option.
2026-03-19 18:58:19+00:00 [Note] [Entrypoint]: Database files initialized
2026-03-19 18:58:19+00:00 [Note] [Entrypoint]: Starting temporary server
2026-03-19T18:58:19.338268Z 0 [Warning] [MY-011068] [Server] The syntax '--skip-host-cache' is deprecated and will be removed in a future release. Please use SET GLOBAL host_cache_size=0 instead.
2026-03-19T18:58:19.339415Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.45) starting as process 124
2026-03-19T18:58:19.350162Z 1 [System] [MY-013576] [InnoDB] InnoDB initialization has started.
2026-03-19T18:58:19.490247Z 1 [System] [MY-013577] [InnoDB] InnoDB initialization has ended.
2026-03-19T18:58:19.661302Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
2026-03-19T18:58:19.661336Z 0 [System] [MY-013602] [Server] Channel mysql_main configured to support TLS. Encrypted connections are now supported for this channel.
2026-03-19T18:58:19.662601Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
2026-03-19T18:58:19.675241Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Socket: /var/run/mysqld/mysqlx.sock
2026-03-19T18:58:19.675368Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.45'  socket: '/var/run/mysqld/mysqld.sock'  port: 0  MySQL Community Server - GPL.
2026-03-19 18:58:19+00:00 [Note] [Entrypoint]: Temporary server started.
'/var/lib/mysql/mysql.sock' -> '/var/run/mysqld/mysqld.sock'
Warning: Unable to load '/usr/share/zoneinfo/iso3166.tab' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/leap-seconds.list' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/leapseconds' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/tzdata.zi' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/zone.tab' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/zone1970.tab' as time zone. Skipping it.
2026-03-19 18:58:20+00:00 [Note] [Entrypoint]: Creating database meubanco
2026-03-19 18:58:20+00:00 [Note] [Entrypoint]: Creating user userlab
2026-03-19 18:58:20+00:00 [Note] [Entrypoint]: Giving user userlab access to schema meubanco

2026-03-19 18:58:20+00:00 [Note] [Entrypoint]: Stopping temporary server
2026-03-19T18:58:20.660465Z 13 [System] [MY-013172] [Server] Received SHUTDOWN from user root. Shutting down mysqld (Version: 8.0.45).
2026-03-19T18:58:22.302506Z 0 [System] [MY-010910] [Server] /usr/sbin/mysqld: Shutdown complete (mysqld 8.0.45)  MySQL Community Server - GPL.
2026-03-19 18:58:22+00:00 [Note] [Entrypoint]: Temporary server stopped

2026-03-19 18:58:22+00:00 [Note] [Entrypoint]: MySQL init process done. Ready for start up.

2026-03-19T18:58:22.831561Z 0 [Warning] [MY-011068] [Server] The syntax '--skip-host-cache' is deprecated and will be removed in a future release. Please use SET GLOBAL host_cache_size=0 instead.
2026-03-19T18:58:22.832395Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.45) starting as process 1
2026-03-19T18:58:22.837042Z 1 [System] [MY-013576] [InnoDB] InnoDB initialization has started.
2026-03-19T18:58:22.927161Z 1 [System] [MY-013577] [InnoDB] InnoDB initialization has ended.
2026-03-19T18:58:23.060740Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
2026-03-19T18:58:23.060777Z 0 [System] [MY-013602] [Server] Channel mysql_main configured to support TLS. Encrypted connections are now supported for this channel.
2026-03-19T18:58:23.063790Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
2026-03-19T18:58:23.072134Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Bind-address: '::' port: 33060, socket: /var/run/mysqld/mysqlx.sock
2026-03-19T18:58:23.072204Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.45'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.
ronaldoattamah@QQWFK990LC lab1-static-site % cd .. 
ronaldoattamah@QQWFK990LC Cloud Developer % cd lab2-php-mysql 
ronaldoattamah@QQWFK990LC lab2-php-mysql % docker build -t lab2-php-app .
[+] Building 0.0s (1/1) FINISHED                                                                                          docker:desktop-linux
 => [internal] load build definition from Dockerfile                                                                                      0.0s
 => => transferring dockerfile: 2B                                                                                                        0.0s
ERROR: failed to build: failed to solve: failed to read dockerfile: open Dockerfile: no such file or directory
ronaldoattamah@QQWFK990LC lab2-php-mysql % touch Dockerfile
ronaldoattamah@QQWFK990LC lab2-php-mysql % docker build -t lab2-php-app .
[+] Building 0.5s (7/7) FINISHED                                                                                          docker:desktop-linux
 => [internal] load build definition from Dockerfile                                                                                      0.0s
 => => transferring dockerfile: 142B                                                                                                      0.0s
 => [internal] load metadata for docker.io/library/php:8.2-apache                                                                         0.4s
 => [internal] load .dockerignore                                                                                                         0.0s
 => => transferring context: 2B                                                                                                           0.0s
 => CANCELED [1/3] FROM docker.io/library/php:8.2-apache@sha256:f74ec0b41f6c853ce206ee7f15cde27c83638426abe66baf922d4df18868f67b          0.0s
 => => resolve docker.io/library/php:8.2-apache@sha256:f74ec0b41f6c853ce206ee7f15cde27c83638426abe66baf922d4df18868f67b                   0.0s
 => => sha256:84abd527f29167d7ac0eb95301a957b6da8c8b90d5a255ce1e96f045df917f71 3.82kB / 3.82kB                                            0.0s
 => => sha256:0120711dd89cb62db4ac53291909b458aee8cf57acadee608fac4bc08990276c 11.94kB / 11.94kB                                          0.0s
 => => sha256:f74ec0b41f6c853ce206ee7f15cde27c83638426abe66baf922d4df18868f67b 10.35kB / 10.35kB                                          0.0s
 => [internal] load build context                                                                                                         0.0s
 => => transferring context: 2B                                                                                                           0.0s
 => CACHED [2/3] RUN docker-php-ext-install pdo pdo_mysql mysqli                                                                          0.0s
 => ERROR [3/3] COPY app/ /var/www/html/                                                                                                  0.0s
------
 > [3/3] COPY app/ /var/www/html/:
------
Dockerfile:5
--------------------
   3 |     RUN docker-php-ext-install pdo pdo_mysql mysqli
   4 |     
   5 | >>> COPY app/ /var/www/html/
   6 |     
   7 |     EXPOSE 80
--------------------
ERROR: failed to build: failed to solve: failed to compute cache key: failed to calculate checksum of ref 66f48c65-efe4-4c06-bb80-c805037786f0::wrkto6m8gf5lqqpul0zgxkoa0: "/app": not found
ronaldoattamah@QQWFK990LC lab2-php-mysql % docker build -t lab2-php-app .
[+] Building 77.3s (9/9) FINISHED                                                                                         docker:desktop-linux
 => [internal] load build definition from Dockerfile                                                                                      0.0s
 => => transferring dockerfile: 142B                                                                                                      0.0s
 => [internal] load metadata for docker.io/library/php:8.2-apache                                                                         0.9s
 => [auth] library/php:pull token for registry-1.docker.io                                                                                0.0s
 => [internal] load .dockerignore                                                                                                         0.0s
 => => transferring context: 2B                                                                                                           0.0s
 => [1/3] FROM docker.io/library/php:8.2-apache@sha256:f74ec0b41f6c853ce206ee7f15cde27c83638426abe66baf922d4df18868f67b                  65.6s
 => => resolve docker.io/library/php:8.2-apache@sha256:f74ec0b41f6c853ce206ee7f15cde27c83638426abe66baf922d4df18868f67b                   0.0s
 => => sha256:8af7753225c0a79ef3c56194676dac85a2ade8fb9c256415f21600acb03a9731 225B / 225B                                                0.7s
 => => sha256:0120711dd89cb62db4ac53291909b458aee8cf57acadee608fac4bc08990276c 11.94kB / 11.94kB                                          0.0s
 => => sha256:84abd527f29167d7ac0eb95301a957b6da8c8b90d5a255ce1e96f045df917f71 3.82kB / 3.82kB                                            0.0s
 => => sha256:a1b0ffd274772cdefc5ba095eece54497b0562452e0ea1caf5998bb486d5b630 110.16MB / 110.16MB                                       52.1s
 => => sha256:d18be28244641f4edd769e324a504255161c59fef2d5759b4daad764090536f1 222B / 222B                                                0.5s
 => => sha256:f74ec0b41f6c853ce206ee7f15cde27c83638426abe66baf922d4df18868f67b 10.35kB / 10.35kB                                          0.0s
 => => sha256:84b68504ace9fdb7e306032e2adf1d297b591f087627c533b121b03e5ace5e1b 4.31MB / 4.31MB                                            8.3s
 => => extracting sha256:8af7753225c0a79ef3c56194676dac85a2ade8fb9c256415f21600acb03a9731                                                 0.0s
 => => sha256:4164c41cf3f401bd706f091c14f5deb30cfd58d065cdd074b0b704b22afaf14f 429B / 429B                                                1.5s
 => => sha256:3fb1ddd3dd35c3ad1fff159bf905b70255b82a38083e7689184f019e1bb23015 482B / 482B                                                3.0s
 => => sha256:a8b19ab041956cc518363726acd71c703078bc71ca46279445dbe0d462b1c1bb 12.32MB / 12.32MB                                         65.1s
 => => sha256:f57d376bb3a0f60e5db4e2b6dafba6cb615317f1cf6786be9fbd3f4964ee8f2d 488B / 488B                                                9.8s
 => => sha256:a6fd57f1ea3b0bfa9905533da0a6ad95282654436572f070bfecd37e3c2f0bc0 11.49MB / 11.49MB                                         23.4s
 => => sha256:72291c43daaef417a15fef16d39cb93cac029702c6363b3987d3fd4f188b5152 2.46kB / 2.46kB                                           23.9s
 => => sha256:9ce309a3039b5bc7964ccd757117989c575df5cd63333df508ef51e0fbe24376 249B / 249B                                               24.3s
 => => sha256:05d50c88bf0d113b15f086cff2d9fd3a90f6ccc81b4e97c36f770414a3dfec8b 244B / 244B                                               24.6s
 => => sha256:2226ab8414c1d8a8a9feb592a2fd11f7978715bf7e3fc28e2265dacdf34b62d5 890B / 890B                                               24.9s
 => => sha256:4f4fb700ef54461cfa02571ae0db9a0dc1e0cdb5577484a6d75e68dc38e8acc1 32B / 32B                                                 25.3s
 => => extracting sha256:a1b0ffd274772cdefc5ba095eece54497b0562452e0ea1caf5998bb486d5b630                                                 2.9s
 => => extracting sha256:d18be28244641f4edd769e324a504255161c59fef2d5759b4daad764090536f1                                                 0.0s
 => => extracting sha256:84b68504ace9fdb7e306032e2adf1d297b591f087627c533b121b03e5ace5e1b                                                 0.2s
 => => extracting sha256:4164c41cf3f401bd706f091c14f5deb30cfd58d065cdd074b0b704b22afaf14f                                                 0.0s
 => => extracting sha256:3fb1ddd3dd35c3ad1fff159bf905b70255b82a38083e7689184f019e1bb23015                                                 0.0s
 => => extracting sha256:a8b19ab041956cc518363726acd71c703078bc71ca46279445dbe0d462b1c1bb                                                 0.1s
 => => extracting sha256:f57d376bb3a0f60e5db4e2b6dafba6cb615317f1cf6786be9fbd3f4964ee8f2d                                                 0.0s
 => => extracting sha256:a6fd57f1ea3b0bfa9905533da0a6ad95282654436572f070bfecd37e3c2f0bc0                                                 0.3s
 => => extracting sha256:72291c43daaef417a15fef16d39cb93cac029702c6363b3987d3fd4f188b5152                                                 0.0s
 => => extracting sha256:9ce309a3039b5bc7964ccd757117989c575df5cd63333df508ef51e0fbe24376                                                 0.0s
 => => extracting sha256:05d50c88bf0d113b15f086cff2d9fd3a90f6ccc81b4e97c36f770414a3dfec8b                                                 0.0s
 => => extracting sha256:2226ab8414c1d8a8a9feb592a2fd11f7978715bf7e3fc28e2265dacdf34b62d5                                                 0.0s
 => => extracting sha256:4f4fb700ef54461cfa02571ae0db9a0dc1e0cdb5577484a6d75e68dc38e8acc1                                                 0.0s
 => [internal] load build context                                                                                                         0.0s
 => => transferring context: 2.34kB                                                                                                       0.0s
 => [2/3] RUN docker-php-ext-install pdo pdo_mysql mysqli                                                                                10.8s
 => [3/3] COPY app/ /var/www/html/                                                                                                        0.0s 
 => exporting to image                                                                                                                    0.0s 
 => => exporting layers                                                                                                                   0.0s 
 => => writing image sha256:ab906c3119cf0b6a7a213931584cc7aa381517933276f84ae9f5c30c6094d299                                              0.0s 
 => => naming to docker.io/library/lab2-php-app                                                                                           0.0s 
                                                                                                                                               
What's next:
    View a summary of image vulnerabilities and recommendations → docker scout quickview 
ronaldoattamah@QQWFK990LC lab2-php-mysql % docker run -d --name php-app --network lab2-network -p 8081:80 lab2-php-app
e383d6eb4d4ceee30f6497665b7a00d97279c11a7f7e16f57db353cf38c2baff
ronaldoattamah@QQWFK990LC lab2-php-mysql % docker ps
CONTAINER ID   IMAGE          COMMAND                  CREATED          STATUS          PORTS                                         NAMES
e383d6eb4d4c   lab2-php-app   "docker-php-entrypoi…"   33 seconds ago   Up 33 seconds   0.0.0.0:8081->80/tcp, [::]:8081->80/tcp       php-app
9b3632ca499c   mysql:8.0      "docker-entrypoint.s…"   16 minutes ago   Up 16 minutes   0.0.0.0:3307->3306/tcp, [::]:3307->3306/tcp   mysql-db
3bf1eb311ecc   lab1-nginx     "/docker-entrypoint.…"   37 minutes ago   Up 37 minutes   0.0.0.0:8080->80/tcp, [::]:8080->80/tcp       lab1-container
ronaldoattamah@QQWFK990LC lab2-php-mysql % docker logs php-app
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.20.0.3. Set the 'ServerName' directive globally to suppress this message
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.20.0.3. Set the 'ServerName' directive globally to suppress this message
[Thu Mar 19 19:14:28.494276 2026] [mpm_prefork:notice] [pid 1:tid 1] AH00163: Apache/2.4.66 (Debian) PHP/8.2.30 configured -- resuming normal operations
[Thu Mar 19 19:14:28.494336 2026] [core:notice] [pid 1:tid 1] AH00094: Command line: 'apache2 -D FOREGROUND'
ronaldoattamah@QQWFK990LC lab2-php-mysql % 
