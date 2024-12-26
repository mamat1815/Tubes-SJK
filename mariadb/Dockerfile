
# Gunakan base image Ubuntu
FROM ubuntu:latest

# Install MariaDB
RUN apt-get update && \
    apt-get install -y mariadb-server && \
    apt-get clean

# Expose port 3306 untuk akses MariaDB
EXPOSE 3306

# Jalankan MariaDB sebagai proses utama container
CMD ["mysqld"]

