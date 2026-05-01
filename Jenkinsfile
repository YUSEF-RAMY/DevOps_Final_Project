pipeline {
    agent any

    environment {
        // اسم المستخدم الخاص بيكِ على Docker Hub
        DOCKER_HUB_USER = 'rawanfawzy05'
        // اسم المشروع (تقدري تغيريه لو حابه اسم تاني للصورة)
        APP_NAME        = 'devops-final-project'
        // تعريف رقم الـ Build كـ Tag للصورة لضمان عدم التكرار
        IMAGE_TAG       = "${env.BUILD_ID}"
    }

    stages {
        stage('Cleanup & Preparation') {
            steps {
                echo 'Cleaning workspace and preparing for build...'
                deleteDir() 
                checkout scm
            }
        }

        stage('Docker Build') {
            steps {
                echo "Building Docker Image for Rawan: ${APP_NAME}:${IMAGE_TAG}"
                // بيستخدم الـ Dockerfile اللي جيه من برانش الـ dockerization
                script {
                    sh "docker build -t ${DOCKER_HUB_USER}/${APP_NAME}:${IMAGE_TAG} ."
                    sh "docker tag ${DOCKER_HUB_USER}/${APP_NAME}:${IMAGE_TAG} ${DOCKER_HUB_USER}/${APP_NAME}:latest"
                }
            }
        }

        stage('Kubernetes Validation') {
            steps {
                echo 'Validating Kubernetes YAML files...'
                // بيتأكد إن ملفات الـ YAML اللي في فولدر k8s (زي app-deployment و mysql-setup) سليمة
                sh "kubectl apply -f k8s/ --dry-run=client"
            }
        }

        stage('Push to Docker Hub') {
            steps {
                echo 'Logging into Docker Hub and Pushing Image...'
                /* 
                   ملحوظة هامة: لازم تضيفي الـ Credentials في جينكنز باسم 'docker-hub-creds'
                   عشان السطر اللي جاي يشتغل بأمان.
                */
                

                  withCredentials([usernamePassword(credentialsId: 'docker-hub-creds', passwordVariable: 'DOCKER_PASS', usernameVariable: 'DOCKER_USER')]) {
                    sh "echo \$DOCKER_PASS | docker login -u \$DOCKER_USER --password-stdin"
                    sh "docker push ${DOCKER_HUB_USER}/${APP_NAME}:${IMAGE_TAG}"
                    sh "docker push ${DOCKER_HUB_USER}/${APP_NAME}:latest"
                  }
                

            }
        }

        stage('K8s Deployment') {
            steps {
                echo 'Deploying to Local Minikube Cluster...'
                // تحديث الـ Deployment بملفات الـ YAML اللي مدموجة عندك
                sh "kubectl apply -f k8s/"
                sh "kubectl get pods"
            }
        }
    }

    post {
        success {
            echo "Congratulations Rawan! Pipeline for ${APP_NAME} finished successfully."
        }
        failure {
            echo "Pipeline failed. Check the logs in Jenkins to fix the issue."
        }
    }
}