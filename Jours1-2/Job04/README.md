- https://hub.docker.com/_/php  
`(meilleur lien fourni dans le pdf des consignes)`
![alt text](images/00-dockerhub_instructions.png)

- `docker build -t jour04-app .` 
 ![alt text](images/01-build_image.png)

- `docker run -d --name jour04-app -p 8080:80 jour04-app`
  ![alt text](images/01-dockerdesktop_container.png)