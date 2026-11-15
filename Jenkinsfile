pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "gestion-institutions-religieuses"
    }

    stages {
        stage('Checkout') {
            steps {
                // Récupère le code source depuis le dépôt GitHub
                git branch: 'main', url: 'https://github.com/ibadiane814-beep/gestion-institutions-religieuses.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist'
                sh 'npm install'
            }
        }

        stage('Build Assets') {
            steps {
                sh 'npm run build'
            }
        }

        stage('Run Tests') {
            steps {
                sh 'php artisan test'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t $DOCKER_IMAGE:latest .'
            }
        }

        stage('Deploy') {
            steps {
                sh 'docker compose down'
                sh 'docker compose up -d --build'
            }
        }
    }

    post {
        success {
            echo 'Pipeline exécuté avec succès : application déployée.'
        }
        failure {
            echo 'Le pipeline a échoué. Vérifier les logs ci-dessus.'
        }
    }
}
