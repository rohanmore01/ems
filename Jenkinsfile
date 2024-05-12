pipeline {
    agent any 
    
    stages{
        stage("Clone Code"){
            steps {
                echo "Cloning the code"
                git url:"https://github.com/rohanmore01/ems.git", branch: "main"           
            }
        }
        stage("Build"){
            steps {
                echo "Building the image"
                sh "docker build -t ems ."
            }
        }
        stage("Push to Docker Hub"){
            steps {
                echo "Pushing the image to docker hub"
                withCredentials([usernamePassword(credentialsId:"dockerCred",passwordVariable:"dockerHubPass",usernameVariable:"dockerHubUser")]){
                sh "docker tag ems ${env.dockerHubUser}/ems:latest"
                sh "docker login -u ${env.dockerHubUser} -p ${env.dockerHubPass}"
                sh "docker push ${env.dockerHubUser}/ems:latest"
                }
            }
        }
        stage("Deploy"){
            steps {
                echo "Deploying the container"
                sh "docker-compose down && docker-compose up -d"     
            }
        }
    }
}