#!/bin/bash

install_composer_dependencies() {
    echo "Installing Composer dependencies..."
    composer install
}

install_npm_dependencies_and_gulp() {
    echo "Installing npm dependencies..."
    npm install

    echo "Running gulp scripts..."
    npx gulp scripts
}

create_symlink_with_composer() {
    echo "Creating symlink with Composer..."
    composer make:symlink
}

run_docker_compose() {
    echo "Running Docker Compose..."
    docker-compose up -d
    sleep 5
}

run_migration() {
    echo "Running migration..."
    composer run:migration
}

run_server() {
     echo "Running server..."
     composer run:server
}

main() {
    install_composer_dependencies
    install_npm_dependencies_and_gulp
    create_symlink_with_composer
    run_docker_compose
    run_migration
    run_server
}

main